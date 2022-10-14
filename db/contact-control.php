<?php
    require_once './connect.php';
    
    session_start();
	
	if(isset($_POST))
	{
		if($_POST["firstname"] && $_POST["email"] && $_POST["mesaj"]){
        
            $firstname =$_POST["firstname"];
            $email =$_POST["email"];
            $mesaj =$_POST["mesaj"];

            $stmt = $conn->prepare("INSERT INTO contact (firstname, email, mesaj) VALUES(:firstname,:email,:mesaj)");
            $stmt->bindParam(':firstname', $firstname);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':mesaj', $mesaj);

            if($stmt->execute()){
                $alert = array(
                    "message" => "Mesajınız gönderilmiştir.",
                    "type" => "success"
                );
            } else {
                $alert = array(
                    "message" => "Mesajınız gönderilmedi!",
                    "type" => "danger"
                );
            }
        }else{
            $alert = array(
                "message" => "Lütfen tüm alanları doldurunuz",
                "type" => "danger"
            );
	    }

        $_SESSION["alert"] = $alert;
        header("location: ../contact.php");

    }
