<?php 
include __DIR__ . "/../config.php";
include __DIR__ . "/../session.php";

$_SESSION["guessNumber"] = $_POST["guessNumber"] ?? null;
$_SESSION["guess"] = $_POST["guess"] ?? null;
$_SESSION["reset"] = $_POST["reset"] ?? null;
$_SESSION["cheat"] = $_POST["cheat"] ?? null;

header("Location: ../index.php");
