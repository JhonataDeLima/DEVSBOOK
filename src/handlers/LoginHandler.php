<?php
namespace src\handlers;

use src\models\User;


class LoginHandler {

    public static function checkLogin(){

        if(!empty($_SESSION['token'])){
            $token = $_SESSION['token'];

            $data = User::select()->where('token', $token)->one();
            if(count($data) >0 ){
                
                $loggedUser = new User();
                $loggedUser->id = $data['id'];
                $loggedUser->name = $data['name'];
                $loggedUser->birthdate = $data['birthdate'];
                $loggedUser->avatar = $data['avatar'];
                $loggedUser->cover = $data['cover'];

                return $loggedUser;
            }
        }
        
        return false;
    }

    public static function verifyLogin($email, $password){
        $user = User::select()->where('email', $email)->one();
    
        if($user){
            if(password_verify($password, $user['password'])){
                $token = md5(time().rand(0,9999).time());

                User::update()
                    ->set('token', $token)
                    ->where('email', $email)
                ->execute();

                return $token;
            }
        }
    
        return false;
    }

    public static function emailExistis($email){
        $user = User::select()->where('email', $email)->one();
        return $user ? true : false;

    }

    public static function addUser($name, $email, $password, $birthdate){
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $token = md5(time().rand(0,9999).time());
        User::insert([
            'name' => $name,
            'email' => $email,
            'password' => $hash,
            'birthdate' => $birthdate,
            'token' => $token
        ])->execute();

        return $token;
    }
}

