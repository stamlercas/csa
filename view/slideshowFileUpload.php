<?php
    $title = 'Upload Image for Slideshow';
    include '../view/headerInclude.php';
?>

<section>
    <div><?php echo $msg ?></div>
    <h1>Upload Slideshow Image Here</h1>
    <div class='warning'>
        Note:  Images should be 1920x1080 or keep the same aspect ratio.  If not, the image will not fully display.
    </div>
    
    <br />
    
    <form enctype='multipart/form-data'
      action="../controller/index.php?action=processSlideshowFileUpload" method="post">
        Upload this image: 
        <input name="userfile" type="file" />
        <input type="submit" value="Send Image" />
    </form>
    
    <h2>Current Images</h2>
    <div style='margin-left:20px;'>
        <form action='../controller/index.php?action=processSlideshowFileDelete' method='post' onsubmit="return deleteConfirm()">
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
                            echo "<input type='radio' style='margin:20px;' name='img' value='$current_dir$file' />"
                                    . "<img src='$current_dir$file' width=250 />";

                        }
                }
                closedir($dir);
            ?>
            <br />
            <?php if (userIsAuthorized('processSlideshowFileDelete')) { ?>
            <input id='Delete' type="submit" value="Delete Selected Image">
            <?php } ?>
        </form>
    </div>
</section>

<script>
    function deleteConfirm()
        {
            var valid = confirm("Are you sure you want to delete this item?");
            if (!valid)
                return false;
            else
                return true;
        }
</script>

<?php include '../view/footerInclude.php'; ?>