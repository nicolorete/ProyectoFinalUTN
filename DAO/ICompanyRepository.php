<?php
    namespace DAO;

    use Models\Company as Company;

    interface ICompanyRepository
    {
        public function Add(Company $company);
        public function GetAll();
        public function GetCompanyByID($companyId);
        public function GetCompanyByName($companyName);
        public function Delete($companyId);
        public function Modify(Company $Company);
    }

?>