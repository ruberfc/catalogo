<?php

/**
 * Representa el la estructura de las Clientes
 * almacenadas en la base de datos
 */
require '../database/DataBaseConexion.php';

class CategoriaAdo
{

    function __construct()
    {
    }

    public static function ListaCategoria($search, $x, $y)
    {
        try {
            $array = array();

            $cmdCategoria = Database::getInstance()->getDb()->prepare("SELECT * FROM tabla_categoria  WHERE nombre LIKE ? LIMIT ?,?");
            $cmdCategoria->bindValue(1, "$search%", PDO::PARAM_STR);
            $cmdCategoria->bindValue(2, $x, PDO::PARAM_INT);
            $cmdCategoria->bindValue(3, $y, PDO::PARAM_INT);
            $cmdCategoria->execute();

            $count = 0;
            $arrayCategoria = array();
            while ($row = $cmdCategoria->fetch()) {
                $count++;
                array_push($arrayCategoria, array(
                    "id" => $count + $x,
                    "idCategoria" => $row["idCategoria"],
                    "nombre" => $row["nombre"],
                    "estado" => $row["estado"]
                ));
            }

            $cmdTotales = Database::getInstance()->getDb()->prepare("SELECT COUNT(*) FROM tabla_categoria WHERE nombre LIKE ?");
            $cmdTotales->bindValue(1, "$search%", PDO::PARAM_STR);
            $cmdTotales->execute();
            $resultTotal = $cmdTotales->fetchColumn();

            array_push($array, $arrayCategoria, $resultTotal);

            return $array;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public static function GetCategoriById($idCategoria)
    {
        try {
            $cmdCategoria = Database::getInstance()->getDb()->prepare("SELECT * FROM tabla_categoria WHERE idCategoria = ?");
            $cmdCategoria->bindValue(1, $idCategoria, PDO::PARAM_INT);
            $cmdCategoria->execute();
            return $cmdCategoria->fetchObject();
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public static function CrudCategoria($body)
    {
        try {
            Database::getInstance()->getDb()->beginTransaction();

            $cmdValidate = Database::getInstance()->getDb()->prepare("SELECT * FROM tabla_categoria WHERE idCategoria = ?");
            $cmdValidate->bindValue(1, $body["idCategoria"], PDO::PARAM_INT);
            $cmdValidate->execute();
            if ($cmdValidate->fetch()) {

                $cmdValidate = Database::getInstance()->getDb()->prepare("SELECT * FROM tabla_categoria WHERE idCategoria <> ? AND nombre = ?");
                $cmdValidate->bindValue(1, $body["idCategoria"], PDO::PARAM_INT);
                $cmdValidate->bindValue(2, $body["nombre"], PDO::PARAM_STR);
                $cmdValidate->execute();
                if ($cmdValidate->fetch()) {
                    Database::getInstance()->getDb()->rollback();
                    return "name";
                } else {
                    $cmdCategoria = Database::getInstance()->getDb()->prepare("UPDATE tabla_categoria SET nombre = ? ,estado = ? WHERE idCategoria = ?");
                    $cmdCategoria->bindValue(1, $body["nombre"], PDO::PARAM_STR);
                    $cmdCategoria->bindValue(2, $body["estado"], PDO::PARAM_BOOL);
                    $cmdCategoria->bindValue(3, $body["idCategoria"], PDO::PARAM_INT);
                    $cmdCategoria->execute();
                    Database::getInstance()->getDb()->commit();
                    return "updated";
                }
            } else {

                $cmdValidate = Database::getInstance()->getDb()->prepare("SELECT * FROM tabla_categoria WHERE nombre = ?");
                $cmdValidate->bindValue(1, $body["nombre"], PDO::PARAM_STR);
                $cmdValidate->execute();
                if ($cmdValidate->fetch()) {
                    Database::getInstance()->getDb()->rollback();
                    return "name";
                } else {
                    $cmdCategoria = Database::getInstance()->getDb()->prepare("INSERT INTO tabla_categoria(nombre,estado) VALUES(?,?)");
                    $cmdCategoria->bindValue(1, $body["nombre"], PDO::PARAM_STR);
                    $cmdCategoria->bindValue(2, $body["estado"], PDO::PARAM_BOOL);
                    $cmdCategoria->execute();
                    Database::getInstance()->getDb()->commit();
                    return "inserted";
                }
            }
        } catch (Exception  $ex) {
            Database::getInstance()->getDb()->rollback();
            return $ex->getMessage();
        }
    }

    public static function DeletedCategiria($idCategoria)
    {
        try {
            Database::getInstance()->getDb()->beginTransaction();

            $cmdValidate = Database::getInstance()->getDb()->prepare("SELECT * FROM productotb WHERE idCategoria  = ?");
            $cmdValidate->bindValue(1, $idCategoria, PDO::PARAM_INT);
            if($cmdValidate->fetch()){
                Database::getInstance()->getDb()->rollback();
                return "producto";
            }else{
                $cmdValidate = Database::getInstance()->getDb()->prepare("DELETE FROM tabla_categoria WHERE idCategoria = ?");
                $cmdValidate->bindValue(1, $idCategoria, PDO::PARAM_INT);
                $cmdValidate->execute();
                Database::getInstance()->getDb()->commit();
                return "deleted";
            }

            
        } catch (Exception $ex) {
            Database::getInstance()->getDb()->rollback();
            return $ex->getMessage();
        }
    }
}
