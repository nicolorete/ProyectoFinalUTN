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

    // public function Add($cuit, $nombre, $address, $link)
    // {
    //     require_once(VIEWS_PATH . "validate-session.php");       ----------->      JSON FUNCTION

    //     $company = new Company();
    //     $company->setCuit($cuit);
    //     $company->setNombre($nombre);
    //     $company->setAddress($address);
    //     $company->setLink($link);

    //     $this->companyDAO->addCompany($company);

    //     $this->ShowAddView();
    // }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Add($cuit, $nombre, $address, $link)
    {
        try {
            if ($_POST) {
                isset($_POST['cuit']) ? $cuit = $_POST['cuit'] : $cuit = '';
                isset($_POST['nombre']) ? $nombre = $_POST['nombre'] : $nombre = '';
                isset($_POST['address']) ? $address = $_POST['address'] : $address = '';
                isset($_POST['link']) ? $link = $_POST['link'] : $link = '';

                
                $errores = array();


                $nombreOK = $this->validaRequerido($nombre);
                $addresOK = $this->validaRequerido($address);

                if (!$nombreOK) {
                    $errores[] = 'El campo nombre es incorrecto.';
                }
                if (!$addresOK) {
                    $errores[] = 'El campo address es incorrecto.';
                }

                if (!$errores) {
                    # Creo la empresa y le asigno los datos
                    $company = new Company();
                    $company->setCuit($cuit);
                    $company->setNombre($nombre);
                    $company->setAddress($address);
                    $company->setLink($link);

                    $encontrado = null;
                    $encontrado = $this->companyDAO->GetCompanyByName($company->getNombre());

                    

                    if (!$errores) {
                        // VALIDO QUE NO HAYA UN CINE AGREGADO
                        if ($encontrado) {
                            //MENSAJE QUE YA EXISTE la empresa
                            $message = 'Ya existe la empresa que intenta ingresar';
                            $this->ShowListView($message);
                        } else {
                            $this->companyDAO->Add($company);
                            $message = "Empresa agregada satisfactoriamente!";
                            $this->ShowListView($message);
                        }
                    }
                } else {
                    // MENSAJE QUE NO SON  CORRECTOS
                    $message = "COMPLETE LOS CAMPOS CON VALORES VALIDOS";
                    $this->ShowAddView($message);
                }
            }
        } catch (Exception $ex) {
            $message = 'Oops ! ' . $ex->getMessage();
        }
    }
    public function validaRequerido($valor)
    {
        if (trim($valor) == '') {
            return false;
        } else {
            return true;
        }
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

