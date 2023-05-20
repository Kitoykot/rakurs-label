<?php

namespace App;
session_start();

class Release extends Connect
{
    public static function create($post, $artist_id, $title, $multi_link, $cover)
    {
        foreach($post as $k => $v)
        {
            setcookie($k, $v, time()+9999, "/admin/add-release.php");
        }

        $artist_id = htmlspecialchars($artist_id);

        $title = htmlspecialchars($title);
        $title = trim($title);

        $multi_link = htmlspecialchars($multi_link);
        $multi_link = trim($multi_link);

        if($title === "" || $multi_link === "")
        {
            $_SESSION["error_message"] = "Заполните все поля";
            header("location:/admin/add-release.php");
            die();

        } elseif($cover["name"] === "")
        {
            $_SESSION["error_message"] = "Прикреите обложку";
            header("location:/admin/add-release.php");
            die();
        }

        if($cover["type"] !== "image/png" && $cover["type"] !== "image/jpg" && $cover["type"] !== "image/jpeg")
        {
            $_SESSION["error_message"] = "Допускаются изображения только формата PNG, JPG, JPEG";
            header("location:/admin/add-release.php");
            die();
        }

        $path = "/storage/covers/" . time() . "_" . $cover["name"];

        if(!move_uploaded_file($cover["tmp_name"], "../".$path))
        {
            $_SESSION["error_message"] = "Ошибка при загрузки обложки, перезагрузите страницу";
            header("location:/admin/add-release.php");
            die(); 
        }

        $sql = "INSERT INTO `releases` (`artist_id`, `title`, `multi-link`, `cover`) 
                VALUES ('$artist_id', '$title', '$multi_link', '$path')";
        
        $db = self::db();

        $query = mysqli_query($db, $sql);

        return $query ? mysqli_insert_id($db) : false;
    }

    public static function get()
    {
        $sql = "SELECT * FROM `releases` ORDER BY `id` DESC";
        $query = mysqli_query(self::db(), $sql);

        return $query;
    }

    //для главной страницы
    public static function get_()
    {
        $sql = "SELECT * FROM `releases` WHERE `public` = 1 ORDER BY `id` DESC LIMIT 10";
        $query = mysqli_query(self::db(), $sql);

        return $query;
    }

    public static function get_one($id)
    {
        $id = htmlspecialchars($id);

        $sql = "SELECT * FROM `releases` WHERE `id` = '$id'";
        $query = mysqli_query(self::db(), $sql);

        return mysqli_fetch_assoc($query);
    }

    public static function check($id)
    {
        $id = htmlspecialchars($id);

        $sql = "SELECT * FROM `releases` WHERE `id` = '$id'";
        $query = mysqli_query(self::db(), $sql);

        return mysqli_num_rows($query) > 0;
    }

    public static function public($id)
    {
        $id = htmlspecialchars($id);

        if(!self::check($id))
        {
            $_SESSION["no_page"] = "Запрашиваемый релиз не найден";
            header("location:/admin/releases.php");
            die();
        }

        $public = self::get_one($id);
        $public = (int)$public["public"] === 1 ? 0 : 1;

        $sql = "UPDATE `releases` SET `public` = '$public' WHERE `id` = '$id'";
        $query = mysqli_query(self::db(), $sql);

        return $query ? true : false;
    }

    public static function delete($id)
    {
        $id = htmlspecialchars($id);

        if(!self::check($id))
        {
            $_SESSION["no_page"] = "Запрашиваемый релиз не найден";
            header("location:/admin/releases.php");
            die();
        }

        $cover = self::get_one($id);

        if(!unlink("../".$cover["cover"]))
        {
            $_SESSION["error_message"] = "Ошибка при удалении";
            header("location:/admin/releases.php");
            die();
        }

        $sql = "DELETE FROM `releases` WHERE `id` = '$id'";
        
        if(mysqli_query(self::db(), $sql))
        {
            header("location:/admin/releases.php");
            die();

        } else {
            $_SESSION["error_message"] = "Ошибка при удалении";
            header("location:/admin/releases.php");
            die();
        }
    }

    public static function update($post, $artist_id, $title, $multi_link, $cover, $old_cover, $id)
    {
        foreach($post as $k => $v)
        {
            setcookie($k, $v, time()+9999, "/admin/update-release.php");
        }

        $artist_id = htmlspecialchars($artist_id);
        $old_cover = htmlspecialchars($old_cover);
        $id = htmlspecialchars($id);

        $title = htmlspecialchars($title);
        $title = trim($title);

        $multi_link = htmlspecialchars($multi_link);
        $multi_link = trim($multi_link);

        $new_cover = false;
        $path = "";

        if($title === "" || $multi_link === "")
        {
            $_SESSION["error_message"] = "Пожалуйста, не оставляйте поля пустыми";
            header("location:/admin/update-release.php?id=".$id);
            die();
        }

        if($cover["name"])
        {
            if($cover["type"] !== "image/png" && $cover["type"] !== "image/jpg" && $cover["type"] !== "image/jpeg")
            {
                $_SESSION["error_message"] = "Допускаются изображения только формата PNG, JPG, JPEG";
                header("location:/admin/update-release.php?id=".$id);
                die(); 
            }

            $new_cover = true;
            
            $path = "/storage/covers/" . time() . "_" . $cover["name"];

            if(!move_uploaded_file($cover["tmp_name"], "../".$path))
            {
                $_SESSION["error_message"] = "Пожалуйста, не оставляйте поля пустыми";
                header("location:/admin/update-release.php?id=".$id);
                die(); 
            }

            if(!unlink("../".$old_cover))
            {
                $_SESSION["error_message"] = "Ошибка при обновлении изображения, перезагрузите страницу";
                header("location:/admin/update-release.php?id=".$id);
                die();  
            }
        }

        if(!$new_cover)
        {
            $path = $old_cover;
        }

        $sql = "UPDATE `releases` SET `artist_id` = '$artist_id', `title` = '$title', `multi-link` = '$multi_link', `cover` = '$path' WHERE `id` = '$id'";
        $query = mysqli_query(self::db(), $sql);

        return $query ? true : false;
    }
}