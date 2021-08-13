<?php
session_start();
if (isset($_SESSION["IdEmpleado"])) {
    echo '<script>location.href = "./index.php";</script>';
} else {
?>
    <!DOCTYPE html>
    <html>

    <head>
        <?php include './layout/head.php'; ?>
    </head>

    <body>
        <section class="material-half-bg">
            <div class="cover"></div>
        </section>
        <section class="login-content">

            <div class="tile p-0">

                <div class="overlay d-none" id="divOverlayLogin">
                    <div class="m-loader mr-4">
                        <svg class="m-circular" viewBox="25 25 50 50">
                            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="4" stroke-miterlimit="10"></circle>
                        </svg>
                    </div>
                    <h4 class="l-text" id="lblTextOverlayLogin">Procesando Petición...</h4>
                </div>

                <div class="tile-body">
                    <div class="login-box">
                        <div class="login-form">
                            <h4 class="login-head"><img class="img-fluid" src="./images/logo.jpg" alt="Logo" width="120" /></h4>
                            <h4 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>Credenciales de Acceso</h4>
                            <div class="form-group">
                                <label class="control-label">Usuario</label>
                                <input class="form-control" type="text" placeholder="Dijite el usuario" id="txtUsuario" autofocus>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Contraseña</label>
                                <input class="form-control" type="password" placeholder="Dijite la contraseña" id="txtClave">
                            </div>
                            <div class="form-group text-center">
                                <label class="control-label text-danger" id="lblErrorMessage"></label>
                            </div>
                            <div class="form-group btn-container">
                                <button class="btn btn-primary btn-block" id="btnAceptar"><i class="fa fa-sign-in fa-lg fa-fw"></i>ACEPTAR</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </section>

        <?php include("./layout/footer.php"); ?>
        <script type="text/javascript">
            let tools = new Tools();
            let state = false;

            $(document).ready(function() {

                $("#btnAceptar").click(function() {
                    if (!state) {
                        login();
                    }
                });

                $("#btnAceptar").keypress(function(event) {
                    if (event.keyCode == 13) {
                        if (!state) {
                            login();
                        }
                    }
                    event.preventDefault();
                });

                $("#txtUsuario").keyup(function(event) {
                    if (event.keyCode == 13) {
                        if (!state) {
                            login();
                        }
                    }
                });

                $("#txtClave").keyup(function(event) {
                    if (event.keyCode == 13) {
                        if (!state) {
                            login();
                        }
                    }
                });

            });

            function login() {
                if ($("#txtUsuario").val().trim() == '') {
                    tools.AlertWarning('Mensaje: ', "Ingrese un usuario por favor");
                    $("#lblErrorMessage").html('');
                    $("#txtUsuario").focus();
                } else if ($("#txtClave").val().trim() == '') {
                    tools.AlertWarning('Mensaje: ', "Ingrese una contraseña por favor");
                    $("#lblErrorMessage").html('');
                    $("#txtClave").focus();
                } else {
                    $.ajax({
                        url: "../app/empleados/Obtener_Empleados_For_Login.php",
                        method: "GET",
                        data: {
                            "usuario": $("#txtUsuario").val().trim(),
                            "clave": $("#txtClave").val().trim()
                        },
                        beforeSend: function() {
                            state = true;
                            $("#divOverlayLogin").removeClass("d-none");
                            $("#lblTextOverlayLogin").html("Procesando Petición...");
                        },
                        success: function(result) {
                            if (result.estado == 1) {
                                state = false;
                                location.href = "./index.php";
                            } else {
                                if (result.estado == 2) {
                                    $("#txtUsuario").val('');
                                    $("#txtUsuario").focus();
                                    $("#txtClave").val('');
                                } else if (result.estado == 3) {
                                    $("#txtClave").val('');
                                    $("#txtClave").focus();
                                }
                                $("#lblErrorMessage").html(result.message);
                                $("#divOverlayLogin").addClass("d-none");
                                state = false;
                            }
                        },
                        error: function(error) {
                            $("#txtUsuario").val('')
                            $("#txtClave").val('')
                            $("#txtUsuario").focus();
                            $("#lblErrorMessage").html(error.responseText);
                            $("#divOverlayLogin").addClass("d-none");
                            state = false;
                        }
                    });
                }
            }
        </script>
    </body>

    </html>
<?php
}
