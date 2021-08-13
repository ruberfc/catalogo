<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Content-Type: application/json; charset=UTF-8');
require './EmpleadoAdo.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if ($_GET["type"] == "lista") {
        $body = $_GET['page'];
        $text = $_GET['datos'];

        $empleados = EmpleadoAdo::getAllEmpleado($text, ($body - 1) * 10, 10);
        if (is_array($empleados)) {
            $datos["estado"] = 1;
            $datos["total"] = $empleados[1];
            $datos["empleados"] = $empleados[0];
            print json_encode($datos);
        } else {
            print json_encode(array(
                "estado" => 2,
                "mensaje" => "Ha ocurrido un error"
            ));
        }
    } else if ($_GET["type"] == "getbyid") {
        $result = EmpleadoAdo::getEmpleadoById($_GET["idEmpleado"]);
        if ($result) {
            $datos["estado"] = 1;
            $datos["empleados"] = $result;
            print json_encode($datos);
        } else {
            print json_encode(array(
                "estado" => 2,
                "mensaje" => "Ha ocurrido un error"
            ));
        }
    } else if ($_GET["type"] == "getregistro") {
        $result = EmpleadoAdo::getEmpleadoRegister();
        if (is_array($result)) {
            $datos["estado"] = 1;
            $datos["roles"] = $result[0];
            print json_encode($datos);
        } else {
            print json_encode(array(
                "estado" => 2,
                "mensaje" => $result
            ));
        }
    } else if ($_GET["type"] == "getmembresia") {
        $empleado = EmpleadoAdo::getMembresiaMarcarAsistencia($_GET["buscar"]);
        if (is_array($empleado)) {
            print json_encode(array(
                "estado" => 1,
                "empleado" => $empleado[0],
                "asistencia" => $empleado[1]
            ));
        } else {
            print json_encode(array(
                "estado" => 0,
                "mensaje" => $empleado
            ));
        }
    }
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $body = json_decode(file_get_contents("php://input"), true);

    if ($body["type"] == "crud") {
        if (EmpleadoAdo::validateEmpleadoId($body['idEmpleado'])) {
            $retorno = EmpleadoAdo::editEmpleado($body);
            if ($retorno == "updated") {
                echo json_encode(array("estado" => 1, "mensaje" => "Se actualizó correctamente el empleado."));
            } else if ($result == "numdocumento") {
                echo json_encode(array("estado" => 2, "mensaje" => "Ya existe un empleado con el mismo número de documento."));
            } else {
                echo json_encode(array("estado" => 3, "mensaje" => $retorno));
            }
        } else {
            $result = EmpleadoAdo::insertEmpleado($body);
            if ($result == "inserted") {
                echo json_encode(array("estado" => 1, "mensaje" => "Se registró correctamente el empleado."));
            } else if ($result == "numdocumento") {
                echo json_encode(array("estado" => 2, "mensaje" => "Ya existe un empleado con el mismo número de documento."));
            } else {
                echo json_encode(array("estado" => 0, "mensaje" => $result));
            }
        }
    } else if ($body["type"] == "delete") {
        $retorno = EmpleadoAdo::deleteEmpleado($body);
        if ($retorno == "deleted") {
            print json_encode(array("estado" => 1, "mensaje" => "Se eliminó correctamente"));
        } elseif ($retorno == "asistencia") {
            print json_encode(array("estado" => 2, "mensaje" => "No se puede eliminar al empleado porque tiene un historial de asistencias"));
        } else if ($retorno == "venta") {
            print json_encode(array("estado" => 3, "mensaje" => "No se puede eliminar al empleado porque tiene una venta vinculada"));
        } else {
            print json_encode(array("estado" => 4, "mensaje" => $retorno));
        }
    } else if ($body["type"] == "updateperdfil") {
        $retorno = EmpleadoAdo::editPerfil($body);
        if ($retorno == "updated") {
            echo json_encode(array("estado" => 1, "mensaje" => "Se actualizó correctamente el empleado."));
        } else if ($result == "numdocumento") {
            echo json_encode(array("estado" => 2, "mensaje" => "Ya existe un empleado con el mismo número de documento."));
        } else {
            echo json_encode(array("estado" => 3, "mensaje" => $retorno));
        }
    }
}
