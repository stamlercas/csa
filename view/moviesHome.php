<?php
    $title = "University Theater";
    include '../view/headerInclude.php';
?>
    <section>
        <?php 
        $navItems = array();
        $navItems[0]['title'] = "Showtimes";
        $navItems[0]['link'] = '../movies/week';
        $navItems[1]['title'] = "Full Calendar";
        $navItems[1]['link'] = '../movies/calendar';
        include '../view/subnav.php';
        ?> 
        <div class="hasSubNav">
            <h1 style="float:left;">The University Theater</h1>
            <div class='btnContainer'>
                <?php if (userIsAuthorized("movieSchedule")) { ?>
                    <input type="button" name="addButton" id='allShowingsButton' value='Show All Showings' class='editBtn'
                           onclick='document.location="../movies/schedule";' /> <?php } ?>
                <?php if (userIsAuthorized("movieList")) { ?>
                    <input type="button" name="addButton" id='allMoviesButton' value='Show All Movies' class='editBtn'
                           onclick='document.location="../movies/list";' /> <?php } ?>
                    <br />
                <?php if (userIsAuthorized("addMovieListing")) { ?>
                <input type="button" name="addButton" id='addShowingButton' value='Add Movie Showing' class='editBtn'
                       onclick='document.location="../movies/addShowing";' /> <?php } ?>
                <?php if (userIsAuthorized("addMovie")) { ?>
                    <input type="button" name="addButton" id='addMovieButton' value='Add Movie' class='editBtn'
                           onclick='document.location="../movies/add";' /> <?php } ?>
            </div>
            <div style="clear:both;"></div>
            <div class="staticContent">
                <div>
                    The University Theater is open to the public, faculty and staff at a low cost of $4 for adults, $2 for children 12 and younger, and free for Clarion University students with a university ID. Concessions also are available.
                </div>
                <br />
                <div>
                    The 188-seat theater shows second-run films after their release but before DVD availability, as well as classics, documentaries and films addressing social issues.
                </div>
            </div>
            <img src="../img/Clarion_Fall_2015_0084.jpg" alt="University Theater" style="max-width:100%;"/>
        </div>
    </section>
        
<?php include '../view/footerInclude.php' ?>
