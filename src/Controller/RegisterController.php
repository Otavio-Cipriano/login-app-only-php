<?php

namespace App\Controller;

use App\Core\View;
use App\Domain\Repositories\UserRepository;

class RegisterController
{

    private static function initSession(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }
    public static function index(): void
    {
        $view = new View();
        $view->render('signin');
    }

    public static function signin(): void
    {
        self::initSession();
        $errors = [];

        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);

        if (!$name) $errors['name'] = 'Nome Inválido';
        if(!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors['email'] = 'E-mail Inválido';
        if(!$password || strlen($password) < 6) $errors['password'] = 'Senha deve ter pelo menos 6 caracteres';

        if(empty($errors)){
            $password = password_hash($password, PASSWORD_BCRYPT);

            try {
                $UserRepository = new UserRepository();
                $user = $UserRepository->createUser($name, $email, $password);
            }catch (\Exception $e){
                echo $e->getMessage();
                $user = null;
            }

            if($user){
                $_SESSION['user'] = ['id' => $user->id, 'name' => $user->name, 'email' => $user->email];
                header('Location: /');
                exit();
            }


            $errors['error_server'] = 'Não foi possível criar o usuário. Tente novamente.';
            $_SESSION['errors']['register'] = $errors;
            header('Location: /signin');
            exit();
        }
    }
}