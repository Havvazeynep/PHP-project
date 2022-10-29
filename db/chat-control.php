<?php
    require_once './connect.php';
    
    session_start();

    $online_user = $_SESSION['user'];
	
	if(isset($_POST))
	{
		if($_POST["message"]){
        
            $message = $_POST["message"];
            $team_id =$_POST["team_id"];

            $message_stmt = $conn->prepare("INSERT INTO team_messages (`message`, `user_id`, team_id) VALUES(:u_message, :u_id, :team_id)");
            $message_stmt->bindValue(':u_message', $message);
            $message_stmt->bindValue(':u_id', $online_user['id']);
            $message_stmt->bindValue(':team_id', $team_id);
            $message_stmt->execute();
            
        }else{
            $alert = array(
                "message" => "Lütfen mesajınızı giriniz",
                "type" => "danger"
            );
	    }

        $_SESSION["alert"] = $alert;
        header("location: ../chat.php");

    }
