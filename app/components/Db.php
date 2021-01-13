<?php
class Db
{

    public static function getConnection()
    {
        $paramsPath = __DIR__ . '/../config/db_config.php';
        $params = include($paramsPath);

        $dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
        $db = new PDO($dsn, $params['user'], $params['password']);

        $db->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAME'utf8'");

        return $db;
    }


}