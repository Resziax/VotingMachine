<?php
     session_start();
     include "connect.php";
     if(isset($_SESSION['user_id']))
            {
                unset($_SESSION['user_id']);
                header("location:login.php");
                die;
            }
?>