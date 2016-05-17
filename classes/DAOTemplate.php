<?php

/**
 * Created by PhpStorm.
 * User: Dieter
 * Date: 13/05/2016
 * Time: 13:30
 */
class DAOTemplate
{
    public static function getByID($table_name, $id_name, $id) {
        $sql = "SELECT * FROM " . $table_name . " WHERE " . $id_name . " = :id";
        $stmt = DatabasePDO::getInstance()->prepare($sql);
        $stmt->bindValue(":id", $id);
        if($stmt->execute()){
            $msg = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(!empty($msg)){
                return $msg;
            }
        }
        return null;
    }

    public static function getHighestValue($table_name, $field_name) {
        $sql = "SELECT MAX(" . $field_name . ") FROM " . $table_name;
        $stmt = DatabasePDO::getInstance()->prepare($sql);
        if($stmt->execute()){
            $msg = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(!empty($msg)){
                return $msg[0];
            }
        }
        return false;
    }

    public static function getAll($table_name, $order_by) {
        $sql = "SELECT * FROM " . $table_name . " ORDER BY " . $order_by . " ASC";
        $stmt = DatabasePDO::getInstance()->prepare($sql);
        if($stmt->execute()){
            $msg = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(!empty($msg)){
                return $msg;
            }
        }
        return array();
    }

    public static function insert($table_name, $keyvalue) {
        $pdo = DatabasePDO::getInstance();
        $sql = "INSERT INTO " . $table_name;
        $keys = "(";
        $values = "(";

        foreach($keyvalue as $key => $value) {
            $keys .= $key . ", ";
            $values .= ":" . $key . ", ";
        }

        $keys = substr($keys, 0, strlen($keys) - 2) . ")";
        $values = substr($values, 0, strlen($values) - 2) . ")";
        $sql .= $keys . " VALUES " . $values;

        $stmt = $pdo->prepare($sql);
        foreach($keyvalue as $key => $value) {
            $stmt->bindValue(":" . $key, $value);
        }

        if($stmt->execute()){
            return $pdo->lastInsertId();
        } else {
            return null;
        }
    }

    public static function getWhere($table_name, $keyvalue) {
        $pdo = DatabasePDO::getInstance();
        $sql = "SELECT * FROM " . $table_name . " WHERE ";

        foreach($keyvalue as $key => $value) {
            $sql .= $key . " = :" . $key . " AND ";
        }

        $sql = substr($sql, 0, strlen($sql) - 5);
        $stmt = $pdo->prepare($sql);

        foreach($keyvalue as $key => $value) {
            $stmt->bindValue(":" . $key, $value);
        }
        
        if($stmt->execute()){
            $msg = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(!empty($msg)){
                return $msg;
            }
        }
        return array();
    }

    public static function getTranslation($table_name, $id_name, $language_id, $id) {
        $sql = "SELECT * FROM " . $table_name . " WHERE " . $id_name . " = :id AND language_id = :language_id";
        $stmt = DatabasePDO::getInstance()->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmt->bindValue(":language_id", $language_id);
        if($stmt->execute()){
            $msg = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(!empty($msg)){
                return $msg[0];
            }
        }
        return null;
    }

    public static function executeSQL($sql, $keyvalue) {
        $pdo = DatabasePDO::getInstance();
        $stmt = $pdo->prepare($sql);

        foreach($keyvalue as $key => $value) {
            $stmt->bindValue(":" . $key, $value);
        }

        if($stmt->execute()){
            if(Verify::stringStartsWith($sql, 'UPDATE')) {
                return true;
            } else {
                $msg = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if(!empty($msg)){
                    return $msg;
                }
            }
        }
        return false;
    }

    public static function getCurrentDateTime() {
        return date("Y-m-d H:i:s");
    }
}