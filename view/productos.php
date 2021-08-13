<?php
session_start();
if (!isset($_SESSION["IdEmpleado"])) {
    echo '<script>location.href = "./login.php";</script>';
} else {
    //JRamosC16
?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <?php include './layout/head.php'; ?>
        </head>

        <body class="app sidebar-mini">
            <!-- Navbar-->
            <?php include "./layout/header.php"; ?>
            <!-- Sidebar menu-->
            <?php include "./layout/menu.php"; ?>
            <main class="app-content">

                <!-- modal nuevo/update Productos  -->
                
                <!-- <div class="row">
                    <div class="modal fade" id="modalProducto" data-backdrop="static">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="titulo-modal">
                                    </h4>
                                    <button type="button" class="close" id="btnCloseModal">
                                        <i class="fa fa-close"></i>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="tile p-0">

                                        <div class="overlay d-none" id="divOverlayProducto">
                                            <div class="m-loader mr-4">
                                                <svg class="m-circular" viewBox="25 25 50 50">
                                                    <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="4" stroke-miterlimit="10"></circle>
                                                </svg>
                                            </div>
                                            <h4 class="l-text" id="lblTextOverlayProducto">Cargando información...</h4>
                                        </div>

                                        <div class="tile-body">
                                            <ul class="nav nav-tabs mb-2" role="tablist">
                                                <li class="nav-item">
                                                    <a id="navProfile" class="nav-link active" href="#profile" role="tab" data-toggle="tab">Información</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a id="navBuzz" class="nav-link" href="#buzz" role="tab" data-toggle="tab">Detalle</a>
                                                </li>
                                            </ul>

                                            <div class="tab-content">
                                                
                                                <div role="tabpanel" class="tab-pane fade in active show" id="profile">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="txtClave">Clave: <i class="fa fa-fw fa-asterisk text-danger"></i></label>
                                                                <input id="txtClave" type="text" class="form-control" placeholder="Ingrese la clave">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="txtClaveAlterna">Clave Alterna: </label>
                                                                <input id="txtClaveAlterna" type="text" class="form-control" placeholder="Ingrese la clave alterna">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="txtNombre">Nombre: <i class="fa fa-fw fa-asterisk text-danger"></i></label>
                                                                <input id="txtNombre" type="text" class="form-control" placeholder="Ingrese el nombre del producto">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="cbCategoria">Categoria: <i class="fa fa-fw fa-asterisk text-danger"></i></label>
                                                                <select id="cbCategoria" class="form-control">
                                                                    <option value="">- Selecciona -</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="cbMarca">Marca: <i class="fa fa-fw fa-asterisk text-danger"></i></label>
                                                                <select id="cbMarca" class="form-control">
                                                                    <option value="">- Selecciona -</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                
                                                <div role="tabpanel" class="tab-pane fade" id="buzz">

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <div class="form-check">
                                                                    <label class="form-check-label">
                                                                        <input id="cbInventario" class="form-check-input" type="checkbox" checked>Producto inventariado
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="txtCosto">Costo: <i class="fa fa-fw fa-asterisk text-danger"></i></label>
                                                                <input id="txtCosto" type="text" class="form-control" placeholder="Ingrese el costo del producto">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="txtStockMinimo">Stock Mínimo: </label>
                                                                <input id="txtStockMinimo" type="text" class="form-control" placeholder="Ingrese el costo del producto">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="txtStockMaximo">Stock Máximo: </label>
                                                                <input id="txtStockMaximo" type="text" class="form-control" placeholder="Ingrese el costo del producto">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>Tipo de producto: </label>
                                                                <div class="row">

                                                                    <div class="col-md-6">
                                                                        <div class="form-check">
                                                                            <label for="cbTipoProducto" class="form-check-label">
                                                                                <input id="cbTipoProducto" class="form-check-input" type="radio" name="tipo" checked>Producto
                                                                            </label>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <div class="form-check">
                                                                            <label for="cbTipoServicio" class="form-check-label">
                                                                                <input id="cbTipoServicio" class="form-check-input" type="radio" name="tipo">Servicio
                                                                            </label>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="cbImpuesto">Impuesto: <i class="fa fa-fw fa-asterisk text-danger"></i></label>
                                                                <select id="cbImpuesto" class="form-control">
                                                                    <option value="">- Selecciona -</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="txtPrecio">Precio: <i class="fa fa-fw fa-asterisk text-danger"></i></label>
                                                                <input id="txtPrecio" type="text" class="form-control" placeholder="Ingrese el precio del producto">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="cbEstado">Estado: </label>
                                                                <select id="cbEstado" class="form-control">
                                                                    <option value="1">Activo</option>
                                                                    <option value="0">Inactivo</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <p class="text-left text-danger">Todos los campos marcados con <i class="fa fa-fw fa-asterisk text-danger"></i> son obligatorios</p>
                                    <button type="button" class="btn btn-success" id="btnGuardarModal">
                                        <i class="fa fa-save"></i> Guardar</button>
                                    <button type="button" class="btn btn-danger" id="btnCancelModal">
                                        <i class="fa fa-remove"></i> Cancelar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->

                <div class="row">
                    <div class="modal fade" id="modalProducto" data-backdrop="static">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="titulo-modal">
                                    </h4>
                                    <button type="button" class="close" id="btnCloseModal">
                                        <i class="fa fa-close"></i>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="tile p-0">

                                        <div class="overlay d-none" id="divOverlayProducto">
                                            <div class="m-loader mr-4">
                                                <svg class="m-circular" viewBox="25 25 50 50">
                                                    <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="4" stroke-miterlimit="10"></circle>
                                                </svg>
                                            </div>
                                            <h4 class="l-text" id="lblTextOverlayProducto">Cargando información...</h4>
                                        </div>

                                        <div class="tile-body">
                                            <!-- <ul class="nav nav-tabs mb-2" role="tablist">
                                                <li class="nav-item">
                                                    <a id="navProfile" class="nav-link active" href="#profile" role="tab" data-toggle="tab">Información</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a id="navBuzz" class="nav-link" href="#buzz" role="tab" data-toggle="tab">Detalle</a>
                                                </li>
                                            </ul> -->

                                            <!-- <div class="tab-content"> -->
                                                
                                                <div role="tabpanel" class="tab-pane fade in active show" id="profile">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="txtClave">Clave: <i class="fa fa-fw fa-asterisk text-danger"></i></label>
                                                                <input id="txtClave" type="text" class="form-control" placeholder="Ingrese la clave">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="txtNombre">Nombre o descripción: <i class="fa fa-fw fa-asterisk text-danger"></i></label>
                                                                <input id="txtNombre" type="text" class="form-control" placeholder="Ingrese el nombre o descripcion del producto">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="cbCategoria">Categoria: <i class="fa fa-fw fa-asterisk text-danger"></i></label>
                                                                <select id="cbCategoria" class="form-control">
                                                                    <option value="">- Selecciona -</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="cbMarca">Marca: <i class="fa fa-fw fa-asterisk text-danger"></i></label>
                                                                <select id="cbMarca" class="form-control">
                                                                    <option value="">- Selecciona -</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="txtCosto">Costo: </label>
                                                                <input id="txtCosto" type="text" class="form-control" maxlength="10" placeholder="Ingrese el costo del producto">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="txtPrecio">Precio: <i class="fa fa-fw fa-asterisk text-danger"></i></label>
                                                                <input id="txtPrecio" type="text" class="form-control" maxlength="10" placeholder="Ingrese el precio del producto">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="txtOferta">Precio Oferta: </label>
                                                                <input id="txtOferta" type="text" class="form-control" maxlength="10" placeholder="Ingrese el precio en oferta del producto">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="txtCantidad">Cantidad: </label>
                                                                <input id="txtCantidad" type="numeric" class="form-control" maxlength="10" placeholder="Ingrese la cantidad o stock del producto">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="cbEstado">Estado: </label>
                                                                <select id="cbEstado" class="form-control">
                                                                    <option value="1">Activo</option>
                                                                    <option value="0">Inactivo</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="cbOferta">Oferta: </label>
                                                                <select id="cbOferta" class="form-control">
                                                                    <option value="0">NO</option>
                                                                    <option value="1">SI</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="inpImg">Imagen: </label>
                                                                <input id="inpImg" name="inpImg" type="file" class="btn" accept=".png, .jpg, .jpeg, .gif">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <div class="boxImg"></div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                <!-- </div> -->

                                                <!-- <div role="tabpanel" class="tab-pane fade" id="buzz"> -->


                                                    <!-- <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <div class="form-check">
                                                                    <label class="form-check-label">
                                                                        <input id="cbInventario" class="form-check-input" type="checkbox" checked>Producto inventariado
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> -->
                                                    

                                                <!-- </div> -->
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <p class="text-left text-danger">Todos los campos marcados con <i class="fa fa-fw fa-asterisk text-danger"></i> son obligatorios y el tamaño máximo de la imagen debe ser menor a los 4.7 MB</p>
                                    <button type="button" class="btn btn-success" id="btnGuardarModal">
                                        <i class="fa fa-save"></i> Guardar</button>
                                    <button type="button" class="btn btn-danger" id="btnCancelModal">
                                        <i class="fa fa-remove"></i> Cancelar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="app-title">
                    <div>
                        <h1><i class="fa fa-shopping-bag"></i> Productos</h1>
                    </div>
                </div>
                <div class="tile mb-4">

                    <div class="row">
                        <div class="col-lg-6">
                            <p class="bs-component">
                                <button class="btn btn-info" type="button" id="btnAdd"><i class="fa fa-plus"></i>
                                    Nuevo</button>
                                <button class="btn btn-secondary" type="button" id="btnReload"><i class="fa fa-refresh"></i>
                                    Recargar</button>
                            </p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <input type="search" class="form-control" placeholder="Buscar por nombre" id="txtSearch">
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <div class="text-right">
                                    <button class="btn btn-primary" id="btnAnterior">
                                        <i class="fa fa-arrow-circle-left"></i>
                                    </button>
                                    <span class="m-2" id="lblPaginaActual">0
                                    </span>
                                    <span class="m-2">
                                        de
                                    </span>
                                    <span class="m-2" id="lblPaginaSiguiente">0
                                    </span>
                                    <button class="btn btn-primary" id="btnSiguiente">
                                        <i class="fa fa-arrow-circle-right"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="tile-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered ">
                                        <thead>
                                            <tr role="row">
                                                <th width="5%">#</th>
                                                <th width="20%">Clave / Nombre</th>
                                                <th width="10%">Cantidad</th>
                                                <th width="10%">Precio</th>
                                                <th width="10%">Categoria</th>
                                                <th width="10%">Marca</th>
                                                <th width="10%">Estado</th>
                                                <th width="10%">Editar</th>
                                                <!-- <th width="10%">Eliminar</th> -->
                                            </tr>
                                        </thead>
                                        <tbody id="tbLista">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <!-- Essential javascripts for application to work-->
            <?php include "./layout/footer.php"; ?>
            <script>
                let tools = new Tools();

                let tbLista = $("#tbLista");
                let totalPaginacion = 0;
                let paginacion = 0;
                let opcion = 0;
                let state = false;

                let idProducto = 0;

                $(document).ready(function() {

                    $("#btnAdd").click(function() {
                        addProducto();
                    });

                    $("#btnAdd").keypress(function(event) {
                        if (event.keyCode == 13) {
                            addProducto();
                        }
                        event.preventDefault();
                    });

                    $("#btnReload").click(function() {
                        loadInitProductos();
                    });

                    $("#btnReload").keypress(function(event) {
                        if (event.keyCode == 13) {
                            loadInitProductos();
                        }
                        event.preventDefault();
                    });

                    $("#btnAnterior").click(function() {
                        if (!state) {
                            if (paginacion > 1) {
                                paginacion--;
                                onEventPaginacion();
                            }
                        }
                    });
                    $("#btnSiguiente").click(function() {
                        if (!state) {
                            if (paginacion < totalPaginacion) {
                                paginacion++;
                                onEventPaginacion();
                            }
                        }
                    });

                    $("#txtSearch").keypress(function() {
                        if ($("#txtSearch").val().trim() != '') {
                            if (!state) {
                                paginacion = 1;
                                loadTableProductos($("#txtSearch").val().trim());
                                opcion = 1;
                            }
                        }
                    });

                    // $("#inpImg").change(function(){

                    //     var file = document.getElementById("inpImg")
                    //     var filePath = $("#inpImg").val('')
                    //     var allowedExtensions = /(\.jpeg|\.JPEG|\.gif|\.GIF|\.png|\.PNG)$/;

                    //     if (filfilePathe.files[0].size > 5000000) {
                    //         // this.value = "";
                    //         $("#inpImg").val('')
                    //         tools.AlertWarning("Producto: ", "El tamaño de la imagen es muy grande.");

                    //     } else {
                    //         tools.AlertSuccess("Producto: ", "Tamaño de imagen aceptado.");
                    //         // console.log(this.value)
                    //         // console.log($("#inpImg").val())
                    //     }
                    // })

                    modalProductosEventos();
                    loadInitProductos();

                    var uploadField = document.getElementById("inpImg");
                    // var upload_Field = document.getElementById("inpImg");
                    var filePath = uploadField.value;
                    var reg = /(.*?)\.(jpg|gif|jpeg|png)$/;
                    var imageType = ['jpeg', 'jpg', 'png', 'gif'];
                    var allowedExtensions = /(\.jpeg|\.JPEG|\.gif|\.GIF|\.png|\.PNG)$/;
                    // !allowedExtensions.exec(filePath)

                    uploadField.onchange = function (e) {
                        if (this.files[0].size > 5000000 && (-1 == $.inArray(file.type.split('/')[1], imageType))) {
                            this.value = ""
                            // $("#inpImg").val('')
                            tools.AlertWarning("Producto: ", "El tamaño de archivo es muy grande o el formato de archivo es incorecto.");

                        } else {

                            let reader = new FileReader();
                            reader.readAsDataURL(e.target.files[0]);
                            reader.onload = function(){
                                let preview = document.getElementById('boxImg'),
                                        image = document.createElement('img');

                                image.src = reader.result;

                                preview.innerHTML = '';
                                preview.append(image);
                            };

                            // $("#boxImg").append(
                            //     '<img src="' + this.files[0].name + '" width="100"/>'
                            // );
                            tools.AlertSuccess("Producto: ", "archivo aceptado.");
                            console.log(this.files[0].name)
                            // console.log($("#inpImg").val())
                        }
                    }

                });

                function modalProductosEventos() {

                    $("#txtCosto").keypress(function() {
                        let key = window.Event ? event.which : event.keyCode;
                        let c = String.fromCharCode(key);
                        if ((c < '0' || c > '9') && (c != '\b') && (c != '.')) {
                            event.preventDefault();
                        }
                        if (c == '.' && $("#txtCosto").val().includes(".")) {
                            event.preventDefault();
                        }
                    });

                    $("#txtPrecio").keypress(function() {
                        let key = window.Event ? event.which : event.keyCode;
                        let c = String.fromCharCode(key);
                        if ((c < '0' || c > '9') && (c != '\b') && (c != '.')) {
                            event.preventDefault();
                        }
                        if (c == '.' && $("#txtPrecio").val().includes(".")) {
                            event.preventDefault();
                        }
                    });

                    $("#txtCantidad").keypress(function() {
                        var key = window.Event ? event.which : event.keyCode;
                        var c = String.fromCharCode(key);
                        if ((c < '0' || c > '9') && (c != '\b') && (c != '.')) {
                            event.preventDefault();
                        }
                        if (c == '.' && $("#txtCantidad").val().includes(".")) {
                            event.preventDefault();
                        }
                    });

                    $("#txtOferta").keypress(function() {
                        var key = window.Event ? event.which : event.keyCode;
                        var c = String.fromCharCode(key);
                        if ((c < '0' || c > '9') && (c != '\b') && (c != '.')) {
                            event.preventDefault();
                        }
                        if (c == '.' && $("#txtOferta").val().includes(".")) {
                            event.preventDefault();
                        }
                    });

                    // $("#cbInventario").change(function(event) {
                    //     if (event.currentTarget.checked) {
                    //         $("#txtCosto").prop("disabled", false);
                    //         $("#txtStockMinimo").prop("disabled", false);
                    //         $("#txtStockMaximo").prop("disabled", false);
                    //     } else {
                    //         $("#txtCosto").prop("disabled", true);
                    //         $("#txtStockMinimo").prop("disabled", true);
                    //         $("#txtStockMaximo").prop("disabled", true);
                    //     }
                    // });


                    $("#btnGuardarModal").click(function() {
                        crudProducto()
                    });

                    $("#btnGuardarModal").keypress(function(event) {
                        if (event.keyCode === 13) {
                            crudProducto()
                        }
                        event.preventDefault();
                    });

                    $("#btnCancelModal").click(function() {
                        clearComponents();
                    });

                    $("#btnCancelModal").keypress(function(event) {
                        if (event.keyCode === 13) {
                            clearComponents();
                        }
                        event.preventDefault();
                    });

                    $("#btnCloseModal").click(function() {
                        clearComponents();
                    });

                    $("#btnCloseModal").keypress(function() {
                        if (event.keyCode === 13) {
                            clearComponents();
                        }
                        event.preventDefault();
                    });

                }

                function onEventPaginacion() {
                    switch (opcion) {
                        case 0:
                            loadTableProductos("");
                            break;
                        case 1:
                            loadTableProductos($("#txtSearch").val().trim());
                            break;
                    }
                }

                function loadInitProductos() {
                    if (!state) {
                        paginacion = 1;
                        loadTableProductos("");
                        opcion = 0;
                    }
                }

                function loadTableProductos(text) {
                    $.ajax({
                        url: "../app/productos/ProductoController.php",
                        method: "GET",
                        data: {
                            "type": "lista",
                            "page": paginacion,
                            "datos": text
                        },
                        beforeSend: function() {
                            state = true;
                            tbLista.empty();
                            tbLista.append(
                                '<tr role="row" class="odd"><td class="sorting_1" colspan="8" style="text-align:center"><img src="./images/loading.gif" width="100"/><p>cargando información...</p></td></tr>'
                            );
                            totalPaginacion = 0;
                        },
                        success: function(result) {
                            let data = result;
                            if (data.estado == 1) {
                                tbLista.empty();
                                if (data.productos.length == 0) {
                                    tbLista.append(
                                        '<tr role="row" class="odd"><td class="sorting_1" colspan="8" style="text-align:center"><p>No hay datos para mostrar.</p></td></tr>');
                                    $("#lblPaginaActual").html(0);
                                    $("#lblPaginaSiguiente").html(0);
                                    state = false;
                                } else {
                                    for (let producto of data.productos) {
                                        let estado = producto.estado == 1 ? '<span class="badge badge-pill badge-success"> Activo </span>' : '<span class="badge badge-pill badge-danger"> Inactivo </span>';
                                        tbLista.append('<tr role="row" class="odd">' +
                                            '<td class="text-center">' + producto.id + '</td>' +
                                            '<td>' + producto.clave + '<br>' + producto.nombre + '</td>' +
                                            '<td class="text-right">' + tools.formatMoney(producto.cantidad) + '</td>' +
                                            '<td class="text-right">' + tools.formatMoney(producto.precio) + '</td>' +
                                            '<td>' + producto.categoria + '</td>' +
                                            '<td>' + producto.marca + '</td>' +
                                            '<td class="text-center">' + estado + '</td>' +
                                            '<td class="text-center"><button class="btn btn-warning btn-sm" onclick="updateProducto(\'' + producto.idProducto + '\')"><i class="fa fa-edit"></i> Editar</button></td>' +
                                            // '<td class="text-center"><button class="btn btn-danger btn-sm" onclick="deleteProducto(\'' + producto.idProducto + '\')"><i class="fa fa-trash"></i> Eliminar</button></td>' +
                                            '</tr>');
                                    }
                                    totalPaginacion = parseInt(Math.ceil((parseFloat(data.total) / parseInt(
                                        10))));
                                    $("#lblPaginaActual").html(paginacion);
                                    $("#lblPaginaSiguiente").html(totalPaginacion);
                                    state = false;
                                }
                            } else {
                                tbLista.empty();
                                tbLista.append(
                                    '<tr role="row" class="odd"><td class="sorting_1" colspan="8" style="text-align:center"><p>' +
                                    data.mensaje + '</p></td></tr>');
                                $("#lblPaginaActual").html(0);
                                $("#lblPaginaSiguiente").html(0);
                                state = false;
                            }
                        },
                        error: function(error) {
                            tbLista.empty();
                            tbLista.append(
                                '<tr role="row" class="odd"><td class="sorting_1" colspan="8" style="text-align:center"><p>' +
                                error.responseText + '</p></td></tr>');
                            $("#lblPaginaActual").html(0);
                            $("#lblPaginaSiguiente").html(0);
                            state = false;
                        }
                    });
                }

                function addProducto() {
                    $("#titulo-modal").empty();
                    $("#titulo-modal").append("Registrar Producto");
                    $("#modalProducto").modal("show");

                    getCategoriaMarca()

                }

                function getCategoriaMarca(){

                    $.ajax({
                        url: "../app/productos/ProductoController.php",
                        method: "GET",
                        data: {
                            "type": "getCategoriaMarca"
                        },
                        beforeSend: function() {
                            $("#lblTextOverlayProducto").html("Cargando información...");
                            $("#divOverlayProducto").removeClass("d-none");
                            $("#cbCategoria").empty();
                            $("#cbMarca").empty();
                        },
                        success: function(result) {
                            if (result.estado == 1) {
                                $("#cbCategoria").append('<option value="">- Seleccione -</option>');
                                for (let categoria of result.categorias) {
                                    $("#cbCategoria").append('<option value="' + categoria.idCategoria + '">' + categoria.nombre + '</option>');
                                }

                                $("#cbMarca").append('<option value="">- Seleccione -</option>');
                                for (let marca of result.marcas) {
                                    $("#cbMarca").append('<option value="' + marca.idMarca + '">' + marca.nombre + '</option>');
                                }

                                $("#divOverlayProducto").addClass("d-none");
                            } else {
                                $("#lblTextOverlayProducto").html(result.mensaje);
                            }
                        },
                        error: function(error) {
                            $("#lblTextOverlayProducto").html(error.responseText);
                        }
                    });

                }

                function crudProducto() {
                    if ($("#txtClave").val().trim() == '') {
                        tools.AlertWarning("Producto: ", "Ingrese la clave del producto.");
                        $("#txtClave").focus();
                    } else if ($("#txtNombre").val().trim() == '') {
                        tools.AlertWarning("Producto: ", "Ingrese el nombre del producto.");
                        $("#txtNombre").focus();
                    } else if ($("#cbCategoria").val() == '') {
                        tools.AlertWarning("Producto: ", "Seleccione la categoría del producto.");
                        $("#cbCategoria").focus();
                    } 
                    // else if ($("#cbInventario").is(":checked") && !tools.isNumeric($("#txtCosto").val().trim())) {
                    //     tools.AlertWarning("Producto: ", "Ingrese el costo del producto.");
                    //     $("#txtCosto").focus();
                    // } 
                    else if ($("#cbMarca").val() == '') {
                        tools.AlertWarning("Producto: ", "Seleccione la marca del producto.");
                        $("#cbMarca").focus();
                    } else if (!tools.isNumeric($("#txtPrecio").val().trim())) {
                        tools.AlertWarning("Producto: ", "Ingrese el precio del producto.");
                        $("#txtPrecio").focus();
                    } else {
                        tools.ModalDialog('Producto', '¿Está seguro de continuar?', 'question', function(result) {
                            if (result) {
                                $.ajax({
                                    url: "../app/productos/ProductoController.php",
                                    method: "POST",
                                    accepts: "application/json",
                                    contentType: "application/json",
                                    data: JSON.stringify({
                                        "type": "crud",
                                        "idProducto": idProducto,
                                        "clave": $("#txtClave").val().trim(),
                                        "nombre": ($("#txtNombre").val().trim()).toUpperCase() ,
                                        "categoria": $("#cbCategoria").val(),
                                        "marca": $("#cbMarca").val(),
                                        "costo": tools.isNumeric($("#txtCosto").val().trim()) ? parseFloat($("#txtCosto").val().trim()) : 0,
                                        "precio": parseFloat($("#txtPrecio").val().trim()),
                                        "precioOferta": tools.isNumeric($("#txtOferta").val().trim()) ? parseFloat($("#txtOferta").val().trim()) : 0,
                                        "cantidad": tools.isNumeric($("#txtCantidad").val().trim()) ? parseFloat($("#txtCantidad").val().trim()) : 0,
                                        "estado": $("#cbEstado").val(),
                                        "oferta": $("#cbOferta").val(),
                                        "url": $("#inpImg").val()

                                        /*
                                        "inventario": $("#cbInventario").is(":checked"),
                                        "stockMinimo": tools.isNumeric($("#txtStockMinimo").val().trim()) ? parseFloat($("#txtStockMinimo").val().trim()) : 0,
                                        "stockMaximo": tools.isNumeric($("#txtStockMaximo").val().trim()) ? parseFloat($("#txtStockMaximo").val().trim()) : 0,
                                        "tipoProducto": $("#cbTipoProducto").is(":checked")
                                        */

                                    }),
                                    beforeSend: function() {
                                        clearComponents()
                                        tools.ModalAlertInfo('Producto', 'Procesando petición...');
                                    },
                                    success: function(result) {
                                        if (result.estado == 1) {
                                            tools.ModalAlertSuccess('Producto', result.mensaje);
                                            loadInitProductos();
                                        } else if (result.estado == 2) {
                                            tools.ModalAlertWarning('Producto', result.mensaje);
                                        } else if (result.estado == 3) {
                                            tools.ModalAlertWarning('Producto', result.mensaje);
                                        } else {
                                            tools.ModalAlertWarning('Producto', result.mensaje);
                                        }
                                    },
                                    error: function(error) {
                                        tools.ModalAlertError("Producto", error.responseText);
                                    }
                                });
                            }
                        });
                    }
                }

                function updateProducto(id) {
                    $("#titulo-modal").empty();
                    $("#titulo-modal").append("Editar Producto");
                    $("#modalProducto").modal("show");
                    $.ajax({
                        url: "../app/productos/ProductoController.php",
                        method: "GET",
                        data: {
                            "type": "getbyid",
                            "idProducto": id
                        },
                        beforeSend: function() {
                            $("#lblTextOverlayProducto").html("Cargando información...");
                            $("#divOverlayProducto").removeClass("d-none");
                            $("#cbCategoria").empty();
                            $("#cbMarca").empty();
                        },
                        success: function(result) {
                            if (result.estado == 1) {
                                
                                $("#cbCategoria").append('<option value="">- Seleccione -</option>');
                                for (let categoria of result.categorias) {
                                    $("#cbCategoria").append('<option value="' + categoria.idCategoria + '">' + categoria.nombre + '</option>');
                                }

                                $("#cbMarca").append('<option value="">- Seleccione -</option>');
                                for (let marca of result.marcas) {
                                    $("#cbMarca").append('<option value="' + marca.idMarca + '">' + marca.nombre + '</option>');
                                }
                                
                                /*
                                if (result.producto.inventario == 1) {
                                    $("#cbInventario").prop("checked", true);
                                    $("#txtCosto").prop("disabled", false);
                                    $("#txtStockMinimo").prop("disabled", false);
                                    $("#txtStockMaximo").prop("disabled", false);
                                } else {
                                    $("#cbInventario").prop("checked", false);
                                    $("#txtCosto").prop("disabled", true);
                                    $("#txtStockMinimo").prop("disabled", true);
                                    $("#txtStockMaximo").prop("disabled", true);
                                }


                                if (result.producto.tipo == 1) {
                                    $("#cbTipoProducto").prop("checked", true);
                                } else {
                                    $("#cbTipoServicio").prop("checked", true);
                                }
                                */

                                idProducto = id;
                                $("#txtClave").val(result.producto.clave)
                                $("#txtNombre").val(result.producto.nombre)
                                $("#cbCategoria").val(result.producto.idCategoria)
                                $("#cbMarca").val(result.producto.idMarca)
                                $("#txtCosto").val(result.producto.costo)
                                $("#txtPrecio").val(result.producto.precio)
                                $("#txtOferta").val(result.producto.precioOferta)
                                $("#txtCantidad").val(result.producto.cantidad)
                                $("#cbEstado").val(result.producto.estado)
                                $("#cbOferta").val(result.producto.oferta)
                                $("#divOverlayProducto").addClass("d-none");

                            } else {
                                $("#cbCategoria").append('<option value="">- Seleccione -</option>');
                                $("#cbMarca").append('<option value="">- Seleccione -</option>');
                                $("#lblTextOverlayProducto").html(result.mensaje);
                            }
                        },
                        error: function(error) {
                            $("#cbCategoria").append('<option value="">- Seleccione -</option>');
                            $("#cbMarca").append('<option value="">- Seleccione -</option>');
                            $("#lblTextOverlayProducto").html(error.responseText);
                        }
                    });
                }

                /*
                function deleteProducto(idProducto) {
                    tools.ModalDialog('Producto', '¿Está seguro de eliminar el producto?', 'question', function(result) {
                        if (result) {
                            $.ajax({
                                url: "../app/productos/ProductoController.php",
                                method: "POST",
                                accepts: "application/json",
                                contentType: "application/json",
                                data: JSON.stringify({
                                    "type": "delete",
                                    "idProducto": idProducto
                                }),
                                beforeSend: function() {
                                    clearComponents()
                                    tools.ModalAlertInfo('Producto', 'Procesando petición...');
                                },
                                success: function(result) {
                                    if (result.estado == 1) {
                                        tools.ModalAlertSuccess('Producto', result.mensaje);
                                        loadInitProductos();
                                    } else {
                                        tools.ModalAlertWarning('Producto', result.mensaje);
                                    }
                                },
                                error: function(error) {
                                    tools.ModalAlertError("Producto", error.responseText);
                                }
                            });
                        }
                    });
                }
                */

                function clearComponents() {
                    $("#modalProducto").modal("hide");
                    $("#buzz").removeClass("in active show");
                    $("#profile").removeClass("in active show");
                    $("#profile").addClass("in active show");
                    $("#navProfile").removeClass("active");
                    $("#navProfile").addClass("active");
                    $("#navBuzz").removeClass("active");
                    $("#titulo-modal").empty();
                    $("#txtClave").val("")
                    $("#txtClaveAlterna").val("")
                    $("#txtNombre").val("")
                    $("#cbImpuesto").val("")
                    $("#txtCosto").val("")
                    $("#txtPrecio").val("")
                    $("#cbEstado").val("1")
                    $("#cbCategoria").empty();
                    $("#cbCategoria").append('<option value="">- Seleccione -</option>');

                    $("#txtOferta").val("")
                    $("#txtCantidad").val("")
                    $("#inpImg").val("")

                    idProducto = 0;
                }
            </script>
        </body>

        </html>

<?php
    
}
