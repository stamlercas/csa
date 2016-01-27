<?php
    $title = $mode . ' Policy';
    include '../view/headerInclude.php';
?>

<section>
    <h1><?php echo $mode ?> Policy</h1>
    <?php if ($errors != '') { ?>
        <div class='errors'>
            <?php echo $errors ?>
        </div>
        <br />
        <?php } ?>
    <form enctype='multipart/form-data'
      action="../processAddEditPolicy/" method="post">
        <input hidden name="PolicyID" id="PolicyID" value="<?php echo $policyID ?>" />
        <input hidden name="Mode" id="Mode" value="<?php echo $mode ?>" />
        <div class="addEditForm">
            <label>Policy Name:</label>
            <input type="text" name="Name" id="Name" value="<?php echo htmlspecialchars($name)?>" 
                   required size='20' autofocus />
        </div>
        <div class="addEditForm">
            <label>Disclaimer:</label>
            <input type="text" name="Disclaimer" id="Disclaimer" value="<?php echo htmlspecialchars($disclaimer)?>" 
                   size='20' autofocus />
        </div>
        <div class='addEditForm'>
            <label>Upload New PDF:</label>
            <input type="checkbox" name="newPDF" id="newPDF" <?php if ($mode != "Edit") { echo 'checked'; } ?> 
                   onclick="disableEnable();" />
        </div>
        <div class="addEditForm">
            <label>Upload PDF:</label>
        <input name="userfile" type="file" id='File' <?php if ($mode == 'Edit') { echo 'disabled'; } ?> />
        </div>
        <br />
        <div class="addEditForm">
            <input type="submit" value="Save" />
        </div>
    </form>
</section>

<script>
    <?php if (isset($errors)) { ?>
        $('#errors').html(<?php echo $errors ?>);
    <?php } ?>
        
    //how to upload new image or not
    function disableEnable()
    {
        if ($("#File").prop('disabled')) 
            $("#File").prop('disabled', false);
        else $("#File").prop('disabled', true);
        
        if ($("#File").prop('required')) 
            $("#File").prop('required', false);
        else $("#File").prop('required', true);
        /*
        if ($("#File").prop('required'))
        {
            $("#fileRequired").addClass("required");
            $("#fileRequired").html("*");
        }
        else
        {
            $("#fileRequired").removeClass("required");
            $("#fileRequired").html("");
        }*/
        
    }
</script>

<?php include '../view/footerInclude.php' ?>
