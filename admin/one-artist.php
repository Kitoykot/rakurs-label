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
<?php require_once "includes/header.php"; $artist = Artist::get_one($_GET["id"]);?>

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
        ?>
        <h5><?=$artist["name"]?></h5>
        <img src="<?=$artist["image"]?>" width="400">
        <p class="mt-3">Ссылка на группу VK: <a style="color: blue;" href="<?=$artist["vk-link"]?>"><?=$artist["vk-link"]?></a></p>
        <p class="mt-3">Ссылка на Spotify: <a style="color: blue;" href="<?=$artist["spoti-link"]?>"><?=$artist["spoti-link"]?></a></p>
        <p class="mt-3">Ссылка на Yandex Music: <a style="color: blue;" href="<?=$artist["ym-link"]?>"><?=$artist["ym-link"]?></a></p>
        <p class="mt-3">Ссылка на Apple Music: <a style="color: blue;" href="<?=$artist["am-link"]?>"><?=$artist["am-link"]?></a></p> 
    </div>
</body>
</html>