<?php

namespace App\Controller;

use App\Core\View;
use App\Domain\Repositories\UserRepository;

use Exception;

class AuthController
{

    private static function initSession(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function index(): void
    {
        self::initSession();

        $errors = $_SESSION['errors']['login'] ?? [
            'error_email' => '',
            'error_password' => ''
        ];

        unset($_SESSION['errors']['login']);

        $view = new View();
        $view->render('login', params: [...$errors]);
    }

    public static function login(): void
    {
        self::initSession();

        $errors = [];

        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);

        if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['error_email'] = 'Email inválido';
        }

        if (!$password) {
            $errors['error_password'] = 'Senha inválida';
        }

        if(empty($errors)){
            try {
                $userRepository = new UserRepository();
                $user = $userRepository->getUser($email);
            }catch (Exception $e){
                echo $e->getMessage();
                $user = null;
            }

            if (!$user || !$user->verifyPassword($password)) {
                $errors['error_email'] = 'Email ou senha incorretos';
                $errors['error_password'] = 'Email ou senha incorretos';
            } else {
                $_SESSION['user'] = [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email
                ];
                header('Location: /');
                exit();
            }

            $_SESSION['user'] = ['id' => $user->id, 'name' => $user->name, 'email' => $user->email];
            header('Location: /');
            exit();
        }

        $_SESSION['errors']['login'] = $errors;
        header('Location: /login');
        exit();
    }

    public static function logout(): void
    {
        self::initSession();

        unset($_SESSION['user']);
        header('Location: /');
        exit();
    }

    public static function signin(): void
    {
        self::initSession();
        $errors = [];

        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);

        if (!$name) $errors['name'] = 'Nome Inválido';
        if(!$email || filter_var($email, FILTER_SANITIZE_EMAIL)) $errors['email'] = 'E-mail Inválido';
        if(!$password) $errors['password'] = 'Password Inválido';

        if(empty($errors)){
            $password = password_hash($password, PASSWORD_BCRYPT);

        }
    }

}