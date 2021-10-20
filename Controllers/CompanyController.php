<?php
    namespace Controllers;

    use DAO\CompanyRepository as CompanyRepository;
use Exception;
use Models\Company as Company;

    // if($_POST)
    // {
    //     $companyId = $_POST["companyId"];
    //     $cuit = $_POST["cuit"];
    //     $nombre = $_POST["nombre"];
    //     $address = $_POST["address"];
    //     $link = $_POST["link"];
    //     //$active = $_POST["active"];

    //     $company = new Company();
    //     $company->setCompanyId($companyId);
    //     $company->setCuit($cuit);
    //     $company->setNombre($nombre);
    //     $company->setAddress($address);
    //     $company->setLink($link);
    //     //$company->setActive($active);

    //     $companyRepository = new CompanyRepository();

    //     $companyRepository->addCompany($company);
    // }
    
    class CompanyController 
    {
        private $companyRepository;

        public function __construct()
        {
            $this->companyRepository = new CompanyRepository();
        }


        
    public function validaRequerido($valor)
    {
        if (trim($valor) == '') {
            return false;
        } else {
            return true;
        }
    }

    public function validarEntero($valor, $opciones = null)
    {
        if (filter_var($valor, FILTER_VALIDATE_INT, $opciones) === FALSE) {
            return false;
        } else {
            return true;
        }
    }



        public function Add($cuit, $nombre, $address, $link)
        {
            try {
                if ($_POST) {
                    isset($_POST['cuit']) ? $cuit = $_POST['cuit'] : $cuit = '';
                    
                    isset($_POST['nombre']) ? $nombre = $_POST['nombre'] : $nombre = '';
                    
                    isset($_POST['address']) ? $address = $_POST['address'] : $address = '';

                    isset($_POST['link']) ? $link = $_POST['link'] : $link = '';
    
                    
                    $errores = array();
    
    
                    $cuitOK = $this->validaRequerido($cuit);
                    $nameOK = $this->validaRequerido($nombre);
                    $addresOK = $this->validaRequerido($address);
                    $linkOK = $this->validaRequerido($link);


    
                    if (!$cuitOK) {
                        $errores[] = 'El campo nombre es incorrecto.';
                    }
                    if (!$nameOK) {
                        $errores[] = 'El campo nombre es incorrecto.';
                    }
                    if (!$addresOK) {
                        $errores[] = 'El campo nombre es incorrecto.';
                    }
                    if (!$linkOK) {
                        $errores[] = 'El campo nombre es incorrecto.';
                    }
    
                    if (!$errores) {
                        # Creo el Cine y le asigno los datos
                        $company = new Company();
                        $company-> setCuit($cuit);
                        $company->setNombre($nombre);
                        $company->setAddress($address);
                        $company->setLink($link);
    
                        $encontrado = null;
                        $encontrado = $this->companyDAO->GetcompanyByName($company->getNombre());
    
                        // # Recorro cuantas salas hay en arreglo. 
                        // # Creo las salas y las guardo en un arreglo.  
    
                        // for ($i = 0; $i < count($arregloNombreSalas); $i++) {
                        //     if ($arregloCapacidadSalas[$i] != NULL && $arregloCapacidadSalas[$i] > 0 && $arregloNombreSalas[$i] != NULL && $arregloPrecioSalas[$i] != NULL && $arregloPrecioSalas[$i] > 0) {
    
                        //         $newSala = new Sala();
                        //         $newSala->setName($arregloNombreSalas[$i]);
                        //         $newSala->setCapacity($arregloCapacidadSalas[$i]);
                        //         $newSala->setPrice($arregloPrecioSalas[$i]);
                        //         array_push($arraySalas, $newSala);
                        //     } else {
                        //         // MENSAJE QUE NO SON  MAYORES LOS DATOS
                        //         $errores[] = 'El campo nombre es incorrecto.';
                        //         $message = "COMPLETE LOS CAMPOS CON VALORES VALIDOS";
                        //         $this->ShowAddView($message);
                        //     }
                        // }
    
                        if (!$errores) {
                            // VALIDO QUE NO HAYA UNA EMPRESA AGREGADA
                            if ($encontrado) {
                                //MENSAJE QUE YA EXISTE LA EMPRESA
                                $message = 'Ya existe la empresa que intenta ingresar';
                                $this->ShowListView($message);
                            } else {
                                $this->companyRepository->addCompany($company);
                                $message = "Cine agregado satisfactoriamente!";
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

        # Vista para registrar dar de ALTA un CINE
    public function ShowAddView($message = "")
    {
        try {
            if (isset($_SESSION['loggedUser'])) {
                $loggedUser = $_SESSION['loggedUser'];
                if ($loggedUser->getRole() == 1) {
                    require_once(VIEWS_PATH . 'company-add.php');
                } else {
                    $message = 'Necesita ser admin!';
                    //$proyectionInCartelera = $this->proyectionDAO->GetAllForCartelera();
                    //require_once(VIEWS_PATH . 'search-proyection.php');
                }
            } else {
                $message = 'Debe iniciar sesion';
                require_once(VIEWS_PATH . 'login.php');
            }
        } catch (Exception $ex) {
            $message = $ex->getMessage() . 'Oops ! \n\n Hubo un problema al intentar mostrar la Pagina.';
        }
    }

      # Muestra la vista que lista los cines
      public function ShowListView($message = '')
      {
          try {
              $companyList = null;
              if (isset($_SESSION['loggedUser'])) {
                  $loggedUser = $_SESSION['loggedUser'];
                  if ($loggedUser->getRole() == 1) {
                      $companyList = $this->companyRepository->GetAll();
  
                      if ($companyList != null) {
                          require_once(VIEWS_PATH . "cinema-list.php");
                      } else {
                          throw new Exception("No hay cines en la base de datos!");
                      }
                  } else {
                      $message = 'Necesita ser admin!';
                      $proyectionInCartelera = $this->proyectionDAO->GetAllForCartelera();
                      require_once(VIEWS_PATH . 'search-proyection.php');
                  }
              } else // No está logueado.  
              {
                  $message = "debe iniciar sesion";
                  require_once(VIEWS_PATH . 'login.php');
              }
          } catch (Exception $ex) {
              $message = 'Oops ! ' . $ex->getMessage();
          } finally {
              require_once(VIEWS_PATH . 'cinema-list.php');
          }
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
  
          $this->companyRepository->Modify($companyNew);
  
          $message = 'Compania modificada!';
          $this->ShowListView($message);
      }
  
      public function Delete($nombre)
      {
          $companyFound = null;
          $companyFound = $this->companyRepository->GetCompanyByName($nombre);
          if ($companyFound != null) {
              if ($companyFound->getIsActive() == 1) {
                  $companyFound->setIsActive(0);
                  $message = 'Empresa dada de BAJA. No eliminada!';
              } else {
                  $companyFound->setIsActive(1);
                  $message = 'Empresa dada de ALTA!';
              }
          }
          $this->companyRepository->Modify($companyFound);
          $this->ShowListView($message);
      }
  

    }


    header("location:Views/company-add.php");

    ?>