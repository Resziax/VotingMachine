<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("location:login.php");
    die;
}


if($_SESSION['type'] != 0){
    header("location:menu.php");
    die;
}
?>

<!DOCTYPE html>
<html>
        <link rel="stylesheet" type="text/css" href="smenu.css" >
    <head>
        <title>Voting Machine - Admin Create Poll</title>
    </head>
<body>
    <div class="container">
        <p class="title">Voting Machine ADMIN Create Poll</p>
        <hr>
        <div class="logout-menu-buttons">
            <form action="menu.php" method="post" class="input-box">
                <button>Menu</button>
            </form>
            <form action="logout.php" method="post" class="input-box">
                <button>Log out</button>
            </form>
        </div>

            <div class="nr-option-box">
                <form action="" method="post" class="option-box">
                    <input type="text" name="onumber" placeholder="Number of options" autocomplete="off" required>
                    <button>Create Poll</button>
                </form>
            </div>

            <br>
            <div class = "container-form-box">
            <div class = "form-box">
                    <form action="addpoll.php" method="post" class="poll-box">
                    <?php 
                        if($_SERVER['REQUEST_METHOD'] == "POST"){
                            if(!empty($_POST['onumber']) && is_numeric($_POST['onumber'])){
                                    echo '<input type="text" name="title" placeholder="Poll Title" class="form-item" required>';
                                    for ($i = 1; $i <= $_POST['onumber']; $i++) {
                                        echo '<input type="text" name="option'.$i.'" placeholder="Option'.$i.'" class="form-item" autocomplete="off" required>'; 
                                    }
                                    echo '<button class="form-item">Done</button>';
                            }
                        }
                        ?>
                    </form>
                </div>
            </div>
    </div>

</body>
</html>
