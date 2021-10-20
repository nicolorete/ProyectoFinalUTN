<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="contenedor">
        <div class="cabecera">
            <h2>INICIAR SESIÓN</h2>
        </div>
        <form id="formulario" action="login.php" method="post">

           
            <div class="form-control">
                <label for="email">E-mail</label>
                <input name="email" id="email" type="email">
                <p></p>                
            </div>

            <div class="form-control">
                <label for="pass">Password</label>
                <input name="password" id="pass" type="password">
                <p></p>                
            </div>

           
            <button type="submit" name="button">Login</button>
            
           
        </form>
    </div>

    <script src="js/formularioLogin.js"></script>
</body>
</html>



<!-- <body>
        <form action="login.php" method="post">
            <table>
                <tr>
                    <td>Email</td>
                    <td><input type="text" name="email" placeholder="email" value=""></td>                    
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="password" name="password" placeholder="password" value=""></td>
                </tr>                
                <tr>
                    <td colspan="3"><button type="submit">Login</button></td>
                </tr>
            </table>
        </form>
    </body> -->