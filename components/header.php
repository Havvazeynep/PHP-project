<?php
if (isset($_SESSION['user'])) {
  require_once './db/connect.php';

  $online_user = $_SESSION['user'];
  $online_id = $online_user['id'];

  $stmt = $conn->prepare("SELECT * FROM users WHERE id = :u_id;");
  $stmt->bindParam(':u_id', $online_id);
  $stmt->execute();
  $user = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<div class="w3-top">
  <a class="w3-bar w3-row" id="myNavbar">
    <a class="w3-bar-item w3-button w3-hover-black w3-hide-medium w3-hide-large w3-right" href="javascript:void(0);" onclick="toggleFunction()" title="Toggle Navigation Menu">
      <i class="fa fa-bars"></i>
    </a>
    <a href="index.php" class="w3-bar-item w3-button  w3-hide-small">HOME</a>
    <a href="#about" class="w3-bar-item w3-button w3-hide-small"><i class="fa fa-user"></i> ABOUT</a>
    <a href="#portfolio" class="w3-bar-item w3-button w3-hide-small"><i class="fa fa-th"></i> PORTFOLIO</a>
    <a href="contact.php" class="w3-bar-item w3-button w3-hide-small"><i class="fa fa-envelope"></i> CONTACT</a>
    <?php if (isset($_SESSION['user'])) { ?>
      <div class="w3-dropdown-hover w3-right">
        <button class="w3-button w3-bar-item w3-hide-small w3-hover-red"><i class="fa fa-user"></i> <?php echo $user['firstname'] ?></button>
        <div class="w3-dropdown-content w3-bar-block w3-border" style="right:0">
          <a href="profile.php" class="w3-bar-item w3-button w3-hover-red w3-hide-small"> My Profile</a>
          <a href="messages.php" class="w3-bar-item w3-button w3-hover-red w3-hide-small"> My Messages</a>
          <a href="./db/logout.php" class="w3-bar-item w3-button w3-hover-red w3-hide-small"> Logout</a>
        </div>
      </div>
    <?php } else { ?>
      <a href="register.php" class="w3-bar-item w3-button w3-hide-small w3-right w3-hover-red">
        <i class="fa fa-user"></i> Register
      </a>
      <a href="login.php" class="w3-bar-item w3-button w3-hide-small w3-right w3-hover-red">
        <i class="fa fa-user"></i> LogIn
      </a>
    <?php } ?>
    <!-- <a href="#" class="w3-bar-item w3-button w3-hide-small w3-right w3-hover-red">
      <i class="fa fa-search"></i>
    </a> -->
</div>

<!-- Navbar on small screens -->
<div id="navDemo" class="w3-bar-block w3-white w3-hide w3-hide-large w3-hide-medium">
  <a href="index.php" class="w3-bar-item w3-button" onclick="toggleFunction()">HOME</a>
  <a href="#portfolio" class="w3-bar-item w3-button" onclick="toggleFunction()">PORTFOLIO</a>
  <a href="#contact" class="w3-bar-item w3-button" onclick="toggleFunction()">CONTACT</a>
  <a href="contact.php" class="w3-bar-item w3-button">CONTACT</a>
  <?php if (isset($_SESSION['user'])) { ?>
    <a href="profile.php" class="w3-bar-item w3-button" onclick="toggleFunction()"><?php echo $user['firstname'] ?></a>
    <a href="messages.php" class="w3-bar-item w3-button" onclick="toggleFunction()">My Messages</a>
    <a href="team.php" class="w3-bar-item w3-button" onclick="toggleFunction()">My Teams</a>
    <a href="./db/logout.php" class="w3-bar-item w3-button">LogOut</a>
  <?php } else { ?>
    <a href="login.php" class="w3-bar-item w3-button" onclick="toggleFunction()">LogIn</a>
    <a href="register.php" class="w3-bar-item w3-button" onclick="toggleFunction()">Register</a>
  <?php } ?>
</div>