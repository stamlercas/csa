<?php
    $title = 'Edit ' . $cTitle;
    include '../view/headerInclude.php';
?>

    <section>
        <h1><?php echo $title ?></h1>
        
        <?php if ($errors != '') { ?>
        <div class='errors'>
            <?php echo $errors ?>
        </div>
        <br />
        <?php } ?>
        
        <form id='form'
              action='../processEditContent/' method='post'>
            <input type='hidden' name='ContentID' value='<?php echo $contentID ?>' />
            <input type='hidden' name='Url' value='<?php echo $url ?>' />
            
            <div class='addEditForm'>
                <label>Title:</label>
                <input type="text" name="Title" id="Title" value="<?php echo htmlspecialchars($cTitle)?>" 
                   required size='20' maxlength='50' autofocus />
            </div>
            
            <br />
            
            <div class="addEditForm">
                <label>Content:</label>
                <textarea name="Content" id="Content"><?php echo $content ?></textarea>
            </div>
            
            <br />
            
            <div class="addEditForm">
                <input type="submit" name="SubmitButton" value="Save" />
            </div>
        </form>
    </section>
    
    <script>tinymce.init({selector:'textarea'});</script>

<?php include '../view/footerInclude.php' ?>

