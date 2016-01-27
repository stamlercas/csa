<?php
    $title = 'Policies';
    include '../view/headerInclude.php';
    ?>
    
    <section>
        <h1>Policies</h1>
        <?php foreach ($results as $row) { ?>
        <div>
            <a href='<?php echo $row['Url'] ?>'><?php echo $row['Name'] ?></a>
            
            <?php if (userIsAuthorized("editPolicy")) { ?>
            <input type="button" name="editButton" id='editButton' value='Edit' 
                   onclick='document.location="../editPolicy/?PolicyID=<?php echo $row['PolicyID'] ?>";' />
            <?php } if (userIsAuthorized("deletePolicy")) { ?>
            <input type="button" name="deleteButton" id='deleteButton' value='Delete'
                   onclick='deleteConfirm();' />
            <?php } ?>
            
            <?php if (!empty($row['Disclaimer']) || $row['Disclaimer'] != null) { ?>
            <div style='font-size:small;padding-left:10px;'>
                Disclaimer:  <?php echo $row['Disclaimer'] ?>
            </div>
            <?php } ?>
        </div>
        <?php } ?>
    </section>

<?php include '../view/footerInclude.php' ?>