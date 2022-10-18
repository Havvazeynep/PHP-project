<?php
    require_once './connect.php';
    
    session_start();
	
	if(isset($_POST))
	{
		if($_POST["email"] && $_POST["password"]){
        
            $email =$_POST["email"];
            $password =$_POST["password"];

            $sql = "SELECT * FROM users WHERE email='$email' && `password`='$password'";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ( $user === false ){

                $alert = array(
                    "message" => "Kullanıcı adı veya şifre hatalı",
                    "type" => "danger"
                );
                header("location: ../login.php");
            }else{
                $_SESSION['user'] = $user;
                header("location: ../index.php");
                //$validPassword = password_verify($passwordAttempt, $user['password']);
                // if($validPassword) {
                //     $_SESSION['user'] = $user;
                //     header("location: ../index.php");
                // } else {
                //     $alert = array(
                //         "message" => "Şifre hatalı",
                //         "type" => "danger"
                //     );
                // }
            }
        }else{
            $alert = array(
                "message" => "Lütfen tüm alanları doldurunuz",
                "type" => "danger"
            );
            header("location: ../login.php");
	    }

        $_SESSION["alert"] = $alert;
        

    }

	
?>