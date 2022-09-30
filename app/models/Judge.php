<?php

class Judge {

    private const DIR = "C:/xampp/htdocs/onlinejudge/public/asset/submissions/";

    public $data = [];

    public function __construct($data = []) {
        $this->data = $data;
    }

    private function compile() {
        $code = $this->data['code'];
        $language = $this->data['language'];
        $username = $this->data['username'];
        $file_name = $username . time();
        $file = fopen("asset/submissions/$file_name.$language", "w");
        fwrite($file, $code);
        fclose($file);

        if ($language == 'cpp') {
            $exe_file = "$file_name.exe";
            shell_exec("g++ asset/submissions/$file_name.$language -o asset/submissions/$exe_file");
            $this->data['exe_file'] = $exe_file;
            // $output = shell_exec("D:/xampp/htdocs/onlinejudge/public/asset/submissions/$exe_file");
            // shell_exec("powershell.exe C:/xampp/htdocs/onlinejudge/public/asset/submissions/$exe_file");
        }
    }

    private function execute() {
        $file_to_run = $this->data['exe_file'];
        $cmd = self::DIR.$file_to_run." < ".self::DIR."inputf.in"." > ".self::DIR."outputf.out";
        shell_exec($cmd);
    }

    public function process_submission() {
        $this->compile();
        $this->execute();
    }

}
