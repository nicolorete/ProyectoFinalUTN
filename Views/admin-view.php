<?php include('top-nav.php'); ?>

<div class="columns" id="app-content">
    <?php include('admin-aside-nav.php') ?>

    <div class="column is-10" id="page-content">
        <div class="content-header">
            <h4 class="title is-4">Dashboard</h4>
            <span class="separator"></span>
            <nav class="breadcrumb has-bullet-separator" aria-label="breadcrumbs">
                <ul>
                    <li><a href="#">General</a></li>
                    <li class="is-active"><a href="#" aria-current="page">Elements</a></li>
                </ul>
            </nav>
        </div>

        <div class="content-body">
            <div class="columns">
                <div class="column">
                    <div class="card">
                        <div class="card-content">
                            <p class="title is-2">Administrar Empresas</p>
                            <div class="box">
                                <article class="media">
                                    <div class="media-left">
                                        <figure class="image is-64x64">
                                            <img src="https://www.pinclipart.com/picdir/big/165-1652604_png-file-company-clipart.png" alt="Image">
                                            
                                        </figure>
                                    </div>
                                    <div class="media-content">
                                        <div class="content">
                                            <div class="field">
                                                <li> <a class="button is-dark is-4" href="<?= FRONT_ROOT ?>Company/ShowAddView">Agregar Empresa</a><br><br></li>

                                                <li> <a class="button is-dark is-4" href="<?= FRONT_ROOT ?>Company/ShowListView">Listar Empresa</a> </li>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-content">
                            <p class="title is-2">Propuestas</p>
                            <div class="box">
                                <article class="media">
                                    <div class="media-left">
                                        <figure class="image is-64x64">
                                            <img src="https://www.pinclipart.com/picdir/big/150-1509399_png-file-query-results-icon-clipart.png" alt="Image">
                                        </figure>
                                    </div>
                                    <div class="media-content">
                                        <div class="media-content">

                                            <div class="content">
                                                <div class="field">
                                                    <li><a class="button is-dark is-4">Cargar Propuesta</a><br><br></li>

                                                    <li><a class="button is-dark is-4">Listar Propuestas </a> </li>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="card">
                        <div class="card-content">
                            <p class="title is-2">Administrar Usuarios</p>
                            <div class="box">
                                <article class="media">
                                    <div class="media-left">
                                        <figure class="image is-64x64">
                                            <img src="https://www.pinclipart.com/picdir/big/67-675105_search-log-in-to-your-teach-california-account.png" alt="Image">
                                        </figure>
                                    </div>
                                    <div class="media-content">
                                        <div class="content">
                                            <li><a class="button is-dark is-4" href="<?= FRONT_ROOT ?>User/ShowAddView">Agregar Usuario</a><br><br></li>

                                            <li><a class="button is-dark is-4" href="<?= FRONT_ROOT ?>User/ShowListView">Listar Usuarios </a> </li>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>