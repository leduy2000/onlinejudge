<?php

class Problemset extends Controller {

    public $problem_model;

    public function __construct() {
        $this->problem_model = $this->model("Problem");
    }

    public function index() {
        session_start();
        $problems = $this->problem_model->all();
        $this->view("master", ["page" => "problemset/problemset", "problems" => $problems]);
    }

    public function problem($id) {
        session_start();
        $problem = $this->problem_model->byId($id);
        if ($problem) {
            $this->view("master", ["page" => "problemset/problem", "problem" => $problem]);
        } else {
            $problems = $this->problem_model->all();
            $this->view("master", ["page" => "problemset/problemset", "problems" => $problems]);
        }
    }

    public function create() {
        session_start();
        $this->view("master", ["page" => "problemset/create"]);
    }

    public function user_create() {
        session_start();
        if ($_SESSION['username']) {
            $name = $_POST['name'];
            $difficulty = $_POST['difficulty'];
            $time_limit = $_POST['time_limit'];
            $memory_limit = $_POST['memory_limit'];
            $statement = $_POST['statement'];
            $sample_input = $_POST['sample_input'];
            $sample_output = $_POST['sample_output'];
            $user_id = $_SESSION['id'];
            $data = [];
            $data['name'] = $name;
            $data['difficulty'] = $difficulty;
            $data['time_limit'] = $time_limit;
            $data['memory_limit'] = $memory_limit;
            $data['statement'] = $statement;
            $data['sample_input'] = $sample_input;
            $data['sample_output'] = $sample_output;
            $data['user_id'] = $user_id;
            $data['since'] = $data['last_update'] = time();
            $this->problem_model->create($data);
            die(true);
        }
        die(false);
    }
}
