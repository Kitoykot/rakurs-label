<?php

session_start();
require_once __DIR__ . "/../vendor/autoload.php";
use App\Admin;
use App\General;

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
                $general = General::get();
            ?>
        <form method="POST" action="/admin/general.php">
            <div class="form-group">
              <label for="title">Название сайта</label>
              <input type="text" class="form-control" name="title" value="<?= $_COOKIE["title"] ? $_COOKIE["title"] : $general["title"]?>">
            </div>

            <div class="form-group">
                <label for="description">Раздел "О нас"</label>
                <textarea class="form-control" name="description" rows="10"><?=$_COOKIE["description"] ? $_COOKIE["description"] : $general["description"]?></textarea>
            </div>

            <div class="form-group">
                <label for="vk-link">Ссылка на группу VK</label>
                <input type="text" class="form-control" name="vk-link" value="<?=$_COOKIE["vk-link"] ? $_COOKIE["vk-link"] : $general["vk-link"]?>">
            </div>

            <div class="form-group">
                <label for="tg-link">Ссылка на Телеграм-канал</label>
                <input type="text" class="form-control" name="tg-link" value="<?=$_COOKIE["tg-link"] ? $_COOKIE["tg-link"] : $general["tg-link"]?>">
            </div>

            <div class="form-group">
                <label for="tap-link">Ссылка на Таплинк</label>
                <input type="text" class="form-control" name="tap-link" value="<?=$_COOKIE["tap-link"] ? $_COOKIE["tap-link"] : $general["tap-link"]?>">
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Сохранить</button>
            
            <?php
                if(!is_null($_POST["submit"]))
                {
                    $update = General::update($_POST, $_POST["title"], $_POST["description"], $_POST["vk-link"],
                                            $_POST["tg-link"], $_POST["tap-link"]);
                    if($update)
                    {
                        setcookie("title", "", time()-3600, "/admin/general.php");
                        setcookie("description", "", time()-3600, "/admin/general.php");
                        setcookie("vk-link", "", time()-3600, "/admin/general.php");
                        setcookie("tg-link", "", time()-3600, "/admin/general.php");
                        setcookie("tap-link", "", time()-3600, "/admin/general.php");

                        header("location:/admin/general.php");
                        die();

                    } else {
                    ?>
                        <div class="alert alert-info mt-4" role="alert">
                            Ошибка при сохранении настроек. Попробуйте перезагрузить страницу
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