<?php
session_start();
require(__DIR__ . "/nav.php");

echo 'You have successfully logged out,  '.implode(" ", $_SESSION['user']);
?>
