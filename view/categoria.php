<?php
session_start();
if (!isset($_SESSION["IdEmpleado"])) {
    echo '<script>location.href = "./login.php";</script>';
} else {
    
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
            <div class="row">
                <div class="modal fade" id="modalCategoria" data-backdrop="static">
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

                                    <div class="overlay d-none" id="divOverlayCategoria">
                                        <div class="m-loader mr-4">
                                            <svg class="m-circular" viewBox="25 25 50 50">
                                                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="4" stroke-miterlimit="10"></circle>
                                            </svg>
                                        </div>
                                        <h4 class="l-text" id="lblTextOverlayCategoria">Cargando información...</h4>
                                    </div>

                                    <div class="tile-body">

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="txtNombre">Nombre: <i class="fa fa-fw fa-asterisk text-danger"></i></label>
                                                    <input id="txtNombre" type="text" class="form-control" placeholder="Ingrese el nombre" required="" minlength="8">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" id="cbEstado" type="checkbox" checked>Activo
                                                        </label>
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
            </div>

            <div class="app-title">
                <div>
                    <h1><i class="fa fa-align-left"></i> Categorías</h1>
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
                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr role="row">
                                            <th width="5%;">#</th>
                                            <th width="20%;">Nombre</th>
                                            <th width="10%;">Estado</th>
                                            <th width="10%;">Editar</th>
                                            <!-- <th width="10%;">Eliminar</th> -->
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

            let state = false;
            let paginacion = 0;
            let opcion = 0;
            let totalPaginacion = 0;
            let tbLista = $("#tbLista");

            let idCategoria = 0;

            $(document).ready(function() {

                $("#txtSearch").keyup(function() {
                    if ($("#txtSearch").val().trim() != '') {
                        if (!state) {
                            paginacion = 1;
                            loadTableCategoria($("#txtSearch").val().trim());
                            opcion = 1;
                        }
                    }
                });

                $("#btnReload").click(function() {
                    loadInitCategoria();
                });

                $("#btnReload").keypress(function(event) {
                    if (event.keyCode == 13) {
                        loadInitCategoria();
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

                modalCategoriaEventos();

                loadInitCategoria();
            });

            function modalCategoriaEventos() {
                $("#btnAdd").click(function() {
                    $("#modalCategoria").modal("show");
                    $("#titulo-modal").append('<i class="fa fa-align-left"></i> Registrar Categoría')
                });

                $("#btnAdd").keypress(function(event) {
                    if (event.keyCode == 13) {
                        $("#modalCategoria").modal("show");
                        $("#titulo-modal").append('<i class="fa fa-align-left"></i> Registrar Categoría')
                    }
                    event.preventDefault();
                });

                $("#btnCloseModal").click(function() {
                    closeClearModal();
                });

                $("#btnCloseModal").keypress(function(event) {
                    if (event.keyCode == 13) {
                        closeClearModal();
                    }
                    event.preventDefault();
                });

                $("#btnCancelModal").click(function() {
                    closeClearModal();
                });

                $("#btnCancelModal").keypress(function(event) {
                    if (event.keyCode == 13) {
                        closeClearModal();
                    }
                    event.preventDefault();
                });

                $("#btnGuardarModal").click(function() {
                    crudCategoria();
                });

                $("#btnGuardarModal").keypress(function(event) {
                    if (event.keyCode == 13) {
                        crudCategoria();
                    }
                    event.preventDefault();
                });
            }

            function onEventPaginacion() {
                switch (opcion) {
                    case 0:
                        loadTableCategoria("");
                        break;
                    case 1:
                        loadTableCategoria($("#txtSearch").val().trim());
                        break;
                }
            }

            function loadInitCategoria() {
                if (!state) {
                    paginacion = 1;
                    loadTableCategoria("");
                    opcion = 0;
                }
            }

            function loadTableCategoria(datos) {
                $.ajax({
                    url: "../app/categoria/CategoriaController.php",
                    method: "GET",
                    data: {
                        "type": "lista",
                        "page": paginacion,
                        "datos": datos
                    },
                    beforeSend: function() {
                        state = true;
                        totalPaginacion = 0;
                        tbLista.empty();
                        tbLista.append(
                            '<tr role="row" class="odd"><td class="sorting_1" colspan="5" style="text-align:center"><img src="./images/loading.gif" width="100"/><p>Cargando información...</p></td></tr>'
                        );
                    },
                    success: function(result) {
                        tbLista.empty();
                        if (result.estado == 1) {
                            if (result.categoria.length == 0) {
                                tbLista.append(
                                    '<tr role="row" class="odd"><td class="sorting_1" colspan="5" style="text-align:center"><p>No hay datos para mostrar.</p></td></tr>'
                                );
                                $("#lblPaginaActual").html(0);
                                $("#lblPaginaSiguiente").html(0);
                                state = false;
                            } else {
                                for (let value of result.categoria) {
                                    let estado = value.estado == 1 ? '<span class="badge badge-pill badge-success">Activo</span>' : '<span class="badge badge-pill badge-danger">Inactivo</span>';
                                    tbLista.append('<tr role="row" class="odd">' +
                                        '<td>' + value.id + '</td>' +
                                        '<td>' + value.nombre + '</td>' +
                                        '<td>' + estado + '</td>' +
                                        '<td><button class="btn btn-warning btn-sm" onclick="updateCategoria(\'' + value.idCategoria + '\')"><i class="fa fa-wrench"></i></button></td>' +
                                        // '<td><button class="btn btn-danger btn-sm" onclick="deleteCategoria(\'' + value.idCategoria + '\')"><i class="fa fa-trash"></i></button></td>' +
                                        '</tr>');
                                }
                                totalPaginacion = parseInt(Math.ceil((parseFloat(result.total) / parseInt(
                                    10))));
                                $("#lblPaginaActual").html(paginacion);
                                $("#lblPaginaSiguiente").html(totalPaginacion);
                                state = false;
                            }
                        } else {
                            tbLista.append(
                                '<tr role="row" class="odd"><td class="sorting_1" colspan="5" style="text-align:center"><p>' + result.mensaje + '</p></td></tr>'
                            );
                            $("#lblPaginaActual").html(0);
                            $("#lblPaginaSiguiente").html(0);
                            state = false;
                        }
                    },
                    error: function(error) {
                        tbLista.empty();
                        tbLista.append(
                            '<tr role="row" class="odd"><td class="sorting_1" colspan="5" style="text-align:center"><p>' + error.responseText + '</p></td></tr>'
                        );
                        $("#lblPaginaActual").html(0);
                        $("#lblPaginaSiguiente").html(0);
                        state = false;
                    }
                });
            }

            function crudCategoria() {
                if ($("#txtNombre").val().trim() == '') {
                    tools.AlertWarning("Categoría: ", "Ingrese el nombre de la categoría.");
                    $("#txtNombre").focus();
                } else {

                    $.ajax({
                        url: "../app/categoria/CategoriaController.php",
                        method: "POST",
                        accepts: "application/json",
                        contentType: "application/json",
                        data: JSON.stringify({
                            "type": "crud",
                            "idCategoria": idCategoria,
                            "nombre": ($("#txtNombre").val().trim()).toUpperCase(),
                            "estado": $("#cbEstado").is(":checked"),
                        }),
                        beforeSend: function() {
                            closeClearModal();
                            tools.ModalAlertInfo('Cotegoría', 'Procesando petición...');
                        },
                        success: function(result) {
                            if (result.estado == 1) {
                                tools.ModalAlertSuccess('Cotegoría', result.mensaje);
                                loadInitCategoria();
                            } else if (result.estado == 2) {
                                tools.ModalAlertWarning('Cotegoría', result.mensaje);
                            } else {
                                tools.ModalAlertWarning('Cotegoría', result.mensaje);
                            }
                        },
                        error: function(error) {
                            tools.ModalAlertError('Cotegoría', error.responseText);
                        }
                    });
                }
            }

            function updateCategoria(id) {
                $("#modalCategoria").modal("show");
                $("#titulo-modal").append('<i class="fa fa-align-left"></i> Editar Categoría');

                $.ajax({
                    url: "../app/categoria/CategoriaController.php",
                    method: 'GET',
                    data: {
                        "type": "getbyid",
                        "idCategoria": id
                    },
                    beforeSend: function() {
                        $("#lblTextOverlayCategoria").html("Cargando información...");
                        $("#divOverlayCategoria").removeClass("d-none");
                    },
                    success: function(result) {
                        if (result.estado == 1) {
                            idCategoria = result.categoria.idCategoria;
                            $("#txtNombre").val(result.categoria.nombre);
                            $("#cbEstado").prop("checked", result.categoria.estado == "1" ? true : false);
                            $("#divOverlayCategoria").addClass("d-none");
                        } else {
                            $("#lblTextOverlayCategoria").html(result.mensaje);
                        }
                    },
                    error: function(error) {
                        $("#lblTextOverlayCategoria").html(error.responseText);
                    }
                });
            }

            function deleteCategoria(id) {
                tools.ModalDialog('Categoría', '¿Desea eliminar la categoría?', 'question', function(value) {
                    if (value) {
                        $.ajax({
                            url: "../app/categoria/CategoriaController.php",
                            method: "POST",
                            accepts: "application/json",
                            contentType: "application/json",
                            data: JSON.stringify({
                                "type": "deleted",
                                "idCategoria": id,
                            }),
                            beforeSend: function() {
                                closeClearModal();
                                tools.ModalAlertInfo('Cotegoría', 'Procesando petición...');
                            },
                            success: function(result) {
                                if (result.estado == 1) {
                                    tools.ModalAlertSuccess('Cotegoría', result.mensaje);
                                    loadInitCategoria();
                                } else {
                                    tools.ModalAlertWarning('Cotegoría', result.mensaje);
                                }
                            },
                            error: function(error) {
                                tools.ModalAlertError('Cotegoría', error.responseText);
                            }
                        });
                    }
                });
            }


            function closeClearModal() {
                $("#modalCategoria").modal("hide");
                $("#titulo-modal").empty();
                $("#txtNombre").val("");
                $("#cbEstado").prop("checked", true);
                $("#divOverlayCategoria").addClass("d-none");
                $("#lblTextOverlayCategoria").html("Cargando información...");
                idCategoria = 0;
            }
        </script>
    </body>

    </html>

<?php

}

