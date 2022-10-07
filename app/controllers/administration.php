<?php

class Administration extends Controller {

    public $contest_model;
    public $problem_model;

    public function __construct() {
        $this->contest_model = $this->model("Contest");
        $this->problem_model = $this->model("Problem");
    }

    public function index() {
        session_start();
        $contests = json_encode($this->contest_model->all());
        $this->view("master", ["page" => "administration/contests", "contests" => $contests]);
    }

    public function contests($arg1 = null, $arg2 = null, $arg3 = null) {  
        if ($arg1 != 'edit') {
            $this->index();
        } else {
            session_start();
            $contest = json_encode($this->contest_model->byId($arg3));
            if (!$contest) {
                $this->index();
            } else if ($arg2 == 'details') {
                $this->view("master", ["page" => "administration/edit.contest.details", "contest" => $contest]);
            } else if ($arg2 == 'problems') {
                $this->view("master", ["page" => "administration/edit.contest.problems", "contest" => $contest]);
            }
        }
    }

    public function problems() {
        session_start();
        $problems = json_encode($this->problem_model->all());
        $this->view("master", ["page" => "administration/problems", "problems" => $problems]);
    }

    public function add_problem_to_contest() {
        session_start();
        if ($_SESSION['username']) {
            $id = $_POST['id'];
            $problem_name = $_POST['problem_name'];
            $problem_score = $_POST['problem_score'];
            $data = [];
            $data['id'] = $id;
            $data['problem_name'] = $problem_name;
            $data['problem_score'] = $problem_score;
            // die(json_encode($this->problem_model->by_name($name)));
        }
        die(false);
    }

}
