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
    
}
