<?php
require_once __DIR__ . "/vendor/autoload.php";

use App\Artist;

?>

<!DOCTYPE html>
<html>
<?php require_once "includes/head.php" ?>
<body>
<?php require_once "includes/header.php" ?>

	<main>
		<div class="container">
			<h3 class="mt-4"><b>/наши артисты/</b></h3>

            <div class="artists">
                <?php
                    $artists = Artist::get_();

                    foreach($artists as $artist)
                    {
                    ?>
                        <div class="artist">
                            <p><a href="<?=$artist["vk-link"]?>" target="_blank"><?=$artist["name"]?></a></p>
                            <img src="<?=$artist["image"]?>" width="200">
                            <div class="streams mt-2">
                                <a href="<?=$artist["spoti-link"]?>" target="_blank"><img src="/assets/icons/spotify.png"></a>
                                <a href="<?=$artist["ym-link"]?>" target="_blank"><img src="/assets/icons/yandex.png"></a>
                                <a href="<?=$artist["am-link"]?>" target="_blank"><img src="/assets/icons/apple-music.png"></a>
                            </div>
                        </div>
                    <?php
                    }
                ?>
            </div>
		</div>
	</main>
</body>
</html>