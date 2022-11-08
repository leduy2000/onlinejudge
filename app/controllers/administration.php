<?php

class Administration extends Controller {

    public $contest_model;
    public $problem_model;
    public $testcase_model;

    public function __construct() {
        $this->contest_model = $this->model("Contest");
        $this->problem_model = $this->model("Problem");
        $this->testcase_model = $this->model("Testcase");
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
            $contest = $this->contest_model->byId($arg3);
            if (!$contest) {
                $this->index();
            } else if ($arg2 == 'details') {
                $this->view("master", ["page" => "administration/edit.contest.details", "contest" => json_encode($contest)]);
            } else if ($arg2 == 'problems') {
                $problems = $this->problem_model->by_contest($contest);
                $this->view("master", [
                    "page" => "administration/edit.contest.problems",
                    "contest" => json_encode($contest),
                    "problems" => json_encode($problems)
                ]);
            }
        }
    }

    public function problems($arg1 = null, $arg2 = null, $arg3 = null) {
        session_start();
        if ($arg1 != 'edit') {
            $problems = json_encode($this->problem_model->all());
            $this->view("master", ["page" => "administration/problems", "problems" => $problems]);
        } else {
            $problem = $this->problem_model->byId($arg3);
            if ($arg2 == 'details') {
                $this->view("master", ["page" => "administration/edit.problem.details", "problem" => json_encode($problem)]);
            } else if ($arg2 == 'testcases') {
                $testcases = $this->testcase_model->by_problem($problem);
                $this->view("master", ["page" => "administration/edit.problem.testcases",
                 "problem" => json_encode($problem),
                "testcases" =>json_encode($testcases)
                ]);
            }
        }
    }

    public function create_problem() {
        session_start();
        $this->view("master", ["page" => "administration/create.problem"]);
    }

    public function user_create_problem() {
        session_start();
        if ($_SESSION['username']) {
            $name = $_POST['name'];
            $difficulty = $_POST['difficulty'];
            $time_limit = $_POST['time_limit'];
            $memory_limit = $_POST['memory_limit'];
            $statement = $_POST['statement'];
            $sample_input = $_POST['sample_input'];
            $sample_output = $_POST['sample_output'];
            $user_id = $_SESSION['user_id'];
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

    public function create_contest() {
        session_start();
        $this->view("master", ["page" => "administration/create.contest"]);
    }

    public function create_testcase() {
        session_start();
        if ($_SESSION['username']) {
            $input = $_POST['input'];
            $output = $_POST['output'];
            $problem_id = $_POST['problem_id'];
            $user_id = $_SESSION['user_id'];
            $data = [];
            $data['input'] = $input;
            $data['output'] = $output;
            $data['problem_id'] = $problem_id;
            $data['user_id'] = $user_id;
            $data['since'] = $data['last_update'] = time();
            $this->testcase_model->create($data);
            die(true);
        }
        die(false);
    }

    public function user_create_contest() {
        session_start();
        if ($_SESSION['username']) {
            $name = $_POST['name'];
            $start_time = $_POST['start_time'];
            $end_time = $_POST['end_time'];
            $user_id = $_SESSION['user_id'];
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

    public function user_edit_contest_details() {
        session_start();
        if ($_SESSION['username']) {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $start_time = $_POST['start_time'];
            $end_time = $_POST['end_time'];
            $data = [];
            $data['id'] = $id;
            $data['name'] = $name;
            $data['start_time'] = $start_time;
            $data['end_time'] = $end_time;
            $this->contest_model->edit_details($data);
            die(true);
        }
        die(false);
    }

    public function add_problem_to_contest() {
        session_start();
        if ($_SESSION['username']) {
            $id = $_POST['id'];
            $contest = $this->contest_model->byId($id);
            $problem_name = $_POST['problem_name'];
            $score = $_POST['score'];
            $problem = $this->problem_model->by_name($problem_name)[0];
            $data = [];
            $data['problem'] = $problem;
            $data['contest'] = $contest;
            $data['score'] = $score;
            $this->contest_model->add_problem($data);
        }
        die(false);
    }
}
