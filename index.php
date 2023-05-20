<?php
require_once __DIR__ . "/vendor/autoload.php";

use App\Release;
use App\Artist;

?>

<!DOCTYPE html>
<html>
<?php require_once "includes/head.php" ?>
<body>
<?php require_once "includes/header.php" ?>

	<main>
		<div class="container">
			<h3 class="mt-4"><b>/свежие релизы/</b></h3>
			<?php
				$releases = Release::get_();

				foreach($releases as $release)
				{
				?>
					<div class="releases mt-3">
						<div class="releas mt-3">
							<p><?=Artist::get_one($release["artist_id"])["name"]?> - <?=$release["title"]?></p>
							<img src="<?=$release["cover"]?>" width="450">
							<p class="mt-1"><a href="<?=$release["multi-link"]?>" target="_blank">СЛУШАТЬ</a></p>
						</div>
					</div>
				<?php
				}
			?>
		</div>
	</main>
</body>
</html>