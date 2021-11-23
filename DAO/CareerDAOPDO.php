<?php
    namespace DAO;

    use Models\Career as Career;
    

    class CareerDAOPDO {

        private $careerList;


        public function GetCareerListFromAPI()
        {
           $this->careerList = array();
           $url = curl_init();
           curl_setopt($url, CURLOPT_URL, 'https://utn-students-api2.herokuapp.com/api/Career');
           curl_setopt($url, CURLOPT_HTTPHEADER, array('x-api-key:4f3bceed-50ba-4461-a910-518598664c08'));
           curl_setopt($url, CURLOPT_RETURNTRANSFER, 1);
           curl_setopt($url, CURLOPT_SSL_VERIFYPEER, false); 
           $response = curl_exec($url);
           $toJson = json_decode($response);
            
        //    var_dump($toJson);
    
            foreach ($toJson as $valuesArray) {
                $career = new Career();
                $career->setCareerId($valuesArray->careerId);
                $career->setDescription($valuesArray->description);
                $career->setActive($valuesArray->active);
    
                array_push($this->careerList, $career);
            }
            return $this->careerList;
        }
    

        public function GetCareer($id){
            $careerList = $this->GetCareerListFromAPI();
            
            foreach ($careerList as $values) {
                if($values->getCareerId() == $id){
                    return $values->getDescription();
                }
            }

        }

        
    }