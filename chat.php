<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
}
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

        <div id="Borge" class="w3-container person">
            <div id="chatEkrani">
                <div class="row">
                    <div id="mesajAlani bg-white" class="col-md-12">
                        <div class="d-flex">
                            <div class="alert alert-dark" role="alert">
                                <b>@kizildas</b> Bu mesaj karşı taraftan geldi!
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <div class="alert alert-info" role="alert">
                                Bu mesaj sizin tarafınızdan gönderildi! <b>@emrkzl</b>
                            </div>
                        </div>
                    </div>
                    <div id="yeniMesajAlani" class="w3-padding-large" style="position: absolute;bottom: 10;">
                        <div class="row">
                            <div class="col-md-7">
                                <input type="text" class="form-control" id="mesaj" placeholder="Mesaj yazınız.." />
                            </div>
                            <div class="col-md-3">
                                <button type="button" class="form-control btn btn-success">Gönder</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include './components/message-teams.php' ?>

    </div>

</body>
<script src="./assets/js/message-script.js"></script>

</html>