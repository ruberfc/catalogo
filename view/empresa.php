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
                    <div>
                        <h1><i class="fa fa-calendar"></i> Datos de mi empresa
                        </h1>
                    </div>
                </div>
                <div class="tile mb-4">

                    <div class="overlay d-none" id="divOverlayEmpresa">
                        <div class="m-loader mr-4">
                            <svg class="m-circular" viewBox="25 25 50 50">
                                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="4" stroke-miterlimit="10"></circle>
                            </svg>
                        </div>
                        <h4 class="l-text" id="lblTextOverlayEmpresa">Cargando información...</h4>
                    </div>

                    <div class="tile-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-text">Representante: <i class="fa fa-fw fa-asterisk text-danger"></i></label>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input id="representante" type="text" class="form-control" placeholder="Ingrese el nombre del representante">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-text">Nombre de la empresa: <i class="fa fa-fw fa-asterisk text-danger"></i></label>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input id="empresa" type="text" class="form-control" placeholder="Ingrese el nombre de la empresa">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-text">R.U.C.: <i class="fa fa-fw fa-asterisk text-danger"></i></label>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input id="ruc" type="number" class="form-control" placeholder="Ingrese el numero de RUC">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-text">Teléfono:</label>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input id="telefono" type="text" class="form-control" placeholder="Ingrese el numero de teléfono">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-text">Celular: <i class="fa fa-fw fa-asterisk text-danger"></i></label>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input id="celular" type="number" class="form-control" placeholder="Ingrese el numero de celular">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-text">Email:</label>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input id="email" type="email" class="form-control" placeholder="Ingrese el email">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-text">Pagina web:</label>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input id="web" type="text" class="form-control" placeholder="Ingrese el dominio">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-text">Dirección: <i class="fa fa-fw fa-asterisk text-danger"></i></label>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input id="direccion" type="text" class="form-control" placeholder="Ingrese la dirección">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-text">Términos y condiciones:</label>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input id="terminos" type="text" class="form-control" placeholder="Ingrese la descripción de los términos">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-text text-left text-danger">Todos los campos marcados con <i class="fa fa-fw fa-asterisk text-danger"></i> son obligatorios</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group text-right">
                                    <button class="btn btn-success" type="button" id="btnGuardar"><i class="fa fa-save"></i>
                                        Guardar</button>
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
                let idMiEmpresa = ''
                let state = false;

                $(document).ready(function() {

                    loadDataEmpresa();

                    $("#btnGuardar").click(function() {
                        crudEmpresa();
                    });

                    $("#btnGuardar").keypress(function(event) {
                        if (event.keyCode === 13) {
                            crudEmpresa();
                        }
                        event.preventDefault();
                    });

                });


                function loadDataEmpresa() {
                    if (!state) {
                        getDataEmpresa();
                    }
                }


                function getDataEmpresa() {
                    $.ajax({
                        url: "../app/miempresa/Obtener_MiEmpresa.php",
                        method: "GET",
                        data: {},
                        beforeSend: function() {
                            state = true
                            $("#divOverlayEmpresa").removeClass("d-none");
                            $("#lblTextOverlayEmpresa").html("Cargando información...");
                        },
                        success: function(result) {
                            let data = JSON.parse(result);
                            let empresa = data.datos[0];
                            if (data.estado == 1) {
                                idMiEmpresa = empresa.idMiEmpresa
                                $("#representante").val(empresa.representante)
                                $("#empresa").val(empresa.nombreEmpresa)
                                $("#ruc").val(empresa.ruc)
                                $("#telefono").val(empresa.telefono)
                                $("#celular").val(empresa.celular)
                                $("#email").val(empresa.email)
                                $("#web").val(empresa.web)
                                $("#direccion").val(empresa.direccion)
                                $("#terminos").val(empresa.terminos)
                                $("#divOverlayEmpresa").addClass("d-none");
                                state = false;
                            } else {
                                idMiEmpresa = ''
                                $("#lblTextOverlayEmpresa").html(result.mensaje);
                                state = false;
                            }
                        },
                        error: function(error) {
                            $("#lblTextOverlayEmpresa").html(error.responseText);
                            state = false;
                        }
                    });
                }

                function crudEmpresa() {
                    if ($("#representante").val() == '' || $("#representante").val().length < 7) {
                        tools.AlertWarning("Advertencia", "Ingrese un nombre de representante.")
                    } else if ($("#empresa").val() == '' || $("#empresa").val().length < 4) {
                        tools.AlertWarning("Advertencia", "Ingrese un nombre de empresa.")
                    } else if ($("#ruc").val() == '' || $("#ruc").val().length < 8) {
                        tools.AlertWarning("Advertencia", "Ingrese un número de RUC valido.")
                    } else if ($("#celular").val() == '' || $("#celular").val().length < 9) {
                        tools.AlertWarning("Advertencia", "Ingrese un número de celular valido.")
                    } else if ($("#direccion").val() == '') {
                        tools.AlertWarning("Advertencia", "Ingrese una dirección.")
                    } else {
                        tools.ModalDialog('Empresa', '¿Desea guardar los datos?', 'question', function(result) {
                            if (result) {
                                if (!state) {
                                    $.ajax({
                                        url: "../app/miempresa/Crud_MiEmpresa.php",
                                        method: "POST",
                                        accepts: "application/json",
                                        contentType: "application/json",
                                        data: JSON.stringify({
                                            "idMiEmpresa": idMiEmpresa,
                                            "representante": $("#representante").val().trim(),
                                            "nombreEmpresa": $("#empresa").val().trim(),
                                            "ruc": $("#ruc").val().trim(),
                                            "telefono": $("#telefono").val().trim(),
                                            "celular": $("#celular").val().trim(),
                                            "email": $("#email").val().trim(),
                                            "paginaWeb": $("#web").val().trim(),
                                            "direccion": $("#direccion").val().trim(),
                                            "terminos": $("#terminos").val().trim()
                                        }),
                                        beforeSend: function() {
                                            tools.ModalAlertInfo('Empresa', 'Procesando petición...');
                                        },
                                        success: function(result) {
                                            if (result.estado == 1) {
                                                tools.ModalAlertSuccess('Empresa', result.mensaje);
                                            } else {
                                                tools.ModalAlertWarning('Empresa', result.mensaje);
                                            }
                                        },
                                        error: function(error) {
                                            tools.ModalAlertError("Empresa", error.responseText);
                                        }
                                    });
                                }
                            }
                        });
                    }
                }
            </script>
        </body>

        </html>

<?php
    
}
