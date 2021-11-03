<?php 
    include_once('header.php');
    include_once('styles-login.php')
?>
   
    <div class="contenedor ">
        <div class="cabecera">
            <h2>ALTA USUARIO</h2>
        </div>
        <form action="<?php echo FRONT_ROOT. "Home/StudentRegister" ?>" method="POST" id="formulario">

           
            
            <div class="form-control">
                <label for="email">E-mail</label>
                <input name="email" id="email" type="email">
                <p></p>
                <label for="pass">Password</label>
                <input name="password" id="pass" type="password">
                <p></p>   
                <!-- <label for="apellido">Apellido</label>
                <input name="text" id="apellido" type="password">
                <p></p>    
                <label for="pass">DNI</label>
                <input name="number" id="pass" type="password">
                <p></p> -->
                <a href="<?= FRONT_ROOT ?>Home/ShowLoginView" class="ml-2"><-Volver</a>
                         
            </div>
            <button type="submit" name="button">Registrarse</button>      
          


            
           
        </form>
    </div>
