<?php
require_once "verify.php";

/*
 * todo
 *      if we have a failure drop everything that was added
 */
class registration{

    //coach
    private int $coachId;
    private string $coachFirstName;
    private string $coachLastName;
    private int $coachSalary;
    private int $coachNumberOfSeasons;

    //team
    private int $teamId;
    private string $teamName;
    private string $division;
    private string $location;

    //user
    private string $username;
    private string $password;

    private function setTeamId() : bool{
        $query = "select teamId from team where teamUsername = ?";
        $conn = getConn();
        if($stmt = $conn->prepare($query)){
            $stmt->bind_param("s", $param_username);

            $param_username = $this->username;

            if($stmt->execute()){
                $stmt->store_result();
                $stmt->bind_result($result);
                $this->teamId = $result;

                $stmt->close();
                $conn->close();
                return true;
            }

            $stmt->close();
        }
        $conn->close();
        return false;
    }

    private function addTeam($teamName, $division, $location) : bool{

        // set
        $this->teamName =$teamName;
        $this->division = $division;
        $this->location = $location;

        $query = "insert into team (teamName, division, teamUsername, teamLocation) values (?, ?, ?, ?) ";
        $conn = getConn();

        if($stmt = $conn->prepare($query)){

            $stmt->bind_param("ssss", $param_teamName, $param_division, $param_username, $param_location);

            // bind
            $param_teamName = $this->teamName;
            $param_username = $this->username;
            $param_division = $this->division;
            $param_location = $this->location;

            if($stmt->execute()){
                if($this->setTeamId()){
                    $stmt->close();
                    $conn->close();
                    return true;
                }
            }
            $stmt->close();
        }
        $conn->close();
        return false;

    }

    // add user
    private function addUser($username, $password) : bool{
        $this->username = $username;
        $this->password = $password;

        $query = "insert into users (username, password)  values (?, ?)";
        $conn = getConn();

        if($stmt = $conn->prepare($query)){

            $stmt->bind_param("ss", $param_user, $param_password);
            $param_user = $this->username;
            $param_password = $this->password;

            if($stmt->execute()){
                $stmt->close();
                $conn->close();
                return true;
            }
            $stmt->close();
        }

        $conn->close();
        return false;
    }


    private function addCoach(string $coachFname, string $coachLname, int $coachNumSeasons) : bool {

        $this->coachFirstName = $coachFname;
        $this->coachLastName = $coachLname;
        $this->coachNumberOfSeasons = $coachNumSeasons;

        $query = "insert into coach (coachId, coachFname, coachLname,  seasonsCoached) values (?, ?
, ?,  ?)";
        $conn = getConn();
        if($stmt = $conn->prepare($query)) {
            $this->coachId = $this->fetchMaxCoachId() + 1;

            $stmt->bind_param("issii", $param_id, $param_f, $param_l, $param_exp);

            $param_id = $this->coachId;
            $param_f = $this->coachFirstName;
            $param_l = $this->coachLastName;
            $param_exp = $this->coachNumberOfSeasons;

            if($stmt->execute()){
                $stmt->close();
                $conn->close();
                return true;
            }

            $stmt->close();
        }
        $conn->close();
        return false;
    }



    private function newCoachEmployment(int $coachSalary) : bool{
        $this->coachSalary = $coachSalary;

        $query = "insert into coachTeam (coachId, teamId, coachSalary) values (?, ?, ?)";
        $conn = getConn();
        $stmt = $conn->prepare($query);

        $stmt->bind_param("iii", $param_coach, $param_team, $param_pay);

        $param_coach = $this->coachId;
        $param_team = $this->teamId;
        $param_pay = $this->coachSalary;

        $success = $stmt->execute();

        $stmt->close();
        $conn->close();

        return $success;
    }

    public function registerNew($username, $password, $teamName, $division,
                                $location, $coachF, $coachL, $coachExp, $coachPay) : bool{
        if($this->addUser($username, $password)){

            if($this->addTeam($teamName, $division, $location)){

                if($this->addCoach($coachF, $coachL, $coachExp)){

                    if($this->newCoachEmployment($coachPay)){

                        return true;
                    }
                    // if we fail purge all new information
                    $this->purgeNewCoach();
                }

                $this->purgeNewTeam();
            }
            $this->purgeNewUser();
        }

        return false;

    }

    private function fetchMaxCoachId() : int {
        $conn = getConn();
        if($stmt = $conn->prepare("select max(coachId) from coach")){
            if($stmt->execute()){

                $stmt->store_result();
                $stmt->bind_result($max);

                if(empty($max)){
                    $max = 0;
                }

                $stmt->close();
                $conn->close();

                return $max;
            }

        }

        return 0;
    }

    private function purgeNewUser() : bool{
        $query = "delete from users where username = ?";
        $conn = getConn();
        if($stmt = $conn->prepare($query)){
            $stmt->bind_param("s", $param_username);
            $param_username = $this->username;

            if($stmt->execute()){
             $stmt->close();
             $conn->close();
             return true;
            }
            $stmt->close();
        }
        $conn->close();
        echo'<script>alert("failed to purge user")</script>';
        return false;
    }

    private function purgeNewTeam(){
        $query = "delete from team where teamId = ?";
        $conn =getConn();
        if($stmt =$conn->prepare($query)){
            $stmt->bind_param("i", $param_id);
            $param_id = $this->teamId;

            if($stmt->execute()){
                $stmt->close();
                $conn->close();
                return true;
            }

            $stmt->close();
        }
        $conn->close();
        echo'<script>alert("failed to purge team")</script>';
        return false;
    }

    private function purgeNewCoach() : bool{
        $this->coachId = $this->fetchMaxCoachId();
        $deletion = "delete from coach where coachId = ?";

        $conn = getConn();

        if($stmt = $conn->prepare($deletion)){
            $stmt->bind_param("i", $param_id);
            $param_id = $this->coachId;
            if($stmt->execute()){
                $stmt->close();
                $conn->close();
                return true;
            }
            $stmt->close();
        }

        $conn->close();
        echo'<script>alert("failed to purge coach")</script>';
        return false;

    }

}



?>