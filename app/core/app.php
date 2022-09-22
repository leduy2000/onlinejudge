<?php

class App {

    public $controller = "home";
    public $method = "index";
    public $params = [];

    public function __construct() {
        $arr = $this->get_url();

        // controller
        if (isset($arr[0])) {
            if (file_exists("../app/controllers/$arr[0].php")) {
                $this->controller = $arr[0];
                unset($arr[0]);
            }
        }
        require_once "../app/controllers/$this->controller.php";
        $this->controller = new $this->controller;
        // action
        if (isset($arr[1])) {
            if (method_exists($this->controller, $arr[1])) {
                $this->method = $arr[1];
            }
            unset($arr[1]);
        }

        // params
        $this->params = $arr ? array_values($arr) : [];
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function get_url() {
        if (isset($_GET['url'])) {
            return explode('/', filter_var(trim($_GET['url'], '/')));
        }
    }
}
