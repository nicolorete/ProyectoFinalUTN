<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Mostrando File</h2>

               <?php
               
               header("Content-type: application/pdf");
               header('Content-Disposition: attachment; filename="'.$file->getName().'"');
               readfile($file);
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