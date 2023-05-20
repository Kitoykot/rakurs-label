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
        <h4>Добавить релиз</h4>

        <form method="POST" action="/admin/add-release.php" enctype="multipart/form-data">
            <label class="mt-5" for="artist_id">Выберите артиста</label>
            <select class="form-control" name="artist_id">
                <?php
                    $artists = Artist::get();
                    
                    foreach($artists as $artist)
                    {
                    ?>
                        <option value="<?=$artist["id"]?>"><?=$artist["name"]?></option>
                    <?php
                    }
                ?>
            </select>

            <div class="form-group mt-3">
                <label for="title">Название релиза</label>
                <input type="text" class="form-control" name="title" value="<?=$_COOKIE["title"]?>">
            </div>

            <div class="form-group mt-3">
                <label for="multi-link">Мультиссылка (или любая другая, ведущая на стриминг)</label>
                <input type="text" class="form-control" name="multi-link" value="<?=$_COOKIE["multi-link"]?>">
            </div>
            
            <div class="form-group">
                <label for="cover">Обложка</label>
                <input type="file" class="form-control-file" name="cover">
            </div>
            <button type="submit" class="btn btn-success mt-2 mb-4" name="submit">Добавить</button>

            <?php    
                if(!is_null($_POST["submit"]))
                {
                    $create = Release::create($_POST,$_POST["artist_id"], $_POST["title"], $_POST["multi-link"], $_FILES["cover"]);

                    if($create)
                    {
                        setcookie("artist_id", "", time()-3600, "/admin/add-release.php");
                        setcookie("title", "", time()-3600, "/admin/add-release.php");
                        setcookie("multi-link", "", time()-3600, "/admin/add-release.php");

                        header("location:/admin/one-release.php?id=".$create);
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