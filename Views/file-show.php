<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Mostrando File</h2>

               <?php
                    if(isset($file))
                    {
                        ?>
                            <img src="<?php echo FRONT_ROOT.UPLOADS_PATH.$file->getName() ?>">
                        <?php
                    }
               ?>               
          </div>
     </section>
</main>