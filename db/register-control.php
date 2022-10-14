<?php

    require_once './connect.php';

    session_start();
	
	if(isset($_POST))
	{
		if($_POST["firstname"] && $_POST["lastname"] && $_POST["phone"] && $_POST["email"] && $_POST["password"]){
        
            $firstname =$_POST["firstname"];
            $lastname =$_POST["lastname"];
            $phone =$_POST["phone"];
            $email =$_POST["email"];
            $password =$_POST["password"];

            //$password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));

            $sql = "SELECT COUNT(email) AS num FROM users WHERE email= :email";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':email',$email);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if($row['num'] > 0) {
                $alert = array(
                    "message" => "Email already exists",
                    "type" => "danger"
                );
                
            } else {
                $stmt = $conn->prepare("INSERT INTO users (firstname, lastname, email, phone, `password`) VALUES(:firstname,:lastname,:email,:phone,:pass)");
                $stmt->bindParam(':firstname', $firstname);
                $stmt->bindParam(':lastname', $lastname);
                $stmt->bindParam(':phone', $phone);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':pass', $password);

                if($stmt->execute()){
                    $alert = array(
                        "message" => "Kayıt başarılı",
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

        header("location: ../register.php");

    }

	
?>