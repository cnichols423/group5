<?php
require_once "signup.php";


if(isset($_POST["submitBtn"])){

    $usr = trim($_POST["username"]);
    $pw = trim($_POST["password"]);
    $pwConfirm = trim($_POST["password_confirm"]);
    $team = trim($_POST["team"]);
    $division = trim($_POST["division"]);
    $coach = trim($_POST["coach"]);


    if(!hasEmpty($usr, $pw, $pwConfirm, $team, $division, $coach)){
        // check that passwords match
        if($pw == $pwConfirm){
            // check if the user does not exist
            if(!userExists($usr)){
                $_SESSION['newUser'] = $usr;
                $_SESSION['newUserPassword'] = $pw;
                // add user to users table with password
                alert("adding user");
                //if(addUser($usr, $pw, $team, $division)){
                // redirect
                //     header("location: index.php");
                //}
            }
            else{
                alert("username is already in use");
            }
        }
        else{
            alert("passwords do not match");
        }

    }
    else{
        alert("One or more fields are empty!");
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
