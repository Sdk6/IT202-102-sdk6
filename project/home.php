
<?php
    session_start();
    require(__DIR__ . "/nav.php");

?>
<!DOCTYPE html>
<html>
<body>

<?php
// Echo session variables that were set on previous page
echo 'Welcome '.implode(" ", $_SESSION['user']);
?>

</body>
</html>