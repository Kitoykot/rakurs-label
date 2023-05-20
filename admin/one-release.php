<?php

session_start();
require_once __DIR__ . "/../vendor/autoload.php";

use App\Admin;
use App\Release;
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
            $release = Release::get_one($_GET["id"]);

            if(!Release::check($_GET["id"]))
            {
            ?>
                <div class="alert alert-light" role="alert">
                    Такой страницы не существует :(
                </div>  
            <?php
                die();
            }
        ?>
        
        <h5><?=Artist::get_one($release["artist_id"])["name"]?> - <?=$release["title"]?></h5>
        <img src="<?=$release["cover"]?>" width="400">
        <p class="mt-3">Мультиссылка (или любая другая, ведущая на стриминг_и): <a style="color: blue;" href="<?=$release["multi-link"]?>"><?=$release["multi-link"]?></a></p> 
    </div>
</body>
</html>