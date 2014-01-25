<?php

class Base_Model {

    public $db;

    public function __construct() {
        $user = 'root';
        $pass ='';
        $this->db = new PDO('mysql:host=192.168.12.227;dbname=application;charset=utf8', $user , $pass);
    }

}