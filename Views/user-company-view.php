<!-- <div class="modal" id="exampleModal"> -->
    <div class="modal-background">
    <div class="modal-card">
        <header class="modal-card-head">
            <!-- <p class="modal-card-title">Detalle de la Empresa</p> -->
            <?php if ($companyFound != null) { ?>
            <p class="modal-card-title">Detalle de la Empresa : <?= $companyFound->getNombre(); ?></p>
            <!-- <button class="delete" aria-label="close" onclick="document.getElementById('exampleModal').style.display='none'"></button> -->
        </header>

        <section class="modal-card-body">
           
       <div class="field">
            <!-- Id Cine (hidden) -->
            <div class="control">
                <input class="input" name="companyId" type="number" placeholder="Nombre del Cine" id="id" hidden="true">
            </div>
        </div>

        
        <div class="field">
            <label class="tag is-link">Cuit: </label><br>
            <label><?= $companyFound->getCuit(); ?></label>
        </div>

        <div class="field">
            <label class="tag is-link">Direccion:</label><br>
            <label><?= $companyFound->getAddress(); ?> </label>
        </div>

        <div class="field">
            <label class="tag is-link">Link:</label><br>
            <label><?= $companyFound->getLink(); ?> </label>
        </div>

        
    <?php } ?>
    </section>
        <footer class="modal-card-foot">
            <!-- <button class="button" onclick="document.getElementById('exampleModal').style.display='none'">Aceptar</button> -->
            <button class="button is-success" onclick="window.history.go(-1); return false;">Aceptar</button>
            <!-- <button class="button" onclick="document.getElementById('exampleModal').style.display='none'">Cancel</button> -->
        </footer>


    </div>
</div>
