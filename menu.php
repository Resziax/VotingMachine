<?php
include "connect.php";
session_start();
if(!isset($_SESSION['user_id'])){
    header("location:login.php");
    die;
}
?>

<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="smenu.css" >
    <head>
        <title>Voting Machine - Menu</title>
    </head>
    <body>
        <div class="container">
            <p class="title">Voting Machine</p>
            <hr>
            <div class="logout-menu-buttons">
                <?php
                    if($_SESSION['type'] == 0){
                        echo '<form action="amenu.php" method="post" class="input-box">
                                <button>Admin Menu</button>
                             </form>';
                    }
                ?>
            <form action="logout.php" method="post" class="input-box">
                <button>Log out</button>
            </form>
        </div>
            <div class = "maindiv">
                <div class = "scroll">
                    <?php include "displaypolls.php"; ?>
                </div>
                <div class = "statistics">
                    <div class="statistics-poll">
                        <?php include "displaymainpool.php"; ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>