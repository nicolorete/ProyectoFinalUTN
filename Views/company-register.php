<?php 
    include_once('header.php');
    include_once('styles-login.php')
?>
   
    <div class="contenedor ">
        <div class="cabecera">
            <h2>ALTA EMPRESA</h2>
        </div>
        <form action="<?php echo FRONT_ROOT. "Company/registerUserCompany" ?>" method="POST" id="formulario">

           
            
            <div class="form-control">
                <label for="email">E-mail</label>
                <input name="email" id="email" type="email">
                <p></p>
                <label for="password">Password</label>
                <input name="password" id="password" type="password">
                <p></p>   
                <div class="field">
                                    <label class="label">Cuit </label>
                                    <div class="control">
                                        <input class="input" name="cuit" type="text" placeholder="Cuit de la empresa" required="">
                                    </div>
                                </div>

                                <div class="field">
                                    <label class="label">Nombre</label>
                                    <div class="control">
                                        <input class="input" name="nombre" type="text" placeholder="Nombre de la Empresa" required="">
                                    </div>
                                </div>

                                <div class="field">
                                    <label class="label">Direccion</label>
                                    <div class="control">
                                        <input class="input" name="address" type="address" placeholder="Direccion" required="">
                                    </div>
                                </div>

                                <div class="field">
                                    <label class="label">Link</label>
                                    <div class="control">
                                        <input class="input" name="link" type="text" placeholder="ej: www.google.com" required="">
                                    </div>
                                </div>
                                <div class="field">
                                    <label class="label">Empresa activa?: </label>
                                    <div class="control">
                                        <select class="select" id="active" name="active">
                                            <option value="1">Si</option>
                                            <option value="0">No</option>
                                        </select>

                                     </div>
                                </div>
                <a href="<?= FRONT_ROOT ?>Home/ShowLoginView" class="ml-2"><-Volver</a>
                         
            </div>
            <button type="submit" name="button">Registrarse</button>      
          


            
           
        </form>
    </div>
