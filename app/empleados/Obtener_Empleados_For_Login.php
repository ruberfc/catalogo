<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Content-Type: application/json; charset=UTF-8');
require './EmpleadoAdo.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Manejar petición GET
    $usuario = $_GET['usuario'];
    $clave = $_GET['clave'];

    $result = EmpleadoAdo::getEmpleadoForLogin($usuario, $clave);
    if ($result) {
        // $datos["empleado"] = $result;
        session_start();
        $_SESSION["IdEmpleado"] = $result->idEmpleado;
        $_SESSION["Apellidos"] = $result->apellidos;
        $_SESSION["Nombres"] = $result->nombres;
        print json_encode(array (
            "estado" => 1,
            "empleado" => $result
        ));
        // $empleados = $result[0];
        // $datos["estado"] = 1;
        // $datos["empleado"] = $empleados;
        
        // print json_encode($datos);
    } else if ($result == "nouser") {
        print json_encode(array(
            "estado" => 2,
            "message" => "Usuario incorrecto."
        ));
    } else if ($result == "nopassword") {
        print json_encode(array(
            "estado" => 3,
            "message" => "Contraseña incorrecta."
        ));
    }
     else {
        print json_encode(array(
            "estado" => 0,
            "message" => $result
        ));
    }
    exit();
}
