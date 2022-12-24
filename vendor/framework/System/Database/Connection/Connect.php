<?php

namespace Lynx\System\Database\Connection;

use Lynx\System\Exception\ApplicationException;

class Connect {

    private static $instance;

    public function __construct($username = null,$password = null,$database = null,$hostname = null) {

        $hostname = ($hostname == null ? env('DB_HOSTNAME') : $hostname);
        $username = ($username == null ? env('DB_USERNAME') : $username);
        $password = ($password == null ? env('DB_PASSWORD') : $password);
        $database = ($database == null ? env('DB_DATABASE') : $database);

 
        if (!isset(self::$instance)) {
            try {
                self::$instance = new \PDO("mysql:host=$hostname;dbname=$database", $username, $password);
                self::$instance->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                self::$instance->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_OBJ);
            } catch (\PDOException $e) {
                return new ApplicationException($e->getMessage() , 'Lynx/System/Database/Connection/Connect.php', $e->getCode());
            }

        }
        return self::$instance;
    }

    public static function connect($username = null,$password = null,$database = null,$hostname = null) {

        $hostname = ($hostname == null ? env('DB_HOSTNAME') : $hostname);
        $username = ($username == null ? env('DB_USERNAME') : $username);
        $password = ($password == null ? env('DB_PASSWORD') : $password);
        $database = ($database == null ? env('DB_DATABASE') : $database);

 
        if (!isset(self::$instance)) {
            try {
                self::$instance = new \PDO("mysql:host=$hostname;dbname=$database", $username, $password);
                self::$instance->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                self::$instance->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_OBJ);
            } catch (\PDOException $e) {
                return new ApplicationException($e->getMessage() , 'Lynx/System/Database/Connection/Connect.php', $e->getCode());
            }

        }
        return self::$instance;
    }

    public static function prepare($sql) {
        return self::connect()->prepare($sql);
    }

    public static function query($sql) {
        return self::connect()->query($sql);
    }

    public static function lastInsertId() {
        return self::connect()->lastInsertId();
    }

    public static function beginTransaction() {
        return self::connect()->beginTransaction();
    }

    public static function rollBack() {
        return self::connect()->rollBack();
    }

    public static function commit() {
        return self::connect()->commit();
    }

    public static function execute($sql) {
        return self::connect()->exec($sql);
    }

    public static function close() {
        self::$instance = null;
    }

}