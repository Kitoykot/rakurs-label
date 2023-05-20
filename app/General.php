<?php

namespace App;
session_start();

class General extends Connect
{
    public static function get()
    {
        $sql = "SELECT * FROM `general`";
        $query = mysqli_query(self::db(), $sql);

        return mysqli_fetch_assoc($query);
    }

    public static function update($post, $title, $description, $vk_link, $tg_link, $tap_link)
    {
        foreach($post as $k => $v)
        {
            setcookie($k, $v, time()+9999, "/admin/general.php");
        }

        $title = htmlspecialchars($title);
        $description = htmlspecialchars($description);
        $description = addslashes($description);
        $vk_link = htmlspecialchars($vk_link);
        $tg_link = htmlspecialchars($tg_link);
        $tap_link = htmlspecialchars($tap_link);

        if($title === "" || $description === "" || $vk_link === "" ||
            $tg_link === "" || $tap_link === "")
        {
            $_SESSION["error_message"] = "Пожалуйста, не оставляйте поля пустыми";
            header("location:/admin/general.php");
            die();
        }

        $sql = "UPDATE `general` SET `title` = '$title', `description` = '$description', `vk-link` = '$vk_link', `tg-link` = '$tg_link', `tap-link` = '$tap_link' WHERE `id` = '1'";
        $query = mysqli_query(self::db(), $sql);

        return $query ? true : false;
    }
}