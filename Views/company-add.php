<html>
    <head>
        <title>Agregar Empresa</title>
    </head>
    <body>
        <form action="../Controllers/CompanyController.php" method="post">
            <table>
                <tr>
                    <td>ID</td>
                    <td><input type="number" name="companyId" placeholder="Id" value=""></td>                    
                </tr>
                <tr>
                    <td>Cuit</td>
                    <td><input type="text" name="cuit" placeholder="Cuit" value=""></td>
                </tr>
                <tr>                    
                    <td>Nombre</td>
                    <td><input type="text" name="nombre" placeholder="Nombre" value=""></td>
                </tr>
                <tr>                    
                    <td>Descripcion</td>
                    <td><input type="text" name="descripcion" placeholder="Descripcion" value=""></td>
                </tr>
                <tr>                    
                    <td>Link</td>
                    <td><input type="text" name="link" placeholder="Link" value=""></td>
                </tr>
               
                <tr>
                    <td colspan="3"><button type="submit">Agregar</button></td>
                </tr>
            </table>
        </form>
        <br>
        <a href="company-list.php">Listar Empresas</a>
    </body>
</html>