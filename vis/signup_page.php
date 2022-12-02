<?php
ob_start();

session_start();
require_once "signup.php";

if(isset($_POST["submitBtn"])){


    $usr = trim($_POST["username"]);
    $pw = trim($_POST["password"]);
    $pwConfirm = trim($_POST["password_confirm"]);


    if(!hasEmpty($usr, $pw, $pwConfirm)){
        // check that passwords match

        if($pw == $pwConfirm) {

            // check if the user does not exist
            if (!userExists($usr)) {

                // save password and username to session var
                $_SESSION['newUser'] = $usr;
                // hash password
                $_SESSION['newUserPassword'] = password_hash($pw, PASSWORD_DEFAULT);

                // redirect
                header("location: teamInfo.php");
                exit();

            }
            else {
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
            <label>
                <input name="username" placeholder="username">
            </label>

            <label for="pw"></label><input name="password" placeholder="password" type="password" id="pw">
            <label for="pwconf"></label><input name="password_confirm" placeholder="confirm password" type = "password" id="pwconf">

            <label for="showBox" style="font-size: x-small">show passwords</label>

            <label for="checkBox"></label><input name="showBox" type="checkbox" id="checkBox" onclick="showHide()">
            <script>
                function showHide(){
                    let pw = document.getElementById("pw");
                    let pwConf = document.getElementById("pwconf");
                    if(pw.type === "password") pw.type = "text";
                    else pw.type = "password";
                    pwConf.type = pw.type;
                }
            </script>

            <button name="submitBtn" value="submit">submit</button>
        </form>
    </body>
</html>
