<?php
require_once __DIR__ . "/vendor/autoload.php";

use App\General;

?>

<!DOCTYPE html>
<html>
<?php require_once "includes/head.php" ?>
<body>
<?php require_once "includes/header.php" ?>

	<main>
		<div class="container">
			<h3 class="mt-4"><b>/о нас/</b></h3>
            <p class="description mt-5"><?=General::get()["description"]?></p>
            <div class="contacts_img">
                <a href="<?=General::get()["vk-link"]?>" target="_blank"><img src="/assets/icons/vk.png"></a>
                <a href="<?=General::get()["tg-link"]?>" target="_blank"><img src="/assets/icons/tg.png"></a>
            </div>
		</div>
	</main>
</body>
</html>