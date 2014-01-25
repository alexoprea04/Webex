<?php

class Base_Controller {

    private $viewVars = array();
    private $className;
    private $methodName;

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