<?php

class Controller {

    public function __construct() {
    }

    public function model($model) {
        require_once "../app/models/$model.php";
        return new $model;
    }

    public function view($layout, $data = []) {
        // die(json_encode($data));
        require_once "../app/views/layouts/$layout.php";
    }
}
