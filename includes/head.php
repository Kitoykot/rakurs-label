<?php
require_once __DIR__ . "/../vendor/autoload.php";

use App\General;

?>
<head>
	<meta name="viewport" content="width=device-width">
	<meta charset="utf-8">
	<title><?=General::get()["title"]?></title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="/assets/css/styles.css">
</head>