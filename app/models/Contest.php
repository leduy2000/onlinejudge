<?php

class Contest extends DB {

    public function create($data = []) {
        $name = $data['name'];
        $start_time = $data['start_time'];
        $end_time = $data['end_time'];
        $user_id = $data['user_id'];
        $since = $data['since'];
        $last_update = $data['last_update'];
        $sql = "insert into Contests (name, start_time, end_time, user_id, since, last_update)
                values ('$name', '$start_time', '$end_time', '$user_id', '$since', '$last_update');";
        return $this->execute($sql);
    }

    public function edit_details($data = []) {
        $id = $data['id'];
        $name = $data['name'];
        $start_time = $data['start_time'];
        $end_time = $data['end_time'];
        $last_update = time();
        $sql = "update Contests 
                set name = '$name', start_time = '$start_time', end_time = '$end_time', last_update = '$last_update'
                where id = '$id';";
        return $this->execute($sql);
    }

    public function all() {
        $sql = "select * from Contests";
        $rows = $this->execute($sql);
        $contests = $this->fetch($rows);
        foreach ($contests as &$contest) {
            $user_id = $contest['user_id'];
            $sql1 = "select * from Users where id = $user_id";
            $rows = $this->execute($sql1);
            $user = $this->fetch($rows)[0];
            $contest['username'] = $user['username'];
        }
        return $contests;
    }

    public function add_problem($data = []) {
        $problem = $data['problem'];
        $contest = $data['contest'];
        $problem_id = $problem['id'];
        $contest_id = $contest['id'];
        $score = $data['score'];
        $sql = "insert into ContestsProblems (problem_id, contest_id, score) values ('$problem_id', '$contest_id', '$score');";
        return $this->execute($sql);
    }

    public function byId($id) {
        $sql = "select * from Contests where id = $id";
        $rows = $this->execute($sql);
        $data = $this->fetch($rows);
        if (isset($data[0])) {
            return $data[0];
        }
        return null;
    }
}
