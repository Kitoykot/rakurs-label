<?php

namespace App;
session_start();

class Admin extends Connect
{
    public static function login($login, $password)
    {
        setcookie("login", $login, time()+9999, "/admin/");

        $login = htmlspecialchars($login);
        $password = htmlspecialchars($password);

        if($login === "" || $password === "")
        {
            $_SESSION["error_message"] = "Введите логин и пароль";
            header("location:/admin/");
            die();
        }

        $find_sql = "SELECT * FROM `admins` WHERE `login` = '$login'";
        $find_query = mysqli_query(self::db(), $find_sql);

        if(!mysqli_num_rows($find_query) > 0)
        {
            $_SESSION["error_message"] = "Неверный логин или пароль";
            header("location:/admin/");
            die();
        } 

        $user = mysqli_fetch_assoc($find_query);
        $password_verify = password_verify($password, $user["password"]);

        if($password_verify)
        {
            $_SESSION["id"] = $user["id"];
            $_SESSION["name"] = $user["name"];
            $_SESSION["login"] = $user["login"];

            return true;

        } else {

            $_SESSION["error_message"] = "Неверный логин или пароль";
            header("location:/admin/");
            die();
        }
        
    }

    public static function check($id)
    {
        $id = htmlspecialchars($id);

        $sql = "SELECT * FROM `admins` WHERE `id` = '$id'";
        $query = mysqli_query(self::db(), $sql);

        return mysqli_fetch_assoc($query) > 0;
    }

    public static function logout()
    {
        unset($_SESSION["id"]);
        unset($_SESSION["name"]);
        unset($_SESSION["login"]);
        unset($_SESSION);
    }
}