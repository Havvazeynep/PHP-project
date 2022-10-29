<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
}
require_once './db/connect.php';

$online_user = $_SESSION['user'];

$team_user_stmt = $conn->prepare("SELECT * FROM team_users TU,teams T WHERE TU.team_id=T.id AND TU.user_id = :u_id");
$team_user_stmt->bindValue(':u_id', $online_user['id']);
$team_user_stmt->execute();
$team_users = $team_user_stmt->fetchAll();

if (isset($_POST['team_id'])) {
    $team_id = $_POST['team_id'];

    $team_name_stmt = $conn->query("SELECT * FROM teams WHERE id = $team_id");
    $team_name = $team_name_stmt->fetch(PDO::FETCH_ASSOC);

    $user_message_stmt = $conn->prepare("SELECT U.firstname,TM.message, TM.date_time, T.team_name FROM team_messages TM INNER JOIN teams T ON TM.team_id=T.id INNER JOIN users U ON TM.user_id=U.id WHERE TM.team_id = :team_id GROUP BY TM.id ASC");
    $user_message_stmt->bindValue(':team_id', $team_id);
    $user_message_stmt->execute();
    $user_message = $user_message_stmt->fetchAll();

    if(isset($_POST["message"])){
        $message = $_POST["message"];
    
        $message_stmt = $conn->prepare("INSERT INTO team_messages (`message`, `user_id`, team_id) VALUES(:u_message, :u_id, :team_id)");
        $message_stmt->bindValue(':u_message', $message);
        $message_stmt->bindValue(':u_id', $online_user['id']);
        $message_stmt->bindValue(':team_id', $team_id);
        $message_stmt->execute();
        
    }
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

    <link rel="stylesheet" href="./assets/css/chat-style.css">

    <!-- Bootstrap css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

</head>

<body>

    <div class="chat">
        <div class="sidebar">
            <div class="d-grid gap-2 col-6 mx-auto">
                <a href="messages.php" class="btn btn-primary">My Profile</a>
            </div>
            <div class="search">
                <input type="text" placeholder="Ara..">
                <i class="fa fa-search"></i>
            </div>
            <div class="contacts">
                <ul>
                    <?php foreach ($team_users as $rs) { ?>
                        <li>
                            <form method="post">
                                <div class="d-grid gap-2 m-2">
                                <button class="btn btn-outline-secondary">
                                    <input type="hidden" name="team_id" value="<?php echo $rs['id'] ?>">

                                    <div class="contact">
                                        <div class="name"><?php echo $rs['team_name'] ?></div>
                                    </div>
                                </button>
                                </div>
                            </form>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <div class="content">
            <?php
            if (isset($team_name)) {
            ?>
                <div class="message-header">
                    <div class="user-info">
                        <div class="user">
                            <div class="name"><?php echo $team_name['team_name'] ?></div>
                        </div>
                    </div>
                    <div class="actions">
                        <ul>
                            <li>
                                <a href="#">
                                    <i class="fa fa-info-circle"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-ellipsis-v"></i>
                                </a>
                            </li>
                        </ul>
                    </div>

                </div>
                <div class="message-content">
                    <?php
                    if (isset($user_message)) {
                        foreach ($user_message as $rs) {
                    ?>
                            <div class="message">
                                <div class="bubble">
                                    <h4><?php echo $rs['firstname'] ?></h4>
                                    <?php echo $rs['message'] ?>
                                </div>
                                <div class="time">Tarih: <?php echo $rs['date_time'] ?></div>
                            </div>
                        <?php }
                    } else { ?>
                        <div></div>
                    <?php } ?>
                </div>
                <div class="message-form">
                    <form method="post">
                        <ul>
                            <input type="hidden" name="team_id" value="<?php echo $team_name['id'] ?>">
                            <li class="input">
                                <input type="text" name="message" required placeholder="Bir şeyler yaz..">
                            </li>
                            <li class="sound-btn">
                                <button class="btn btn-outline-secondary">
                                    Send <i class="fa fa-arrow-alt-circle-right"></i>
                                </button>
                            </li>
                        </ul>
                    </form>
                </div>
            <?php } else { ?>
                <div class="message-header"></div>
            <?php } ?>
        </div>
    </div>

</body>
<script src="https://kit.fontawesome.com/5b756dfa76.js" crossorigin="anonymous"></script>

<script src="./assets/js/message-script.js"></script>

</html>