<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Content-Type: application/json; charset=UTF-8');
require './ImpuestoAdo.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if ($_GET["type"] == "lista") {
        $page = $_GET['page'];
        $search = $_GET["datos"];
        $result = ImpuestoAdo::ListaImpuestos($search, ($page - 1) * 10, 10);
        if (is_array($result)) {
            print json_encode(array(
                "estado" => 1,
                "impuestos" => $result[0],
                "total" => $result[1]
            ));
        } else {
            print json_encode(array(
                "estado" => 0,
                "mensaje" => $result
            ));
        }
    } else if ($_GET["type"] == "getbyid") {
        $result = ImpuestoAdo::GetImpuestoById($_GET["idImpuesto"]);
        if (is_object($result)) {
            print json_encode(array(
                "estado" => 1,
                "impuesto" => $result
            ));
        } else if ($result == false) {
            print json_encode(array(
                "estado" => 2,
                "mensaje" => "No se puedo obtener los datos, intente nuevamente por favor."
            ));
        } else {
            print json_encode(array(
                "estado" => 0,
                "mensaje" => $result
            ));
        }
    }
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $body = json_decode(file_get_contents("php://input"), true);

    if ($body["type"] == "crud") {
        $result = ImpuestoAdo::CrudImpuesto($body);
        if ($result == "inserted") {
            print json_encode(array(
                "estado" => 1,
                "mensaje" => "Se registró correctamente el impuesto.",
            ));
        } else if ($result == "updated") {
            print json_encode(array(
                "estado" => 1,
                "mensaje" => "Se actualizó correctamente el impuesto.",
            ));
        } else if ($result == "name") {
            print json_encode(array(
                "estado" => 2,
                "mensaje" => "Hay un impuesto con el mismo nombre.",
            ));
        } else {
            print json_encode(array(
                "estado" => 0,
                "mensaje" => $result,
            ));
        }
    } else if ($body["type"] == "deleted") {
        $result = ImpuestoAdo::DeletedImpuesto($body["idImpuesto"]);
        if ($result == "deleted") {
            print json_encode(array(
                "estado" => 1,
                "mensaje" => "Se eliminó correctamente el impuesto.",
            ));
        } else if ($result == "producto") {
            print json_encode(array(
                "estado" => 2,
                "mensaje" => "No se puede eliminar el impuesto porque esta ligado a un producto.",
            ));
        } else {
            print json_encode(array(
                "estado" => 0,
                "mensaje" => $result,
            ));
        }
    }
}
