<?php

require '../database/DataBaseConexion.php';

class EmpleadoAdo
{

    function __construct()
    {
    }

    public static function insertEmpleado($body)
    {

        $quey = "SELECT Fc_Empleado_Codigo_Almanumerico();";

        $empleado = "INSERT INTO empleadotb ( " .
            "idEmpleado," .
            "tipoDocumento," .
            "numeroDocumento," .
            "apellidos," .
            "nombres," .
            "sexo," .
            "fechaNacimiento," .
            "codigo," .
            // "ocupacion," .
            // "formaPago," .
            // "entidadBancaria," .
            // "numeroCuenta," .
            "rol," .
            "estado," .
            "telefono," .
            "celular," .
            "email," .
            "direccion," .
            "usuario," .
            "clave)" .
            " VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

        try {

            Database::getInstance()->getDb()->beginTransaction();

            $validate = Database::getInstance()->getDb()->prepare("SELECT * FROM empleadotb WHERE numeroDocumento = ?");
            $validate->bindParam(1, $body['numeroDocumento']);
            $validate->execute();
            if ($validate->fetch()) {
                Database::getInstance()->getDb()->rollback();
                return "numdocumento";
            } else {
                $codigoEmpleado = Database::getInstance()->getDb()->prepare($quey);
                $codigoEmpleado->execute();
                $idEmpleado = $codigoEmpleado->fetchColumn();

                $executeEmpleado = Database::getInstance()->getDb()->prepare($empleado);
                $executeEmpleado->execute(
                    array(
                        $idEmpleado,
                        $body['tipoDocumento'],
                        $body['numeroDocumento'],
                        $body['apellidos'],
                        $body['nombres'],
                        $body['sexo'],
                        $body['fechaNacimiento'],
                        $body['codigo'],
                        // $body['ocupacion'],
                        // $body['formaPago'],
                        // $body['entidadBancaria'],
                        // $body['numeroCuenta'],
                        $body['rol'],
                        $body['estado'],
                        $body['telefono'],
                        $body['celular'],
                        $body['email'],
                        $body['direccion'],
                        $body['usuario'],
                        $body['clave']
                    )
                );

                Database::getInstance()->getDb()->commit();
                return "inserted";
            }
        } catch (Exception $e) {
            Database::getInstance()->getDb()->rollback();
            return $e->getMessage();
        }
    }

    public static function editEmpleado($body)
    {

        $comando = "UPDATE empleadotb " .
            "SET tipoDocumento = ?," .
            " numeroDocumento = ?," .
            " apellidos = ?," .
            " nombres = ?," .
            " sexo = ?," .
            " fechaNacimiento = ?," .
            " codigo = ?," .
            // " ocupacion = ?," .
            // " formaPago = ?," .
            // " entidadBancaria = ?," .
            // " numeroCuenta = ?," .
            " rol = ?," .
            " estado = ?," .
            " telefono = ?," .
            " celular = ?," .
            " email = ?," .
            " direccion = ?," .
            " usuario = ?," .
            " clave = ?" .
            "WHERE idEmpleado = ?";

        try {
            Database::getInstance()->getDb()->beginTransaction();

            $validate = Database::getInstance()->getDb()->prepare("SELECT idEmpleado FROM empleadotb WHERE idEmpleado <> ? AND numeroDocumento = ?");
            $validate->bindParam(1, $body['idEmpleado']);
            $validate->bindParam(2, $body['numeroDocumento']);
            $validate->execute();
            if ($validate->fetch()) {
                Database::getInstance()->getDb()->rollback();
                return "numdocumento";
            } else {
                $sentencia = Database::getInstance()->getDb()->prepare($comando);
                $sentencia->execute(
                    array(
                        $body['tipoDocumento'],
                        $body['numeroDocumento'],
                        $body['apellidos'],
                        $body['nombres'],
                        $body['sexo'],
                        $body['fechaNacimiento'],
                        $body['codigo'],
                        // $body['ocupacion'],
                        // $body['formaPago'],
                        // $body['entidadBancaria'],
                        // $body['numeroCuenta'],
                        $body['rol'],
                        $body['estado'],
                        $body['telefono'],
                        $body['celular'],
                        $body['email'],
                        $body['direccion'],
                        $body['usuario'],
                        $body['clave'],
                        $body['idEmpleado']
                    )
                );
                Database::getInstance()->getDb()->commit();
                return "updated";
            }
        } catch (Exception $e) {
            Database::getInstance()->getDb()->rollback();
            return $e->getMessage();
        }
    }

    public static function editPerfil($body)
    {

        $comando = "UPDATE empleadotb " .
            "SET tipoDocumento = ?," .
            " numeroDocumento = ?," .
            " apellidos = ?," .
            " nombres = ?," .
            " sexo = ?," .
            " fechaNacimiento = ?," .
            " codigo = ?," .
            " telefono = ?," .
            " celular = ?," .
            " email = ?," .
            " direccion = ?," .
            " usuario = ?," .
            " clave = ?" .
            "WHERE idEmpleado = ?";

        try {
            Database::getInstance()->getDb()->beginTransaction();

            $validate = Database::getInstance()->getDb()->prepare("SELECT idEmpleado FROM empleadotb WHERE idEmpleado <> ? AND numeroDocumento = ?");
            $validate->bindParam(1, $body['idEmpleado']);
            $validate->bindParam(2, $body['numeroDocumento']);
            $validate->execute();
            if ($validate->fetch()) {
                Database::getInstance()->getDb()->rollback();
                return "numdocumento";
            } else {
                $sentencia = Database::getInstance()->getDb()->prepare($comando);
                $sentencia->execute(
                    array(
                        $body['tipoDocumento'],
                        $body['numeroDocumento'],
                        $body['apellidos'],
                        $body['nombres'],
                        $body['sexo'],
                        $body['fechaNacimiento'],
                        $body['codigo'],                    
                        $body['telefono'],
                        $body['celular'],
                        $body['email'],
                        $body['direccion'],
                        $body['usuario'],
                        $body['clave'],
                        $body['idEmpleado']
                    )
                );
                Database::getInstance()->getDb()->commit();
                return "updated";
            }
        } catch (Exception $e) {
            Database::getInstance()->getDb()->rollback();
            return $e->getMessage();
        }
    }

    public static function deleteEmpleado($body)
    {
        try {
            Database::getInstance()->getDb()->beginTransaction();

            $validateasistencia = Database::getInstance()->getDb()->prepare("SELECT * FROM asistenciatb WHERE idPersona = ? ");
            $validateasistencia->execute(array($body['idEmpleado']));

            if ($validateasistencia->rowCount() >= 1) {
                Database::getInstance()->getDb()->rollback();
                return "asistencia";
            } else {

                $validateventa = Database::getInstance()->getDb()->prepare("SELECT * FROM ventatb WHERE vendedor = ? ");
                $validateventa->execute(array($body['idEmpleado']));

                if ($validateventa->rowCount() >= 1) {
                    Database::getInstance()->getDb()->rollback();
                    return "venta";
                } else {
                    $sentencia = Database::getInstance()->getDb()->prepare("DELETE FROM empleadotb WHERE idEmpleado = ?");
                    $sentencia->execute(array($body['idEmpleado']));
                    Database::getInstance()->getDb()->commit();
                    return "deleted";
                }
            }
        } catch (Exception $ex) {
            Database::getInstance()->getDb()->rollback();
            return $ex->getMessage();
        }
    }

    public static function getAllEmpleado($search, $x, $y)
    {
        try {
            $array = array();

            $comando = Database::getInstance()->getDb()->prepare("SELECT * FROM empleadotb 
            WHERE numeroDocumento LIKE concat(?,'%') OR apellidos LIKE concat(?,'%') OR nombres LIKE concat(?,'%') 
            LIMIT ?,?");
            $comando->bindParam(1, $search, PDO::PARAM_STR);
            $comando->bindParam(2, $search, PDO::PARAM_STR);
            $comando->bindParam(3, $search, PDO::PARAM_STR);
            $comando->bindParam(4, $x, PDO::PARAM_INT);
            $comando->bindParam(5, $y, PDO::PARAM_INT);
            $comando->execute();
            $arrayEmpleados = array();
            while ($row = $comando->fetch()) {
                array_push($arrayEmpleados, array(
                    "idEmpleado" => $row["idEmpleado"],
                    "tipoDocumento" => $row["tipoDocumento"],
                    "numeroDocumento" => $row["numeroDocumento"],
                    "apellidos" => $row["apellidos"],
                    "nombres" => $row["nombres"],
                    "sexo" => $row["sexo"],
                    "fechaNacimiento" => $row["fechaNacimiento"],
                    "telefono" => $row["telefono"],
                    "celular" => $row["celular"],
                    "email" => $row["email"],
                    "direccion" => $row["direccion"],
                    "codigo" => $row["codigo"],
                    // "ocupacion" => $row["ocupacion"],
                    // "formaPago" => $row["formaPago"],
                    // "entidadBancaria" => $row["entidadBancaria"],
                    // "numeroCuenta" => $row["numeroCuenta"],
                    "rol" => $row["rol"],
                    "usuario" => $row["usuario"],
                    "clave" => $row["clave"],
                    "estado" => $row["estado"]
                ));
            }

            $comando = Database::getInstance()->getDb()->prepare("SELECT COUNT(*) FROM empleadotb 
            WHERE numeroDocumento LIKE concat(?,'%') OR apellidos LIKE concat(?,'%') OR nombres LIKE concat(?,'%')");
            $comando->bindParam(1, $search, PDO::PARAM_STR);
            $comando->bindParam(2, $search, PDO::PARAM_STR);
            $comando->bindParam(3, $search, PDO::PARAM_STR);
            $comando->execute();
            $resultTotal =  $comando->fetchColumn();

            array_push($array, $arrayEmpleados, $resultTotal);
            return $array;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }


    public static function getEmpleadoById($idEmpleado)
    {
        try {
            // $array = array();
            $cmdEmpleado = Database::getInstance()->getDb()->prepare("SELECT * FROM empleadotb WHERE idEmpleado = ?");
            $cmdEmpleado->bindParam(1, $idEmpleado, PDO::PARAM_STR);
            $cmdEmpleado->execute();

            /*
            $cmdEmpleado->execute(array($idEmpleado));
            $resultEmpleado = $cmdEmpleado->fetchObject();
            if (!$resultEmpleado) {
                throw new Exception("No se encontro al personal, intente nuevamente.");
            }

            $cmdRol =  Database::getInstance()->getDb()->prepare("SELECT rol, nombre FROM roltb");
            $cmdRol->execute();
            $arrayRol = array();
            while ($row = $cmdRol->fetch()) {
                array_push($arrayRol, array(
                    "rol" => $row["idRol"],
                    "nombre" => $row["nombre"]
                ));
            }

            array_push($array, $resultEmpleado);
            return $array;
            */
            return $cmdEmpleado->fetchObject();

        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public static function getAllDatosSearchEmpleado($datos, $x, $y)
    {
        $consulta = "SELECT * FROM empleadotb WHERE (apellidos LIKE ? OR numeroDocumento LIKE ?) LIMIT ?,?";
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            $comando->bindValue(1, "$datos%", PDO::PARAM_STR);
            $comando->bindValue(2, "$datos%", PDO::PARAM_STR);
            $comando->bindValue(3, $x, PDO::PARAM_INT);
            $comando->bindValue(4, $y, PDO::PARAM_INT);
            // Ejecutar sentencia preparada
            $comando->execute();
            return $comando->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public static function getEmpleadoForLogin($usuario, $clave)
    {
        try {
            // $array = array();

            $comando = Database::getInstance()->getDb()->prepare("SELECT * FROM empleadotb WHERE usuario = ?");
            $comando->bindValue(1, $usuario, PDO::PARAM_STR);
            $comando->execute();
            if ($comando->fetchObject()) {
                $comando = Database::getInstance()->getDb()->prepare("SELECT * FROM empleadotb WHERE  clave = ? ");
                $comando->bindValue(1, $clave, PDO::PARAM_STR);
                $comando->execute();

                if ($comando->fetchObject()) {

                    $comando = Database::getInstance()->getDb()->prepare("SELECT * FROM empleadotb WHERE usuario = ? AND clave = ? ");
                    $comando->bindValue(1, $usuario, PDO::PARAM_STR);
                    $comando->bindValue(2, $clave, PDO::PARAM_STR);
                    $comando->execute();
                    
                    /*
                    if ($row = $comando->fetchObject()) {
                        $idRol = $row->idRol;
                        $cmdRol = Database::getInstance()->getDb()->prepare("SELECT * FROM permisotb WHERE idRol = ? ");
                        $cmdRol->bindValue(1,  $idRol, PDO::PARAM_INT);
                        $cmdRol->execute();

                        $arrayRol = array();
                        while ($rowRol =  $cmdRol->fetch()) {
                            array_push($arrayRol, array(
                                "idModulo" => $rowRol["idModulo"],
                                "ver" => $rowRol["ver"],
                                "crear" => $rowRol["crear"],
                                "actualizar" => $rowRol["actualizar"],
                                "eliminar" => $rowRol["eliminar"]
                            ));
                        }

                        array_push($array, $row);
                        return  $array;
                    } else {
                        return "nostate";
                    }
                    */

                    // array_push($array, $row, $arrayRol);
                    // return  $array;
                    return $comando->fetchObject();

                } else {
                    return "nopassword";
                }
            } else {
                return "nouser";
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public static function getEmpleadosForLista()
    {
        $consulta = "SELECT * FROM empleadotb ORDER BY apellidos ASC";
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            $comando->setFetchMode(PDO::FETCH_ASSOC);
            // Ejecutar sentencia preparada
            $comando->execute();
            return $comando->fetchAll();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public static function validateEmpleadoId($idEmpleados)
    {
        $validate = Database::getInstance()->getDb()->prepare("SELECT idEmpleado FROM empleadotb WHERE idEmpleado = ?");
        $validate->bindParam(1, $idEmpleados);
        $validate->execute();
        if ($validate->fetch()) {
            return true;
        } else {
            return false;
        }
    }

    public static function getMembresiaMarcarAsistencia($buscar)
    {
        try {
            $array = array();
            $comando = Database::getInstance()->getDb()->prepare("SELECT * FROM empleadotb WHERE numeroDocumento = ? or codigo = ?");
            $comando->bindValue(1, $buscar, PDO::PARAM_STR);
            $comando->bindValue(2, $buscar, PDO::PARAM_STR);
            $comando->execute();
            $empleado = $comando->fetchObject();
            if (!$empleado) {
                throw new Exception("Datos no encontrados, intente nuevamente o consulte al encargado sobre su información");
            }

            $resultAsistencia = "";
            $comando = Database::getInstance()->getDb()->prepare("SELECT * FROM asistenciatb WHERE idPersona = ? and estado = 1");
            $comando->bindValue(1, $empleado->idEmpleado, PDO::PARAM_STR);
            $comando->execute();
            if ($comando->fetch()) {
                $comando = Database::getInstance()->getDb()->prepare("SELECT * FROM asistenciatb WHERE idPersona = ? and estado = 1 and fechaApertura  = CURDATE()");
                $comando->bindValue(1, $empleado->idEmpleado, PDO::PARAM_STR);
                $comando->execute();
                $validate = $comando->fetchObject();
                if ($validate) {
                    $resultAsistencia = $validate;
                } else {
                    $resultAsistencia = "MARCAR ENTRADA";
                }
            } else {
                $resultAsistencia = "MARCAR ENTRADA";
            }

            array_push($array, $empleado, $resultAsistencia);
            return $array;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public static function getEmpleadoRegister()
    {
        try {
            $array = array();

            $cmdRol =  Database::getInstance()->getDb()->prepare("SELECT idRol ,nombre FROM roltb");
            $cmdRol->execute();
            $arrayRol = array();
            while ($row = $cmdRol->fetch()) {
                array_push($arrayRol, array(
                    "idRol" => $row["idRol"],
                    "nombre" => $row["nombre"]
                ));
            }
            array_push($array, $arrayRol);
            return $array;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
}
