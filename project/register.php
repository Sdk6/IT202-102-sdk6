<?php
require(__DIR__ . "/nav.php");
$dev= True;

?>
<style>


</style>
<form onsubmit="return validate(this)" method="POST">
    <div>
        <label for="email">Email</label>
        <input type="email" name="email" required />
    </div>
    <div>
        <label for="username">username</label>
        <input name="username" required />
    </div>
    <div>
        <label for="pw">Password</label>
        <input type="password" id="pw" name="password" required minlength="8" />
    </div>
    <div>
        <label for="confirm">Confirm</label>
        <input type="password" name="confirm" required minlength="8" />
    </div>
    <input type="submit" value="Register" />
</form>
<script>
    function validate(form) {
        //TODO 1: implement JavaScript validation
        //ensure it returns false for an error and true for success

        return true;
    }
</script>
<?php
$hasError=true;
 //TODO 2: add PHP Code
 if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirm']) && isset($_POST['username'])){

    if($_POST['password']==$_POST['confirm'])
    $email= $_POST['email'];
    $password= $_POST['password'];
    $confirm= $_POST['confirm'];
    $username= $_POST['username'];
    echo $email . ' ' . $password;
    $hasError=false;
 }

 if(!$hasError){
    $hash=password_hash($password, PASSWORD_BCRYPT);
    $db= getDB();
    //test before going further
    $stmt = $db->prepare("INSERT INTO Users(email, password, username) VALUES(:email, :password, :username)");
    try{
        $r= $stmt->execute([":email" => $email, ":password" => $hash, ":username" => $username]);
        echo "Successfully register!";
    }catch(Exception $e){
        echo "There was an error registering<br>";
        echo "<pre>" . var_export($e, true) . "</pre>";
    }
 }

 session_start();
 $_SESSION["favcolor"] = "green";
 echo session_id();
?>