<?php 
    include_once('header.php');
    include_once('styles-login.php')
?>
   
    <div class="contenedor">
        <div class="cabecera">
            <h2>INICIAR SESIÓN</h2>
        </div>
        <form action="<?php echo FRONT_ROOT."Home/Login" ?>" method="post" id="formulario">

           
            <div class="form-control">
                <label for="email">E-mail</label>
                <input name="email" id="email" type="user">
                <p></p>                
            </div>

            <div class="form-control">
                <label for="pass">Password</label>
                <input name="password" id="pass" type="password">
                <p></p>                
            </div>

            <div class="form-control">
					No estas registrado? <a href="<?= FRONT_ROOT ?>Student/ShowRegisterView" class="ml-2">Registrarse</a>
			</div>

            <!-- <div class="form-control">
					Eres una emrpesa? <a href="<?= FRONT_ROOT ?>Company/ShowCompanyLogin" class="ml-2">Inciar sesion como empresa</a>
			</div> -->
           
            <button type="submit" name="button">Login</button>
            
            
           
        </form>
    </div>

    <script>
        window.addEventListener('load', ()=> {
    const form = document.querySelector('#formulario')
    const usuario = document.getElementById('usuario')
    //const email = document.getElementById('email')
    const pass = document.getElementById('pass')
    const passConfirma = document.getElementById('passConfirma')

    form.addEventListener('submit', (e) => {
        //e.preventDefault()
        validaCampos()
    })
    
    const validaCampos = ()=> {
        //capturar los valores ingresados por el usuario
       
        const emailValor = email.value.trim()
        const passValor = pass.value.trim()
        
     
        //validando campo usuario
        //(!usuarioValor) ? console.log('CAMPO VACIO') : console.log(usuarioValor)
     

        //validando campo email
        // if(!emailValor){
        //     validaFalla(email, 'Campo vacío')            
        // }else if(!validaEmail(emailValor)) {
        //     validaFalla(email, 'El e-mail no es válido')
        // }else {
        //     validaOk(email)
        // }
         //validando campo password
         const er = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,18}$/          
         if(!passValor) {
             validaFalla(pass, 'Campo vacío')
         } else if (passValor.length < 4) {             
             validaFalla(pass, 'Debe tener 4 caracteres cómo mínimo.')
         } else {
             validaOk(pass)
         }

        

    }

    const validaFalla = (input, msje) => {
        const formControl = input.parentElement
        const aviso = formControl.querySelector('p')
        aviso.innerText = msje

        formControl.className = 'form-control falla'
    }
    const validaOk = (input, msje) => {
        const formControl = input.parentElement
        formControl.className = 'form-control ok'
    }

    const validaEmail = (email) => {
        return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);        
    }

})
</script>

