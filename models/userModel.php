<?php
require_once 'dataBase.php';

class UserModel{

    public static function getAll($table){

        $stmt = DataBase::connect()->prepare("SELECT * FROM $table;");
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt = null;
    }

    public static function getOne($table, $id){
        $stmt = Database::connect()->prepare("SELECT * FROM $table WHERE id = :id");

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS);

        $stmt = null;
    }

    public static function add($table, $data){

        $stmt = DataBase::connect()->prepare("INSERT INTO $table (userName, email, password, role, image, emailValidation, id_client, secret_key, created_at, updated_at) 
            VALUES (:userName, :email, :password, 'user', :image, null, :id_client, :secret_key, :created_at, :updated_at)");

        $stmt -> bindParam(':userName', $data['userName'], PDO::PARAM_STR);
        $stmt -> bindParam(':email', $data['email'], PDO::PARAM_STR);
        $stmt -> bindParam(':password', $data['password'], PDO::PARAM_STR);
        $stmt -> bindParam(':image', $data['image'], PDO::PARAM_STR);
        $stmt -> bindParam(':id_client', $data['id_client'], PDO::PARAM_STR);
        $stmt -> bindParam(':secret_key', $data['secret_key'], PDO::PARAM_STR);
        $stmt -> bindParam(':created_at', $data['created_at'], PDO::PARAM_STR);
        $stmt -> bindParam(':updated_at', $data['updated_at'], PDO::PARAM_STR);

        if($stmt->execute()){
            return 'ok';

        }else{
            print_r(DataBase::connect()->errorInfo());
        }

        $stmt = null;
   
    }


    
}