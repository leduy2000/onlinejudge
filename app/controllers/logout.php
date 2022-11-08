<?php

class Logout extends Controller {

    public $user_model;

    public function __construct() {
        $this->user_model = $this->model("User");
    }

    public function index() {
        session_start();
        session_destroy();
        return true;
    }
}
