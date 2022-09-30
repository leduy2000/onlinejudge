<?php

class Home extends Controller {

    public $user_model;

    public function __construct() {
        $this->user_model = $this->model("User");
    }

    public function index() {
        session_start();
        $this->view("master", ["page" => "home/home"]);
    }

    public function user_submit() {
        session_start();
        if ($_SESSION['username']) {
            $language = $_POST['language'];
            $code = $_POST['code'];
            $data = [];
            $data['code'] = $code;
            $data['language'] = $language;
            $data['username'] = $_SESSION['username'];
            $judge = new Judge($data);
            $judge->process_submission();
        }
        die(false);
    }
}
