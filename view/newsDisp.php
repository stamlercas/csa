<?php
    $title = $row['Headline'];
    include '../view/headerInclude.php';
?>

<section>
    <div id='newsItem'>
        <h1><?php echo $row['Headline'] ?></h1>
        <div class="details">
            <?php echo htmlspecialchars(dispDate($row['DateSubmitted'])) . " " . 
                htmlspecialchars(dispTime($row['DateSubmitted'])) ?>
             | Author: <?php echo $row['UserName'] ?>
        </div>
        <div class='details'>
            <?php 
                if (!empty( $row['DateEdited'] ))
                { ?>
                    Last Edited: 
                    <?php echo htmlspecialchars(dispDate($row['DateEdited'])) . " " . 
                    htmlspecialchars(dispTime($row['DateEdited'])) ?>
                     | Author: <?php echo $editUserName;
                } ?>
        </div>
        <br />
        <div id='article'>
            <?php echo $row['Content'] ?>
        </div>
    </div>
    <div class="showForm">
        <br />
        <?php if (userIsAuthorized("editNews")) { ?>
        <input type="button" name="editButton" id='editButton' value='Edit' 
               onclick='document.location="../editNews/?NewsID=<?php echo $row['NewsID'] ?>";' />
        <?php } if (userIsAuthorized("deleteNews")) { ?>
        <input type="button" name="deleteButton" id='deleteButton' value='Delete' style="margin-left: 10px;"
               onclick='deleteConfirm();' />
        <?php } ?>
    </div>
    <br />
</section>

    <script>
        function deleteConfirm()
        {
            if (confirm("Are you sure you want to delete this item?"))
                document.location="../news/delete?&NewsID=<?php echo $row['NewsID'] ?>";
        }
    </script>

<?php include '../view/footerInclude.php' ?>
