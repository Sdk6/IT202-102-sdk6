
<?php
    session_start();
    require(__DIR__ . "/nav.php");

?>
<!DOCTYPE html>
<html>
<body>
<script>
    let list = document.getElementById("navbar");
    let entry = document.createElement('li');
    //list.appendChild(entry);
    let a = document.createElement('a');
    let linkText = document.createTextNode("Change username");
    a.appendChild(linkText);
    a.title = "change username";
    a.href = "changeuser.php";
    entry.appendChild(a);
    list.appendChild(entry);
</script>
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