<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
        <div class="app-sidebar__user">
                <div class="m-2">
                        <img class="img-fluid" src="./images/logo.jpg" alt="User Image">
                </div>

                <div class="m-1">
                        <p class="app-sidebar__user-name"><?= $_SESSION["Nombres"] . ' ' . $_SESSION["Apellidos"] ?></p>
                </div>
        </div>
        <ul class="app-menu">

                <li><a class="app-menu__item" href="productos.php"><i class="app-menu__icon fa fa-product-hunt"></i><span class="app-menu__label">Productos/Servicios</span></a></li>            
                <li><a class="app-menu__item" href="categoria.php"><i class="app-menu__icon fa fa-align-left"></i><span class="app-menu__label">Categoria</span></a></li>
                <li><a class="app-menu__item" href="marca.php"><i class="app-menu__icon fa fa-folder"></i><span class="app-menu__label">Marcas</span></a></li>
                <li><a class="app-menu__item" href="empleados.php"><i class="app-menu__icon fa fa-address-book-o"></i><span class="app-menu__label">Personal</span></a></li>
                <li><a class="app-menu__item" href="empresa.php"><i class="app-menu__icon fa fa-home"></i><span class="app-menu__label">Empresa</span></a></li>
                 
        </ul>
</aside>