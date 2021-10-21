<?php 
    include_once('header.php');
?>
   
    <div class="contenedor">
        <div class="cabecera">
            <h2>INICIAR SESIÓN</h2>
        </div>
        <form action="<?php echo FRONT_ROOT."Home/Login" ?>" method="post" id="formulario">

           
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

    <!-- <script src="js/formularioLogin.js"></script> -->

