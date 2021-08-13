<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Content-Type: application/json; charset=UTF-8');
require './ProductoAdo.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if ($_GET["type"] == "lista") {
        $search = $_GET['datos'];
        $page = $_GET['page'];

        $productos = ProductoAdo::getAllProducto($search, ($page - 1) * 10, 10);
        if (is_array($productos)) {
            $datos["estado"] = 1;
            $datos["total"] = $productos[1];
            $datos["productos"] = $productos[0];
            print json_encode($datos);
        } else {
            print json_encode(array(
                "estado" => 2,
                "mensaje" => $productos
            ));
        }
    } else if ($_GET["type"] == "getbyid") {
        $result = ProductoAdo::getProductoById($_GET["idProducto"]);
        if (is_array($result)) {
            print json_encode(array(
                "estado" => 1,
                "producto" => $result[0],
                "categorias" => $result[1],
                "marcas" => $result[2],
            ));
        } else {
            print json_encode(array(
                "estado" => 2,
                "mensaje" => $producto
            ));
        }
    } else if ($_GET["type"] == "getCategoriaMarca") {
        $result = ProductoAdo::getDataRegistroProducto();
        if (is_array($result)) {
            print json_encode(array(
                "estado" => 1,
                "categorias" => $result[0],
                "marcas" => $result[1]
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
        $result = ProductoAdo::crudProducto($body);
        if ($result == "inserted") {
            echo json_encode(array("estado" => 1, "mensaje" => "Se registró correctamente el producto"));
        } else if ($result == "updated") {
            echo json_encode(array("estado" => 1, "mensaje" => "Se actualizó correctamente el producto"));
        } else if ($result == "duplicate") {
            echo json_encode(array("estado" => 3, "mensaje" => "Ya existe un producto con la misma clave"));
        } else if ($result == "duplicatename") {
            echo json_encode(array("estado" => 4, "mensaje" => "Ya existe un producto con el mismo nombre"));
        } else {
            echo json_encode(array("estado" => 0, "mensaje" => $result));
        }
    } else if ($body["type"] == "delete") {
        $result = ProductoAdo::deleteProducto($body);
        if ($result == "deleted") {
            print json_encode(array("estado" => 1, "mensaje" => "Se eliminó correctamente"));
        } elseif ($result == "registrado") {
            print json_encode(array("estado" => 2, "mensaje" => "No se puede eliminar el producto porque está ligada a una venta"));
        } else {
            print json_encode(array("estado" => 3, "mensaje" => $result));
        }
    }
}
