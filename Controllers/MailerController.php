<?php

namespace Controllers;

require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use DAO\PostulationDAOPDO as PostulationDAOPDO;
use DAO\StudentDAOPDO as StudentDAOPDO;
use DAO\JobOfferDAOPDO as JobOfferDAOPDO;
use Models\Postulation as Postulation;
use Models\Student as Student;
use Models\JobOffer as JobOffer;

class MailerController
{

    private $mail;
    private $jobOfferDAO;
    private $studentDAO;
    private $postulationDAO;


    public function __construct()
    {
        $this->mail = new PHPMailer;
        $this->jobOfferDAO = new JobOfferDAOPDO();
        $this->postulationDAO = new PostulationDAOPDO();
        $this->studentDAO = new StudentDAOPDO();

        // $fname = $_POST['fname'];
        // $toemail = $_POST['toemail'];
        // $subject = $_POST['subject'];
        // $message = $_POST['message'];
        $this->mail->isSMTP();
        $this->mail->Host = 'smtp.gmail.com';
        $this->mail->SMTPAuth = true;
        $this->mail->Username = 'maildeprueba2914@gmail.com';
        $this->mail->Password = 'boquita1212';
        $this->mail->SMTPSecure = 'tls';
        $this->mail->Port = 587;
        $this->mail->setFrom('maildeprueba2914@gmail.com', 'Find a Job UTN');
        $this->mail->addReplyTo('maildeprueba2914@gmail.com', 'Find a Job UTN');
        // $this->mail->addAddress($toemail);

        $this->mail->isHTML(true);
    }

    public function sender($toemail, $subject, $message)
    {
        $bodyContent = $message;
        $bodyContent = 'Estimado estudiante de la UTN';
        $bodyContent .= '<p>' . $message . '</p>';
        $bodyContent .= 'Find a Job UTN - ' . date('Y');

        $this->mail->Body = $bodyContent;
        $this->mail->addAddress($toemail);
        $this->mail->Subject = $subject;

        if (!$this->mail->send())
            echo 'Error: ' . $this->mail->ErrorInfo;
        else{    
            (new JobOfferController)->ShowListView();
            echo sprintf("<script>alert('Enviado a: %s ');</script>", $toemail); 
        }
    }

    public function sendMail($jobOfferId)
    {
        $studentFound = null;
        $jobOfferFound = null;
        $postulationList = $this->postulationDAO->GetAll();
        $studentList = $this->studentDAO->GetAll();
        $jobOfferFound = $this->jobOfferDAO->GetById($jobOfferId);



        foreach ($postulationList as $postulation) {
            if ($postulation->getJobOffer() == $jobOfferFound) {
                $studentFound = $postulation->getStudent();
                foreach ($studentList as $student) {
                    if ($studentFound == $student->getStudentId()) {
                        $studentFound = $student;
                        $this->sender("" . $studentFound->getEmail() . "", "from " . $jobOfferFound->getCompany()->getNombre() . " ", "<br> La oferta " . $jobOfferFound->getTitle() . " culmino. <br>Si fuiste aplicado en la breverdad nos estaremos comunicando con vos. <br>Desde ya muchas gracias por confiar en  " . $jobOfferFound->getCompany()->getNombre() . "");
                        
                    }
                }
                //$this->sender("coronelnico5@gmail.com", "from ".$jobOfferFound->getCompany()->getNombre()." ", "<br> La oferta ".$jobOfferFound->getTitle()." culmino. <br>Si fuiste aplicado en la breverdad nos estaremos comunicando con vos. <br>Desde ya muchas gracias por confiar en  ".$jobOfferFound->getCompany()->getNombre()."");
            }
        }
        $jobOfferFound->setActive(0);
        
        $this->jobOfferDAO->Modify($jobOfferFound);
        

    }
}
