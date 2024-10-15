<?php

session_start();

class  AuthController
{

var_dump($_POST);

if(isset($_POST['action'])) {
switch($_POST['action']) {
    case 'access' :
                $authController = new AuthController();

                $email = $_POST['correo'];
                $email = $_POST['contrasenia'];

                $authController
        }
}

public function login($email=null, $password=null)
{


    $response = curl_exec($curl);



    if (isset($response->data->nombre)) {

    }

}

}

?>