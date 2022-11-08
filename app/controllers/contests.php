<?php

class Contests extends Controller {

    public $contest_model;
    public $problem_model;
    public $submission_model;
    public $user_model;
    public $testcase_model;

    public function __construct() {
        $this->contest_model = $this->model("Contest");
        $this->problem_model = $this->model("Problem");
        $this->submission_model = $this->model("Submission");
        $this->user_model = $this->model("User");
        $this->testcase_model = $this->model("Testcase");
    }

    public function index() {
        session_start();
        $contests = $this->contest_model->all();
        $this->view("master", ["page" => "contests/contests", "contests" => json_encode($contests)]);
    }

    public function problems($contest_id) {
        $contest = $this->contest_model->byId($contest_id);
        if ($contest) {
            session_start();
            $problems = $this->problem_model->by_contest($contest);
            $this->view("master", ["page" => "contests/contest.problems",
             "problems" => json_encode($problems), "contest" => json_encode($contest)]);
        } else {
            $this->index();
        }
    }

    public function problem($contest_id, $problem_id) {
        $contest = $this->contest_model->byId($contest_id);
        if ($contest) {
            session_start();
            $problem = $this->problem_model->byId($problem_id);
            $this->view("master", ["page" => "contests/contest.problem", "contest" => json_encode($contest), "problem" => json_encode($problem)]);
        } else {
            $this->index();
        }
    }

    public function submissions($contest_id, $problem_id) {
        $contest = $this->contest_model->byId($contest_id);
        if ($contest) {
            session_start();
            $problem = $this->problem_model->byId($problem_id);
            $user = $this->user_model->by_id($_SESSION['user_id']);
            $submissions = $this->submission_model->by_contest_problem_user($contest, $problem, $user);
            $this->view("master", ["page" => "contests/contest.problem.submissions",
             "contest" => json_encode($contest), "problem" => json_encode($problem),
              "submissions" => json_encode($submissions)]);
        } else {
            $this->index();
        }
    }

    public function submission($contest_id, $problem_id, $submission_id) {
        session_start();
        $contest = $this->contest_model->byId($contest_id);
        $problem = $this->problem_model->byId($problem_id);
        $submission = $this->submission_model->byId($submission_id);
        $this->view("master", ["page" => "contests/contest.problem.submission",
             "contest" => json_encode($contest),
              "problem" => json_encode($problem),
              "submission" => json_encode($submission)]);
    }

    public function user_submit() {
        session_start();
        if ($_SESSION['username']) {
            $language = $_POST['language'];
            $code = $_POST['code'];
            $problem_id = $_POST['problem_id'];
            $contest_id = $_POST['contest_id'];

            $contest = $this->contest_model->byId($contest_id);
            $problem = $this->problem_model->byId($problem_id);
            $meta_data = $this->problem_model->contest_meta_data($contest, $problem);
            $user = $this->user_model->by_id($_SESSION['user_id']);
            $testcases = $this->testcase_model->by_problem($problem);

            $problem['score'] = $meta_data['score'];

            $data = [];
            $data['code'] = $code;
            $data['language'] = $language;
            $data['problem'] = $problem;
            $data['contest'] = $contest;
            $data['user'] = $user;
            $data['testcases'] = $testcases;

            $judge = new Judge($data);
            $submission = $judge->process_submission();
            $this->submission_model->create($submission);
            die(json_encode($submission));
        }
        die(false);
    }

}
