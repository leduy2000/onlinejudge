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
}
