<?php
require_once "signup.php";


if(isset($_POST["submitBtn"])){

    $usr = $_POST["username"];
    $pw = $_POST["pw"];

    if(!userExists($usr)){
        // add user to users table with password
        if(addUser($usr, $pw)){
            echo "added user";
            // redirect
            header("location: index.php");

        }
        echo'<script>alert("failed to add user")</script>';
    }

}

if(isset($_POST["showBox"])){
    echo '<script>
        pw = document.getElementById("pw");
        pwconf = document.getElementById("pwconf");
        if(pw.type == "password") pw.type = "text";
        else pw.type = "password";
        pwconf.type = pw.type;
</script>';

}
?>
<!DOCTYPE html>
<html lang ="en">
    <head>
        <title>
            Signup!
        </title>
    </head>
    <body>
    <h2>Signup</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <input name="username" placeholder="username">

            <input name="password" placeholder="password" type="password" id="pw">
            <input name="password_confirm" placeholder="confirm password" type = "password" id="pwconf">

            <label for="showBox" style="font-size: x-small">show passwords</label>
            <input name="showBox" type="checkbox" value="value1">

            <button name="submitBtn">submit</button>
        </form>
    </body>
</html>
