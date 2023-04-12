<?php
    include "connect.php";
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $title_done = 0;
        $nr_votes = 0;

        foreach ($_POST as $elem){
            if($title_done == 0){
                $sql_insert = "insert into polls (poll_title) values ('$elem')"; 
                mysqli_query($con,$sql_insert);

                $sql_search = "select * from polls where poll_title = '$elem'"; 
                $result_search = mysqli_query($con,$sql_search);

                $row_result = mysqli_fetch_assoc($result_search);
                $result_id = $row_result['poll_id'];

                $title_done += 1;
                continue;
            }
                $sql_insert_option = "insert into options(poll_id,option_name,nr_votes) values ('$result_id','$elem','$nr_votes')"; 
                mysqli_query($con,$sql_insert_option);
        }
            header("location:amenu.php");
            die;
    }
?>