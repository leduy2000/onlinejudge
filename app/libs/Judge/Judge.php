<?php

class Judge {

    private $data = [];
    private $submission = [];

    public function __construct($data = []) {
        $this->data = $data;
        $this->submission['problem_id'] = $data['problem']['id'];
        $this->submission['contest_id'] = $data['contest']['id'];
        $this->submission['language'] = $data['language'];
        $this->submission['code'] = $data['code'];
        $this->submission['user_id'] = $data['user']['id'];
        $this->submission['score'] = 0;
    }

    private function prepare() {
        $code = $this->data['code'];
        $language = $this->data['language'];
        $username = $this->data['user']['username'];
        $file_name = $username . time();
        $file = fopen(__DIR__ . "/$file_name.$language", "w");
        fwrite($file, $code);
        fclose($file);

        if ($language == 'cpp') {
            shell_exec("g++ " . __DIR__ . "/$file_name.$language -o " . __DIR__ . "/$file_name.exe");
            if (file_exists(__DIR__ . "/$file_name.exe")) {
                $this->data['file_name'] = $file_name;
                return true;
            }
            shell_exec("del " . __DIR__ . "\\$file_name.$language /f");
            return false;
        }
    }

    private static function exec_time($start, $end) {
        return round($end - $start, 2);
    }

    private function execute() {
        $file_name = $this->data['file_name'];
        $time_limit = $this->data['problem']['time_limit'];
        $memory_limit = $this->data['problem']['memory_limit'];
        $language = $this->data['language'];
        $AC = 0;

        foreach ($this->data['testcases'] as $testcase) {

            $testcase_id = $testcase['id'];

            file_put_contents( __DIR__ . "/input.in", base64_decode($testcase['input']));
            file_put_contents( __DIR__ . "/jury.output.out", base64_decode($testcase['output']));

            $this->submission['result']['testcases']["$testcase_id"]['input'] = $testcase['input'];
            $this->submission['result']['testcases']["$testcase_id"]['output'] = $testcase['output'];

            $descriptorspec = array(
                0 => array("file", __DIR__ . "/input.in", "r"),
                1 => array("file", __DIR__ . "/participant.output.out", "w"),
                2 => array("file", __DIR__ . "/error.err", "w")
            );

            $start = microtime(true);
            $process = proc_open(__DIR__ . "/$file_name.exe", $descriptorspec, $pipes);

            $this->submission['result']['testcases']["$testcase_id"]['memusage'] = shell_exec(__DIR__ . "/getmemusage.bat $file_name.exe");
            $this->submission['result']['testcases']["$testcase_id"]['execution_time'] = self::exec_time($start, microtime(true));

            while (is_resource($process)) {
                $time = self::exec_time($start, microtime(true));
                $mem = shell_exec(__DIR__ . "/getmemusage.bat $file_name.exe");
                $this->submission['result']['testcases']["$testcase_id"]['memusage'] = $mem;
                $this->submission['result']['testcases']["$testcase_id"]['execution_time'] = $time;
                if ($time_limit !== false and $time > $time_limit) {
                    proc_terminate($process, 9);
                    $this->submission['result']['testcases']["$testcase_id"]['verdict'] = "Time Limit Exeeded";
                    if (!isset($this->submission['result']['verdict'])) {
                        $this->submission['result']['verdict'] = "Time Limit Exeeded";
                    }
                    break;
                }
                if ($memory_limit !== false and $mem > $memory_limit) {
                    proc_terminate($process, 9);
                    $this->submission['result']['testcases']["$testcase_id"]['verdict'] = "Memory Limit Exeeded";
                    if (!isset($this->submission['result']['verdict'])) {
                        $this->submission['result']['verdict'] = "Memory Limit Exeeded";
                    }
                    break;
                }
                $status = proc_get_status($process);
                if (!$status['running']) {
                    proc_close($process);
                }
            }

            if (isset($this->submission['result']['testcases']["$testcase_id"]['verdict'])) {
                continue;
            }

            $participant_output_file = fopen(__DIR__ . "/participant.output.out", "r");
            $jury_output_file = fopen(__DIR__ . "/jury.output.out", "r");

            $participant_output = [];
            $jury_output = [];

            while (!feof($participant_output_file)) {
                $line = trim(fgets($participant_output_file));
                if ($line !== '')
                    $participant_output[] = $line;
            }
            fclose($participant_output_file);

            while (!feof($jury_output_file)) {
                $line = trim(fgets($jury_output_file));
                if ($line !== '')
                    $jury_output[] = $line;
            }
            fclose($jury_output_file);

            $this->submission['result']['testcases']["$testcase_id"]['verdict'] = "Accepted";

            if (count($participant_output) != count($jury_output)) {
                $this->submission['result']['testcases']["$testcase_id"]['verdict'] = "Wrong Answer";
                if (!isset($this->submission['result']['verdict'])) {
                    $this->submission['result']['verdict'] = "Wrong Answer";
                }
                continue;
            }

            for ($i = 0; $i < count($participant_output); $i++) {
                if ($participant_output[$i] != $jury_output[$i]) {
                    $this->submission['result']['testcases']["$testcase_id"]['verdict'] = "Wrong Answer";
                    if (!isset($this->submission['result']['verdict'])) {
                        $this->submission['result']['verdict'] = "Wrong Answer";
                    }
                    break;
                }
            }

            if ($this->submission['result']['testcases']["$testcase_id"]['verdict'] == "Accepted") {
                $AC++;
            }
        }
        $this->submission['score'] = $AC * $this->data['problem']['score'] / count($this->data['testcases']);
        if (!isset($this->submission['result']['verdict'])) {
            $this->submission['result']['verdict'] = "Accepted";
        }

        shell_exec("taskkill /im $file_name.exe /f");
        shell_exec("del " . __DIR__ . "\\$file_name.$language /f");
        shell_exec("del " . __DIR__ . "\\$file_name.exe /f");
    }

    public function process_submission() {
        if (!$this->prepare()) {
            $this->submission['result']['verdict'] = "Compilation Error";
            return $this->submission;
        }
        $this->execute();
        return $this->submission;
    }
}
