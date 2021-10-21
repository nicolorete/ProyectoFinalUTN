<?php

namespace Controllers;


class DashboardController
{



    function __construct()
    {
        
    }

    public function Index($message = "")
    {
        
        if (isset($_SESSION['loggedUser'])) {
            $loggedUser = $_SESSION['loggedUser'];
            if ($loggedUser->getRole() == 1) {

                require_once(VIEWS_PATH . 'admin-view.php');
            } else {

                require_once(VIEWS_PATH . 'user-dashboard.php');
            }
        } else {

            require_once(VIEWS_PATH . 'home.php');
        }
    }


    public function Logout()
    {
        session_destroy();
        echo "<script>alert('Gracias. Vuelva pronto...')</script>";
        require_once(VIEWS_PATH . 'home.php');
    }
}
