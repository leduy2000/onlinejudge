<?php

class Judge {

    private $data = [];

    public function __construct($data = []) {
        $this->data = $data;
    }

    private function prepare() {
        $code = $this->data['code'];
        $language = $this->data['language'];
        $username = $this->data['username'];
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
            return false;
        }
    }

    private static function exec_time($start, $end) {
        return round($end - $start, 2);
    }

    private function execute() {
        $file_name = $this->data['file_name'];
        $time_limit = $this->data['time_limit'];
        $memory_limit = $this->data['memory_limit'];
        $language = $this->data['language'];

        $descriptorspec = array(
            0 => array("file", __DIR__ . "/input.in", "r"),
            1 => array("file", __DIR__ . "/participant.output.out", "w"),
            2 => array("file", __DIR__ . "/error.err", "w")
        );

        $start = microtime(true);
        $process = proc_open(__DIR__ . "/$file_name.exe", $descriptorspec, $pipes);

        $this->data['memusage'] = shell_exec(__DIR__."/getmemusage.bat $file_name.exe");
        $this->data['execution_time'] = self::exec_time($start, microtime(true));

        while (is_resource($process)) {
            $time = self::exec_time($start, microtime(true));
            $mem = shell_exec(__DIR__."/getmemusage.bat $file_name.exe");
            $this->data['memusage'] = $mem;
            $this->data['execution_time'] = $time;
            $status = proc_get_status($process);
            if (!$status['running']) {
                proc_close($process);
            }
            if ($time_limit !== false and $time > $time_limit) {
                proc_terminate($process, 9);
                $this->data['verdict'] = "Time Limit Exeeded";
                break;
            }
            if ($memory_limit !== false and $mem > $memory_limit) {
                proc_terminate($process, 9);
                $this->data['verdict'] = "Memory Limit Exeeded";
                break;
            }
        }

        shell_exec("taskkill /im $file_name.exe /f");
        shell_exec("del ".__DIR__."\\$file_name.$language /f");
        shell_exec("del ".__DIR__."\\$file_name.exe /f");

        if (isset($this->data['verdict'])) {
            return;
        }

        $participant_output_file = fopen(__DIR__."/participant.output.out", "r");
        $jury_output_file = fopen(__DIR__."/jury.output.out", "r");

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

        $this->data['verdict'] = "Accepted";

        if (count($participant_output) != count($jury_output)) {
            $this->data['verdict'] = "Wrong Answer";
            return;
        }
        
        for ($i = 0; $i < count($participant_output); $i++) {
            if ($participant_output[$i] != $jury_output[$i]) {
                $this->data['verdict'] = "Wrong Answer";
                return;
            }
        }
    }

    public function process_submission() {
        if (!$this->prepare()) {
            $this->data['verdict'] = "Compilation Error";
            die(json_encode($this->data));
        }
        $this->execute();
        die(json_encode($this->data));
    }
}
