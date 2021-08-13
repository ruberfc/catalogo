<?php

require '../database/DataBaseConexion.php';

class MarcaAdo
{

    function __construct()
    {
    }

    public static function ListaMarca($search, $x, $y)
    {
        try {
            $array = array();

            $cmdMarca = Database::getInstance()->getDb()->prepare("SELECT * FROM tabla_marca  WHERE nombre LIKE ? LIMIT ?,?");
            $cmdMarca->bindValue(1, "$search%", PDO::PARAM_STR);
            $cmdMarca->bindValue(2, $x, PDO::PARAM_INT);
            $cmdMarca->bindValue(3, $y, PDO::PARAM_INT);
            $cmdMarca->execute();

            $count = 0;
            $arrayMarca = array();
            while ($row = $cmdMarca->fetch()) {
                $count++;
                array_push($arrayMarca, array(
                    "id" => $count + $x,
                    "idMarca" => $row["idMarca"],
                    "nombre" => $row["nombre"],
                    "estado" => $row["estado"]
                ));
            }

            $cmdTotales = Database::getInstance()->getDb()->prepare("SELECT COUNT(*) FROM tabla_marca WHERE nombre LIKE ?");
            $cmdTotales->bindValue(1, "$search%", PDO::PARAM_STR);
            $cmdTotales->execute();
            $resultTotal = $cmdTotales->fetchColumn();

            array_push($array, $arrayMarca, $resultTotal);

            return $array;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public static function GetMarcaById($idMarca)
    {
        try {
            $cmdMarca = Database::getInstance()->getDb()->prepare("SELECT * FROM tabla_marca WHERE idMarca = ?");
            $cmdMarca->bindValue(1, $idMarca, PDO::PARAM_INT);
            $cmdMarca->execute();
            return $cmdMarca->fetchObject();
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public static function CrudMarca($body)
    {
        try {
            Database::getInstance()->getDb()->beginTransaction();

            $cmdValidate = Database::getInstance()->getDb()->prepare("SELECT * FROM tabla_marca WHERE idMarca = ?");
            $cmdValidate->bindValue(1, $body["idMarca"], PDO::PARAM_INT);
            $cmdValidate->execute();
            if ($cmdValidate->fetch()) {

                $cmdValidate = Database::getInstance()->getDb()->prepare("SELECT * FROM tabla_marca WHERE idMarca <> ? AND nombre = ?");
                $cmdValidate->bindValue(1, $body["idMarca"], PDO::PARAM_INT);
                $cmdValidate->bindValue(2, $body["nombre"], PDO::PARAM_STR);
                $cmdValidate->execute();
                if ($cmdValidate->fetch()) {
                    Database::getInstance()->getDb()->rollback();
                    return "name";
                } else {
                    $cmdMarca = Database::getInstance()->getDb()->prepare("UPDATE tabla_marca SET nombre = ? ,estado = ? WHERE idMarca = ?");
                    $cmdMarca->bindValue(1, $body["nombre"], PDO::PARAM_STR);
                    $cmdMarca->bindValue(2, $body["estado"], PDO::PARAM_BOOL);
                    $cmdMarca->bindValue(3, $body["idMarca"], PDO::PARAM_INT);
                    $cmdMarca->execute();
                    Database::getInstance()->getDb()->commit();
                    return "updated";
                }
            } else {

                $cmdValidate = Database::getInstance()->getDb()->prepare("SELECT * FROM tabla_marca WHERE nombre = ?");
                $cmdValidate->bindValue(1, $body["nombre"], PDO::PARAM_STR);
                $cmdValidate->execute();
                if ($cmdValidate->fetch()) {
                    Database::getInstance()->getDb()->rollback();
                    return "name";
                } else {
                    $cmdMarca = Database::getInstance()->getDb()->prepare("INSERT INTO tabla_marca(nombre,estado) VALUES(?,?)");
                    $cmdMarca->bindValue(1, $body["nombre"], PDO::PARAM_STR);
                    $cmdMarca->bindValue(2, $body["estado"], PDO::PARAM_BOOL);
                    $cmdMarca->execute();
                    Database::getInstance()->getDb()->commit();
                    return "inserted";
                }
            }
        } catch (Exception  $ex) {
            Database::getInstance()->getDb()->rollback();
            return $ex->getMessage();
        }
    }

    public static function DeletedMarca($idMarca)
    {
        try {
            Database::getInstance()->getDb()->beginTransaction();

            $cmdValidate = Database::getInstance()->getDb()->prepare("SELECT * FROM productotb WHERE idMarca  = ?");
            $cmdValidate->bindValue(1, $idMarca, PDO::PARAM_INT);
            if($cmdValidate->fetch()){
                Database::getInstance()->getDb()->rollback();
                return "producto";
            }else{
                $cmdValidate = Database::getInstance()->getDb()->prepare("DELETE FROM tabla_marca WHERE idmarca = ?");
                $cmdValidate->bindValue(1, $idMarca, PDO::PARAM_INT);
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
