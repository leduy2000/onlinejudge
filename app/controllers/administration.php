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
        $contests = $this->contest_model->all();
        $this->view("master", ["page" => "administration/contests", "contests" => $contests]);
    }

    public function contests($arg1 = null, $arg2 = null) {  
        if ($arg1 != 'edit') {
            $this->index();
        } else {
            session_start();
            $contest = $this->contest_model->byId($arg2);
            if (!$contest) {
                $this->index();
            } else {
                $this->view("master", ["page" => "administration/edit.contest", "contest" => $contest]);
            }
        }
    }

    public function problems() {
        session_start();
        $problems = $this->problem_model->all();
        $this->view("master", ["page" => "administration/problems", "problems" => $problems]);
    }

}
