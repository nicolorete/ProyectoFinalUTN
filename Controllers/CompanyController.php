<?php

    use DAO\CompanyRepository as CompanyRepository;
    use Models\Company as Company;

    if($_POST)
    {
        $companyId = $_POST["companyId"];
        $cuit = $_POST["cuit"];
        $nombre = $_POST["nombre"];
        $descripcion = $_POST["descripcion"];
        $link = $_POST["link"];
        //$active = $_POST["active"];

        $company = new Company();
        $company->setCompanyId($companyId);
        $company->setCuit($cuit);
        $company->setNombre($nombre);
        $company->setDescripcion($descripcion);
        $company->setLink($link);
        //$company->setActive($active);

        $companyRepository = new CompanyRepository();

        $companyRepository->addCompany($company);
    }
    header("location:Views/company-add.php");

    ?>