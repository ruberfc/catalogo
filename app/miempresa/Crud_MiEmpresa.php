<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Content-Type: application/json; charset=UTF-8');

require './MiEmpresaAdo.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $body = json_decode(file_get_contents("php://input"), true);

    if (MiEmpresaAdo::validate()) {
        $result = MiEmpresaAdo::actualizar($body);
        if ($result == "updated") {
             print json_encode(array(
                "estado" => 1,
                "mensaje" => "Se actualizó correctamente los datos de la empresa!!"
            ));
        } else {
            print json_encode(array(
                "estado" => 2,
                "mensaje" => $result
            ));
        }
    } else {
        $result = MiEmpresaAdo::registrar($body);
        if ($result == "inserted") {
            print json_encode(array(
                "estado" => 1,
                "mensaje" => "Se registró correctamente los datos de la empresa!!"
            ));
        } else {
            print json_encode(array(
                "estado" => 2,
                "mensaje" => $result
            ));
        }

    }
    exit();
}


