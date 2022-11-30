<?php
require_once "verify.php";

function addUser($post_user, $post_pw) : bool{
    // trim username
    $user = trim($post_user);
    // hash password
    $pw = password_hash(trim($post_pw), PASSWORD_DEFAULT);

    $conn = newCon();
    // execute query, store success/failure
    bool: $res = mysqli_query($conn, "INSERT INTO users VALUES ({$user}, {$pw})");
    // close connection
    $conn->close();
    // return success/failure
    return $res;
}

?>