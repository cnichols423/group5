<?php
require_once "verify.php";

function addUser($user, $pw, $team, $division, $coachF, $coachL, $coachSalary, $coachNumSeasons) : bool{
    // trim username
    $user = trim($user);
    // hash password
    $pw = password_hash(trim($pw), PASSWORD_DEFAULT);

    $conn = newCon();
    $queryUser = "insert into users (username, password) values ({$user}, {$pw})";
    $queryDivision = "insert into division (divisionName) values ({$division})";
    $queryCoach = "insert into coach (coachFname, coachLname, coachSalary, seasonsCoached) values ({$coachF}, {$coachL},
                                                                                {$coachSalary}, {$coachNumSeasons})";
    $queryTeam = "insert into team (teamName, divisionId, teamUserId, teamCoachId, teamLocation) values ()";
    // execute query, store success/failure
    bool: $res = mysqli_query($conn, "INSERT INTO users VALUES ({$user}, {$pw})");
    // close connection
    $conn->close();
    // return success/failure
    return $res;
}

?>