<?php

    require_once './connect.php';

    session_start();

    $team_value = $_POST['team_value'];
    $_SESSION['team_value'] = $team_value ;
	
	if(isset($_POST))
	{
        if($_POST["delete_value"]){
        
            $delete_user = $_POST["delete_value"];

            $sql = "SELECT COUNT(`user_id`) AS num FROM team_users WHERE `user_id` = :id AND team_id = :team_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':id',$delete_user);
            $stmt->bindValue(':team_id',$team_value);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if($row['num'] <= 0) {
                $alert = array(
                    "message" => "This user already exists",
                    "type" => "danger"
                );
                
            } else {
                $stmt = $conn->prepare("DELETE FROM team_users WHERE team_id = :team_id, `user_id` = :u_id");
                $stmt->bindParam(':team_id', $team_value, PDO::PARAM_INT);
                $stmt->bindParam(':u_id', $delete_user, PDO::PARAM_INT);
                $stmt->execute();

                if($stmt->rowCount() > 0){
                    $alert = array(
                        "message" => "This users deleting",
                        "type" => "success"
                    );
                } else {
                    $alert = array(
                        "message" => "Silme işleminiz başarısız oldu.",
                        "type" => "danger"
                    );
                }
            }
        }else{
            $alert = array(
                "message" => "Lütfen sileceğiniz kullanıcıyı seçin",
                "type" => "danger"
            );
	    }
        
        $_SESSION["alert"] = $alert;

        header("location: ../team-update.php");

    }

	
?>