<?php

class Login extends Controller {

    public $user_model;

    public function __construct() {
        $this->user_model = $this->model("User");
    }

    public function index() {
        session_start();
        $this->view("master", ["page" => "login/login"]);
    }

    public function user_login() {
        $data = [];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $data['email'] = $email;
        $user = $this->user_model->find_by_email($data);
        if (isset($user)) {
            if (password_verify($password, $user['password'])) {
                session_start();
                $_SESSION['username'] = $user['username'];
                die(true);
            }
        }
        die(false);
    }
}
