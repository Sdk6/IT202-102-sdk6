<?php
    session_start();
    require(__DIR__ . "/nav.php");

?>
<style>
    div {
        margin: 5px;
    }

</style>
<form id ="frm1" onsubmit="return validate(this)" method="POST">
    <div>
        <label for="newU">Desired New Username</label><br>
        <input type="text" name="newU" required />
    </div>
    <div>
        <label for="confirmU">Confirm Username</label><br>
        <input name="confirmU"  required />
    </div>
    <div>
        <label for="pw">Password</label><br>
        <input type="password" id="pw" name="password" required minlength="8" />
    </div>
    
    <input type="submit" value="Submit" />
</form>
<p id="msg"></p>
<script>
    function validate(form) {
        var x = document.getElementById("frm1");
        var text = "";
        var user = x.elements[0].value;
        var userConfirm = x.elements[1].value;
        var password = x.elements[2].value;

        //text = `email: ${email}\nuser: ${username}\npass: ${pass}\npass confirm: ${confirm}`
        //console.log(text);
        if (user === userConfirm){
        }
        else{
            document.getElementById("msg").innerText="Usernames do not match, please try again.";
            console.log(`user: ${user}\nconfirm: ${userConfirm}`);
            return false;
        }
        
        return true;
    }
</script>