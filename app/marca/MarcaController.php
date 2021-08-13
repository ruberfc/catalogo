<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Content-Type: application/json; charset=UTF-8');
require './MarcaAdo.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if ($_GET["type"] == "lista") {
        $page = $_GET['page'];
        $search = $_GET["datos"];
        $result = MarcaAdo::ListaMarca($search, ($page - 1) * 10, 10);
        if (is_array($result)) {
            print json_encode(array(
                "estado" => 1,
                "marca" => $result[0],
                "total" => $result[1]
            ));
        } else {
            print json_encode(array(
                "estado" => 0,
                "mensaje" => $result
            ));
        }
    } else if ($_GET["type"] == "getbyid") {
        $result = MarcaAdo::GetMarcaById($_GET["idMarca"]);
        if (is_object($result)) {
            print json_encode(array(
                "estado" => 1,
                "marca" => $result
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
        $result = MarcaAdo::CrudMarca($body);
        if ($result == "inserted") {
            print json_encode(array(
                "estado" => 1,
                "mensaje" => "Se registró correctamente la marca.",
            ));
        } else    if ($result == "updated") {
            print json_encode(array(
                "estado" => 1,
                "mensaje" => "Se actualizó correctamente la marca.",
            ));
        } else   if ($result == "name") {
            print json_encode(array(
                "estado" => 2,
                "mensaje" => "Hay una marca con el mismo nombre.",
            ));
        } else {
            print json_encode(array(
                "estado" => 0,
                "mensaje" => $result,
            ));
        }
    } else if ($body["type"] == "deleted") {
        $result = MarcaAdo::DeletedMarca($body["idMarca"]);
        if ($result == "deleted") {
            print json_encode(array(
                "estado" => 1,
                "mensaje" => "Se eliminó correctamente la marca.",
            ));
        } else if ($result == "producto") {
            print json_encode(array(
                "estado" => 2,
                "mensaje" => "No se puede eliminar la marca porque esta ligado a un producto.",
            ));
        } else {
            print json_encode(array(
                "estado" => 0,
                "mensaje" => $result,
            ));
        }
    }
}
