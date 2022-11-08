<?php

class Testcase extends DB {

    public function create($data = []) {
        $problem_id = $data['problem_id'];
        $input = base64_encode($data['input']);
        $output = base64_encode($data['output']);
        $user_id = $data['user_id'];
        $since = $data['since'];
        $last_update = $data['last_update'];
        $sql = "insert into Testcases (problem_id, input, output, user_id, since, last_update)
                values ('$problem_id', '$input', '$output', '$user_id', '$since', '$last_update');";
        return $this->execute($sql);
    }

    public function by_user($user) {
        $user_id = $user['id'];
        $sql = "select * from Testcases where user_id = '$user_id'";
        $rows = $this->execute($sql);
        $submissions = $this->fetch($rows);
        foreach ($submissions as $submission) {
            $submission['username'] = $user['username'];
        }
        return $submissions;
    }

    public function by_problem($problem) {
        $problem_id = $problem['id'];
        $sql = "select * from Testcases where problem_id = '$problem_id'";
        $rows = $this->execute($sql);
        $testcases = $this->fetch($rows);
        return $testcases;
    }

    public function byId($id) {
        $sql = "select * from Testcases where id = '$id'";
        $rows = $this->execute($sql);
        $data = $this->fetch($rows);
        if (isset($data[0])) {
            return $data[0];
        }
        return null;
    }
}
