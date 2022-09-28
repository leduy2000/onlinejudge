<?php

class Contests extends Controller {

    public $contest_model;

    public function __construct() {
        $this->contest_model = $this->model("Contest");
    }

    public function index() {
        session_start();
        $this->view("master", ["page" => "contests/contests"]);
    }

    public function create() {
        session_start();
        $this->view("master", ["page" => "contests/create"]);
    }

    public function user_create() {
        session_start();
        if ($_SESSION['username']) {
            $name = $_POST['name'];
            $start_time = $_POST['start_time'];
            $end_time = $_POST['end_time'];
            $user_id = $_SESSION['id'];
            $data = [];
            $data['name'] = $name;
            $data['start_time'] = $start_time;
            $data['end_time'] = $end_time;
            $data['user_id'] = $user_id;
            $data['since'] = $data['last_update'] = time();
            $this->contest_model->create($data);
            die(true);
        }
        die(false);
    }
}
