<?php
    namespace Controllers;

    use DAO\JobOfferDAOPDO as JobOfferDAO;
    use DAO\JobPositionDAOPDO as JobPositionDAOPDO;
    use DAO\CompanyDAOPDO as CompanyDAOPDO;
    use Models\JobOffer as JobOffer;
    


    class JobOfferController {
        private $jobOfferDAO;


        public function __construct()
        {
            $this->jobOfferDAO = new JobOfferDAO();
        }

        public function ShowAddView(){

            $jobPositionDAO = new JobPositionDAOPDO;
            $jobPositionList = $jobPositionDAO->GetJobPositionListFromApi();
            $companyDAO = new CompanyDAOPDO;
            $companyList = $companyDAO->GetAll();
            require_once(VIEWS_PATH. "joboffer-add.php");
        }

        public function ShowListView(){
            require_once(VIEWS_PATH. "joboffer-list.php");
        }


        public function Add(){

            var_dump($_POST);

        }
    }