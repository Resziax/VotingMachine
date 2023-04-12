<?php     
    $sql_select_polls = "select * from polls";
    $query_polls = mysqli_query($con,$sql_select_polls);
    $query_result = mysqli_num_rows($query_polls);
    if($query_result > 0){
        while($row = mysqli_fetch_assoc($query_polls)){
    echo '<a href="menu.php?poll_id='.$row['poll_id'].'" class="pool-link">
            <div class="poll-div">
                <p style="padding: 10px 0px 10px 0px">' . $row['poll_title'] . '</p>
            </div>
        </a>';
        }
    }

    else{
        echo "There are no polls yet.";
    }
?>