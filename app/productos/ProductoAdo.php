<?php

require '../database/DataBaseConexion.php';

class ProductoAdo
{

    function __construct()
    {
    }

    public static function crudProducto($body)
    {

        try {
            Database::getInstance()->getDb()->beginTransaction();

            $validateProducto = Database::getInstance()->getDb()->prepare("SELECT * FROM productotb WHERE idProducto = ?");
            $validateProducto->bindParam(1, $body['idProducto'], PDO::PARAM_STR);
            $validateProducto->execute();

            if ($validateProducto->fetch()) {

                $validateProducto = Database::getInstance()->getDb()->prepare("SELECT * FROM productotb WHERE idProducto <> ? AND clave = ?");
                $validateProducto->bindParam(1, $body['idProducto'], PDO::PARAM_STR);
                $validateProducto->bindParam(2, $body['clave'], PDO::PARAM_STR);
                $validateProducto->execute();

                if ($validateProducto->fetch()) {
                    Database::getInstance()->getDb()->rollBack();
                    return "duplicate";
                } else {

                    $validateProducto = Database::getInstance()->getDb()->prepare("SELECT * FROM productotb WHERE idProducto <> ? AND nombre = ?");
                    $validateProducto->bindParam(1, $body['idProducto'], PDO::PARAM_STR);
                    $validateProducto->bindParam(2, $body['nombre'], PDO::PARAM_STR);
                    $validateProducto->execute();

                    if ($validateProducto->fetch()) {
                        Database::getInstance()->getDb()->rollBack();
                        return "duplicatename";
                    } else {

                        $sentencia = Database::getInstance()->getDb()->prepare("UPDATE productotb 
                        SET clave = ?,
                        nombre = ?,
                        idCategoria = ?,
                        idMarca = ?,
                        costo = ?,
                        precio = ?,
                        precioOferta = ?,
                        cantidad = ?,
                        estado = ?,
                        oferta = ?
                        WHERE idProducto = ?");
                        $sentencia->bindParam(1, $body['clave'], PDO::PARAM_STR);
                        $sentencia->bindParam(2, $body['nombre'], PDO::PARAM_STR);
                        $sentencia->bindParam(3, $body['categoria'], PDO::PARAM_STR);
                        $sentencia->bindParam(4, $body['marca'], PDO::PARAM_STR);
                        $sentencia->bindParam(5, $body['costo'], PDO::PARAM_STR);
                        $sentencia->bindParam(6, $body['precio'], PDO::PARAM_STR);
                        $sentencia->bindParam(7, $body['precioOferta'], PDO::PARAM_STR);
                        $sentencia->bindParam(8, $body['cantidad'], PDO::PARAM_STR);
                        $sentencia->bindParam(9, $body['estado'], PDO::PARAM_BOOL);
                        $sentencia->bindParam(10, $body['oferta'], PDO::PARAM_BOOL);
                        $sentencia->bindParam(11, $body['idProducto'], PDO::PARAM_STR);
                        $sentencia->execute();

                        Database::getInstance()->getDb()->commit();
                        return "updated";
                    }
                }
            } else {

                $validateProducto = Database::getInstance()->getDb()->prepare("SELECT * FROM productotb WHERE clave = ?");
                $validateProducto->bindParam(1, $body['idProducto'], PDO::PARAM_STR);
                $validateProducto->execute();

                if ($validateProducto->fetch()) {
                    Database::getInstance()->getDb()->rollBack();
                    return "duplicate";
                } else {

                    $validateProducto = Database::getInstance()->getDb()->prepare("SELECT * FROM productotb WHERE nombre = ?");
                    $validateProducto->bindParam(1, $body['nombre'], PDO::PARAM_STR);
                    $validateProducto->execute();

                    if ($validateProducto->fetch()) {
                        Database::getInstance()->getDb()->rollBack();
                        return "duplicatename";
                    } else {

                        $codigoProducto = Database::getInstance()->getDb()->prepare("SELECT Fc_Producto_Codigo_Almanumerico();");
                        $codigoProducto->execute();
                        $idProducto = $codigoProducto->fetchColumn();

                        $sentencia = Database::getInstance()->getDb()->prepare("INSERT INTO productotb ( 
                        idProducto,
                        clave,
                        nombre,
                        idCategoria,
                        idMarca,
                        costo,
                        precio,
                        precioOferta ,
                        cantidad,
                        estado,
                        oferta)
                        VALUES(?,?,?,?,?,?,?,?,?,?,?)");
                        $sentencia->bindParam(1, $idProducto, PDO::PARAM_STR);
                        $sentencia->bindParam(2, $body['clave'], PDO::PARAM_STR);
                        $sentencia->bindParam(3, $body['nombre'], PDO::PARAM_STR);
                        $sentencia->bindParam(4, $body['categoria'], PDO::PARAM_STR);
                        $sentencia->bindParam(5, $body['marca'], PDO::PARAM_INT);
                        $sentencia->bindParam(6, $body['costo'], PDO::PARAM_STR);
                        $sentencia->bindParam(7, $body['precio'], PDO::PARAM_BOOL);
                        $sentencia->bindParam(8, $body['precioOferta'], PDO::PARAM_STR);
                        $sentencia->bindParam(9, $body['cantidad'], PDO::PARAM_STR);
                        $sentencia->bindParam(10, $body['estado'], PDO::PARAM_STR);
                        $sentencia->bindParam(11, $body['oferta'], PDO::PARAM_STR);
                        $sentencia->execute();

                        Database::getInstance()->getDb()->commit();
                        return "inserted";
                    }
                }
            }
        } catch (Exception $e) {
            Database::getInstance()->getDb()->rollback();
            return $e->getMessage();
        }
    }

    public static function deleteProducto($body)
    {
        try {
            Database::getInstance()->getDb()->beginTransaction();

            $validate = Database::getInstance()->getDb()->prepare("SELECT * FROM detalleventatb WHERE idOrigen = ? ");
            $validate->execute(array($body['idProducto']));

            if ($validate->rowCount() >= 1) {
                Database::getInstance()->getDb()->rollback();
                return "registrado";
            } else {
                $sentencia = Database::getInstance()->getDb()->prepare("DELETE FROM productotb WHERE idProducto = ?");
                $sentencia->execute(array($body['idProducto']));
                Database::getInstance()->getDb()->commit();
                return "deleted";
            }
        } catch (Exception $ex) {
            Database::getInstance()->getDb()->rollback();
            return $ex->getMessage();
        }
    }

    public static function validateProductoId($idProducto)
    {
        $validate = Database::getInstance()->getDb()->prepare("SELECT idProducto FROM productotb WHERE idProducto = ?");
        $validate->bindParam(1, $idProducto);
        $validate->execute();
        if ($validate->fetch()) {
            return true;
        } else {
            return false;
        }
    }

    public static function getAllProducto($search, $x, $y)
    {
        try {
            $array = array();

            $comando = Database::getInstance()->getDb()->prepare("SELECT 
            p.idProducto,
            p.clave,
            p.nombre,
            p.costo,
            p.precio,
            p.precioOferta,
            p.cantidad,
            p.estado,
            p.oferta,
            tc.nombre as categoria,
            tm.nombre as marca
            FROM productotb as p
            LEFT JOIN tabla_categoria AS tc ON tc.idCategoria = p.idCategoria
            LEFT JOIN tabla_marca AS tm ON tm.idMarca = p.idMarca
            WHERE p.clave LIKE concat(?,'%') OR p.nombre LIKE concat(?,'%') 
            LIMIT ?,?");
            $comando->bindValue(1, $search, PDO::PARAM_STR);
            $comando->bindValue(2, $search, PDO::PARAM_STR);
            $comando->bindValue(3, $x, PDO::PARAM_INT);
            $comando->bindValue(4, $y, PDO::PARAM_INT);
            $comando->execute();
            $arrayProductos = array();
            $count = 0;
            while ($row = $comando->fetch()) {
                $count++;
                array_push($arrayProductos, array(
                    "id" => $count + $x,
                    "idProducto" => $row["idProducto"],
                    "clave" => $row["clave"],
                    "nombre" => $row["nombre"],
                    "categoria" => $row["categoria"],
                    "marca" => $row["marca"],
                    "costo" => $row["costo"],
                    "precio" => $row["precio"],
                    "precioOferta" => $row["precioOferta"],
                    "cantidad" => $row["cantidad"],
                    "estado" => $row["estado"],
                    "oferta" => $row["oferta"],
                ));
            }

            $comando = Database::getInstance()->getDb()->prepare("SELECT COUNT(*) FROM productotb as p
            LEFT JOIN tabla_categoria AS tc ON tc.idCategoria = p.idCategoria
            LEFT JOIN tabla_marca AS tm ON tm.idMarca = p.idMarca
            WHERE p.clave LIKE concat(?,'%')  OR p.nombre LIKE concat(?,'%')");
            $comando->bindValue(1, $search);
            $comando->bindValue(2, $search);
            $comando->execute();
            $totalProducto = $comando->fetchColumn();

            array_push($array, $arrayProductos, $totalProducto);
            return $array;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public static function getProductoById($idProducto)
    {
        try {
            $array = array();

            $cmdProducto = Database::getInstance()->getDb()->prepare("SELECT * FROM productotb WHERE idProducto = ?");
            $cmdProducto->execute(array($idProducto));
            $producto = $cmdProducto->fetchObject();
            if (!$producto) {
                throw new Exception("Producto no encontrado, intente nuevamente.");
            }

            $cmdCategoria = Database::getInstance()->getDb()->prepare("SELECT idCategoria, nombre FROM tabla_categoria");
            $cmdCategoria->execute();
            $arrayCategoria = $cmdCategoria->fetchAll(PDO::FETCH_CLASS);

            $cmdImpuesto = Database::getInstance()->getDb()->prepare("SELECT idMarca, nombre FROM tabla_marca");
            $cmdImpuesto->execute();
            $arrayImpuesto = $cmdImpuesto->fetchAll(PDO::FETCH_CLASS);

            array_push($array, $producto, $arrayCategoria, $arrayImpuesto);

            return $array;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public static function getDataRegistroProducto()
    {
        try {
            $array = array();

            $cmdCategoria = Database::getInstance()->getDb()->prepare("SELECT idCategoria, nombre FROM tabla_categoria WHERE  estado = 1");
            $cmdCategoria->execute();
            $arrayCategoria = $cmdCategoria->fetchAll(PDO::FETCH_CLASS);

            $cmdImpuesto = Database::getInstance()->getDb()->prepare("SELECT idMarca, nombre FROM tabla_marca WHERE estado = 1");
            $cmdImpuesto->execute();
            $arrayImpuesto = $cmdImpuesto->fetchAll(PDO::FETCH_CLASS);

            array_push($array, $arrayCategoria, $arrayImpuesto);
            return $array;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
}
