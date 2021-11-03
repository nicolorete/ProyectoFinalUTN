<?php
    namespace Controllers;

    use DAO\JobOfferDAOPDO as JobOfferDAO;
    use DAO\JobPositionDAOPDO as JobPositionDAO;
    use DAO\CompanyDAOPDO as CompanyDAO;
    use Models\JobOffer as JobOffer;
    


    class JobOfferController {
        private $jobOfferDAO;


        public function __construct()
        {
            $this->jobOfferDAO = new JobOfferDAO();
        }

        public function ShowAddView(){
            require_once(VIEWS_PATH. "joboffer-add.php");
        }
        public function ShowListView(){
            require_once(VIEWS_PATH. "joboffer-list.php");
        }

    }