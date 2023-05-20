<?php

namespace App;
session_start();

class Artist extends Connect
{
    public static function create($post, $name, $spoti_link, $ym_link, $am_link, $vk_link, $image)
    {
        foreach($post as $k => $v)
        {
            setcookie($k, $v, time()+9999, "/admin/add-artist.php");
        }

        $name = htmlspecialchars($name);
        $name = trim($name);

        $spoti_link = htmlspecialchars($spoti_link);
        $spoti_link = trim($spoti_link);

        $ym_link = htmlspecialchars($ym_link);
        $ym_link = trim($ym_link);

        $am_link = htmlspecialchars($am_link);
        $am_link = trim($am_link);

        $vk_link = htmlspecialchars($vk_link);
        $vk_link = trim($vk_link);

        if($name === "" || $spoti_link === "" || $ym_link === "" ||
            $am_link === "" || $vk_link === "")
        {
            $_SESSION["error_message"] = "Пожалуйста, заполните все поля";
            header("location:/admin/add-artist.php");
            die();

        } elseif ($image["name"] === "")
        {
            $_SESSION["error_message"] = "Пожалуйста, прикрепите фото артиста";
            header("location:/admin/add-artist.php");
            die();

        } elseif ($image["type"] !== "image/png" && $image["type"] !== "image/jpeg" && $image["type"] !== "image/jpg")
        {
            $_SESSION["error_message"] = "Допускаются изображения только формата PNG, JPG, JPEG";
            header("location:/admin/add-artist.php");
            die();
        }

        $path = "/storage/images/" . time() . "_" . $image["name"];

        if(move_uploaded_file($image["tmp_name"], "../" . $path))
        {
            $sql = "INSERT INTO `artists` (`name`, `spoti-link`, `ym-link`, `am-link`, `vk-link`, `image`) 
                    VALUES ('$name', '$spoti_link', '$ym_link', '$am_link', '$vk_link', '$path')";
            
            $db = self::db();

            $query = mysqli_query($db, $sql);

        } else {

            $_SESSION["error_message"] = "Ошибка при загрузки изображения";
            header("location:/admin/add-artist.php");
            die();
        }

        return $query ? mysqli_insert_id($db) : false;
    }

    public static function get()
    {
        $sql = "SELECT * FROM `artists` ORDER BY `name`";
        $query = mysqli_query(self::db(), $sql);

        return $query;
    }

    public static function get_()
    {
        $sql = "SELECT * FROM `artists` WHERE `public` = 1 ORDER BY RAND()";
        $query = mysqli_query(self::db(), $sql);

        return $query;
    }

    public static function get_one($id)
    {
        $id = htmlspecialchars($id);

        $sql = "SELECT * FROM `artists` WHERE `id` = '$id'";
        $query = mysqli_query(self::db(), $sql);

        return mysqli_fetch_assoc($query);
    }

    public static function check($id)
    {
        $id = htmlspecialchars($id);

        $sql = "SELECT * FROM `artists` WHERE `id` = '$id'";
        $query = mysqli_query(self::db(), $sql);

        return mysqli_num_rows($query) > 0;
    }

    public static function delete($id)
    {
        $id = htmlspecialchars($id);        
        
        if(!self::check($id))
        {
            $_SESSION["no_page"] = "Запрашиваемый артист не найден";
            header("location:/admin/artists.php");
            die();
        }

        $image = self::get_one($id);

        if(!unlink("../" . $image["image"]))
        {
            $_SESSION["error_message"] = "Ошибка при удалении";
            header("location:/admin/artists.php");
            die();
        }

        $sql = "DELETE FROM `artists` WHERE `id` = '$id'";
        $query = mysqli_query(self::db(), $sql);

        if($query)
        {          
            header("location:/admin/artists.php");
            die(); 

        } else {

            $_SESSION["error_message"] = "Ошибка при удалении";
            header("location:/admin/artists.php");
            die(); 
        }
    }

    public static function public($id)
    {
        $id = htmlspecialchars($id);        
        
        if(!self::check($id))
        {
            $_SESSION["no_page"] = "Запрашиваемый артист не найден";
            header("location:/admin/artists.php");
            die();
        }

        $public = self::get_one($id);
        $public = (int)$public["public"] === 1 ? 0 : 1;

        $sql = "UPDATE `artists` SET `public` = '$public' WHERE `id` = '$id'";
        $query = mysqli_query(self::db(), $sql);

        return $query ? true : false;
    }

    public static function update($post, $name, $spoti_link, $ym_link, $am_link, $vk_link, $image, $old_image, $id)
    {
        foreach($post as $k => $v)
        {
            setcookie($k, $v, time()+9999, "/admin/update-artist.php");
        }

        $name = htmlspecialchars($name);
        $name = trim($name);

        $spoti_link = htmlspecialchars($spoti_link);
        $spoti_link = trim($spoti_link);

        $ym_link = htmlspecialchars($ym_link);
        $ym_link = trim($ym_link);

        $am_link = htmlspecialchars($am_link);
        $am_link = trim($am_link);

        $vk_link = htmlspecialchars($vk_link);
        $vk_link = trim($vk_link);

        $new_image = false;
        $path = "";
        $old_image = htmlspecialchars($old_image);

        $id = htmlspecialchars($id);

        if($name === "" || $spoti_link === "" || $ym_link === "" ||
            $am_link === "" || $vk_link === "")
        {
            $_SESSION["error_message"] = "Пустые значения не допускаются";
            header("location:/admin/update-artist.php?id=".$id);
            die();
        }

        if($image["name"])
        {
            $new_image = true;

            if($image["type"] !== "image/png" && $image["type"] !== "image/jpg" && $image["type"] !== "image/jpeg")
            {
                $_SESSION["error_message"] = "Допускаются изображения только формата PNG, JPG, JPEG";
                header("location:/admin/update-artist.php?id=".$id);
                die();                
            }

            $path = "/storage/images/" . time() . "_" . $image["name"];

            if(move_uploaded_file($image["tmp_name"], "../" . $path))
            {
                if(!unlink("../" . $old_image))
                {
                    $_SESSION["error_message"] = "Ошибка при удалении";
                    header("location:/admin/artists.php");
                    die();
                }

            } else {

                $_SESSION["error_message"] = "Ошибка при обновлении изображения";
                header("location:/admin/update-artist.php?id=".$id);
                die(); 
            }
        }

        if(!$new_image)
        {
            $path = $old_image;
        }

        $sql = "UPDATE `artists` SET `name` = '$name', `spoti-link` = '$spoti_link', `ym-link` = '$ym_link', `am-link` = '$am_link', `vk-link` = '$vk_link', `image` = '$path' WHERE `id` = '$id'";

        $query = mysqli_query(self::db(), $sql);

        return $query ? true : false;
    }
}