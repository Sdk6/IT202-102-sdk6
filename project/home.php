
<?php
    session_start();
    require(__DIR__ . "/nav.php");

?>
<!DOCTYPE html>
<html>
<body>

<?php
// Echo session variables that were set on previous page
if(isset($_SESSION["user"])){
    echo 'Welcome '.implode(" ", $_SESSION['user']);
}
else{
    echo "You do not have permission to access this page";
};

?>

</body>
</html>