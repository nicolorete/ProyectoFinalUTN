<div class="modal" id="exampleModal">
    <div class="modal-background"></div>
    <div class="modal-card">
        <header class="modal-card-head">
            <p class="modal-card-title">Detalle de la Empresa</p>
            <button class="delete" aria-label="close" onclick="document.getElementById('exampleModal').style.display='none'"></button>
        </header>
                          
        <section class="modal-card-body">
            <form action=""method="POST">
                <div class="field">
                   
                    <div class="control">
                        <input class="input" name="idCompany" type="number" placeholder="" id="id" hidden="true">
                    </div>
                </div>

          

                <div class="field">
                    <label class="label">Cuit </label>
                    <div class="control">
                        <label> <?php echo $company->getCuit()?></label>
                    </div>
                </div>


                <div class="field"> 
                    <label class="label">Nombre </label>
                    <div class="control">
                    <label> <?php echo $company->getNombre()?></label>
                    </div>
                </div>

               
                <div class="field">
                    <label class="label">Direccion</label>
                    <div class="control">
                    <label> <?php echo $company->getAddress()?></label>
                    </div>
                </div>

                <div class="field">
                    <label class="label">Link</label>
                    <div class="control">
                        <label><?php echo $company->getLink()?>"</label>
                    </div>
                </div>

               


        </section>

        <footer class="modal-card-foot">
            <!-- <button class="button is-success" type="submit">Modificar</button> -->
            </form>
            <button class="button" onclick="document.getElementById('exampleModal').style.display='none'">Aceptar</button>
        </footer>


    </div>
</div>