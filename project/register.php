<?php
require(__DIR__ . "/nav.php");
$dev= True;

?>
<style>


</style>
<form id ="frm1" onsubmit="return validate(this)" method="POST">
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
        var x = document.getElementById("frm1");
        var text = "";
        var email = x.elements[0].value
        var username = x.elements[1].value
        var pass = x.elements[2].value
        var confirm = x.elements[3].value
        text = `email: ${email}\nuser: ${username}\npass: ${pass}\npass confirm: ${confirm}`
        //console.log(text);
        if (pass === confirm){
        }
        else{
            document.getElementById("msg").innerText="Passwords do not match, please try again.";
            console.log(`pass: ${pass}\nconfirm: ${confirm}`);
            return false;
        }
        
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
    echo 'email: ' . $email . "<br>password: " . $password . "<br>username: " . $username . "<br>";
    $hasError=false;
 }

 if(!$hasError){
    $cont=true;
    $hash=password_hash($password, PASSWORD_BCRYPT);
    $db= getDB();
    $sql = $db->query("SELECT * FROM Users WHERE username='$username'");
    $result = $sql->fetch(PDO::FETCH_ASSOC);
    if($result){
        echo "username taken please try again<br>";
        $cont=false;
    }

    $sql = $db->query("SELECT * FROM Users WHERE email='$email'");
    $result = $sql->fetch(PDO::FETCH_ASSOC);
    if($result){
        echo "email in use please try again<br>";
        $cont = false;
    }
    if($cont){
        //test before going further
        $stmt = $db->prepare("INSERT INTO Users(email, password, username) VALUES(:email, :password, :username)");
        try{
            $r= $stmt->execute([":email" => $email, ":password" => $hash, ":username" => $username]);
            echo "Successfully register!";
        }catch(Exception $e){
            echo "There was an error registering<br>";
            //echo "<pre>" . var_export($e, true) . "</pre>";
        }
    }
 }
 session_start();
 $_SESSION["favcolor"] = "green";
 echo session_id();
?>
<p id="msg"></p>