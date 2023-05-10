<?php
session_start();
require(__DIR__ . "/nav.php");
if(isset($_SESSION["user"])){
    echo 'You have successfully logged out,  '.implode(" ", $_SESSION['user']);
    unset($_SESSION["user"]);
}
else{
    echo "You are not logged in!";
}

?>
