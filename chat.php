<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
}
require_once './db/connect.php';

$online_user = $_SESSION['user'];

$team_user_stmt = $conn->prepare("SELECT TM.title,TM.message, TM.date_time, T.team_name FROM team_users TU INNER JOIN teams T ON TU.team_id=T.id INNER JOIN team_messages TM ON TM.team_id=T.id WHERE TU.user_id = :u_id");
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

    <link rel="stylesheet" href="./assets/css/chat-style.css">

    <!-- Bootstrap css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

</head>

<body>

    <div class="chat">
        <div class="sidebar">
            <div class="d-grid gap-2 col-6 mx-auto">
                <a href="messages.php" class="btn btn-primary">
                    <i class="fa fa-envelope"></i> My team
                </a>
            </div>
            <div class="search">
                <input type="text" placeholder="Ara..">
                <i class="fa fa-search"></i>
            </div>
            <div class="contacts">
                <ul>
                    <li>
                        <a href="#" class="list-group-item">
                            <div class="contact">
                                <div class="name">Tayfun Erbilen</div>
                                <div class="message">Merhaba, bu bir test mesajıdır..</div>
                            </div>
                            <div class="notification"></div>
                        </a>
                    </li>
                    <li class="active">
                        <a href="#" class="list-group-item">
                            <div class="contact">
                                <div class="name">Tayfun Erbilen</div>
                                <div class="message">Merhaba, bu bir test mesajıdır..</div>
                            </div>
                            <div class="notification">3</div>
                        </a>
                    </li>
                    <?php foreach ($team_users as $rs) { ?>
                        <li>
                            <a href="#" class="list-group-item">
                                <div class="contact">
                                    <div class="name"><?php echo $rs['team_name'] ?></div>
                                    <div class="message">Merhaba, bu bir test mesajıdır..</div>
                                </div>
                                <div class="notification"></div>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <div class="content">
            <div class="message-header">
                <div class="user-info">
                    <div class="user">
                        <div class="name">Tayfun Erbilen</div>
                        <div class="time">10 dk önce</div>
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
                <div class="message me">
                    <div class="bubble">
                        Merhaba tahsin dost, nasıl gidiyor keyifler?
                    </div>
                    <div class="time">1dk önce</div>
                </div>
                <div class="message">
                    <div class="bubble">
                        Merhaba tahsin dost, nasıl gidiyor keyifler?
                    </div>
                    <div class="time">1dk önce</div>
                </div>

                <div class="message">
                    <div class="bubble">
                        Merhaba tahsin dost, nasıl gidiyor keyifler?
                    </div>
                    <div class="time">1dk önce</div>
                </div>
                <?php foreach ($team_users as $rs) { ?>
                    <div class="message">
                        <div class="bubble">
                            <h4><?php echo $rs['title'] ?></h4>
                            <?php echo $rs['message'] ?>
                        </div>
                        <div class="time">Tarih: <?php echo $rs['date_time'] ?></div>
                    </div>
                <?php } ?>

            </div>
            <div class="message-form">
                <ul>
                    <li class="emoji-btn">
                        <a href="#">
                            <i class="fa fa-laugh"></i>
                        </a>
                    </li>
                    <li class="input">
                        <input type="text" placeholder="Bir şeyler yaz..">
                    </li>
                    <li class="sound-btn">
                        <a href="#">
                            <i class="fa fa-microphone"></i>
                        </a>
                    </li>
                    <li class="image-btn">
                        <a href="#">
                            <i class="fa fa-image"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

</body>
<script src="https://kit.fontawesome.com/5b756dfa76.js" crossorigin="anonymous"></script>

<script src="./assets/js/message-script.js"></script>

</html>