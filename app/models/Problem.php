<?php

class Problem extends DB {

    public function create($data = []) {
        $name = $data['name'];
        $difficulty = $data['difficulty'];
        $time_limit = $data['time_limit'];
        $memory_limit = $data['memory_limit'];
        $statement = base64_encode($data['statement']);
        $sample_input = base64_encode($data['sample_input']);
        $sample_output = base64_encode($data['sample_output']);
        $user_id = $data['user_id'];
        $since = $data['since'];
        $last_update = $data['last_update'];
        $sql = "insert into Problems (name, difficulty, time_limit, memory_limit, statement, sample_input, sample_output, user_id, since, last_update)
                values ('$name', '$difficulty', '$time_limit', '$memory_limit', '$statement', '$sample_input', '$sample_output', '$user_id', '$since', '$last_update');";
        return $this->execute($sql);
    }

    public function all() {
        $sql = "select * from Problems";
        $rows = $this->execute($sql);
        $problems = $this->fetch($rows);
        foreach ($problems as &$problem) {
            $user_id = $problem['user_id'];
            $sql1 = "select * from Users where id = $user_id";
            $rows = $this->execute($sql1);
            $user = $this->fetch($rows)[0];
            $problem['username'] = $user['username'];
        }
        return $problems;
    }

    public function byId($id) {
        $sql = "select * from Problems where id = $id";
        $rows = $this->execute($sql);
        $data = $this->fetch($rows);

        if (isset($data[0])) {
            return $data[0];
        }
        return null;
    }

    public function by_contest($contest) {
        $contest_id = $contest['id'];
        $sql1 = "select * from ContestsProblems where contest_id = '$contest_id'";
        $rows1 = $this->execute($sql1);
        $data1 = $this->fetch($rows1);
        $problems = [];
        $idx = 1;
        foreach ($data1 as $row) {
            $problem = $this->byId($row['problem_id']);
            $problem['score'] = $row['score'];
            $problem['name'] = $contest['name'] . " #" . $idx . ": " . $problem['name'];

            $user_id = $problem['user_id'];
            $sql2 = "select * from Users where id = $user_id";
            $rows2 = $this->execute($sql2);
            $user = $this->fetch($rows2)[0];
            $problem['username'] = $user['username'];

            $problems[] = $problem;
            $idx++;
        }
        return $problems;
    }

    public function contest_meta_data($contest, $problem) {
        $contest_id = $contest['id'];
        $problem_id = $problem['id'];
        $sql = "select * from ContestsProblems where contest_id = '$contest_id' and problem_id = '$problem_id'";
        $rows = $this->execute($sql);
        $data = $this->fetch($rows);
        if (isset($data[0])) {
            return $data[0];
        }
        return null;
    }

    public function by_name($name) {
        $sql = "select * from Problems where name like '%$name%'";
        $rows = $this->execute($sql);
        return $this->fetch($rows);
    }
}
