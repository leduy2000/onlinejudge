<?php

class Register extends Controller {

    public $user_model;

    public function __construct() {
        $this->user_model = $this->model("User");
    }

    public function index() {
        $this->view("master", ["page" => "register/register"]);
    }

    public function user_register() {
        $data = [];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $username = strstr($email, '@', true);
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        if ($password != $confirm_password) {
            die(false);
        }
        $data['first_name'] = $first_name;
        $data['last_name'] = $last_name;
        $data['username'] = $username;
        $data['email'] = $email;
        $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        $data['since'] = $data['last_update'] = time();
        if ($this->user_model->create($data)) {
            session_start();
            $_SESSION['username'] = $username;
            die($_SESSION['username']);
        } else {
            die(false);
        }
    }
}
