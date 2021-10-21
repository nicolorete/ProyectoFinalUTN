<?php
    namespace Controllers;

    use DAO\CompanyRepository as CompanyDAO;
    use Models\Company as Company;

    class CompanyController
    {
        private $companyDAO;

        public function __construct()
        {
            $this->companyDAO = new CompanyDAO();
        }

        public function ShowAddView()
        {
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."company-add.php");
        }

        public function ShowListView()
        {
            require_once(VIEWS_PATH."validate-session.php");
            $companyList = $this->companyDAO->getAll();
            
            require_once(VIEWS_PATH."company-list.php");
        }

        public function Add($cuit, $nombre, $address, $link)
        {
            require_once(VIEWS_PATH."validate-session.php");

            $company = new Company();
            $company->setCuit($cuit);
            $company->setNombre($nombre);
            $company->setAddress($address);
            $company->setLink($link);

            $this->companyDAO->addCompany($company);

            $this->ShowAddView();
        }

        public function Delete($id)
        {
            require_once(VIEWS_PATH."validate-session.php");
            
            $this->companyDAO->Delete($id);

            $this->ShowListView();
        }


        public function Modify($companyId, $cuit, $nombre, $address, $link, $active)
        {
            $companyNew = new Company();
            $companyNew->setCompanyId($companyId);
            $companyNew->setCuit($cuit);
            $companyNew->setNombre($nombre);
            $companyNew->setAddress($address);
            $companyNew->setLink($link);
            $companyNew->setIsActive($active);
    
            $this->companyDAO->Modify($companyNew);
    
            $message = 'Empresa modificada!';
            $this->ShowListView($message);
        }
    }
?>