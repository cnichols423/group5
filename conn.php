<?php
require_once "configure.php";

function newCon() : mysqli{
    $conn = new mysqli();

    // connect to host and specify database
    $conn->connect(getHost(), getUsr(), getPw());
    $conn->select_db(getDb());

    return $conn;
}

?>