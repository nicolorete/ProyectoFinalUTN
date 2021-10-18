<?php
    
    use DAO\CompanyRepository as CompanyRepository;
    use Models\Company as Company;

    $companyRepository = new CompanyRepository();

    $companyList = $companyRepository-> getAll();

?>


<html>
    <head>
        <title>Listar Empresas</title>
    </head>
    <body>
        <table>
            <tr>
                <th>CompanyID</th>
                <th>Cuit</th>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Link</th>
                <th>Active</th>
            </tr>
            <?php
                foreach($companyList as $company)
                {
                    ?>
                        <tr>
                            <td><?php echo $company->getCompanyId() ?></td>
                            <td><?php echo $company->getCuit() ?></td>
                            <td><?php echo $company->getNombre() ?></td>
                            <td><?php echo $company->getDescripcion() ?></td>
                            <td><?php echo $company->getLink() ?></td>
                            <td><?php echo $company->getActive() ?></td>
                        </tr>
                    <?php
                }
            ?>            
        </table>        
        <br>
        <a href="index.php">Volver</a>
    </body>
</html>