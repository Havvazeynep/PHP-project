<?php
session_start();
if (!isset($_SESSION['user']))
{
    header('Location: login.php');
}
require_once './db/connect.php';

$online_user = $_SESSION['user'];

// $stmt = $conn->query("SELECT * FROM teams");
// $teams = $stmt->fetchAll();

$team_user_stmt = $conn->prepare("SELECT * FROM team_users TU,teams T WHERE TU.team_id=T.id AND TU.user_id = :u_id");
$team_user_stmt->bindValue(':u_id',$online_user['id']);
$team_user_stmt->execute();
$team_users = $team_user_stmt->fetchAll();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Teams</title>
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
            <span class="w3-xxlarge w3-text-white w3-wide">MY TEAMS</span>
        </div>
    </div>

    <div class="w3-container w3-padding-large w3-light-grey">
        <div class="w3-container w3-margin w3-padding-large">
            <h3 id="contact"><b>My teams</b></h3>
            <div class="w3-row">
                <a href="javascript:void(0)" onclick="openCity(event, 'London');">
                    <div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding">London</div>
                </a>
                <a href="javascript:void(0)" onclick="openCity(event, 'Paris');">
                    <div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding">Paris</div>
                </a>
                <a href="javascript:void(0)" onclick="openCity(event, 'Tokyo');">
                    <div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding">Tokyo</div>
                </a>
            </div>

            <div id="London" class="w3-container city" style="display:none">
                <h2>London</h2>
                <p>London is the capital city of England.</p>
            </div>

            <div id="Paris" class="w3-container city" style="display:none">
                <h2>Paris</h2>
                <p>Paris is the capital of France.</p>
            </div>

            <div id="Tokyo" class="w3-container city" style="display:none">
                <h2>Tokyo</h2>
                <p>Tokyo is the capital of Japan.</p>
            </div>
        </div>
    </div>
    <hr class="w3-opacity">
    <div class="w3-container w3-margin w3-padding-large">
        <table class="w3-table-all w3-hoverable">
            <thead>
                <tr class="w3-light-grey">
                    <th style="width: 40px">ID</th>
                    <th>Team Name</th>
                    <th>Status</th>
                    <th style="width: 60px">Show</th>
                    <th style="width: 60px">Edit</th>
                    <th style="width: 60px">Delete</th>
                </tr>
            </thead>

            <?php foreach ($team_users as $rs) { ?>
                <tr>
                    <td><?php echo $rs['id'] ?></td>
                    <td><?php echo $rs['team_name'] ?></td>
                    <td><?php echo $rs['status'] ?></td>
                    <td>
                        <!-- <a href="" onClick="window.open('team-update.php','mywindow','width=900,height=500')" class="w3-button w3-green w3-hover-light-grey w3-round-large">
                                Show
                            </a> -->
                        <form action="team-update.php" method="post">
                            <input type="hidden" name="varname" value="<?php echo $rs['id'] ?>">
                            <input type="submit" value="Show" class="w3-button w3-green w3-hover-light-grey w3-round-large">
                        </form>
                    </td>
                    <td><a href="#" class="w3-button w3-teal w3-hover-light-grey w3-round-large">Edit</a></td>
                    <td><a href="#" class="w3-button w3-red w3-hover-light-grey w3-round-large">Delete</a></td>
                </tr>
            <?php } ?>

        </table>
        <h3 id="contact"><b>Create a new team</b></h3>
        <?php if (isset($_SESSION["alert"])) { ?>
            <div class="alert alert-<?php echo $_SESSION["alert"]["type"]; ?>">
                <?php echo $_SESSION["alert"]["message"]; ?>
            </div>
            <?php unset($_SESSION["alert"]); ?>
        <?php } ?>
        <form action="./db/team-create-control.php" method="post">
            <div class="w3-section">
                <label class="w3-text-blue-gray">
                    <h5>Team Name</h5>
                </label>
                <input class="w3-input w3-border w3-round-small" type="text" name="team_name" required placeholder="Name">
            </div>
            <div class="w3-center">
                <button class="w3-button w3-section w3-blue w3-ripple w3-padding"><i class="fa fa-paper-plane w3-margin-right"></i>Create a New Team</button>
            </div>
        </form>
    </div>
    </div>

    <?php include './components/footer.php' ?>

</body>

<script src="./assets/js/script.js"></script>
<script>
    function openCity(evt, cityName) {
        var i, x, tablinks;
        x = document.getElementsByClassName("city");
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablink");
        for (i = 0; i < x.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" w3-border-red", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.firstElementChild.className += " w3-border-red";
    }
</script>

</html>