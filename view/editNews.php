<?php
    $title = $mode . ' News';
    include '../view/headerInclude.php'
?>

    <section>
        <h1><?php echo $mode ?> News</h1>
        
        <?php if ($errors != '') { ?>
        <div class='errors'>
            <?php echo $errors ?>
        </div>
        <br />
        <?php } ?>
        
        <form id='form' action='../controller/index.php?action=processAddEditNews' method='post'>
            <input type='hidden' name='NewsID' value='<?php echo $newsID ?>' />
            <input type='hidden' name='Mode' value='<?php echo $mode ?>' />
            
            <div class='addEditForm'>
                <label>Headline:</label>
                <input type="text" name="Headline" id="Headline" value="<?php echo htmlspecialchars($headline)?>" 
                   required size='20' maxlength='100' autofocus />
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
