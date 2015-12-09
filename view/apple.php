<?php
    $title = 'The Apple';
    include '../view/headerInclude.php';
?>

<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/themes/south-street/jquery-ui.css" id="theme">
<link rel="stylesheet" href="//blueimp.github.io/Gallery/css/blueimp-gallery.min.css">
<!-- ISSUE WITH SLICKNAV for mobile
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> 
-->
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/jquery-ui.min.js"></script>
<script src="//blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
<script src="../js/jquery.image-gallery.min.js"></script>

<section>
    <h1 style="float:left;">The Apple</h1>
    <?php if (userIsAuthorized("addApple")) { ?>
        <input type="button" name="addButton" id='editButton' value='Add Image' style="margin-top:20px;float:right;"
               onclick='document.location="../apple/add";' /> <?php } ?>
    <div style="clear:both;"></div>
    
    
    <div style="margin:0 auto;">
        <div id="links">
            <?php $firstPic = true; foreach ($results as $row) { ?>
            <div style='float:left;'>
                <a href="<?php echo htmlspecialchars($row['ImagePath']) ?>" 
                   title="<?php echo htmlspecialchars($row['Title']) ?>" data-dialog>
                    <img src="<?php echo htmlspecialchars($row['ImagePath']) ?>" 
                        <?php //the latest picture is biggest for formatting
                            if ($firstPic)
                                {
                                    echo "style='max-width:100%;max-height:400px;' ";
                                }
                                else
                                {
                                    echo "width=125 ";
                                }
                         ?>
                         style='padding:5px;vertical-align:middle;' />
                </a>
                <br />
                <?php //buttons for editing/deleting
                    if (userIsAuthorized("editApple")) { ?>
                <input type="button" name="editButton" id='editButton' value='Edit' 
                       onclick='document.location="../apple/edit?AppleID=<?php echo $row['AppleID'] ?>";' />
                <?php } if (userIsAuthorized("deleteApple")) { ?>
                <input type="button" name="deleteButton" id='deleteButton' value='Delete'
                       onclick="deleteConfirm( <?php echo $row['AppleID'] ?>, '<?php echo $row['ImagePath'] ?>' );" />
                <?php } ?>
            </div>
                         <?php if ($firstPic) { ?>
            <div style='clear:both;'></div>
            <div style="padding:20px;">
                Clarion Students' Association, in collaboration with the Traditions Council, 
                unveiled an apple sculpture Sept. 7, 2013, on the lawn of Grunenwald Center for Science and Technology. 
                Students have embraced this new canvas to share their thoughts and promote their organizations. 
                "Painting on the apple is very popular, even during winter," said  Kaitlyn Jones, a recent graduate of the 
                Communication program. "You are lucky if your message remains on the apple for 24 hours.  The space is very 
                much in demand." Funded through the CSA Special Projects Fund, the apple sculpture honors Clarion University's 
                long-standing commitment to education since its founding as Clarion Seminary in 1867.
            </div>
            <div style="clear:both;"></div>
            
            <?php $firstPic = false; } } ?>
        </div>
        <div style='clear:both;'></div>
    </div>
    
</section>

<!-- The dialog widget -->
<div id="blueimp-gallery-dialog" data-show="fade" data-hide="fade">
    <!-- The gallery widget  -->
    <div class="blueimp-gallery blueimp-gallery-carousel blueimp-gallery-controls">
        <div class="slides"></div>
        <a class="prev">‹</a>
        <a class="next">›</a>
        <a class="play-pause"></a>
    </div>
</div>

<script>
$('#gallery').pinbox().hide(0).fadeIn(1000);
var options = {
        newitemindicator : "new",
        subcontainer : ".img" 
};
$('#gallery').pinbox(options);

    function deleteConfirm(id, imgPath)
    {
        if (confirm("Are you sure you want to delete this item?"))
            document.location="../apple/delete?AppleID=" + id + "&ImagePath=" + imgPath;
    }
</script>

<?php include '../view/footerInclude.php'; ?>