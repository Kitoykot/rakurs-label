<?php

session_start();
require_once __DIR__ . "/../vendor/autoload.php";

use App\Admin;
use App\Artist;
use App\Release;

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
            if(!Release::check($_GET["id"]))
            {
            ?>
                <div class="alert alert-light" role="alert">
                    Такой страницы не существует :(
                </div> 
            <?php
            }

            $release = Release::get_one($_GET["id"]);
        ?>
        <h4>Обновить релиз артиста <?=Artist::get_one($release["artist_id"])["name"]?></h4>

        <form method="POST" action="/admin/update-release.php?id=<?=$release["id"]?>" enctype="multipart/form-data">
            <input type="hidden" value="<?=$release["cover"]?>" name="old_cover">
            <input type="hidden" value="<?=$release["id"]?>" name="id">

            <label class="mt-5" for="artist_id">Выберите артиста</label>
            <select class="form-control" name="artist_id">
                <option value="<?=Artist::get_one($release["artist_id"])["id"]?>">
                    <?=Artist::get_one($release["artist_id"])["name"]?>
                </option>
                <?php
                    $artists = Artist::get();

                    foreach($artists as $artist)
                    {
                        if(Artist::get_one($release["artist_id"])["name"] !== $artist["name"])
                        {
                        ?>
                            <option value="<?=$artist["id"]?>">
                                <?=$artist["name"]?>
                            </option>
                        <?php
                        }
                    }
                ?>
            </select>

            <div class="form-group mt-3">
                <label for="title">Название релиза</label>
                <input type="text" class="form-control" name="title" value="<?=$_COOKIE["title"] ? $_COOKIE["title"] : $release["title"]?>">
            </div>

            <div class="form-group mt-3">
                <label for="multi-link">Мультиссылка (или любая другая, ведущая на стриминг)</label>
                <input type="text" class="form-control" name="multi-link" value="<?=$_COOKIE["multi-link"] ? $_COOKIE["multi-link"] : $release["multi-link"]?>">
            </div>
            
            <div class="form-group">
                <label for="cover">Обложка</label>
                <br>
                <img src="<?=$release["cover"]?>" width="300">
                <br><br>
                <input type="file" class="form-control-file" name="cover">
            </div>
            <button type="submit" class="btn btn-success mt-2 mb-4" name="submit">Обновить</button>

            <?php    
                if(!is_null($_POST["submit"]))
                {
                    $update = Release::update($_POST, $_POST["artist_id"], $_POST["title"], $_POST["multi-link"], $_FILES["cover"], $_POST["old_cover"], $_POST["id"]);

                    if($update)
                    {
                        setcookie("artist_id", "", time()-3600, "/admin/update-release.php");
                        setcookie("title", "", time()-3600, "/admin/update-release.php");
                        setcookie("multi-link", "", time()-3600, "/admin/update-release.php");
                        setcookie("old_cover", "", time()-3600, "/admin/update-release.php");
                        setcookie("id", "", time()-3600, "/admin/update-release.php");

                        header("location:/admin/one-release.php?id=".$release["id"]);
                        die();

                    } else {
                    ?>
                        <div class="alert alert-info" role="alert">
                            Ошибка, перезагрузите страницу и попробуйте ещё раз
                        </div>
                    <?php
                    }
                }

                if($_SESSION["error_message"])
                {
                ?>
                <div class="alert alert-info" role="alert">
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