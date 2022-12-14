<?php
session_start();
if (isset($_SESSION['user'])) {
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LogIn</title>
    <meta name="description" content="PHP Project - Havva Zeynep Akdemir">
	<meta name="author" content="https://github.com/Havvazeynep , havvazeynepakdemir@gmail.com">
	<meta name="keywords" content="HTML CSS JS Javascript Web Tasarım SQL mysql PDO PHP">
    <link rel="icon" href="./assets/img/icon.png">

    <link rel="stylesheet" href="./assets/css/style.css">

    <!-- Bootstrap css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <!-- w3schools css link -->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>
    <?php include './components/header.php' ?>

    <div class="bgimg-2 w3-display-container w3-opacity-min" id="home">
        <div class="w3-display-middle">
            <?php if (isset($_SESSION["alert"])) { ?>
                <div class="alert alert-<?php echo $_SESSION["alert"]["type"]; ?>">
                    <?php echo $_SESSION["alert"]["message"]; ?>
                </div>
                <?php unset($_SESSION["alert"]); ?>
            <?php } ?>
            <form action="./db/login-control.php" method="POST" class="w3-container w3-card-4 w3-light-grey w3-text-blue-gray">
            <a href="index.php" class="w3-button w3-xlarge w3-circle w3-red w3-card-4" style="float: right;">X</a>
                <h2 class="w3-center">Log In</h2>
                <div class="w3-row w3-section">
                    <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-envelope-o"></i></div>
                    <div class="w3-rest">
                        <input class="w3-input w3-border" style="width:350px" name="email" type="email" required placeholder="Email">
                    </div>
                </div>

                <div class="w3-row w3-section">
                    <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-eye-slash"></i></div>
                    <div class="w3-rest">
                        <input class="w3-input w3-border" style="width:350px" name="password" type="password" required placeholder="Password">
                    </div>
                </div>

                <div class="w3-center">
                    <button class="w3-button w3-section w3-blue w3-ripple w3-padding">Login</button>
                </div>
            </form>
        </div>
    </div>

</body>

<!-- Bootstrap js links -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
<script src="./assets/js/script.js"></script>

</html>