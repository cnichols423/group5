<?php
session_start();
require_once "login.php";

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: welcome.php");
    exit;
}

if(isset($_POST["loginBtn"])){
    if(checkLoginInfo($_POST["username"], $_POST["password"])){
        $_SESSION["loggedin"] = true;
        header("location: usr_home.php");
    }
    else{
        echo '<script>alert("incorrect information")</script>';
    }
}

?>

<!DOCTYPE html>
<html lang = "en">
    <head>
        <title>
            trader
        </title>
    </head>
    <body>
        <h2>
            Welcome!
        </h2>
        <form method = "post" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >
            <input name = "username" placeholder="username" type="text">
            <input name = "password" placeholder="password" type="password">

            <label for="showBox" style="font-size: x-small">Show password</label>
            <input name = "showBox" type="checkbox">

            <button name = "loginBtn">Login</button>
        </form>
        <form method = "post" action = "signup_page.php">
            <button>signup</button>
        </form>
    </body>
</html>
