<?php
    $title = "Admin Menu";
    include '../view/headerInclude.php';
?>

<section>
    <h1>Admin Menu</h1>
    
    <ul id="adminMenu">
        <?php //for whole unordered list
            //all actions are in if statement
            if (userIsAuthorized('slideshowFileUpload')) { ?>
        <ul>
            <h3>File Management</h3>
            <?php if (userIsAuthorized('slideshowFileUpload')) { ?>
            <li>
                <a href="../slideshow/upload">Manage Slideshow Images</a>
            </li>
            <?php } ?>
        </ul>
        <?php } ?>
        
        <?php if (userIsAuthorized('addNews')) { ?>
        <ul>
            <h3>News</h3>
            <?php if (userIsAuthorized('addNews')) { ?>
            <li>
                <a href="../addNews/">Add News Article</a>
            </li>
            <?php } ?>
        </ul>
        <?php } ?>
        
        <?php if (userIsAuthorized('addMovie') || userIsAuthorized('addMovieListing') || 
                userIsAuthorized('deleteMovie') || userIsAuthorized('deleteDate')) { ?>
        <ul>
            <h3>Movies</h3>
                <?php if (userIsAuthorized('addMovie')) { ?>
            <li>
                <a href="../movies/add">Add Movie</a>
            </li>
                <?php } if(userIsAuthorized('addMovieListing')) { ?>
            <li>
                <a href="../movies/add-showing">Add Movie Showing</a>
            </li>
                <?php } if(userIsAuthorized('deleteMovie')) { ?>
            <li>
                <a href="../movies/list">Complete Movie List</a>
            </li>
                <?php } if(userIsAuthorized('deleteDate')) { ?>
            <li>
                <a href="../movies/schedule">Complete Movie Schedule List</a>
            </li>
                <?php } ?>
        </ul>
        <?php } ?>
    </ul>
    
</section>

<?php include '../view/footerInclude.php'; ?>

