<?php


require '../database/DataBaseConexion.php';

class ImpuestoAdo
{

    function __construct()
    {
    }

    public static function ListaImpuestos($search, $x, $y)
    {
        try {
            $array = array();

            $cmdImpuesto = Database::getInstance()->getDb()->prepare("SELECT * FROM tabla_impuesto  WHERE nombre LIKE ? LIMIT ?,?");
            $cmdImpuesto->bindValue(1, "$search%", PDO::PARAM_STR);
            $cmdImpuesto->bindValue(2, $x, PDO::PARAM_INT);
            $cmdImpuesto->bindValue(3, $y, PDO::PARAM_INT);
            $cmdImpuesto->execute();

            $count = 0;
            $arrayImpuestos = array();
            while ($row = $cmdImpuesto->fetch()) {
                $count++;
                array_push($arrayImpuestos, array(
                    "id" => $count + $x,
                    "idImpuesto" => $row["idImpuesto"],
                    "nombre" => $row["nombre"],
                    "codigo" => $row["codigo"],
                    "valor" => $row["valor"],
                    "estado" => $row["estado"],
                ));
            }

            $cmdTotales = Database::getInstance()->getDb()->prepare("SELECT COUNT(*) FROM tabla_impuesto WHERE nombre LIKE ?");
            $cmdTotales->bindValue(1, "$search%", PDO::PARAM_STR);
            $cmdTotales->execute();
            $resultTotal = $cmdTotales->fetchColumn();

            array_push($array, $arrayImpuestos, $resultTotal);

            return $array;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public static function GetImpuestoById($idImpuesto)
    {
        try {
            $cmdImpuesto = Database::getInstance()->getDb()->prepare("SELECT * FROM tabla_impuesto WHERE idImpuesto = ?");
            $cmdImpuesto->bindValue(1, $idImpuesto, PDO::PARAM_INT);
            $cmdImpuesto->execute();
            return $cmdImpuesto->fetchObject();
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public static function CrudImpuesto($body)
    {
        try {
            Database::getInstance()->getDb()->beginTransaction();

            $cmdValidate = Database::getInstance()->getDb()->prepare("SELECT * FROM tabla_impuesto WHERE idImpuesto  = ?");
            $cmdValidate->bindValue(1, $body["idImpuesto"], PDO::PARAM_INT);
            $cmdValidate->execute();
            if ($cmdValidate->fetch()) {

                $cmdValidate = Database::getInstance()->getDb()->prepare("SELECT * FROM tabla_impuesto WHERE idImpuesto <> ? AND nombre  = ?");
                $cmdValidate->bindValue(1, $body["idImpuesto"], PDO::PARAM_INT);
                $cmdValidate->bindValue(2, $body["nombre"], PDO::PARAM_STR);
                $cmdValidate->execute();
                if ($cmdValidate->fetch()) {
                    Database::getInstance()->getDb()->rollBack();
                    return "name";
                } else {
                    $cmdImpuesto = Database::getInstance()->getDb()->prepare("UPDATE tabla_impuesto SET nombre = ?,codigo = ?,valor = ?,estado = ? WHERE idImpuesto = ?");
                    $cmdImpuesto->bindValue(1, $body["nombre"], PDO::PARAM_STR);
                    $cmdImpuesto->bindValue(2, $body["codigo"], PDO::PARAM_INT);
                    $cmdImpuesto->bindValue(3, $body["valor"], PDO::PARAM_STR);
                    $cmdImpuesto->bindValue(4, $body["estado"], PDO::PARAM_BOOL);
                    $cmdImpuesto->bindValue(5, $body["idImpuesto"], PDO::PARAM_INT);
                    $cmdImpuesto->execute();
                    Database::getInstance()->getDb()->commit();
                    return "updated";
                }
            } else {
                $cmdValidate = Database::getInstance()->getDb()->prepare("SELECT * FROM tabla_impuesto WHERE nombre  = ?");
                $cmdValidate->bindValue(1, $body["nombre"], PDO::PARAM_STR);
                $cmdValidate->execute();
                if ($cmdValidate->fetch()) {
                    Database::getInstance()->getDb()->rollBack();
                    return "name";
                } else {
                    $cmdImpuesto = Database::getInstance()->getDb()->prepare("INSERT INTO tabla_impuesto(nombre,codigo,valor,estado) VALUES(?,?,?,?)");
                    $cmdImpuesto->bindValue(1, $body["nombre"], PDO::PARAM_STR);
                    $cmdImpuesto->bindValue(2, $body["codigo"], PDO::PARAM_INT);
                    $cmdImpuesto->bindValue(3, $body["valor"], PDO::PARAM_STR);
                    $cmdImpuesto->bindValue(4, $body["estado"], PDO::PARAM_BOOL);
                    $cmdImpuesto->execute();
                    Database::getInstance()->getDb()->commit();
                    return "inserted";
                }
            }
        } catch (Exception $ex) {
            Database::getInstance()->getDb()->rollBack();
            return $ex->getMessage();
        }
    }

    public static function DeletedImpuesto($idImpuesto)
    {
        try {
            Database::getInstance()->getDb()->beginTransaction();

            $cmdValidate = Database::getInstance()->getDb()->prepare("SELECT * FROM productotb WHERE idCategoria  = ?");
            $cmdValidate->bindValue(1, $idImpuesto, PDO::PARAM_INT);
            if($cmdValidate->fetch()){
                Database::getInstance()->getDb()->rollback();
                return "producto";
            }else{
                $cmdValidate = Database::getInstance()->getDb()->prepare("DELETE FROM tabla_impuesto WHERE idImpuesto = ?");
                $cmdValidate->bindValue(1, $idImpuesto, PDO::PARAM_INT);
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
