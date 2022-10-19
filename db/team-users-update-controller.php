<?php

    require_once './connect.php';

    session_start();

    $user_id = $_POST["user_id"];
	
	if(isset($_POST))
	{
		if(isset($_POST["team_value"])){

            $team_value = $_POST['team_value'];

            $sql = "SELECT COUNT(`user_id`) AS num FROM team_users WHERE `user_id` = :id AND team_id = :team_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':id',$user_id);
            $stmt->bindValue(':team_id',$team_value);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if($row['num'] > 0) {
                $_SESSION['team_value'] = $team_value ;
                $alert = array(
                    "message" => "This user already exists",
                    "type" => "danger"
                );
                
            } else {
                $stmt = $conn->prepare("INSERT INTO team_users (team_id,`user_id`) VALUES(:team_id,:u_id)");
                $stmt->bindParam(':team_id', $team_value);
                $stmt->bindParam(':u_id', $user_id);
                if($stmt->execute()){
                    $_SESSION['team_value'] = $team_value ;
                    $alert = array(
                        "message" => "New team created",
                        "type" => "success"
                    );
                } else {
                    $_SESSION['team_value'] = $team_value ;
                    $alert = array(
                        "message" => "Kaydınız oluşturulamadı",
                        "type" => "danger"
                    );
                }
            }
        }

        else if(isset($_POST["delete_value"])){
        
            $delete_value = $_POST["delete_value"];

            $sql = "SELECT COUNT(`user_id`) AS num FROM team_users WHERE `user_id` = :id AND team_id = :team_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':id',$user_id);
            $stmt->bindValue(':team_id',$delete_value);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if($row['num'] <= 0) {
                $_SESSION['team_value'] = $delete_value ;
                $alert = array(
                    "message" => "This user already exists",
                    "type" => "danger"
                );
                
            } else {
                $stmt = $conn->prepare("DELETE FROM team_users WHERE team_id = :team_id AND `user_id` = :u_id");
                $stmt->bindValue(':team_id', $delete_value, PDO::PARAM_INT);
                $stmt->bindValue(':u_id', $user_id, PDO::PARAM_INT);
                $stmt->execute();

                if($stmt->rowCount() > 0){
                    $_SESSION['team_value'] = $delete_value ;
                    $alert = array(
                        "message" => "This users deleting",
                        "type" => "success"
                    );
                } else {
                    $_SESSION['team_value'] = $delete_value ;
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