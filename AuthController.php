<?php

if(session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../models/User.php';

class AuthController {

    private $userModel;

    public function __construct() {

        $this->userModel = new User();
    }

    public function showLogin() {

        include __DIR__ . '/../views/auth/login.php';
    }

    public function login() {

        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = $this->userModel->login($email, $password);

            if($user) {

                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['nombre'];
                $_SESSION['user_email'] = $user['email'];

                header('Location: index.php?action=dashboard');

                exit();

            } else {

                $_SESSION['error'] = "Email o contraseña incorrectos";

                header('Location: index.php?action=login');

                exit();
            }
        }
    }

    public function logout() {

        session_destroy();

        header('Location: index.php?action=login');

        exit();
    }

    public function checkAuth() {

        if(!isset($_SESSION['user_id'])) {

            header('Location: index.php?action=login');

            exit();
        }
    }
}

?>