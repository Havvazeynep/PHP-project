<?php

    require_once './connect.php';

    session_start();

    $team_value = $_POST['team_value'];
    $_SESSION['team_value'] = $team_value ;
	
	if(isset($_POST))
	{
		if($_POST["user_id"]){
        
            $user_id = $_POST["user_id"];

            $sql = "SELECT COUNT(`user_id`) AS num FROM team_users WHERE `user_id` = :id AND team_id = :team_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':id',$user_id);
            $stmt->bindValue(':team_id',$team_value);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if($row['num'] > 0) {
                $alert = array(
                    "message" => "This user already exists",
                    "type" => "danger"
                );
                
            } else {
                $stmt = $conn->prepare("INSERT INTO team_users (team_id,`user_id`) VALUES(:team_id,:u_id)");
                $stmt->bindParam(':team_id', $team_value);
                $stmt->bindParam(':u_id', $user_id);
                if($stmt->execute()){
                    $alert = array(
                        "message" => "New team created",
                        "type" => "success"
                    );
                } else {
                    $alert = array(
                        "message" => "Kaydınız oluşturulamadı",
                        "type" => "danger"
                    );
                }
            }
        }else{
            $alert = array(
                "message" => "Lütfen tüm alanları doldurunuz",
                "type" => "danger"
            );
	    }
        
        $_SESSION["alert"] = $alert;



        header("location: ../team-update.php");

    }

	
?>