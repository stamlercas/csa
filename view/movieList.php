<?php
    $title = 'Complete Movie Schedule';
    include '../view/headerInclude.php';
?>

<section>
    <h1>All Movies</h1>
    <div id="movieList">
        <ul class="movieList">
            <?php 
            //results is ordered by movieID, so all dates for a specific movie will be grouped together
            $movieID = '';
            foreach ($results as $row) 
            {
                echo "<li class='movieListItem'><label><a href='../movies/" . $row['MovieID'] . "'>"
                        . $row['Title'] . "</a></label>";
                        if (userIsAuthorized("deleteDate")) { ?>
                            <input type="button" name="deleteButton" id='deleteButton' value='Delete' 
                                   style="margin-left: 20px;"
                            onclick="deleteConfirm( '<?php echo $row['MovieID'] ?>' );" />
            <?php           } echo "</li>";
            }
            ?>
        </ul>
    </div>
    
</section>

<script>
    function deleteConfirm(id)
    {
        if (confirm("Are you sure you want to delete this item?"))
            document.location="../movies/deleteMovie?MovieID=" + id;
    }
</script>

<?php
    include '../view/footerInclude.php';
?>

