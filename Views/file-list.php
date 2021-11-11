<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Listado de imagenes</h2>
               <table class="table bg-light-alpha">
                    <thead>
                         <th>Nombre de imagen</th>
                         <th>Ver</th>
                    </thead>
                    <tbody>
                        <?php
                            if(isset($fileList))
                            {
                                foreach($fileList as $file)
                                {
                                    ?>
                                        <tr>
                                            <td><?php echo $file->getName() ?></td> 
                                            <td><a href="<?php echo FRONT_ROOT ?>File/ShowFile/<?php echo $file->getFileId() ?>">Descargar</a></td>
                                        </tr>
                                    <?php
                                }
                            }
                        ?>
                    </tbody>
               </table>
          </div>
     </section>

     <section id="eliminar">
          <div class="container">
               <h2 class="mb-4">Subir File</h2>

               <form method="post" action="<?php echo FRONT_ROOT ?>File/Upload" enctype="multipart/form-data" class="form-inline bg-light-alpha p-5">
                    <div class="form-group text-white">
                         <input type="file" name="image" value="" class="form-control-file ml-3">
                    </div>
                    <button type="submit" class="btn btn-danger ml-3">Subir</button>
               </form>
               <span><?php if(isset($message)) { echo $message; } ?></span>
          </div>
     </section>

</main>
