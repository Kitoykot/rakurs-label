<?php

require_once __DIR__ . "/../../vendor/autoload.php";
use App\Admin;

session_start();
    Admin::logout($_SESSION["id"]);
session_destroy();

header("location:/admin/");