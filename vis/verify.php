<?php
require_once __DIR__."/../conn.php";
    function userExists($post_usr) : bool{
        $post_usr = trim($post_usr);
        $conn = newCon();
        $query = "SELECT id FROM users WHERE user = ?";

        if($stmt = $conn->prepare($query)){
            $stmt->bind_param("s", $param_usr);
            $param_usr = $post_usr;
            if($stmt->execute()){
                $stmt->store_result();
                if($stmt->num_rows == 1 ){
                    $stmt->close();
                    $conn->close();
                    return true;
                }
            }
        }
        return false;
    }


?>

