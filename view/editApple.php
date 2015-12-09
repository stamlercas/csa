<?php
    $title = 'Apple Gallery File Upload';
    include '../view/headerInclude.php';
?>

<section>
    <h1>Apple Image Upload</h1>
    <div id="errors"></div>
    <form enctype='multipart/form-data'
      action="../processAddEditApple/" method="post">
        <input hidden name="AppleID" id="AppleID" value="<?php echo $appleID ?>" />
        <input hidden name="Mode" id="Mode" value="<?php echo $mode ?>" />
        <div class="addEditForm">
            <label>Upload this image:</label>
        <input name="userfile" type="file" <?php if ($mode == 'Edit') { echo 'disabled'; } ?> />
        </div>
        <br />
        
        <div class="addEditForm">
            <label>Title: <span style="font-weight:normal;">(optional)</span></label>
            <input type="text" id="Title" name="Title" value="<?php echo htmlspecialchars($appleTitle) ?>" 
                   maxlength="100" />
        </div>
        <div class="addEditForm">
            <input type="submit" value="Save" />
        </div>
    </form>
</section>

<script>
    <?php if (isset($errors)) { ?>
        $('#errors').html(<?php echo $errors ?>);
    <?php } ?>
</script>

<?php include '../view/footerInclude.php' ?>

