<?php

class Base_Controller {

    private $viewVars = array();
    private $className;
    private $methodName;
    public $db;
	public $app_user;

    public function __construct() {
        $user = 'root';
        $pass ='';
        $this->db = new PDO('mysql:host=192.168.12.227;dbname=application;charset=utf8', $user , $pass);
		if(isset($_SESSION['user_id'])) $this->app_user = $_SESSION['user_id'];
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
        $baseDir = Config::baseDir;
        $baseDirImages = Config::baseDirImages;

        $filename =  'view/' .
            strtolower($matches[1])
            . DIRECTORY_SEPARATOR .
            strtolower($this->methodName) . '.php';

        //load file
        if (is_file($filename)) {
            require_once($filename);
        }
    }

    public function preMethodCall() {

    }

    public function postMethodCall() {
        $this->loadHeader();
        $this->loadView();
        $this->loadFooter();
    }

    public function loadHeader() {
        require_once(dirname(__DIR__) . '../view/header.php');
    }

    public function loadFooter() {
        require_once(dirname(__DIR__) . '../view/footer.php');
    }


}