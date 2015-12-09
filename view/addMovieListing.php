<?php
    $title = 'Add Movie Showing';
    include '../view/headerInclude.php';
?>

<section>
    <h1>Add Movie Showing</h1>
    
    <div style="width:330px;float:left;">
        <div id="msg"></div>

        <br />
    
    
        <form id='submitForm' action='../processAddMovieListing/' method="post">
            <div class='addEditForm'>
                <label>Movie:</label>
                <select name="Movie" id="Movie" onchange="showPoster()">
                    <option>Movies...</option>
                    <?php foreach ($movieList as $movie) { ?>
                        <option value="<?php echo $movie['MovieID'] ?>" >
                                <?php echo $movie['Title'] ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <br />

            <div class="addEditForm">
                <label>Date:</label>
                <input type='date' name="Date" id="Date" required />
            </div>

            <br />

            <div class="addEditForm">
                <label>Time:</label>
                <input type='time' name="Time" id="Time" required />
            </div>

            <br />

            <div class="addEditForm">
                <input type="submit" name="SubmitButton" value="Save" />
            </div>

        </form>
    </div>
    
    <div id='poster' style="float:left;padding-left:25%;"></div>
    <div style='clear:both;'></div>
    
</section>

<script>
    
    //get php movielist array
    var movies = <?php echo json_encode( $movieList ) ?>;
    
    $("form").submit( function(event) {
        //prevent default action of form
        event.preventDefault();

        var movieID = $("#Movie").val();  //the movie id to place in table
        var date = $('form').find( "input[name='Date']" ).val();
        var time = $('form').find( "input[name='Time']" ).val();

       $.ajax({
            type: 'POST',
            url: '../processAddMovieListing/',
            data: 'MovieID=' + movieID + '&Date=' + date + '&Time=' + time,
            dataType: 'text',
            cache: false,
            success: function(result) {
                $('#msg').html(result);
            }
        })  //no semicolon for whatever reason....
    });
    
    function showPoster()
    {
        var i = $('#Movie').prop("selectedIndex") - 1;
        $('#poster').html( "<img width=200 src='" + '..' + 
                JSON.stringify(movies[i].Poster).substring(1, JSON.stringify(movies[i].Poster).length - 1) + "' />");
    }
</script>

<?php include '../view/footerInclude.php' ?>
