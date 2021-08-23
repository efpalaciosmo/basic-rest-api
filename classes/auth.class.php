<?php

require_once 'connection/connection.php';
require_once 'answers.class.php';

class Auth extends Connection{

    public function login($json){
        $_answers = new Answers();
        $data = json_decode($json, true);
        if(!isset($data['user']) || !isset($data['password'])){
            return $_answers->error_400();
        }else{
            $user = $data['user'];
            $password = $data['password'];
            $data = $this->getData($user);
            if ($data){
                return "something is here";
            }else{
                return $_answers->error_200("Email does not exist");
            }
        }
    }

    private function getDataUser($email)
    {
        $query = "SELECT UsuarioID,Password,Estado FROM usuarios WHERE Usuario = '$email'";
        $data = parent::getData($query);
        if (isset($data[0]['UsuarioId'])) {
            return $data;
        }else{
            return  "User not found";
        }
    }
}