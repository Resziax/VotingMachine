<!DOCTYPE html>
<html>
    <link rel="stylesheet" type="text/css" href="sregister.css" >
<head>
    <meta charset="UTF-8">
    <title>Voting Machine - Register</title>
</head>
<body>
    <center>
        <form action="#" method="post" class="input-boxr">
            <p class="rtitlu1">Voting Machine</p>
            <hr>
            <p class="rtitlu">Register</p>

            <p style="color:red;">
        <?php
            session_start();
            include "connect.php";
            
            if(isset($_SESSION['user_id']))
            {
                header("location:");
                die;
            }

            if($_SERVER['REQUEST_METHOD'] == "POST")
            {
                $username = $_POST['username'];
                $password = $_POST['password'];
                $cpassword = $_POST['cpassword'];
                $type = 1;

                if(!empty($username) && !empty($password) && !empty($cpassword)){
                    $query_username = mysqli_query($con,"select * from users where username = '$username'"); 
                    $result_username = mysqli_num_rows($query_username);

                    if($result_username == 0){
                        if(strlen($password) >= 8){
                            if($password == $cpassword){
                                $password = md5($password);
                                $query_register = "insert into users(username,password,type) values('$username','$password','$type')";

                                mysqli_query($con, $query_register);
                                header("location:login.php");
                                die;
                            }
                            else{
                                echo "Password doesn't match!";
                            }
                        }
                        else{
                            echo "Password must be at least 8 characters long!";
                        }
                    }
                    else{
                        echo "Username already used!";
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
            <input type="password" name="cpassword" placeholder="Confirm Password" autocomplete="off" required>
            <button>Register</button><br>
            <p>Already have an account?</p><a href="login.php">Sign in here!</a>
        </form>
    </center>   
</body>
</html>