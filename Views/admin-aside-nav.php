<div class="column is-2 is-fullheight is-hidden-touch" id="navigation">
    <aside class="menu">
        <ul class="menu-list"><br>
            <li>
                <a class="is-active" href="<?= FRONT_ROOT ?>Home/ShowAdminView">
                    <span class="icon">
                        <i class="fa fa-home"></i>
                    </span> Dashboard
                </a>
            </li>
        </ul>
        <p class="menu-label is-hidden-touch">Empresas </p>
        <ul class="menu-list">
            <li>
                <a class="" href="<?= FRONT_ROOT ?>Company/ShowAddView">
                    <span class="icon">
                        <i class="fa fa-edit"></i>
                    </span> Agregar Empresa
                </a>
            </li>
            <li>
                <a class="" href="<?= FRONT_ROOT ?>Company/ShowListView">
                    <span class="icon">
                        <i class="fa fa-list"></i>
                    </span> Listar Empresas
                </a>
            </li>
            <li>
                <a class="" href="<?= FRONT_ROOT ?>Postulation/ShowListViewAdmin">
                    <span class="icon">
                        <i class="fa fa-desktop"></i>
                    </span> 
                    Listar Postulaciones
                </a>
            </li>
        </ul>

        <p class="menu-label is-hidden-touch">Usuarios</p>
        <ul class="menu-list">
            <li>
                <a class="" href="<?= FRONT_ROOT ?>Admin/ShowAddView">
                    <span class="icon">
                        <i class="fa fa-edit"></i>
                    </span> Agregar Administrador
                </a>
            </li>
            <li>
                <a class="" href="<?= FRONT_ROOT ?>Admin/ShowListView">
                    <span class="icon">
                        <i class="fa fa-lock"></i>
                    </span> Ver Administradores
                </a>
            </li>
            <li>
                <a class="" href="<?= FRONT_ROOT ?>Student/ShowListView">
                    <span class="icon">
                        <i class="fa fa-lock"></i>
                    </span> Alumnos Registrados
                </a>
            </li>
        </ul>
        <p class="menu-label is-hidden-touch">Consultas</p>
        <ul class="menu-list">
            <li>
                <a class="" href="<?= FRONT_ROOT ?>JobOffer/ShowAddView">
                    <span class="icon">
                        <i class="fa fa-edit"></i>
                    </span> Cargar Propuestas
                </a>
            </li>
            
        </ul>
    </aside>
</div>