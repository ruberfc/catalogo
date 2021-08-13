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

                <div class="app-title">
                    <h1><i class="fa fa-address-book-o"></i> Usuarios</h1>
                </div>

                <!-- modal nuevo/update Empleado  -->
                <div class="row">
                    <div class="modal fade" id="modalEmpleado" data-backdrop="static">
                        <div class="modal-dialog modal-lg">
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

                                        <div class="overlay d-none" id="divOverlayEmpleado">
                                            <div class="m-loader mr-4">
                                                <svg class="m-circular" viewBox="25 25 50 50">
                                                    <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="4" stroke-miterlimit="10"></circle>
                                                </svg>
                                            </div>
                                            <h4 class="l-text" id="lblTextOverlayEmpleado">Cargando información...</h4>
                                        </div>

                                        <div class="tile-body">
                                            <ul class="nav nav-tabs mb-2" role="tablist">
                                                <li class="nav-item">
                                                    <a id="navBasico" class="nav-link active" href="#basico" role="tab" data-toggle="tab"><strong class="text-info">Basico</strong></a>
                                                </li>
                                                <li class="nav-item">
                                                    <a id="navContanto" class="nav-link" href="#contacto" role="tab" data-toggle="tab"><strong class="text-info">Contacto</strong></a>
                                                </li>
                                                <li class="nav-item">
                                                    <a id="navAcceso" class="nav-link" href="#acceso" role="tab" data-toggle="tab"><strong class="text-info">Acceso</strong></a>
                                                </li>
                                            </ul>


                                            <div class="tab-content">
                                                <div role="tabpanel" class="tab-pane fade in active show" id="basico">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="tipoDocumento">Tipo de documento: <i class="fa fa-info-circle  text-danger"></i></label>
                                                                <select id="tipoDocumento" class="form-control">
                                                                    <option value="DNI">DNI</option>
                                                                    <option value="Carnet-Extranjeria">Carnet-Extranjeria</option>
                                                                    <option value="Pasaporte">Pasaporte</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="numeroDocumento">Número de documento: <i class="fa fa-info-circle  text-danger"></i></label>
                                                                <input id="numeroDocumento" type="number" name="numeroDocumento" class="form-control" placeholder="Ingrese el número de documento" required="" minlength="8">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="apellidos">Apellidos: <i class="fa fa-info-circle text-danger"></i></label>
                                                                <input id="apellidos" type="text" name="apellidos" class="form-control" placeholder="Ingrese los apellidos" required="" minlength="2">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="nombres">Nombres: <i class="fa fa-info-circle text-danger"></i></label>
                                                                <input id="nombres" type="text" name="nombres" class="form-control" placeholder="Ingrese los nombres" required="" minlength="2">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="sexo">Sexo: </label>
                                                                <select id="sexo" class="form-control">
                                                                    <option value="Masculino">Masculino</option>
                                                                    <option value="Femenino">Femenino</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div role="tabpanel" class="tab-pane fade" id="contacto">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="nacimiento">Fecha de Nacimiento: </label>
                                                                <input id="nacimiento" type="date" name="nacimiento" class="form-control" required="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="telefono">Teléfono: </label>
                                                                <input id="telefono" type="number" name="telefono" class="form-control" placeholder="Ingrese el número de teléfono" required="" minlength="6">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="celular">Celular: <i class="fa fa-info-circle text-danger"></i></label>
                                                                <input id="celular" type="number" name="celular" class="form-control" placeholder="Ingrese el número de celular" required="" minlength="6">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="email">Email: </label>
                                                                <input id="email" type="email" name="email" class="form-control" placeholder="Ingrese el email" required="" minlength="6">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="direccion">Dirección: </label>
                                                                <input id="direccion" type="text" name="direccion" class="form-control" placeholder="Ingrese la dirección" required="" minlength="6">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div role="tabpanel" class="tab-pane fade" id="acceso">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="codigo">Codigo: </label>
                                                                <input id="codigo" type="text" name="codigo" class="form-control" placeholder="Ingrese el codigo de empleado" required="" minlength="2">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="rol">Rol: </label>
                                                                <select id="rol" class="form-control">
                                                                    <option value="Gestion">Gestion</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="usuario">Usuario: <i class="fa fa-info-circle text-danger"></i></label>
                                                                <input id="usuario" type="text" name="usuario" class="form-control" placeholder="Ingrese el nombre de usuario" required="" minlength="2">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for=pass>Contraseña: <i class="fa fa-info-circle text-danger"></i></label>
                                                                <div class="d-flex">
                                                                    <input id="pass" type="password" name="pass" class="form-control" placeholder="Ingrese la contraseña de usuario" required="" minlength="2">
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="estado">Estado: </label>
                                                                <select id="estado" class="form-control">
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
                                    <p class="text-left text-danger">Todos los campos marcados con <i class="fa fa-info-circle text-danger"></i> son obligatorios</p>
                                    <button type="button" class="btn btn-success btn-group-sm" id="btnGuardarModal">
                                        <i class="fa fa-save"></i> Guardar</button>
                                    <button type="button" class="btn btn-danger btn-group-sm" id="btnCancelModal">
                                        <i class="fa fa-remove"></i> Cancelar</button>
                                </div>
                            </div>
                        </div>
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
                                <input type="search" class="form-control" placeholder="Buscar por apellidos, nombres o dni" id="txtSearch">
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
                                                <th class="sorting text-center" width="5%;">#</th>
                                                <th class="sorting" width="10%;">N° de Documento</th>
                                                <th class="sorting" width="20%;">Apellidos y Nombres</th>
                                                <th class="sorting" width="10%;">Celular</th>
                                                <th class="sorting text-center" width="5%;">Editar</th>
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

                let idEmpleado = "";

                $(document).ready(function() {

                    $('#modalEmpleado').on('shown.bs.modal', function(event) {
                        $('#numeroDocumento').trigger('focus')
                    });

                    $("#btnAdd").click(function() {
                        addEmpleado();
                    })

                    $("#btnCancelModal").click(function() {
                        clearModalEmpleado()
                    })

                    $("#btnCloseModal").click(function() {
                        clearModalEmpleado()
                    })

                    $("#btnReload").click(function() {
                        loadInitEmpleados()
                    })

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

                    $("#txtSearch").keyup(function() {
                        if ($("#txtSearch").val().trim() != '') {
                            if (!state) {
                                paginacion = 1;
                                loadTableEmpleados($("#txtSearch").val().trim());
                                opcion = 1;
                            }
                        }
                    });

                    $("#btnGuardarModal").click(function() {
                        crudEmpleado();
                    });

                    loadInitEmpleados();

                });

                function onEventPaginacion() {
                    switch (opcion) {
                        case 0:
                            loadTableEmpleados('');
                            break;
                        case 1:
                            loadTableEmpleados($("#txtSearch").val().trim());
                            break;
                    }
                }

                function loadInitEmpleados() {
                    if (!state) {
                        paginacion = 1;
                        loadTableEmpleados('');
                        opcion = 0;
                    }
                }

                function loadTableEmpleados(text) {
                    $.ajax({
                        url: "../app/empleados/EmpleadoController.php",
                        method: "GET",
                        data: {
                            "type": "lista",
                            "opcion": 1,
                            "page": paginacion,
                            "datos": text
                        },
                        beforeSend: function() {
                            state = true;
                            totalPaginacion = 0;
                            tbLista.empty();
                            tbLista.append(
                                '<tr role="row" class="odd"><td class="sorting_1" colspan="7" style="text-align:center"><img src="./images/loading.gif" width="100"/><p>Cargando información...</p></td></tr>'
                            );
                        },
                        success: function(result) {
                            tbLista.empty();
                            if (result.estado == 1) {
                                if (result.empleados.length == 0) {
                                    tbLista.append(
                                        '<tr role="row" class="odd"><td class="sorting_1" colspan="7" style="text-align:center"><p>No datos para mostrar.</p></td></tr>'
                                    );
                                    $("#lblPaginaActual").html(0);
                                    $("#lblPaginaSiguiente").html(0);
                                    state = false;
                                } else {
                                    let count = 0;
                                    for (let empleado of result.empleados) {
                                        count++;
                                        let btnPerfil =
                                            '<button class="btn btn-info" onclick="loadDataPerfil(\'' + empleado.idEmpleado + '\')">' +
                                            '<i class="fa fa-user-circle"></i>' +
                                            '</button>';

                                           let btnUpdate =  '<button class="btn btn-warning" onclick="updateEmpleado(\'' + empleado.idEmpleado + '\')">' + '<i class="fa fa-pencil"></i>'


                                        tbLista.append('<tr role="row" class="odd">' +
                                            '<td class="text-center">' + count + '</td>' +
                                            '<td>' + empleado.numeroDocumento + '</td>' +
                                            '<td>' + empleado.apellidos + " " + empleado.nombres + '</td>' +
                                            '<td>' + empleado.celular + '</td>' +
                                            '<td class="text-center">' + btnUpdate + '</td>' +
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
                                    '<tr role="row" class="odd"><td class="sorting_1" colspan="7" style="text-align:center"><p>' +
                                    result.mensaje + '</p></td></tr>');
                                state = false;
                            }
                        },
                        error: function(error) {
                            tbLista.empty();
                            tbLista.append(
                                '<tr role="row" class="odd"><td class="sorting_1" colspan="7" style="text-align:center"><p>' +
                                error.responseText + '</p></td></tr>');
                            state = false;
                        }
                    });
                }


                function addEmpleado() {
                    $("#modalEmpleado").modal("show");
                    $("#titulo-modal").append('<i class="fa fa-user-plus"></i> Registrar Empleado')

                    /*
                    $.ajax({
                        url: "../app/empleados/EmpleadoController.php",
                        method: "GET",
                        data: {
                            "type": "getregistro"
                        },
                        beforeSend: function() {
                            $("#lblTextOverlayEmpleado").html("Cargando información...");
                            $("#divOverlayEmpleado").removeClass("d-none");
                            $("#rol").empty();
                        },
                        success: function(result) {
                            
                            if (result.estado == 1) {
                                $("#rol").append('<option value="">- Seleccione -</option>');
                                for (rol of result.roles) {
                                    $("#rol").append('<option value="' + rol.idRol + '">' + rol.nombre + '</option>');
                                }
                                $("#divOverlayEmpleado").addClass("d-none");
                            } else {
                                $("#lblTextOverlayEmpleado").html(result.mensaje);
                            }
                        },
                        error: function(error) {
                            $("#lblTextOverlayEmpleado").html(error.responseText);
                        }
                    });
                    */
                    
                }

                function crudEmpleado() {
                    if ($("#numeroDocumento").val() == '' || $("#numeroDocumento").val().length < 8) {
                        tools.AlertWarning("Advertencia", "Ingrese un número de documento valido")
                    } else if ($("#apellidos").val() == '' || $("#apellidos").val().length < 2) {
                        tools.AlertWarning("Advertencia", "Ingrese un apellido de 2 o mas letras.")
                    } else if ($("#nombres").val() == '' || $("#nombres").val().length < 2) {
                        tools.AlertWarning("Advertencia", "Ingrese un nombre de 2 o mas letras.")
                    } else if ($("#celular").val() == '' || $("#celular").val().length < 6) {
                        tools.AlertWarning("Advertencia", "Ingrese un número de celular valido.")
                    } else if ($("#usuario").val() == '' || $("#usuario").val().length < 4) {
                        tools.AlertWarning("Advertencia", "Ingrese un nombre de usuario valido.")
                    } else if ($("#pass").val() == '' || $("#pass").val().length < 4) {
                        tools.AlertWarning("Advertencia", "Ingrese una contraseña valida.")
                    }else {
                        tools.ModalDialog('Empleado', '¿Desea guardar los datos?', 'question', function(result) {
                            if (result) {
                                $.ajax({
                                    url: "../app/empleados/EmpleadoController.php",
                                    method: "POST",
                                    accepts: "application/json",
                                    contentType: "application/json",
                                    data: JSON.stringify({
                                        "type": "crud",
                                        "idEmpleado": idEmpleado,
                                        "tipoDocumento": $("#tipoDocumento").val(),
                                        "numeroDocumento": $("#numeroDocumento").val().trim(),
                                        "apellidos": ($("#apellidos").val()).toUpperCase().trim(),
                                        "nombres": ($("#nombres").val()).toUpperCase().trim(),
                                        "sexo": $("#sexo").val(),
                                        "fechaNacimiento": $("#nacimiento").val(),
                                        "telefono": $("#telefono").val().trim(),
                                        "celular": $("#celular").val().trim(),
                                        "email": $("#email").val().trim(),
                                        "direccion": ($("#direccion").val()).toUpperCase().trim(),

                                        "codigo": $("#codigo").val().trim(),

                                        "rol": $("#rol").val(),
                                        "usuario": $("#usuario").val(),
                                        "clave": $("#pass").val(),
                                        "estado": $("#estado").val(),
                                    }),
                                    beforeSend: function() {
                                        clearModalEmpleado();
                                        tools.ModalAlertInfo('Empleados', 'Procesando petición...');
                                    },
                                    success: function(result) {
                                        if (result.estado == 1) {
                                            tools.ModalAlertSuccess('Empleados', result.mensaje);
                                            loadInitEmpleados()
                                        } else {
                                            tools.ModalAlertWarning('Empleados', result.mensaje);
                                        }
                                    },
                                    error: function(error) {
                                        tools.ModalAlertError("Empleados", error.responseText);
                                    }
                                });
                            }
                        });
                    }
                }

                function updateEmpleado(id) {
                    $("#modalEmpleado").modal("show");
                    $("#titulo-modal").append('<i class="fa fa-user"></i> Editar Empleado');

                    $.ajax({
                        url: "../app/empleados/EmpleadoController.php",
                        method: "GET",
                        data: {
                            "type": "getbyid",
                            "idEmpleado": id
                        },
                        beforeSend: function() {
                            $("#lblTextOverlayEmpleado").html("Cargando información...");
                            $("#divOverlayEmpleado").removeClass("d-none");
                            // $("#rol").empty();
                        },
                        success: function(result) {
                            // console.log(result)
                            if (result.estado == 1) {
                                let empleado = result.empleados;
                                idEmpleado = id;

                                /* tipoDocumento, sexo , rol y estado*/

                                $("#tipoDocumento").val(empleado.tipoDocumento)
                                $("#numeroDocumento").val(empleado.numeroDocumento)
                                $("#apellidos").val(empleado.apellidos)
                                $("#nombres").val(empleado.nombres)
                                $("#sexo").val(empleado.sexo)

                                $("#nacimiento").val(empleado.fechaNacimiento)
                                $("#telefono").val(empleado.telefono)
                                $("#celular").val(empleado.celular)
                                $("#email").val(empleado.email)
                                $("#direccion").val(empleado.direccion)

                                $("#codigo").val(empleado.codigo)

                                $("#usuario").val(empleado.usuario)
                                $("#pass").val(empleado.clave)
                                $("#estado").val(empleado.estado)

                                // $("#rol").append('<option value="">- Seleccione -</option>');
                                // for (rol of result.roles) {
                                //     $("#rol").append('<option value="' + rol.idRol + '">' + rol.nombre + '</option>');
                                // }
                                $("#rol").val(empleado.rol)

                                $("#divOverlayEmpleado").addClass("d-none");
                            } else {
                                $("#lblTextOverlayEmpleado").html(result.mensaje);
                            }

                        },
                        error: function(error) {
                            $("#lblTextOverlayEmpleado").html(error.responseText);
                        }
                    });
                }


                function deleteEmpleado(idEmpleado) {
                    tools.ModalDialog('Personal', '¿Está seguro de eliminar al empleado?', 'question', function(result) {
                        if (result) {
                            $.ajax({
                                url: "../app/empleados/EmpleadoController.php",
                                method: "POST",
                                accepts: "application/json",
                                contentType: "application/json",
                                data: JSON.stringify({
                                    "type": "delete",
                                    "idEmpleado": idEmpleado
                                }),
                                beforeSend: function() {
                                    tools.ModalAlertInfo('Personal', 'Procesando petición...');
                                },
                                success: function(result) {
                                    if (result.estado == 1) {
                                        tools.ModalAlertSuccess('Personal', result.mensaje);
                                        loadInitClientes();
                                    } else {
                                        tools.ModalAlertWarning('Personal', result.mensaje);
                                    }
                                },
                                error: function(error) {
                                    tools.ModalAlertError("Personal", error.responseText);
                                }
                            });
                        }
                    });
                }

                function loadDataPerfil(idEmpleado) {
                    location.href = "empleadoPerfil.php?idEmpleado=" + idEmpleado
                }

                function clearModalEmpleado() {
                    $("#modalEmpleado").modal("hide")
                    $("#titulo-modal").empty()

                    document.getElementById("tipoDocumento").selectedIndex = "0"
                    $("#numeroDocumento").val('')
                    $("#apellidos").val('')
                    $("#nombres").val('')
                    document.getElementById("sexo").selectedIndex = "0"

                    $("#nacimiento").val('')
                    $("#telefono").val('')
                    $("#celular").val('')
                    $("#email").val('')
                    $("#direccion").val('')

                    $("#codigo").val('')
                    document.getElementById("rol").selectedIndex = "0"
                    $("#usuario").val('')
                    $("#pass").val('')
                    document.getElementById("estado").selectedIndex = "0"


                    $("#navContanto").removeClass("active");
                    $("#navLabores").removeClass("active");
                    $("#navAcceso").removeClass("active");
                    $("#navBasico").removeClass("active");
                    $("#navBasico").addClass("active");

                    $("#contacto").removeClass("in active show");
                    $("#labores").removeClass("in active show");
                    $("#acceso").removeClass("in active show");
                    $("#basico").removeClass("in active show");
                    $("#basico").addClass("in active show");

                    idEmpleado = "";
                }
            </script>
        </body>

        </html>

<?php

}
