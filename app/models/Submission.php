<?php

class Submission extends DB {

    public function create($data = []) {
        $problem_id = $data['problem_id'];
        $contest_id = $data['contest_id'];
        $result = $data['result'];
        $score = $data['score'];
        $user_id = $data['user_id'];
        $language = $data['language'];
        $code = $data['code'];
        $since = $last_update = time();
        $result = base64_encode(json_encode($result));
        $code = base64_encode($code);
        $sql = "insert into Submissions (problem_id, contest_id, result, score, language, code, user_id, since, last_update)
                values ('$problem_id', '$contest_id', '$result', '$score', '$language', '$code', '$user_id', '$since', '$last_update');";
        return $this->execute($sql);
    }

    public function all() {
        $sql = "select * from Submissions";
        $rows = $this->execute($sql);
        $submissions = $this->fetch($rows);
        foreach ($submissions as &$submission) {

            $user_id = $submission['user_id'];
            $sql1 = "select * from Users where id = '$user_id'";
            $user_rows = $this->execute($sql1);
            $user = ($this->fetch($user_rows))[0];

            $problem_id = $submission['problem_id'];
            $sql2 = "select * from Problems where id = '$problem_id'";
            $problem_rows = $this->execute($sql2);
            $problem = ($this->fetch($problem_rows))[0];

            $submission['username'] = $user['username'];
            $submission['problem_name'] = $problem['name'];
        }
        return $submissions;
    }

    public function by_user($user) {
        $user_id = $user['id'];
        $sql = "select * from Submissions where user_id = '$user_id'";
        $rows = $this->execute($sql);
        $submissions = $this->fetch($rows);
        foreach ($submissions as $submission) {
            $submission['username'] = $user['username'];
        }
        return $submissions;
    }

    public function by_contest_problem_user($contest, $problem, $user) {
        $user_id = $user['id'];
        $contest_id = $contest['id'];
        $problem_id = $problem['id'];
        $sql = "select * from Submissions where user_id = '$user_id' and contest_id = '$contest_id' and problem_id = '$problem_id'";
        $rows = $this->execute($sql);
        $submissions = $this->fetch($rows);
        foreach ($submissions as $submission) {
            $submission['username'] = $user['username'];
        }
        return $submissions;
    }

    public function byId($id) {
        $sql = "select * from Submissions where id = '$id'";
        $rows = $this->execute($sql);
        $data = $this->fetch($rows);
        if (isset($data[0])) {
            return $data[0];
        }
        return null;
    }
}
