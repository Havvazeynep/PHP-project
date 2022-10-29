<!-- Side Navigation -->
<nav class="w3-sidebar w3-bar-block w3-collapse w3-white w3-animate-left w3-card" style="z-index:3;width:320px;" id="mySidebar">
    <a href="index.php" class="w3-bar-item w3-button"><i class=" w3-margin-right"></i>HOME</a>
    <a href="javascript:void(0)" onclick="w3_close()" title="Close Sidemenu" class="w3-bar-item w3-button w3-hide-large w3-large">Close <i class="fa fa-remove"></i></a>
    <a href="javascript:void(0)" class="w3-bar-item w3-button w3-dark-grey w3-button w3-hover-black w3-left-align" onclick="document.getElementById('id01').style.display='block'">New Message <i class="w3-padding fa fa-pencil"></i></a>
    <a href="chat.php" class="w3-bar-item w3-button"><i class="fa fa-paper-plane w3-margin-right"></i>My Message</a>
    <a href="team.php" class="w3-bar-item w3-button"><i class="fa fa-paper-plane w3-margin-right"></i>My teams</a>
    <a href="profile.php" class="w3-bar-item w3-button"><i class="fa fa-user w3-margin-right"></i>Setting</a>
    <a href="#" class="w3-bar-item w3-button"><i class="fa fa-trash w3-margin-right"></i>Trash</a>
</nav>

<!-- Modal that pops up when you click on "New Message" -->
<div id="id01" class="w3-modal" style="z-index:4">
    <div class="w3-modal-content w3-animate-zoom">
        <div class="w3-container w3-padding w3-red">
            <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-red w3-right w3-xxlarge"><i class="fa fa-remove"></i></span>
            <h2>Send Mail</h2>
        </div>
        <div class="w3-panel">
            <form action="">
                <label>To</label>
                <input class="w3-input w3-border w3-margin-bottom" type="text" name="">
                <label>From</label>
                <input class="w3-input w3-border w3-margin-bottom" type="text">
                <label>Subject</label>
                <input class="w3-input w3-border w3-margin-bottom" type="text">
                <input class="w3-input w3-border w3-margin-bottom" style="height:150px" placeholder="What's on your mind?">
                <div class="w3-section">
                    <a class="w3-button w3-red" onclick="document.getElementById('id01').style.display='none'">Cancel  <i class="fa fa-remove"></i></a>
                    <a class="w3-button w3-light-grey w3-right" onclick="document.getElementById('id01').style.display='none'">Send  <i class="fa fa-paper-plane"></i></a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Overlay effect when opening the side navigation on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="Close Sidemenu" id="myOverlay"></div>