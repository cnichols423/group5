<?php
    $team = $_POST["team"];
    $division = $_POST["division"];
    $coach = $_POST["coach"];
    $coachPay = $_POST["coach_pay"];
    $coachExp = $_POST["coach_num_seasons"];
    if(addUser($_SESSION['newUser'],$_SESSION['newUserPassword'],$team, $division, $coach, $coachPay, $coachExp)){

    }
    else{
        alert("Something went wrong");
        header("location: index.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>info</title>
</head>
<body>

</body>
</html>
