<?php

namespace Controllers;
// PDO
use DAO\CompanyDAOPDO as CompanyDaoPdo;
use Exception;
// json
// use DAO\CompanyRepository as CompanyDAO;
use Models\Company as Company;
use Models\UserCompany as UserCompany;
use DAO\UserCompanyDAOPDO as UserCompanyDAOPDO;

class CompanyController
{
    private $companyDAO;
    private $UserCompanyDAOPDO;

    public function __construct()
    {
        $this->companyDAO = new CompanyDaoPdo();
        $this->UserCompanyDAOPDO = new UserCompanyDAOPDO();
    }

    public function Add($cuit, $nombre , $address, $link , $isActive){
        $company = new Company();
        $companyFound = false;
        $companyList = $this->companyDAO->GetAll();
        
        if($companyList){
            foreach($companyList as $companyNew) {
                if($companyNew->getNombre() == $nombre || $companyNew->getCuit() == $cuit){
                    $companyFound = true;
                }
            }
            if($companyFound == false){
                $company = $this->setCompany($cuit, $nombre, $address, $link , $isActive);
                $this->companyDAO->Add($company);
            } else {
                ?>
                    <script>alert('Esa Empresa ya existe!');</script>
                <?php
            }
        } else {
            $company = $this->setCompany($cuit, $nombre, $address, $link, $isActive);
            $this->companyDAO->Add($company);
        }
        $this->ShowAddView();
    }

    public function ShowCompanyLogin(){
		require_once(VIEWS_PATH . 'iniciarCompany.php');
        
    }

    public function Login($email, $password){
        $userCompany = $this->UserCompanyDAOPDO->GetUserCompanyByEmail($email);
        $company = $this->companyDAO->GetCompanyByCuit($userCompany->getCompany());
        $userCompany->setCompany($company);
        $_SESSION['loggedCompany'] = $userCompany;
		require_once(VIEWS_PATH . 'company-view.php');

    }

    private function setCompany($cuit, $nombre, $address, $link, $isActive) {
        $company = new Company();
        $company->setCuit($cuit);
        $company->setNombre($nombre);
        $company->setAddress($address);
        $company->setLink($link);
        $company->setIsActive($isActive);
        return $company;
    }

    public function validaRequerido($valor)
    {
        if (trim($valor) == '') {
            return false;
        } else {
            return true;
        }
    }    
    
    public function registerUserCompany($email, $password, $cuit, $nombre, $address, $link, $isActive){
        // var_dump($email);
        $usercompany = new UserCompany();
        $usercompany->setEmail($email);
        $usercompany->setPassword($password);
        $usercompany->setCompany($cuit);
        $companyFound = false;
        $companyList = $this->companyDAO->GetAll();
        
        if($companyList){
            foreach($companyList as $companyNew) {
                if($companyNew->getNombre() == $nombre || $companyNew->getCuit() == $cuit){
                    $companyFound = true;
                }
            }
            if($companyFound == false){
                $company = $this->setCompany($cuit, $nombre, $address, $link , $isActive);
                $this->companyDAO->Add($company);
                $this->UserCompanyDAOPDO->Add($usercompany);
            } else {
                ?>
                    <script>alert('Esa Empresa ya existe!');</script>
                <?php
            }
        } else {
            $company = $this->setCompany($cuit, $nombre, $address, $link, $isActive);
            $this->companyDAO->Add($company);
            $this->UserCompanyDAOPDO->Add($usercompany);
        }
        $this->ShowCompanyLogin();
    }

    public function searcherCompany($companyFound, $companyList) {
        $i = 0;
        if($companyFound != ""){
            foreach($companyList as $company){
                if(strpos($company->getNombre(), $companyFound) !== false && $company->getIsActive() == 0){
                    $i++;
                    $this->showCompany($company);
                }
            }
        }else{
            foreach($companyList as $company){
                if($company->getActive() == 0){
                    $i++;
                    $this->showCompany($company);
                }
            }
        }
        echo "<br><b>There are ".$i." Result/s!</b>";
    }
    
    public function Delete($id)
    {
        $companyFound = null;
        $companyFound = $this->companyDAO->GetCompanyByID($id);
        if ($companyFound != null) {
            if ($companyFound->getIsActive() == 1) {
                $companyFound->setIsActive(0);
            } else {
                $companyFound->setIsActive(1);
            }
        }
        $this->companyDAO->Modify($companyFound);
        $this->ShowListView();
    }
    public function Modify($companyId, $cuit, $nombre, $address, $link, $isActive)
    {
        $companyNew = new Company();
        $companyNew->setCompanyId($companyId);
        $companyNew->setCuit($cuit);
        $companyNew->setNombre($nombre);
        $companyNew->setAddress($address);
        $companyNew->setLink($link);
        $companyNew->setIsActive($isActive);

        
        $this->companyDAO->Modify($companyNew);
        
        
        $this->ShowListView();
    }

    public function ShowCompany ($company){
        ?>
        <tr>
          <td><?php echo $company->getNombre() ?></td>
          <td><?php echo $company->getCuit() ?></td>
          <td><?php echo $company->getAddress() ?></td>
          <td><?php echo $company->getLink() ?></td>


          </tr>
        <?php

    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function ShowAddView()
    {
        require_once(VIEWS_PATH . "validate-session-admin.php");
        require_once(VIEWS_PATH . "company-add.php");
    }

    public function ShowListView()
    {
        
        $companyList = $this->companyDAO->getAll();

        require_once(VIEWS_PATH . "company-list.php");
    }

    public function ShowListViewUser()
    {
        
        $companyList = $this->companyDAO->GetActive();


        require_once(VIEWS_PATH . "user-company-list.php");
    }

    public function ShowCompanyView($companyId)
	{
		
		$companyFound = null;
		$companyFound = $this->companyDAO->GetCompanyByID($companyId);
		require_once(VIEWS_PATH . 'user-company-view.php');
				
		
	}
    
    public function ShowCompanyEditView($companyId)
	{
		
		$companyFound = null;
		$companyFound = $this->companyDAO->GetCompanyByID($companyId);
		require_once(VIEWS_PATH . 'company-edit.php');
				
		
	}

    // public function Modify($companyId, $cuit, $nombre, $address, $link, $isActive)
	// {   
    //     $companyNew = new Company;
    //     $companyNew = $this->setCompany($cuit, $nombre, $address, $link, $isActive);
    //     var_dump($companyNew);
    //     $this->companyDAO->Modify($companyId, $cuit, $nombre, $address, $link, $isActive);
    //     $this->ShowListView();
	// }
}

