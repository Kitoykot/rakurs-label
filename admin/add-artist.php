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
        <h4>Добавить артиста</h4>
        <form method="POST" action="/admin/add-artist.php" enctype="multipart/form-data">
            <div class="form-group mt-4">
              <label for="spoti-link">Название группы/исполнителя</label>
              <input type="text" class="form-control" name="name" value="<?=$_COOKIE["name"]?>">
            </div>

            <div class="form-group">
                <label for="spoti-link">Ссылка на Spotify</label>
                <input type="text" class="form-control" name="spoti-link" value="<?=$_COOKIE["spoti-link"]?>">
            </div>

            <div class="form-group">
                <label for="ym-link">Ссылка на Yandex Music</label>
                <input type="text" class="form-control" name="ym-link" value="<?=$_COOKIE["ym-link"]?>">
            </div>

            <div class="form-group">
                <label for="am-link">Ссылка на группу Apple Music</label>
                <input type="text" class="form-control" name="am-link" value="<?=$_COOKIE["am-link"]?>">
            </div>

            <div class="form-group">
                <label for="vk-link">Ссылка на группу VK</label>
                <input type="text" class="form-control" name="vk-link" value="<?=$_COOKIE["vk-link"]?>">
            </div>

            <div class="form-group">
                <label for="image">Фото группы/исполнителя</label>
                <input type="file" class="form-control-file" name="image">
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Добавить</button>

            <?php

                if(!is_null($_POST["submit"]))
                {
                    $create = Artist::create($_POST, $_POST["name"], $_POST["spoti-link"], $_POST["ym-link"],
                                            $_POST["am-link"], $_POST["vk-link"], $_FILES["image"]);
                    
                    if($create)
                    {
                        setcookie("name", "", time()-3600, "/admin/add-artist.php");
                        setcookie("spoti-link", "", time()-3600, "/admin/add-artist.php");
                        setcookie("ym-link", "", time()-3600, "/admin/add-artist.php");
                        setcookie("am-link", "", time()-3600, "/admin/add-artist.php");
                        setcookie("vk-link", "", time()-3600, "/admin/add-artist.php");

                        header("location:/admin/one-artist.php?id=".$create);
                        die();

                    } else {
                    ?>
                        <div class="alert alert-info mt-4" role="alert">
                            Ошибка, перезагрузите страницу
                        </div>                    
                    <?php
                    }
                }
                
                if($_SESSION["error_message"])
                {
                ?>
                    <div class="alert alert-info mt-4" role="alert">
                        <?=$_SESSION["error_message"]?>
                    </div>
                <?php
                    unset($_SESSION["error_message"]);
                }
                ?>
          </form>
    </div>
</body>
</html>