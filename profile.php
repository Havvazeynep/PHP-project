<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
}
require_once './db/connect.php';

$online_user = $_SESSION['user'];
$online_id = $online_user['id'];

$stmt = $conn->prepare("SELECT * FROM users WHERE id = :u_id;");
$stmt->bindParam(':u_id', $online_id);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
    <meta name="description" content="PHP Project - Havva Zeynep Akdemir">
    <meta name="author" content="https://github.com/Havvazeynep , havvazeynepakdemir@gmail.com">
    <meta name="keywords" content="HTML CSS JS Javascript Web Tasarım SQL mysql PDO PHP">
    <link rel="icon" href="./assets/img/icon.png">

    <!-- Bootstrap css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <!-- w3schools css link -->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href='https://fonts.googleapis.com/css?family=RobotoDraft' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="./assets/css/message-style.css">

</head>

<body>
    <?php include './components/message-navbar.php' ?>


    <div class="w3-main" style="margin-left:320px;">
        <i class="fa fa-bars w3-button w3-white w3-hide-large w3-xlarge w3-margin-left w3-margin-top" onclick="w3_open()"></i>
        <a href="javascript:void(0)" class="w3-hide-large w3-red w3-button w3-right w3-margin-top w3-margin-right" onclick="document.getElementById('id01').style.display='block'"><i class="fa fa-pencil"></i></a>

        <div class="w3-container">
            <h3>My Profile Setting</h3>
            <?php if (isset($_SESSION["alert"])) { ?>
                <div class="alert alert-<?php echo $_SESSION["alert"]["type"]; ?>">
                    <?php echo $_SESSION["alert"]["message"]; ?>
                </div>
                <?php unset($_SESSION["alert"]); ?>
            <?php } ?>
            <form action="./db/profile-control.php" method="post">
                <div class="w3-section">
                    <label class="w3-text-blue-gray">
                        <h5>First Name</h5>
                    </label>
                    <input class="w3-input w3-border w3-round-small" value="<?php echo $user['firstname'] ?>" type="text" name="firstname" required>
                </div>
                <div class="w3-section">
                    <label class="w3-text-blue-gray">
                        <h5>Last Name</h5>
                    </label>
                    <input class="w3-input w3-border w3-round-small" value="<?php echo $user['lastname'] ?>" type="text" name="lastname" required>
                </div>
                <div class="w3-section">
                    <label class="w3-text-blue-gray">
                        <h5>Phone</h5>
                    </label>
                    <input class="w3-input w3-border w3-round-small" value="<?php echo $user['phone'] ?>" type="phone" name="phone" required>
                </div>
                <div class="w3-center">
                    <button class="w3-button w3-section w3-blue w3-ripple w3-padding"><i class="fa fa-paper-plane w3-margin-right"></i>Update</button>
                </div>
            </form>
        </div>
    </div>

</body>
<script src="./assets/js/message-script.js"></script>

</html>