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
            $this->fileName = dirname(__DIR__)."/Data/company.json";
        }

        public function addCompany(Company $company)
        {
            $this->retrieveData();

            array_push($this->companyList, $company);

            $this->saveData();
        }

        public function getAll()
        {
            $this->retrieveData();

            return $this->companyList;
        }

        public function removeCompany($companyId)
		{
			$flag = false;
			$companyList = $this->retrieveData();
			$i=0;
			foreach ($this->companyList as $company) 
			{
				if($company->getCompanyId() == $companyId)
				{
					unset($companyList[$i]);
					//die(var_dump($id));
					$flag = true;
				}else
				{
					$company->setCompanyId($i+1);
					$i++;
				}
			}
			$this->saveData($companyList);
			return $flag;
		}

        public function saveData()
        {
            $arrayToEncode = array();

            foreach($this->companyList as $company)
            {
                $valuesArray["companyId"] = $company->getCompanyId();
                $valuesArray["cuit"] = $company->getCuit();
                $valuesArray["nombre"] = $company->getNombre();
                $valuesArray["descripcion"] = $company->getDescripcion();
                $valuesArray["link"] = $company->getLink();
                $valuesArray["active"] = $company->getActive();
            
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
                    $company->setDescripcion($valuesArray["descripcion"]);
                    $company->setLink($valuesArray["link"]);
                    $company->setActive($valuesArray["active"]);

                    array_push($this->companyList, $company);
                }
            }

        }
    }

?>