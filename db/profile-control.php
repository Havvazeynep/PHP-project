<?php

    require_once './connect.php';

    session_start();

    $online_user = $_SESSION['user'];
	
	if(isset($_POST))
	{
		if($_POST["firstname"] && $_POST["lastname"] && $_POST["phone"]){

            $firstname =$_POST["firstname"];
            $lastname =$_POST["lastname"];
            $phone =$_POST["phone"];

            $stmt = $conn->prepare("UPDATE users SET firstname = :firstname, lastname = :lastname, phone = :phone WHERE id = :u_id");
            $stmt->bindValue(':firstname', $firstname, PDO::PARAM_STR);
            $stmt->bindValue(':lastname', $lastname, PDO::PARAM_STR);
            $stmt->bindValue(':phone', $phone, PDO::PARAM_STR);
            $stmt->bindValue(':u_id', $online_user['id']);

            if($stmt->execute()) {
                $alert = array(
                    "message" => "Bilgileriniz güncellenmiştir",
                    "type" => "success"
                );
                
            } else {
                    $_SESSION['team_value'] = $team_value ;
                    $alert = array(
                        "message" => "Güncelleme başarısız",
                        "type" => "danger"
                    );
            }
        }else {
            $_SESSION['team_value'] = $team_value ;
            $alert = array(
                "message" => "Lütfen boş alan bırakmayınız",
                "type" => "danger"
            );
        }
        
        $_SESSION["alert"] = $alert;

        header("location: ../profile.php");

    }
