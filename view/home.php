<?php
    $title = "Clarion Students' Association";
    include '../view/headerInclude.php';
?>

<section class='homepage'>
    
    <div id="slider1_container" style="position: relative; top: 0px; left: 0px; width: 600px; height: 250px; overflow: hidden;">
    <!-- Slides Container -->
        <div u="slides" style="cursor: move; position: absolute; overflow: hidden; left: 0px; top: 0px; width: 600px; height: 250px;">
            <?php
                //uses the function to get pictures in directory and
                //use it for the slideshow
                $current_dir = '../img/slideshow/';
                $dir = opendir($current_dir);
                while(false !== ($file = readdir($dir))){
                        //strip out the two entries of . and ..
                        //not valid files
                        if($file != "." && $file != "..")
                        {
                            echo "<div><img u='image' src='$current_dir/$file' /></div>";

                        }
                }
                closedir($dir);
            ?>
        </div>
    </div>
</section>

<hr style='width:75%;'/>

<section>
    <div id="homepageContent">
        <div class="left">
            <!-- ********** NEWS ********** -->
            <h2>Latest News</h2>
                <?php foreach ($newsResults as $row) { ?>
                <div class='newsContent'>

                        <div class='newsItem'>
                            <h4>
                                <a href="../news/<?php echo $row['Slug'] ?>">
                                    <?php echo $row['Headline'] ?>
                                </a>
                            </h4>
                            <div class="details">
                                <?php echo htmlspecialchars(dispDate($row['DateSubmitted'])) . " " . 
                                    htmlspecialchars(dispTime($row['DateSubmitted'])) ?>
                                 | Author: <?php echo $row['UserName'] ?>

                            </div>
                            <a href="../news/<?php echo $row['Slug'] ?>">
                                <div class="description">
                                    <img style='float:left;max-height:50px;padding-right:10px;' src='<?php echo $row['Image'] ?>' />
                                    <div class='descriptionTxt'>
                                        <?php //length of substring for accoutName
                                            $substrLength = 27; 
                                            echo TinyMCESubStr($row['Content'],0,$substrLength);
                                            if (strlen($row['Content']) > $substrLength) { echo '...'; } 
                                        ?>
                                    </div>
                                    <div style='clear:both;'></div>
                                </div>
                            </a>
                        </div>
                    </a>
                </div>
            <?php } ?>
            <br />
            <a href='../news/' style='font-size:medium;'>See More...</a>
            
            <!-- ********** SCHOLARSHIPS ********** -->
            <h2>Scholarships</h2>
            <div>
                Paragraph about scholars the Clarion Students' Association awards
            </div>
        </div>
        
        <div class="right">
            <!-- ********** APPLE ********** -->
            <h2>
                The Latest With The Apple
            </h2>
            
            <a href="../apple/">
                <img src="<?php echo $appleItem['ImagePath'] ?>" 
                     alt="<?php echo $appleItem['Title'] ?>" width="450" />
            </a>
            
            <!-- ********** MOVIES ********** -->
            <h2>
                Movies Currently Showing
            </h2>
            
            <div>
                <?php foreach ($movieItems as $movie) { ?>
                    <a href="../movies/<?php echo $movie['MovieID'] ?>">
                        <div class="moviePosterDisplay" style="width:75px;margin:5px;">
                            <img src="..<?php echo $movie['Poster'] ?>" width="75" alt="<?php echo $movie['Title'] ?>" />
                            <br />
                            <?php echo $movie['Title'] ?>
                        </div>
                    </a>
                <?php } ?>
                <div style="clear:both"></div>
                
                <a href="../movies/">See all showings...</a>
                
            </div>
            
            
        </div>
        
        <div style="clear:both;"></div>
    </div>
    
</section>

<script>jssor_slider1_starter('slider1_container');</script>

<?php include '../view/footerInclude.php'; ?>