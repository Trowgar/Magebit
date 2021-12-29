<?php

class Database
{
    const HOST = 'localhost';
    const USER = 'root';
    const PASSWORD = '';
    const DBNAME = 'magebit';

    public static function connect()
    {
        $host = self::HOST;
        $user = self::USER;
        $password = self::PASSWORD;
        $dbname = self::DBNAME;

        try {
            $connection = new PDO("mysql:host=$host; dbname=$dbname", $user, $password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            print $e->getMessage();
        }

        return $connection;
    }
}