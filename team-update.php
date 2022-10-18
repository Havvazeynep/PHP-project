<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
}
require_once './db/connect.php';

$user_stmt = $conn->query("SELECT * FROM users");
$users = $user_stmt->fetchAll();

if (isset($_POST['varname'])) {
    $var_value = $_POST['varname'];

    $team_stmt = $conn->query("SELECT id, team_name, `status`, date_time FROM teams WHERE id = $var_value");
    $teams = $team_stmt->fetch(PDO::FETCH_ASSOC);

    $team_user_stmt = $conn->query("SELECT U.firstname FROM users U, team_users TU,teams T WHERE TU.team_id=T.id AND TU.user_id = U.id AND T.id = $var_value");
    $team_users = $team_user_stmt->fetchAll();
} else {
    $team_value = $_SESSION['team_value'];

    $team_stmt = $conn->query("SELECT id, team_name, `status`, date_time FROM teams WHERE id = $team_value");
    $teams = $team_stmt->fetch(PDO::FETCH_ASSOC);

    $team_user_stmt = $conn->query("SELECT U.firstname FROM users U, team_users TU,teams T WHERE TU.team_id=T.id AND TU.user_id = U.id AND T.id = $team_value");
    $team_users = $team_user_stmt->fetchAll();
}

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
    <div class="w3-container w3-margin w3-padding-large">
        <?php if (isset($_SESSION["alert"])) { ?>
            <div class="alert alert-<?php echo $_SESSION["alert"]["type"]; ?>">
                <?php echo $_SESSION["alert"]["message"]; ?>
            </div>
            <?php unset($_SESSION["alert"]); ?>
        <?php } ?>
        <table class="w3-table-all w3-hoverable">
            <tr>
                <th style="width: 200px">ID</th>
                <td><?php echo $teams['id'] ?></td>
            </tr>
            <tr>
                <th>Team Name</th>
                <td><?php echo $teams['team_name'] ?></td>
            </tr>
            <?php foreach ($team_users as $rs) { ?>
                <tr>
                    <th>User</th>
                    <td><?php echo $rs['firstname'] ?></td>
                </tr>
            <?php } ?>
            <tr>
                <th>Status</th>
                <td><?php echo $teams['status'] ?></td>
            </tr>
            <tr>
                <th>Date Time</th>
                <td><?php echo $teams['date_time'] ?></td>
            </tr>
            <tr>
                <th>Add Role to User :</th>
                <td>
                    <form action="./db/team-users-update-controller.php" method="post">
                        <input type="hidden" name="team_value" value="<?php echo $teams['id'] ?>">
                        <select name="user_id">
                            <?php foreach ($users as $rs) { ?>
                                <option value="<?php echo $rs['id'] ?>"><?php echo $rs['firstname'] ?></option>
                            <?php } ?>
                        </select>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Add Role</button>
                        </div>
                    </form>
                </td>
            </tr>
        </table>

    </div>
    </div>


</body>

<script src="./assets/js/script.js"></script>

</html>