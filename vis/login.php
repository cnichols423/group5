<?php
require_once "verify.php";

// verifies login info for existing users
function checkLoginInfo($usr, $pw){
    // open new connection
    $conn = newCon();
    // looking up a password
    $query = "SELECT password FROM users WHERE user = ?";

    if($stmt = $conn->prepare($query)){
        // binding search param
        $stmt->bind_param("s", $param_usr);
        $param_usr = $usr;

        if($stmt->execute()){
            $stmt->store_result();
            if($stmt->num_rows == 1){
                // if exists bind result and check hashed pw
                $stmt->bind_result($hashed_pw);
                if(password_verify($pw, $hashed_pw)){
                    // close connection and stmt
                    $stmt->close();
                    $conn->close();
                    return true;
                }
            }
        }
        $stmt->close();
    }
    $conn->close();
    return false;
}

function clearSession(){
    session_start();
    // unset session vars
    $_SESSION = array();
    // destroy session
    session_destroy();
}
?>
