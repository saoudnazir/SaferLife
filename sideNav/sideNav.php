<?php
echo '
    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()"><i class="fas fa-bars" style="font-size: 30px; color: white; margin: 10px 10px 10px 10px;"></i></a>
        <a href="../index.php">Home</a>
        <a href="../add-new-record1/add-new-record.php">Add New Record</a>
        <a href="../search/search.php">Search In List</a>
        <a href="../logout/logout.php">Log Out</a>
    </div>
    <a onclick="openNav()"><i class="fas fa-bars openNavBtn" style="font-size: 30px; color: #0000e6; margin: 10px 10px 10px 10px;"></i></a>
    <script>
        function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
        document.getElementById("main").style.marginLeft = "250px";
        }

        function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
        document.getElementById("main").style.marginLeft= "0";
        }
    </script>
';
?>