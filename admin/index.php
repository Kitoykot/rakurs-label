<?php

session_start();
require_once __DIR__ . "/../vendor/autoload.php";
use App\Admin;

if(Admin::check($_SESSION["id"]))
{
    header("location:/admin/general.php");
    die();
}

?>

<!DOCTYPE html>
<html lang="en">
<?php require_once "includes/head.php" ?>

<body>
    <div class="container mt-5">
        <div class="login">

            <form method="POST" action="/admin/">
                <h3 class="mt-5">Вход в панель администратора</h3>

                <div class="form-group">
                    <label for="login">Логин</label>
                    <input type="text" class="form-control" name="login" value="<?=$_COOKIE["login"]?>">
                </div>

                <div class="form-group">
                    <label for="password">Пароль</label>
                    <input type="password" class="form-control" name="password">
                </div>

                <button type="submit" class="btn btn-primary" name="submit">Войти</button>
                <?php
                    if(!is_null($_POST["submit"]))
                    {
                        $login = Admin::login($_POST["login"], $_POST["password"]);

                        if($login)
                        {
                            setcookie("login", "", time()-3600, "/admin/");
                            header("location:/admin/general.php");
                            die();

                        } else {
                        ?>
                            <div class="alert alert-danger mt-4" role="alert">
                                Ошибка авторизации, попробуйте перезагрузить страницу
                            </div>
                        <?php
                        }
                    }

                    if($_SESSION["error_message"])
                    {
                    ?>
                        <div class="alert alert-danger mt-4" role="alert">
                            <?=$_SESSION["error_message"]?>
                        </div>
                    <?php
                        unset($_SESSION["error_message"]);
                    }
                ?>
            </form>

        </div>
    </div>
</body>

</html>