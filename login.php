<!DOCTYPE html>
<html>
    <link rel="stylesheet" type="text/css" href="slogin.css" >
    <head>
        <meta charset="UTF-8">
        <title>Voting Machine - Login</title>
    </head>

    <body>
        <center>

            <form action="#" method="post" class="input-box">
                <p class="titlu1">Voting Machine</p>
                <hr>
                <p class="titlu">Login</p>
                <p style="color:red;">
        <?php
            session_start();
            include "connect.php";
            
            if(isset($_SESSION['user_id'])){
                header("location:menu.php");
                die;
            }

            if($_SERVER['REQUEST_METHOD'] == "POST")
            {
                $username = $_POST['username'];
                $password = $_POST['password'];
                $password = md5($password);


                if(!empty($username) && !empty($password)){
                    $query_login = mysqli_query($con,"select * from users where username = '$username'"); 

                    if($query_login){
                        if(mysqli_num_rows($query_login) > 0){
                            $user_data = mysqli_fetch_assoc($query_login);

                            if($user_data['password'] == $password){
                                $_SESSION['user_id']= $user_data['user_id'];
                                $_SESSION['type'] = $user_data['type'];
                                if($user_data['type'] == 0){
                                    header("location:amenu.php");
                                    die;
                                }
                                header("location:menu.php");
                                die;
                            }
                            else{
                                echo "Username or password is not correct!";
                            }
                        }
                    }
                    else{
                        echo "Username or password is not correct!";
                    }
                }          
                else{
                    echo "Invalid information!";
                }
            }
        ?>
    </p>

                <input type="text" name="username" placeholder="Username" autocomplete="off" required>
                <input type="password" name="password" placeholder="Password" autocomplete="off" required>
                <button>Login</button><br>
                <p>Not registered?</p><a href="register.php"> Register now!</a>
            </form>
        </center>
</body>
</html>