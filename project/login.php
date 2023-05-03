<?php
require(__DIR__ . "/nav.php");
session_start();
?>
<script>
    console.log("test")
</script>
<form onsubmit="return validate(this)" id="frm1" method="POST">
    <div>
        <label for="email">Email</label><br>
        <input type="email" name="email"  />
    </div>
    <div>
        <label for="username">Username</label><br>
        <input type="text" name="username"  />
    </div>
    <div>
        <label for="pw">Password</label><br>
        <input type="password" id="pw" name="password" required minlength="8" />
    </div>
    <input type="submit" value="Login" />
    <p id="msg"></p>
</form>
<script>
    function validate(form) {
        //TODO 1: implement JavaScript validation
        //ensure it returns false for an error and true for success
        var x = document.getElementById("frm1");
        var email = x.elements[0].value;
        var user = x.elements[1].value;
        var password = x.elements[2].value;
        //console.log(user)
        //console.log(email)
        //check if email field has input
        if (!email && !user){
            console.log("im here")
            document.getElementById("msg").innerHTML="Enter a Username or Email"

            return false
        }

        return true;
    }
</script>
<?php
//TODO 2: add PHP Code
if (!empty($_POST["email"])) {
    $email = se($_POST, "email", "", false);
    $password = se($_POST, "password", "", false);
    //echo "in if";
    //TODO 3
    $hasError = false;
    if (empty($email)) {
        echo "Email must not be empty";
        $hasError = true;
    }
    //sanitize
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    //validate
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email address";
        $hasError = true;
    }
    if (empty($password)) {
        echo "password must not be empty";
        $hasError = true;
    }
    if (strlen($password) < 8) {
        echo "Password too short";
        $hasError = true;
    }
    if (!$hasError) {
        //TODO 4
        $db = getDB();
        $sql = $db->query("SELECT * FROM Users WHERE username='$email'");
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        if($result){
            $cont=true;
        }
        else{
            echo "Email not found, please enter a valid username or email<br>(You entered: " . $email . ")<br>";
            $cont = false;
        }
        $stmt = $db->prepare("SELECT email, password from Users where email = :email");
        if($cont){
            try {
                $r = $stmt->execute([":email" => $email]);
                if ($r) {
                    $user = $stmt->fetch(PDO::FETCH_ASSOC);
                    if ($user) {
                        $hash = $user["password"];
                        unset($user["password"]);
                        if (password_verify($password, $hash)) {
                            echo "Weclome $email";
                            $_SESSION["user"] = $user;
                            die(header("Location: home.php"));
                        } 
                        else {
                            echo "Invalid password";
                        }
                    }
                }
            } catch (Exception $e) {
                echo "<pre>" . var_export($e, true) . "</pre>";
            }
        }
    }
}
else {
    $hasError=true;
    if(empty($_POST["username"])){}
    else{
        $user = $_POST["username"];
        $password = $_POST["password"];
        $hasError=false;
    }
    
    if (!$hasError) {
        //TODO 4
        $db = getDB();
        $sql = $db->query("SELECT * FROM Users WHERE username='$user'");
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        if($result){
            $_SESSION["user"] = $user;
            $cont=true;
        }
        else{
            echo "Username not found, please enter a valid username or email<br>(You entered: " . $user . ")<br>";
            $cont = false;
        }
        $stmt = $db->prepare("SELECT username, password from Users where username = :username");
        if($cont){
            try {
                $r = $stmt->execute([":username" => $user]);
                if ($r) {
                    $user = $stmt->fetch(PDO::FETCH_ASSOC);
                    if ($user) {
                        $hash = $user["password"];
                        unset($user["password"]);
                        if (password_verify($password, $hash)) {
                            echo "Weclome $email";
                            $_SESSION["user"] = $user;
                            die(header("Location: home.php"));
                        } else {
                            echo "Invalid password";
                        }
                    } else {
                        echo "User not found";
                    }
                }
            } catch (Exception $e) {
                echo "<pre>" . var_export($e, true) . "</pre>";
            }
        }
    }
}
?>