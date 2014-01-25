<?php

    class DBConnection {
        private static $conn;

        public static function getConnection() {
            if (!self::$conn) {
                $user = 'root';
                $pass ='';
                self::$conn = new PDO('mysql:host=192.168.12.227;dbname=application;charset=utf8', $user , $pass);
            }
            return  self::$conn;
        }
    }