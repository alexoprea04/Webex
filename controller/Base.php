<?php

class Base_Controller {

    private $viewVars = array();
    private $className;
    private $methodName;
    public $db;

    public function __construct() {
        $user = 'root';
        $pass ='';
        $this->db = new PDO('mysql:host=192.168.12.227;dbname=application;charset=utf8', $user , $pass);
    }

    public function setCalledClass($className) {
        $this->className = $className;
    }

    public function setCalledMethod($methodName) {
        $this->methodName = $methodName;
    }

    protected function addVar($name, $value) {
        $this->viewVars[$name] = $value;
    }

    private function loadView() {
        preg_match('/([a-zA-Z]+)_Controller/s', $this->className, $matches);
        $data = $this->viewVars;
        //load file
        require_once(
                'view/' .
                strtolower($matches[1])
                . DIRECTORY_SEPARATOR .
                strtolower($this->methodName) . '.php');
    }

    public function preMethodCall() {

    }

    public function postMethodCall() {
        $this->loadView();
    }


}