<?php
    $title = "Showtimes";
    include '../view/headerInclude.php';
?>

<section>
    <h1>
        Showtimes
    </h1>
    
    <table id='movieTable'>
        <tr id='movieHeading'>
            <th>
                Movie
            </th>
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
            for ($i = 0; $i < count($movieItems); $i++)
            {
                echo "<tr ";
                
                if ($i % 2 != 0) {
                    echo "style='background-color:#eee;'";
                }
                
                echo "><td><a href='../movies/" . $movieItems[$i]['MovieID'] . "'>"
                        . htmlspecialchars( ($movieItems[$i]['Title'] ) ) . '</a></td>';
                //the days
                for ($j = 0; $j < 7; $j++)
                {
                    //beginning of cell
                    echo '<td>';
                        
                    //the dates are in results array
                    foreach ($results as $row)
                    {
                        if ($movieItems[$i]['Title'] == $row['Title'])
                        {
                            //the same days
                            if ( date('m/j', time() + 86400 * $j) == date('m/j', strtotime($row['Date']) ) )
                            {
                                echo dispTime($row['Date']) . '<br />';
                            }
                        }
                    }
                    //end of cell
                    echo '</td>';
                }
                //end of row
                echo '</tr>';
            }
        ?>
        
    </table>
    
    <br />
    
    <div>
        <?php foreach ($movieItems as $movie) { ?>
            <a href="../movies/<?php echo $movie['MovieID'] ?>">
                <div class="moviePosterDisplay">
                    <img src="..<?php echo $movie['Poster'] ?>" width="150" alt="<?php echo $movie['Title'] ?>" />
                    <br />
                    <?php echo $movie['Title'] ?>
                </div>
            </a>
        <?php } ?>
        <div style="clear:both"></div>
    </div>
    
    
</section>



<?php include '../view/footerInclude.php'; ?>

