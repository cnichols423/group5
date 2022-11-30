<?php
require_once "verify.php";

function addUser($post_user, $post_pw) : bool{
    $post_user = trim($post_user);
    $post_pw = trim($post_pw);

    if(userExists(trim($post_user))){

        return false;
    }
    else{

        $conn = newCon();

        $query = "INSERT INTO users (user, password) VALUES (?, ?)";
        if($stmt = $conn->prepare($query)){

            $stmt->bind_param("ss", $param_user, $param_password);

            $param_user = $post_user;
            $param_password = password_hash($post_pw, PASSWORD_DEFAULT);

            if(mysqli_stmt_execute($stmt)){

                $stmt->close();
                $conn->close();
                return true;
            }
            $stmt->close();
        }
    }
    $conn->close();
    return false;
}

?>