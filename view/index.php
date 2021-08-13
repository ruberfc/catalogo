<?php
session_start();
if (!isset($_SESSION["IdEmpleado"])) {
  echo '<script>location.href = "./login.php";</script>';
} else {
  /*if ($_SESSION["Roles"][0]["ver"] == 1) {*/
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
      <?php include './layout/head.php'; ?>
    </head>

    <body class="app sidebar-mini">
      <!-- Navbar-->
      <?php include("./layout/header.php"); ?>
      <!-- Sidebar menu-->
      <?php include("./layout/menu.php"); ?>
      <main class="app-content">

        <div class="app-title">
        <div>
          <h1><i class="fa fa-smile-o"></i> Bienvenido a COMPULIDER PERÚ</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        </ul>
      </div>

      <div class="tile mb-4 pt-xl-3 pb-xl-3 pl-xl-5">
        <div class="row">
          <div class="col-lg-12">
            <label for="f-inicio">Bienvenido a la aplicacíon de gestión de catalogo de productos de COMPULIDER PERÚ, donde podra agregar y actulizar los datos de los productos y usuarios.</label>
          </div>
        </div>

      </div>

      </main>
      <!-- Essential javascripts for application to work-->
      <?php include "./layout/footer.php"; ?>

      <script type="text/javascript">
        let tools = new Tools();

        $(document).ready(function() {
          // loadDasboard();
        });

         /* 
        function loadDasboard() {
          $.ajax({
            url: "../app/miempresa/LoadDashboard.php",
            method: "GET",
            data: {

            },
            beforeSend: function() {
              $("#lblCliente").html(0);
              $("#lblIngresos").html(0);
              $("#lblEmpleados").html(0);
              $("#lblCuentas").html(0);
              $("#tbProximasRenovaciones").empty();
              $("#lblProximasRenovaciones").html("Próximas Renovaciones(0)");
              $("#tbClientesPorRecurar").empty();
              $("#lblClientePorRecuperar").html("Clientes por Recuperar(0)");
            },
            success: function(result) {
              if (result.estado == 1) {
                $("#lblCliente").html(result.clientes);
                $("#lblIngresos").html("S/ " + tools.formatMoney(result.ingresos));
                $("#lblEmpleados").html(result.empleados);
                $("#lblCuentas").html(result.cuentas);

                for (let value of result.memPorVencer) {
                  $("#tbProximasRenovaciones").append('<tr>' +
                    '<td>' + value.apellidos + "<br>" + value.nombres + '</td>' +
                    '<td>' + tools.getDateForma(value.fechaFin) + '</td>' +
                    '<td>' + value.celular + '</td>' +
                    '</tr>');
                }

                $("#lblProximasRenovaciones").html("Próximas Renovaciones(" + result.memPorVencerTotal + ")");

                for (let value of result.memFinazalidas) {
                  $("#tbClientesPorRecurar").append('<tr>' +
                    '<td>' + value.apellidos + "<br>" + value.nombres + '</td>' +
                    '<td>' + tools.getDateForma(value.fechaFin) + '</td>' +
                    '<td>' + value.celular + '</td>' +
                    '</tr>');
                }

                $("#lblClientePorRecuperar").html("Clientes por Recuperar(" + result.memFinazalidasTotal + ")");
              } else {

              }
            },
            error: function(error) {
              console.log(error)
            }
          });
        }
        */

        // var data = {
        //   labels: ["January", "February", "March", "April", "May"],
        //   datasets: [{
        //       label: "My First dataset",
        //       fillColor: "rgba(220,220,220,0.2)",
        //       strokeColor: "rgba(220,220,220,1)",
        //       pointColor: "rgba(220,220,220,1)",
        //       pointStrokeColor: "#fff",
        //       pointHighlightFill: "#fff",
        //       pointHighlightStroke: "rgba(220,220,220,1)",
        //       data: [65, 59, 80, 81, 56]
        //     },
        //     {
        //       label: "My Second dataset",
        //       fillColor: "rgba(151,187,205,0.2)",
        //       strokeColor: "rgba(151,187,205,1)",
        //       pointColor: "rgba(151,187,205,1)",
        //       pointStrokeColor: "#fff",
        //       pointHighlightFill: "#fff",
        //       pointHighlightStroke: "rgba(151,187,205,1)",
        //       data: [28, 48, 40, 19, 86]
        //     }
        //   ]
        // };
        // var pdata = [{
        //     value: 300,
        //     color: "#46BFBD",
        //     highlight: "#5AD3D1",
        //     label: "Complete"
        //   },
        //   {
        //     value: 50,
        //     color: "#F7464A",
        //     highlight: "#FF5A5E",
        //     label: "In-Progress"
        //   }
        // ]

        // var ctxl = $("#lineChartDemo").get(0).getContext("2d");
        // var lineChart = new Chart(ctxl).Line(data);

        // var ctxp = $("#pieChartDemo").get(0).getContext("2d");
        // var pieChart = new Chart(ctxp).Pie(pdata);
      </script>
    </body>

    </html>

<?php
  /*
  } else {
    echo '<script>location.href = "./index.php";</script>';
  }
  */
}
