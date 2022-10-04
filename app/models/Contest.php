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

    public function all() {
        $sql = "select * from Contests";
        $rows = $this->execute($sql);
        return json_encode($this->fetch($rows));
    }
}
