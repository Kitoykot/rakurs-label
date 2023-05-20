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
        <a style="color: rgb(64, 137, 190)" href="add-artist.php">+Добавить артиста</a>

        <?php
        if($_SESSION["no_page"])
        {
        ?>
            <div class="alert alert-info mt-4" role="alert">
                <?=$_SESSION["no_page"]?>
            </div>
        <?php
            unset($_SESSION["no_page"]);
        }
        
            $artists = Artist::get();
            
            foreach($artists as $artist)
            {
            ?>
                <ul class="list-group mt-3">
                    <a href="one-artist.php?id=<?=$artist["id"]?>" class="list-group-item list-group-item-action">
                        <b><?=$artist["name"]?></b>

                        <form method="POST" action="/admin/artists.php" style="float: right;">
                            <input type="hidden" value="<?=$artist["id"]?>" name="id">
                            <button class="btn btn-danger" type="submit" name="delete_<?=$artist["id"]?>">Удалить</button>
                            <?php
                                if(!is_null($_POST["delete_".$artist["id"]]))
                                {
                                    Artist::delete($_POST["id"]);
                                }
                            ?>
                        </form>

                        <form style="float: right; padding-right: 10px;" method="POST" action="/admin/update-artist.php?id=<?=$artist["id"]?>">
                            <button class="btn btn-success">Изменить</button>
                        </form>

                        <form method="POST" action="/admin/artists.php" style="float: right; padding-right: 10px;">
                            <input type="hidden" value="<?=$artist["id"]?>" name="id">
                            <button class="btn btn-<?=(int)$artist["public"] === 1 ? "warning" : "primary"?>" 
                                    type="submit" name="public_<?=$artist["id"]?>">
                                    <?=(int)$artist["public"] === 1 ? "Снять с публикации" : "Опубликовать"?>
                            </button>

                            <?php
                                if(!is_null($_POST["public_".$artist["id"]]))
                                {
                                    $public = Artist::public($_POST["id"]);

                                    if($public)
                                    {
                                        header("location:/admin/artists.php");
                                        die();

                                    } else {
                                    ?>
                                        <div class="alert alert-info mt-4" role="alert">
                                            Ошибка
                                        </div>
                                    <?php
                                    }
                                }
                            ?>
                        </form>
                    </a>
                </ul>
            <?php
            }
        ?>
    </div>
</body>

</html>