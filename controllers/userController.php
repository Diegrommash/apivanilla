<?php

class UserController{

    public function create(){
        $json = array(
            'Details' => 'cliente creado'
        );             
        echo json_encode($json);
    }

    public function getAll(){

        $users = UserModel::getAll('users');

        $json = array(
            'status' => 200,
            'totalRecords' => count($users),
            'details' => $users
        );             
        echo json_encode($json);
    }

    public function get($id){
        $json = array(
            'Details' => "mostrando el usuario con id: $id"
        );             
        echo json_encode($json);
    }

    public function put($id){
        $json = array(
            'Details' => "modificando el usuario con id: $id"
        );             
        echo json_encode($json);
    }

    public function delete($id){
        $json = array(
            'Details' => "borrando el usuario con id: $id"
        );             
        echo json_encode($json);
    }
}