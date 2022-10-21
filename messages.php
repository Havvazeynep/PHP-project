<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
}
require_once './db/connect.php';

$online_user = $_SESSION['user'];

$team_user_stmt = $conn->prepare("SELECT TM.title,TM.message, TM.date_time FROM team_users TU INNER JOIN teams T ON TU.team_id=T.id INNER JOIN team_messages TM ON TM.team_id=T.id WHERE TU.user_id = :u_id");
$team_user_stmt->bindValue(':u_id', $online_user['id']);
$team_user_stmt->execute();
$team_users = $team_user_stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Messages</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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

    <!-- Message Style -->
    <link rel="stylesheet" href="./assets/css/message-style.css">
</head>

<body>

    <?php include './components/message-navbar.php' ?>


    <!-- Page content -->
    <div class="w3-main" style="margin-left:320px;">
        <i class="fa fa-bars w3-button w3-white w3-hide-large w3-xlarge w3-margin-left w3-margin-top" onclick="w3_open()"></i>
        <a href="javascript:void(0)" class="w3-hide-large w3-red w3-button w3-right w3-margin-top w3-margin-right" onclick="document.getElementById('id01').style.display='block'"><i class="fa fa-pencil"></i></a>


    </div>

</body>
<script src="./assets/js/message-script.js"></script>

</html>