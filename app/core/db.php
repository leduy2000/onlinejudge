<?php

class DB {

    public $conn;
    protected $servername = 'localhost';
    protected $username = 'root';
    protected $password = '';
    protected $dbname = 'onlinejudge';

    public function __construct() {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
    }

    protected function execute($sql) {
        return $this->conn->query($sql);
    }

    public function fetch($rows) {
        $res = [];
        while ($row = $rows->fetch_assoc()) {
            $res[] = $row;
        }
        return $res;
    }
}
