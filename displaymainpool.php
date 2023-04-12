<?php     
    $sql_select_polls = "select * from polls";
    $query_polls = mysqli_query($con,$sql_select_polls);
    $query_result = mysqli_num_rows($query_polls);

    if(isset($_GET['poll_id'])){

        if(!isset($_POST['optiune'])){//NO option picked => show options
            $selected_poll_id = mysqli_real_escape_string($con, $_GET['poll_id']);
            $result_poll = mysqli_query($con,"select * from polls where poll_id = '$selected_poll_id'");
            $row_poll = mysqli_fetch_assoc($result_poll);

            $connected_user = $_SESSION['user_id'];
            $result_poll_user_vote = mysqli_query($con,"select * from votes where poll_id = '$selected_poll_id' and user_id = '$connected_user'");
            $row_poll_vote = mysqli_num_rows($result_poll_user_vote);

            if($row_poll_vote == 0){//if in values table user_id and poll id are NOT on a row show options
                if(mysqli_num_rows($result_poll) > 0){
                    echo '<br>      <p style="font-size: 22px; margin: 0;">'.$row_poll['poll_title'].'</p>      <br>';

                    $result_options = mysqli_query($con,"select * from options where poll_id = '$selected_poll_id'");
                        echo '<form action="" method="post" class="poll-box"">';

                    while($row_option = mysqli_fetch_assoc($result_options)){
                        echo '<input type="submit" name="optiune" value="'.$row_option['option_name'].'" class="poll-item">';
                    }
                    echo '</form>';
                }
            }
            
            else{//option picked => show stats
                $selected_id_poll = mysqli_real_escape_string($con, $_GET['poll_id']);
                $connected_user = $_SESSION['user_id'];
        
                $result_polls = mysqli_query($con,"select * from polls where poll_id = '$selected_id_poll'");
                $row_poll = mysqli_fetch_assoc($result_polls);
                echo '<br>      <p>'.$row_poll['poll_title'].'</p>      <br>';
        
                $result_options = mysqli_query($con,"select * from options where poll_id = '$selected_id_poll'");
        
                while($row_option = mysqli_fetch_assoc($result_options)){
                    echo '<p>'.$row_option['option_name'].' ('.$row_option['nr_votes'].' votes)</p>';
                }
            }
        }
        else{//option picked => show stats
            $selected_option = $_POST['optiune'];
            $selected_id_poll = mysqli_real_escape_string($con, $_GET['poll_id']);
            $connected_user = $_SESSION['user_id'];
    
            $sql_update_vote = "update options set nr_votes = nr_votes + 1 where poll_id = '$selected_id_poll' and option_name ='$selected_option'";
            mysqli_query($con, $sql_update_vote);
    
            $sql_add_user_vote = "insert into votes (user_id, poll_id) values ('$connected_user','$selected_id_poll')";
            mysqli_query($con, $sql_add_user_vote);
    
            $result_polls = mysqli_query($con,"select * from polls where poll_id = '$selected_id_poll'");
            $row_poll = mysqli_fetch_assoc($result_polls);
            echo '<br>      <p>'.$row_poll['poll_title'].'</p>      <br>';
    
            $result_options = mysqli_query($con,"select * from options where poll_id = '$selected_id_poll'");
    
            while($row_option = mysqli_fetch_assoc($result_options)){
                echo '<p>'.$row_option['option_name'].' ('.$row_option['nr_votes'].' votes)</p>';
            }
        }
    }
?>