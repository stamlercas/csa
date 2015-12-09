<?php
    $title = 'Complete Movie Schedule';
    include '../view/headerInclude.php';
?>

<section>
    <h1>Movie Schedule</h1>
    <div id="movieList">
        <ul class="movieList">
            <?php 
            //results is ordered by movieID, so all dates for a specific movie will be grouped together
            $movieID = '';
            foreach ($results as $row) 
            { 
                //if movieID no longer matches, move onto next section
                if ($movieID != $row['MovieID'])
                {
                    $movieID = $row['MovieID'];
                    echo "<h3><a href='../movies/" . $row['MovieID'] . "'>" . $row['Title']. "</a></h3>";
                }
                echo "<li class='movieScheduleItem'>" . date('m/d/Y | g:i a', strtotime($row['Date']));
                        if (userIsAuthorized("deleteDate")) { ?>
                            <input type="button" name="deleteButton" id='deleteButton' value='Delete' 
                                   style="margin-left: 20px;"
                            onclick="deleteConfirm( '<?php echo $row['Date'] ?>' );" />
            <?php           } echo "</li>";
            }
            ?>
        </ul>
    </div>
    
</section>

<script>
    function deleteConfirm(date)
    {
        if (confirm("Are you sure you want to delete this item?"))
            document.location="../movies/deleteDate?Date=" + date;
    }
</script>

<?php
    include '../view/footerInclude.php';
?>

