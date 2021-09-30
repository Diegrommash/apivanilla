<?php
require_once 'dataBase.php';

class UserModel{

    public static function getAll($table){

        $stmt = DataBase::connect()->prepare("SELECT * FROM $table;");
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }
    
}