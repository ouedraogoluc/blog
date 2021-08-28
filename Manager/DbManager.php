<?php


class DbManager extends PDO
{
    const USER = "root";
    const PWD = "basseva";
    const DSN = 'mysql:host=localhost;port=3306;dbname=blog';
    private static ?DbManager $instance = null;

    private function __construct()
    {
        try {
            parent::__construct(self::DSN, self::USER, self::PWD);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    private function __clone() {}

    public static function get_instance(): DbManager
    {
        if (!self::$instance)
            return new DbManager;
        return self::$instance;
    }

}