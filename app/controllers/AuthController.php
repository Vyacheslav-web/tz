<?php

class AuthController{

    public function __construct()
    {
        $this->ToTask = new ToTask();
    }

    public function ActionIndex(){

        if($_SESSION['admin']){
            header('Location: '.BASE_URL);
        }

        if ($_POST) {

            $error = [];

            $_POST = Functions::check_security($_POST);

            $login = trim($_POST['login']);

            $password = trim($_POST['password']);

            if (!empty($login) && !empty($password)){

                $user = $this->ToTask->GetUser($login,md5($password));

                if($user){

                    $_SESSION['admin'] = $user['login'];

                    header('Location: '.BASE_URL);

                } else{

                    $error['error'] = 'Неверный логин или пароль';
                }

            }else{
                $error['error'] = 'Все поля обязательны для заполнения';
            }

        }

        $post = $_POST;
        include_once __DIR__."/../views/auth.php";

        return true;
    }

}