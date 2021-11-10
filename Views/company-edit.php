<!-- <div class="modal" id="exampleModal"> -->
    <div class="modal-background">
    <div class="modal-card">
        <header class="modal-card-head">
        <?php if ($companyFound != null) { ?>
            <p class="modal-card-title">Modificar Empresa</p>
            <p class="modal-card-title">Detalle de la Empresa : <?= $companyFound->getNombre(); ?></p>
            <!-- <button class="delete" aria-label="close" onclick="document.getElementById('exampleModal').style.display='none'"></button> -->
        </header>

        <section class="modal-card-body">
            <form action="<?= FRONT_ROOT ?>Company/Modify" method="POST">
                <div class="field">
                    
                    <div class="control">
                        <input class="input" name="companyId" type="number" placeholder="" id="companyId" hidden="true">
                    </div>
                </div>

          

                <div class="field">
                    <label class="label">Cuit </label>
                    <div class="control">
                        <input class="input" name="cuit" type="text" placeholder="Cuit" id="cuit" value="<?= $companyFound->getCuit(); ?>">
                    </div>
                </div>


                <div class="field"> 
                    <label class="label">Nombre </label>
                    <div class="control">
                        <input class="input" name="nombre" type="text" placeholder="" id="nombre" value="<?= $companyFound->getNombre()?>">
                    </div>
                </div>

               
                <div class="field">
                    <label class="label">Direccion</label>
                    <div class="control">
                        <input class="input" name="address" type="text" placeholder="Direccion" id="address" value="<?= $companyFound->getAddress()?>">
                    </div>
                </div>

                <div class="field">
                    <label class="label">Link</label>
                    <div class="control">
                        <input class="input" name="link" type="text" placeholder="Direccion" id="address" value="<?= $companyFound->getLink()?>">
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

                <?php } ?>
        </section>

        <footer class="modal-card-foot">
            <button class="button is-success" type="submit">Modificar</button>
            </form>
            <button class="button is-success" onclick="window.history.go(-1); return false;">Cancelar</button>
        </footer>


    </div>
    </div>
