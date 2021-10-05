<?php

class UserController{

    public function add($data){
        $message = array();

        if(!preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ]{2,255}+$/', $data['userName'])){
            $message['userName'] = 'error en el nombre, solo debe contener letras y un minimo de 2 caracteres';
        }

        if($data['email'] == null){
            $message['email'] = 'el campo email es obligatorio';
        }else{
            if(!preg_match('/^([da-z_.-]+)@([da-z.-]+).([a-z.]{2,6})$/', $data['email'])){
                $message['email'] = 'error en el email, el formato no es el adecuado';
            }else{
                $users = UserModel::getAll('users');
                foreach ($users as $key => $value) {
                    if($value['email'] == $data['email']){
                        $message['email'] = 'el email ya existe, pruebe con otro';
                    }
                }
            }
        }

        if($data['password'] == null){
            $message['email'] = 'el campo password es obligatorio';
        }else{
            if(!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{8,15}$/', $data['password'])){
                $message['password'] = 'error en la contraseña, debe contener al menos: una mayuscula una miniscula un numero un signo y mas de 8 caracteres';
            }     
        }
     
        if($message != null){
            $json = array(
                'Status' => 404,
                'totalErrors' => count($message),
                'details' => $message
            );             
            echo json_encode($json);

        }else{         
            // imagen
            if(!empty($data['image'])){
                $file = $_FILES['image'];
                $filename = $file['name'];
                $mimetype = $file['type'];

                if($mimetype == "image/jpg" || $mimetype == 'image/jpeg' || $mimetype == 'image/png' || $mimetype == 'image/gif'){

                    if(!is_dir('uploads/user/images')){
                        mkdir('uploads/user/images', 0777, true);
                    }

                    move_uploaded_file($file['tmp_name'], 'uploads/user/images/'.$filename);
                }else{
                    $message['image'] = 'error en la imagen, el formato no esta permitido';
                }
            }

            $id_client = str_replace('$', 'a', crypt($data['userName'].$data['email'], 
                '$2a$07$123ads456asdfADFREQA789QEWR357adf$' ));

            $secret_key = str_replace('$', 'o', crypt($data['email'].$data['userName'], 
                '$2a$07$123ads456asdfADFREQA789QEWR357adf$' ));

            
            $data = array(
                'userName' => $data['userName'],
                'email' => $data['email'],
                'password' => $data['password'],
                'image' => $filename,
                'id_client' => $id_client,
                'secret_key' => $secret_key,
                'created_at' => date('d-m-Y h:i:s'),
                'updated_at' => date('d-m-Y h:i:s')
            );

            $add = UserModel::add('users', $data);
            if($add == 'ok'){
                $json = array(
                    'Status' => 200,
                    'details' => 'registro guardado con exito',
                    'credentials' => array(
                        'id_client' => $id_client,
                        'secret_key' => $secret_key
                    )
                );             
                echo json_encode($json);
            }
        }
        
    }

    public function getAll(){

        if(isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])){
            $users = UserModel::getAll('users');

            foreach ($users as $key => $value) {
                if("Basic ".base64_encode($_SERVER['PHP_AUTH_USER'].':'.$_SERVER['PHP_AUTH_PW']) ==
                   "Basic ".base64_encode($value['id_client'].':'.$value['secret_key'])){
                    
                    $users = UserModel::getAll('users');

                    $json = array(
                        'status' => 200,
                        'totalRecords' => count($users),
                        'details' => $users
                    );

                }else{
                    $json = array(
                        'status' => 404,
                        'details' => 'El token es invalido'
                    );
                }
            }
            echo json_encode($json, true);
        }
    }

    public function get($id){
        if(isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])){
            $users = UserModel::getAll('users');

            foreach ($users as $key => $value) {
                if("Basic ".base64_encode($_SERVER['PHP_AUTH_USER'].':'.$_SERVER['PHP_AUTH_PW']) ==
                   "Basic ".base64_encode($value['id_client'].':'.$value['secret_key'])){

                    $user = UserModel::getOne('users', $id);
                    if(!empty($user)){
                        $json = array(
                            'status' => 200,
                            'details' => $user
                        );
                        
                    }else{
                        $json = array(
                            'status' => 200,
                            'total registers' => 0,
                            'details' => 'el usuario no existe'
                        );
                    }

                }else{
                    $json = array(
                        'status' => 404,
                        'details' => 'El token es invalido'
                    );
                }
            }
        }
        echo json_encode($json, true);
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