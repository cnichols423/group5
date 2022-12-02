<?php

session_start();

require_once "signup.php";



if(isset($_POST["submit"])){

    $usr = $_SESSION['newUser'];
    $pw = $_SESSION['newUserPassword'];
    $team = $_POST["team"];
    $location= $_POST["location"];
    $division = $_POST["division"];
    $coachFname = $_POST["coach_first_name"];
    $coachLname = $_POST["coach_last_name"];
    $coachPay = $_POST["coach_pay"];
    $coachExp = $_POST["coach_num_seasons"];

    if(hasEmpty($usr, $pw, $team, $division, $location, $coachFname, $coachLname, $coachPay, $coachExp)){
        alert("one or more fields are empty");
    }
    else{
        $registration = new registration();

        if($registration->registerNew($usr, $pw, $team, $division, $location,
            $coachFname, $coachLname, $coachExp, $coachPay)){
            header("location: user_home.php");
            exit();
        }
        else{
            alert("Something went wrong");
            header("location: index.php");
            exit();
        }

    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>info</title>
</head>
<body>
    <h2>
        Team Information
    </h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label>
            <input name="team" placeholder="team name">
        </label>

        <label>
            <input name="location" placeholder="state">
        </label>

        <label>
            <select name="division">
                <option value="">division</option>
                <option value="North">North</option>
                <option value="East">East</option>
                <option value="South">South</option>
                <option value="West">West</option>
            </select>
        </label>

        <label>
            <input name="coach_first_name" placeholder="coach first name">
        </label>

        <label>
            <input name="coach_last_name" placeholder="coach last name">
        </label>

        <label>$</label>
        <label>
            <input name="coach_pay" placeholder="coach pay" type="number">
        </label>
        <label>.00</label>

        <label>
            <input name="coach_num_seasons" placeholder="number of seasons coached" type="number">
        </label>
        <label>seasons</label>

        <button name="submit" >submit</button>

    </form>
</body>
</html>
