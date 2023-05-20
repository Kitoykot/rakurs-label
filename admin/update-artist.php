<?php

session_start();
require_once __DIR__ . "/../vendor/autoload.php";

use App\Admin;
use App\Artist;

if(!Admin::check($_SESSION["id"]))
{
    header("location:/admin/");
    die();
}

?>

<!DOCTYPE html>
<html lang="en">
<?php require_once "includes/head.php" ?>
<body>
<?php require_once "includes/header.php" ?>

    <div class="container mt-5">
        <?php
            if(!Artist::check($_GET["id"]))
            {
            ?>
                <div class="alert alert-light" role="alert">
                    Такой страницы не существует :(
                </div> 
            <?php
                die();
            }

            $artist = Artist::get_one($_GET["id"]);
        ?>
        <h4>Обновить данные артиста</h4>
        <form method="POST" action="/admin/update-artist.php?id=<?=$artist["id"]?>" enctype="multipart/form-data">
            <input type="hidden" value="<?=$artist["image"]?>" name="old-image">
            <input type="hidden" value="<?=$artist["id"]?>" name="id">
            <?php        
                if($_SESSION["error_message"])
                {
                ?>
                    <div class="alert alert-info mt-2" role="alert">
                        <?=$_SESSION["error_message"]?>
                    </div>
                <?php
                    unset($_SESSION["error_message"]);
                }
            ?>
            <div class="form-group mt-3">
              <label for="spoti-link">Название группы/исполнителя</label>
              <input type="text" class="form-control" name="name" value="<?= $_COOKIE["name"] ? $_COOKIE["name"] : $artist["name"]?>">
            </div>

            <div class="form-group">
                <label for="spoti-link">Ссылка на Spotify</label>
                <input type="text" class="form-control" name="spoti-link" value="<?= $_COOKIE["spoti-link"] ? $_COOKIE["spoti-link"] : $artist["spoti-link"]?>">
            </div>

            <div class="form-group">
                <label for="ym-link">Ссылка на Yandex Music</label>
                <input type="text" class="form-control" name="ym-link" value="<?= $_COOKIE["ym-link"] ? $_COOKIE["ym-link"] : $artist["ym-link"]?>">
            </div>

            <div class="form-group">
                <label for="am-link">Ссылка на группу Apple Music</label>
                <input type="text" class="form-control" name="am-link" value="<?= $_COOKIE["am-link"] ? $_COOKIE["am-link"] : $artist["am-link"]?>">
            </div>

            <div class="form-group">
                <label for="vk-link">Ссылка на группу VK</label>
                <input type="text" class="form-control" name="vk-link" value="<?= $_COOKIE["vk-link"] ? $_COOKIE["vk-link"] : $artist["vk-link"]?>">
            </div>

            <div class="form-group">
                <label for="image">Фото группы/исполнителя</label>
                <br>
                <img src="<?=$artist["image"]?>" width="300">
                <br><br>
                <input type="file" class="form-control-file" name="image">
            </div>
            <button type="submit" class="btn btn-primary mb-5" name="submit">Обновить</button>

            <?php

                if(!is_null($_POST["submit"]))
                {
                    $create = Artist::update($_POST, $_POST["name"], $_POST["spoti-link"], $_POST["ym-link"], $_POST["am-link"],
                                            $_POST["vk-link"], $_FILES["image"], $_POST["old-image"], $_POST["id"]);
                    
                    if($create)
                    {
                        setcookie("name", "", time()-3600, "/admin/update-artist.php");
                        setcookie("spoti-link", "", time()-3600, "/admin/update-artist.php");
                        setcookie("ym-link", "", time()-3600, "/admin/update-artist.php");
                        setcookie("am-link", "", time()-3600, "/admin/update-artist.php");
                        setcookie("vk-link", "", time()-3600, "/admin/update-artist.php");
                        setcookie("id", "", time()-3600, "/admin/update-artist.php");
                        setcookie("old-image", "", time()-3600, "/admin/update-artist.php");

                        header("location:/admin/one-artist.php?id=".$_GET["id"]);
                        die();

                    } else {
                    ?>
                        <div class="alert alert-info" role="alert">
                            Ошибка, перезагрузите страницу
                        </div>                    
                    <?php
                    }
                }
                ?>
          </form>
    </div>
</body>
</html>