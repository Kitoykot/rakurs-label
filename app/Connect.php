<?php

namespace App;

class Connect
{
    private static $host = "127.0.0.1";
    private static $user = "root";
    private static $password = "";
    private static $name = "rakurs-label";

    public static function db()
    {
        $db = mysqli_connect(self::$host, self::$user, self::$password, self::$name);

        return $db;
    }
}