<?php
    $dbhost="localhost";
    $dbuser="root";
    $dbpassword="";
    $dbname="votingm";
    $con= mysqli_connect($dbhost,$dbuser,$dbpassword,$dbname);
    if(!$con)
    {
        die("Connection Failed!");
    }
?>