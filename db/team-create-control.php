<?php

require_once './connect.php';

session_start();

$online_user = $_SESSION['user'];

if (isset($_POST)) {
    if ($_POST["team_name"]) {

        $team_name = $_POST["team_name"];

        $sql = "SELECT COUNT(team_name) AS num FROM teams WHERE team_name= :team_name";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':team_name', $team_name);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row['num'] > 0) {
            $alert = array(
                "message" => "Team name already exists",
                "type" => "danger"
            );
        } else {
            $stmt = $conn->prepare("INSERT INTO teams (team_name) VALUES(:team_name)");
            $stmt->bindParam(':team_name', $team_name);
            if ($stmt->execute()) {
                $last_team = $conn->prepare("SELECT id FROM teams ORDER BY id DESC LIMIT 1");
                $last_team->execute();
                $new_team = $last_team->fetch(PDO::FETCH_ASSOC);
                $user_update = $conn->prepare("INSERT INTO team_users (team_id, `user_id`) VALUES(:team_id, :online_id)");
                $user_update->bindParam(':team_id', $new_team['id']);
                $user_update->bindParam(':online_id', $online_user['id']);
                if ($user_update->execute()) {
                    $alert = array(
                        "message" => "New team created",
                        "type" => "success"
                    );
                }
            } else {
                $alert = array(
                    "message" => "Kaydınız oluşturulamadı",
                    "type" => "danger"
                );
            }
        }
    } else {
        $alert = array(
            "message" => "Lütfen tüm alanları doldurunuz",
            "type" => "danger"
        );
    }

    $_SESSION["alert"] = $alert;

    header("location: ../team.php");
}
