<?php
    $title = 'News';
    include '../view/headerInclude.php';
?>

<section>
    <h1>News</h1>
    <hr />
        <?php if (userIsAuthorized("addNews")) { ?>
        <input type="button" name="addButton" id='editButton' value='Add News' 
               onclick='document.location="../news/add";' />
        <?php }  ?>
        <?php foreach ($results as $row) { ?>
            <div class='newsContent'>
                
                    <div class='newsItem'>
                        <h3>
                            <a href="../news/<?php echo $row['Slug'] ?>">
                                <?php echo $row['Headline'] ?>
                            </a>
                        </h3>
                        <div class="details">
                            <?php echo htmlspecialchars(dispDate($row['DateSubmitted'])) . " " . 
                                htmlspecialchars(dispTime($row['DateSubmitted'])) ?>
                             | Author: <?php echo $row['FirstName'] . " " . $row['LastName'] ?>

                        </div>
                        <a href="../news/<?php echo $row['Slug'] ?>">
                            <div class="description">
                                <img style='float:left;max-height:75px;padding-right:10px;' src='<?php echo $row['Image'] ?>' />
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
    
        <!-- PAGES ************************************************************************ -->
        <?php if ( !isset($_GET['NewsType'])) { ?>
        <div style='margin-top:15px;'>
            <h3 style='text-align:center;'>Pages</h3>
            <?php if ($page != 1) { ?>
                <div class='page'><a href='../news/?Page=1'><< First Page </a></div>
                <div class='page'><a href='../news/?Page=<?php echo $page - 1 ?>'>< Previous Page </a></div>
            <?php } $numOfPagesDisp = 5; ?>
            <?php if ($page < $numOfPagesDisp + 1)
                {
                    $listCount = $page;
                }
                else 
                {
                    $listCount = $numOfPagesDisp;
                }
                for ( $i = 1; $i < $listCount; $i++ ) {
            ?>
                <div class='page'><a href='../news/?Page=<?php echo $i ?>'>
                    <?php echo $i ?></a></div>
            <?php } //putting dots in place
                if ($page != 1 && $page > $numOfPagesDisp) { ?>
                    <div class='page'>...</div>
            <?php } ?>

            <?php   //never actually sure what newsCount is for....
                if ($page == $newsCount && $page > $numOfPagesDisp) {
                    for ( $i = $page - $numOfPagesDisp; $i < $page; $i++ ) { ?>
                        <div class='page'><a href='../news/?Page=<?php echo $i ?>'>
                    <?php echo $i ?></a></div>
            <?php } } ?>

                <div class='currentPage page'><?php echo $page ?></div>  
            <?php for ( $i = $page + 1; $i < $page + $numOfPagesDisp; $i++ ) { ?>
                <?php if ($i > $newsCount)
                        {
                            break;
                        } ?>
                <div class='page'><a href='../news/?Page=<?php echo $i ?>'>
                    <?php echo $i ?></a></div>
            <?php } //putting dots in place
                //if ( $page < $newsCount - $numOfPagesDisp) { ?>
                   <!-- <div class='page'>...</div> -->
            <?php //} ?> 


            <?php if ($page != $newsCount) { ?>
                <div class='page'><a href='../news/?Page=<?php echo $page + 1 ?>'> Next Page ></a></div>
                <div class='page'><a href='../news/?Page=<?php echo $newsCount ?>'> Last Page >></a></div>
        <?php } } ?>    
        </div>
        <div style="clear:both"></div>
    
</section>

<?php include '../view/footerInclude.php'; ?>