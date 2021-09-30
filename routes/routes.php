<?php

$routeArray = explode('/', $_SERVER['REQUEST_URI']);

if(count(array_filter($routeArray)) == 0){

    $json = array(
        'Details' => 'not found'
    );
    
    echo json_encode($json);

}else{

    if(count(array_filter($routeArray)) == 1){

        if(array_filter($routeArray)[1] == 'login'){

            if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'GET'){
                
                $login = new UserController();
                $login->getAll();

            }

            if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST'){
                
                $login = new UserController();
                $login->create();

            }
   
        }

    }else{

        if(array_filter($routeArray)[1] == 'login' && is_numeric(array_filter($routeArray)[2])){
            
            if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'GET'){
                
                $login = new UserController();
                $login->get($routeArray[2]);

            }

            if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'PUT'){
                
                $login = new UserController();
                $login->put($routeArray[2]);

            }

            if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'DELETE'){
                
                $login = new userController();
                $login->delete($routeArray[2]);

            }



        }

    }

    

}

