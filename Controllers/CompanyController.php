<?php

namespace Controllers;
// PDO
use DAO\CompanyDAOPDO as CompanyDaoPdo;
use Exception;
// json
// use DAO\CompanyRepository as CompanyDAO;
use Models\Company as Company;

class CompanyController
{
    private $companyDAO;

    public function __construct()
    {
        // $this->companyDAO = new CompanyDAO();
        $this->companyDAO = new CompanyDaoPdo();
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
                    <script>alert('The company already exists!');</script>
                <?php
            }
        } else {
            $company = $this->setCompany($cuit, $nombre, $address, $link, $isActive);
            $this->companyDAO->Add($company);
        }
        $this->ShowAddView();
    }

    private function setCompany($cuit, $nombre, $address, $link, $isActive) {
        $company = new Company();
        $company->setNombre($nombre);
        $company->setCuit($cuit);
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
    public function Modify($companyId, $cuit, $nombre, $address, $link, $isActive)
    {
        // $this->companyDAO->Modify($companyId, $cuit, $nombre, $address, $link, $isActive);
        $companyNew = new Company();
        $companyNew->setCompanyId($companyId);
        $companyNew->setCuit($cuit);
        $companyNew->setNombre($nombre);
        $companyNew->setAddress($address);
        $companyNew->setLink($link);
        $companyNew->setIsActive($isActive); 
        $message = 'Empresa modificada!';
        $this->ShowListView($message);
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

    public function companyFilter($searchedCompany, $companyList) {
        $i = 0;
        if($searchedCompany != ""){
            foreach($companyList as $company){
                if(strpos($company->getNombre(), $searchedCompany) !== false && $company->getIsActive() == 0){
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
    
    public function Delete1($id)
    {
        require_once(VIEWS_PATH."validate-session.php");

        $this->companyDAO->Delete($id);

        $this->ShowListView();
    }
    public function Delete($id)
    {
        $companyFound = null;
        $companyFound = $this->companyDAO->GetCompanyByID($id);
        if ($companyFound != null) {
            if ($companyFound->getIsActive() == 1) {
                $companyFound->setIsActive(0);
                $message = 'Cine dado de BAJA. No eliminado!';
            } else {
                $companyFound->setIsActive(1);
                $message = 'Cine dado de ALTA!';
            }
        }
        $this->companyDAO->Modify($companyFound);
        $this->ShowListView($message);
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function ShowAddView()
    {
        require_once(VIEWS_PATH . "validate-session.php");
        require_once(VIEWS_PATH . "company-add.php");
    }

    public function ShowListView()
    {
        require_once(VIEWS_PATH . "validate-session.php");
        $companyList = $this->companyDAO->getAll();

        require_once(VIEWS_PATH . "company-list.php");
    }

    public function ShowListViewUser()
    {
        require_once(VIEWS_PATH . "validate-session.php");
        $companyList = $this->companyDAO->getAll();

        require_once(VIEWS_PATH . "user-company-list.php");
    }
    
//------------------------------------------------------------------------------------------------------------------
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

}

