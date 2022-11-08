<?php

class Home extends Controller {

    public $user_model;
    public $submission_model;

    public function __construct() {
        $this->user_model = $this->model("User");
        $this->submission_model = $this->model("Submission");
    }

    public function index() {
        session_start();
        $submissions = $this->submission_model->all();
        $this->view("master", ["page" => "home/home", "submissions" => json_encode($submissions)]);
    }
    
}
