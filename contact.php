<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <meta name="description" content="PHP Project - Havva Zeynep Akdemir">
	<meta name="author" content="https://github.com/Havvazeynep , havvazeynepakdemir@gmail.com">
	<meta name="keywords" content="HTML CSS JS Javascript Web Tasarım SQL mysql PDO PHP">
    <link rel="icon" href="./assets/img/icon.png">

    <link rel="stylesheet" href="./assets/css/style.css">

    <!-- Bootstrap css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <!-- w3schools css link -->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>
    <?php include './components/header.php' ?>

    <div class="bgimg-3 w3-display-container w3-opacity-min">
        <div class="w3-display-middle">
            <span class="w3-xxlarge w3-text-white w3-wide">CONTACT</span>
        </div>
    </div>

    <div class="w3-container w3-padding-large w3-light-grey">
        <h3 id="contact" class="w3-center"><b>Contact Me</b></h3>
        <div class="w3-row-padding w3-center w3-padding-24" style="margin:0 -16px">
            <div class="w3-third w3-dark-grey">
                <p><i class="fa fa-envelope w3-xxlarge w3-text-light-grey"></i></p>
                <p>havva.zeynep.16@gmail.com</p>
            </div>
            <div class="w3-third w3-blue-gray">
                <p><i class="fa fa-map-marker w3-xxlarge w3-text-light-grey"></i></p>
                <p>Mersin, TR</p>
            </div>
            <div class="w3-third w3-dark-grey">
                <p><i class="fa fa-phone w3-xxlarge w3-text-light-grey"></i></p>
                <p>5079782904</p>
            </div>
        </div>
        
        <div class="w3-container w3-margin w3-padding-large">
            <?php if (isset($_SESSION["alert"])) { ?>
                <div class="alert alert-<?php echo $_SESSION["alert"]["type"]; ?>">
                    <?php echo $_SESSION["alert"]["message"]; ?>
                </div>
                <?php unset($_SESSION["alert"]); ?>
            <?php } ?>
            <form action="./db/contact-control.php" method="post">
                <div class="w3-section">
                    <label class="w3-text-blue-gray">
                        <h5>Name</h5>
                    </label>
                    <input class="w3-input w3-border w3-round-small" type="text" name="firstname" required placeholder="Name">
                </div>
                <div class="w3-section">
                    <label class="w3-text-blue-gray">
                        <h5>Email</h5>
                    </label>
                    <input class="w3-input w3-border w3-round-small" type="email" name="email" required placeholder="Email">
                </div>
                <div class="w3-section">
                    <label class="w3-text-blue-gray">
                        <h5>Message</h5>
                    </label>
                    <input class="w3-input w3-border w3-round-small" type="text" name="mesaj" required placeholder="Message">
                </div>
                <div class="w3-center">
                    <button class="w3-button w3-section w3-blue w3-ripple w3-padding"><i class="fa fa-paper-plane w3-margin-right"></i>Send Message</button>
                </div>
            </form>
        </div>
    </div>

    <?php include './components/footer.php' ?>

</body>

<!-- Bootstrap js links -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
<script src="./assets/js/script.js"></script>

</html>