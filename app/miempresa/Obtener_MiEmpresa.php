<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
// header('Content-Type: application/json; charset=UTF-8');

require './MiEmpresaAdo.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Manejar petición GET
    $datos = MiEmpresaAdo::getMiEmpresa();

    if (is_array($datos)) {        
        if(!empty($datos)){
            print json_encode(array(
            "estado"=>1,
            "datos"=>$datos
        ));
        }else{
            print json_encode(array(
                "estado"=>2,
                "mensaje"=>"Sin contendio"
            ));
        }        
    } else {
        print json_encode(array(
            "estado" => 3,
            "mensaje" => $datos
        ));
    }
    exit();
}

