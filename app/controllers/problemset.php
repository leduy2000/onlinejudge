<?php

class Problemset extends Controller {

    public $problem_model;
    public $submission_model;

    public function __construct() {
        $this->problem_model = $this->model("Problem");
        $this->submission_model = $this->model("Submission");
    }

    public function index() {
        session_start();
        $problems = json_encode($this->problem_model->all());
        $this->view("master", ["page" => "problemset/problemset", "problems" => $problems]);
    }

    public function problem($id) {
        session_start();
        $problem = json_encode($this->problem_model->byId($id));
        if ($problem) {
            $this->view("master", ["page" => "problemset/problem", "problem" => $problem]);
        } else {
            $problems = json_encode($this->problem_model->all());
            $this->view("master", ["page" => "problemset/problemset", "problems" => $problems]);
        }
    }

    public function submissions($id) {
        session_start();
        $problem = json_encode($this->problem_model->byId($id));
        if ($problem) {
            $this->view("master", ["page" => "problemset/submissions", "problem" => $problem]);
        } else {
            $problems = json_encode($this->problem_model->all());
            $this->view("master", ["page" => "problemset/problemset", "problems" => $problems]);
        }
    }

    public function submission($id) {
        session_start();
        $problem = json_encode($this->problem_model->byId($id));
        if ($problem) {
            $this->view("master", ["page" => "problemset/submission", "problem" => $problem]);
        } else {
            $problems = json_encode($this->problem_model->all());
            $this->view("master", ["page" => "problemset/problemset", "problems" => $problems]);
        }
    }

    public function user_submit() {
        session_start();
        if ($_SESSION['username']) {
            $language = $_POST['language'];
            $code = $_POST['code'];
            $problem_id = $_POST['problem_id'];
            $contest_id = $_POST['contest_id'];
            $time_limit = $_POST['time_limit'];
            $memory_limit = $_POST['memory_limit'];
            $data = [];
            $data['code'] = $code;
            $data['language'] = $language;
            $data['username'] = $_SESSION['username'];
            $data['problem_id'] = $problem_id;
            $data['contest_id'] = $contest_id;
            $data['time_limit'] = $time_limit;
            $data['memory_limit'] = $memory_limit;
            $data['user_id'] = $_SESSION['user_id'];
            $judge = new Judge($data);
            $submission = $judge->process_submission();
            $this->submission_model->create($submission);
            die(json_encode($submission));
        }
        die(false);
    }

    public function by_name() {
        session_start();
        if ($_SESSION['username']) {
            $name = $_POST['name'];
            die(json_encode($this->problem_model->by_name($name)));
        }
        die(false);
    }
}
