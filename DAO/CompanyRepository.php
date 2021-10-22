<?php
    namespace DAO;

    use DAO\ICompanyRepository as ICompanyRepository;
    use Models\Company as Company;

    class CompanyRepository implements ICompanyRepository
    {
        private $companyList = array();
        private $fileName;

        public function __construct()
        {
            $this->fileName = dirname(__DIR__)."/Data/Companys.json";
        }

        public function addCompany(Company $company)
        {
            
            $this->retrieveData();

            $company->setCompanyId($this->GetNextId());
            array_push($this->companyList, $company);

            $this->saveData();
        }

        public function Modify2 (Company $company){
            $this->RetrieveData();
            $companyToModify = null;
            
            $companyToModify = $this->GetCompanyByName($company->getNombre());
            if ($companyToModify != null) {
                $this->Delete($company->getCompanyId());
            }
            array_push($this->companyList, $companyToModify);
            $this->SaveData();
        }

        public function GetAll()
        {
            $this->retrieveData();

            return $this->companyList;
        }

        public function GetCompanyByName($nombre){
            $companyFound = null;
            $this->RetrieveData();
            foreach ($this->companyList as $company) {
                if ($company->getNombre() == $nombre) {
                    $companyFound = $company;
                }
            }
            return $companyFound;
        }


        
        public function Delete($companyId){
            $this->RetrieveData();
            
            $this->companyList = array_filter($this->companyList, function($company) use($companyId){                
                return $company->getCompanyId() != $companyId;
            });
            
            $this->SaveData();
        }



        // public function removeCompany($companyId)
		// {
		// 	$flag = false;
		// 	$companyList = $this->retrieveData();
		// 	$i=0;
		// 	foreach ($this->companyList as $company) 
		// 	{
		// 		if($company->getCompanyId() == $companyId)
		// 		{
		// 			unset($companyList[$i]);
		// 			//die(var_dump($id));
		// 			$flag = true;
		// 		}else
		// 		{
		// 			$company->setCompanyId($i+1);
		// 			$i++;
		// 		}
		// 	}
		// 	$this->saveData($companyList);
		// 	return $flag;
		// }

        public function saveData()
        {
            $arrayToEncode = array();

            foreach($this->companyList as $company)
            {
                $valuesArray["companyId"] = $company->getCompanyId();
                $valuesArray["cuit"] = $company->getCuit();
                $valuesArray["nombre"] = $company->getNombre();
                $valuesArray["address"] = $company->getAddress();
                $valuesArray["link"] = $company->getLink();
                $valuesArray["active"] = $company->getIsActive();
            
                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

            file_put_contents($this->fileName, $jsonContent);
        }

        private function retrieveData()
        {
            $this->companyList = array();

            if(file_exists($this->fileName))
            {
                $jsonContent = file_get_contents($this->fileName);

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $company = new Company();
                    $company->setCompanyId($valuesArray["companyId"]);
                    $company->setCuit($valuesArray["cuit"]);
                    $company->setNombre($valuesArray["nombre"]);
                    $company->setAddress($valuesArray["address"]);
                    $company->setLink($valuesArray["link"]);
                    $company->setIsActive($valuesArray["active"]);

                    array_push($this->companyList, $company);
                }
            }

        }

        public function Modify(Company $company){
            $this->RetrieveData();
    
            foreach ($this->companyList as $companyValue) {
                if ($company->getCompanyId() == $companyValue->getCompanyId()) {
                    $companyValue->setCuit($company->getCuit());
                    $companyValue->setNombre($company->getNombre());                   
                    $companyValue->setAddress($company->getAddress());
                    $companyValue->setLink($company->getLink());
                    $companyValue->setIsActive($company->getIsActive());
                }
            }
            $this->SaveData();
        }


        private function GetNextId()
        {
            $id = 0;

            foreach($this->companyList as $company)
            {
                $id = ($company->getCompanyId() > $id) ? $company->getCompanyId() : $id;
            }

            return $id + 1;
        }
    }

?>