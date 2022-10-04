<?php

class Problem extends DB {

    public function create($data = []) {
        $name = $data['name'];
        $difficulty = $data['difficulty'];
        $time_limit = $data['time_limit'];
        $memory_limit = $data['memory_limit'];
        $statement = $data['statement'];
        $sample_input = $data['sample_input'];
        $sample_output = $data['sample_output'];
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
        return json_encode($this->fetch($rows));
    }

    public function byId($id) {
        $sql = "select * from Problems where id = $id";
        $rows = $this->execute($sql);
        $data = $this->fetch($rows);
        
        if (isset($data[0])) {
            return json_encode($data[0]);
        }
        return null;
    }

}
