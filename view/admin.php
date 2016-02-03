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
        <h3 onclick='showAdminMenu("#fileManagement");'>File Management</h3>
        <ul class='adminSubmenu' id='fileManagement'>
            <?php if (userIsAuthorized('slideshowFileUpload')) { ?>
            <li>
                <a href="../slideshow/upload">Manage Slideshow Images</a>
            </li>
            <?php } ?>
        </ul>
        <?php } ?>
        
        <?php if (userIsAuthorized('addNews')) { ?>
        <h3 onclick='showAdminMenu("#news");'>News</h3>
        <ul class='adminSubmenu' id='news'>
            <?php if (userIsAuthorized('addNews')) { ?>
            <li>
                <a href="../addNews/">Add News Article</a>
            </li>
            <?php } ?>
        </ul>
        <?php } ?>
        
        <?php if (userIsAuthorized('addMovie') || userIsAuthorized('addMovieListing') || 
                userIsAuthorized('deleteMovie') || userIsAuthorized('deleteDate')) { ?>
        <h3 onclick='showAdminMenu("#movies");'>Movies</h3>
        <ul class='adminSubmenu' id='movies'>
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

<script>
        function showAdminMenu(id)
        {
            if ($(id).css('display') === "none")
            {
                $(id).slideDown("fast");
                $(id).addClass("shown");
            }
            else if ($(id).has("shown"))
            {
                $(id).slideUp("fast");
                $(id).removeClass("shown");

            }
        }
</script>

<?php include '../view/footerInclude.php'; ?>

