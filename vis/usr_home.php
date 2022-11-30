<?php
require_once "search.php";

if(isset($_POST["sign-outBtn"])){
    require_once "login.php";
    clearSession();
    header("location: index.php");
    exit();
}

if(isset($_POST["searchBtn"])){
    search($_POST["searchBar"]);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>
        Welcome
    </title>
</head>
<body>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <input name="searchBar" placeholder="search">
        <button name="searchBtn">search</button>
        <button name="playersBtn">players</button>
        <button name="tradeBtn">trade</button>
        <button name="sign-outBtn">sign-out</button>
    </form>
</body>
</html>
