<?php
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
}
require_once './db/connect.php';

$online_user = $_SESSION['user'];

// $stmt = $conn->query("SELECT * FROM teams");
// $teams = $stmt->fetchAll();

$team_user_stmt = $conn->prepare("SELECT * FROM team_users TU,teams T WHERE TU.team_id=T.id AND TU.user_id = :u_id");
$team_user_stmt->bindValue(':u_id', $online_user['id']);
$team_user_stmt->execute();
$team_users = $team_user_stmt->fetchAll();

?>

<div id="teams" class="w3-container person">
    <div class="w3-container w3-margin w3-padding-large">
        <h3 id="contact"><b>Team List</b></h3>
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