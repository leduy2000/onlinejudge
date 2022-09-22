<?php

class Judge {

    private static function compile($data = []) {
        $code = $data['code'];
        $language = $data['language'];
        $username = $data['username'];
        $file_name = $username . time();
        $file = fopen("asset/submissions/$file_name.$language", "w");
        fwrite($file, $code);
        fclose($file);

        if ($language == 'cpp') {
            $exe_file = "$file_name.exe";
            shell_exec("g++ asset/submissions/$file_name.$language -o asset/submissions/$exe_file");
            $output = shell_exec("D:/xampp/htdocs/onlinejudge/public/asset/submissions/$exe_file");
            die($output);
        }
    }

    public static function process_submission($data = []) {
        self::compile($data);
    }
}
