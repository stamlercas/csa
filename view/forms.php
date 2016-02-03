<?php
    $title = 'Forms';
    include '../view/headerInclude.php';
    ?>
    
    <section>
        <h1 style="float:left;">Forms</h1>
    <?php if (userIsAuthorized("addForm")) { ?>
        <input type="button" name="addButton" id='editButton' value='Add Form' style="margin-top:20px;float:right;"
               onclick='document.location="../forms/add";' /> <?php } ?>
    <div style="clear:both;"></div>
        <?php foreach ($results as $row) { ?>
        <div>
            <a href='<?php echo $row['Url'] ?>'><?php echo $row['Name'] ?></a>
            
            <?php if (userIsAuthorized("editForm")) { ?>
            <input type="button" name="editButton" id='editButton' value='Edit' 
                   onclick='document.location="../editForm/?FormID=<?php echo $row['FormID'] ?>";' />
            <?php } if (userIsAuthorized("deleteForm")) { ?>
            <input type="button" name="deleteButton" id='deleteButton' value='Delete'
                   onclick='deleteConfirm(<?php echo $row['FormID'] ?>);' />
            <?php } ?>
            
            <div style="font-size:small;padding-left:10px;">
                Last Updated: <?php echo date('m/d/Y g:i a', strtotime($row['LastUpdated'])) ?>
            </div>
            <?php if (!empty($row['Disclaimer']) || $row['Disclaimer'] != null) { ?>
            <div class="disclaimer">
                Disclaimer:  <?php echo $row['Disclaimer'] ?>
            </div>
            <?php } ?>
        </div>
        <?php } ?>
    </section>
    <script>
        function deleteConfirm(id, url)
        {
            if (confirm("Are you sure you want to delete this item?"))
                document.location="../forms/delete?FormID=" + id;
        }
    </script>

<?php include '../view/footerInclude.php' ?>