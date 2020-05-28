<?php


class Conexao {

    public static $instance;

    private function __construct() {
        //
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new PDO('mysql:host='.getenv('mysql_host').';
            dbname='.getenv('mysql_db'), getenv('mysql_user'), getenv('mysql_password'),
                array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            self::$instance->setAttribute(PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION);
            self::$instance->setAttribute(PDO::ATTR_ORACLE_NULLS,
                PDO::NULL_EMPTY_STRING);
        }

        return self::$instance;
    }

}