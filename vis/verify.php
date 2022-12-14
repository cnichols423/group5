<?php
require_once __DIR__."/../configure.php";

        // checks if user exists
    function userExists($post_usr) : bool{
        $post_usr = trim($post_usr);
        $conn = getConn();
        $query = "SELECT username FROM users WHERE username = ?";

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

    // checks if any of the given args are empty
    function hasEmpty() : bool{
        $argv = func_get_args();
        $argc = func_num_args();
        for($i = 0; $i < $argc; $i++){
            if(empty($argv[$i])) return true;
        }
        return false;
    }

    // alerts for pages
    function alert(string $msg){
        echo'<script>alert("'.$msg.'")</script>';
    }


?>

