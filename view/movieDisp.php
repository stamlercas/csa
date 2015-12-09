<?php
    $title = $row['Title'];
    include '../view/headerInclude.php';
    
    require_once '../lib/MovieTrailer.php';
?>
<div id="movieBackdrop" class='movieBackdrop' 
     style="background-image:url('..<?php echo htmlspecialchars($row['Backdrop']) ?>');"></div>
    <section>
        
        <div id='movieHeader'>
            <div id='moviePoster'>
                <img src='<?php echo '../' . htmlspecialchars($row['Poster']); ?>' 
                     alt="<?php echo htmlspecialchars($row['Title']) ?>" width=250 />
            </div>
            <div id='movieTitle'>
                <h2><?php echo htmlspecialchars($row['Title']) ?></h2>
                <p style="font-size:small;"><?php echo htmlspecialchars($row['Tagline']) ?></p>
                <p>Release Date: <?php echo dispDate(htmlspecialchars($row['ReleaseDate'])) ?></p>
                <div id="movieDesc">
                    <?php echo htmlspecialchars($row['Description']) ?>
                </div>
                <br />
                <div id="ytplayer" style="margin:0 auto;"></div>
                <div style='clear:both;'></div>
        </div>
        
    <?php if (!empty($movieSchedule)) { ?>
        <table id='movieTable'>
        <tr id='movieHeading'>
            <?php
                //get today
                //echo '<th>' . date('D m/j', time()) . '</th>';
                //get the rest 6 days
                for ($i = 0; $i <= 6; $i++)
                {
                    echo '<th>' . date('D m/j', time() + 86400 * $i) . '</th>';     //86400 is number of seconds in a day
                }
            ?>
        </tr>
        
        <?php
                //STRIPPED DOWN VERSION FOR ONLY ONE MOVIE
                echo "<tr style='background-color:#eee;'>";
                
                //the days
                for ($j = 0; $j < 7; $j++)
                {
                    //beginning of cell
                    echo '<td>';
                        
                    //the dates are in results array
                    foreach ($movieSchedule as $date)
                    {
                            //the same days
                            if ( date('m/j', time() + 86400 * $j) == date('m/j', strtotime($date['Date']) ) )
                            {
                                echo dispTime($date['Date']) . '<br />';
                            }
                    }
                    //end of cell
                    echo '</td>';
                }
                //end of row
                echo '</tr>';
            
        ?>
        
    </table>
<?php } ?>
    </section>

<script>
  // Load the IFrame Player API code asynchronously.
  var tag = document.createElement('script');
  tag.src = "https://www.youtube.com/player_api";
  var firstScriptTag = document.getElementsByTagName('script')[0];
  firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

  // Replace the 'ytplayer' element with an <iframe> and
  // YouTube player after the API code downloads.
  var player;
  function onYouTubePlayerAPIReady() {
    player = new YT.Player('ytplayer', {
      height: '290',
      width: '480',
      videoId: '<?php 
                    $trailer = new MovieTrailer($row['Title'], date("Y", strtotime($row['ReleaseDate'])) );
                    echo $trailer->getID();
                ?>'
    });
  }
  
  var headerHeight = $('header').outerHeight() + "px";
  $('#movieBackdrop').css("top", headerHeight);
  //alert("'" + $('header').outerHeight() + "px'");
</script>

<?php include '../view/footerInclude.php' ?>
