<?php
    $title = "University Theater";
    include '../view/headerInclude.php';
?>
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5&appId=558576377613488";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
    <section>
        <?php 
        include '../view/subnav.php';
        $navItems = array();
        $navItems[0]['title'] = "Showtimes";
        $navItems[0]['link'] = '../movies/week';
        $navItems[1]['title'] = "Full Calendar";
        $navItems[1]['link'] = '../movies/calendar';
        (new Subnav)->addSubnav($navItems, '<div class="fb-page" data-href="https://www.facebook.com/cumoviesonmain/" data-tabs="timeline" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/cumoviesonmain/"><a href="https://www.facebook.com/cumoviesonmain/">CU Movies on Main</a></blockquote></div></div>');
        ?> 
        <div class="hasSubNav">
            <h1 style="float:left;"><?php echo $row['Title'] ?></h1>
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
                <?php echo $row['Content']; ?>
                <?php if (userIsAuthorized("editContent")) { ?>
                <br />
                <input type="button" name="editButton" id='editButton' value='Edit' 
                       onclick='document.location="../content/edit?ContentID=<?php echo $row['ContentID'] ?>";' />
                <?php } ?>
            </div>
            <img src="../img/Clarion_Fall_2015_0084.jpg" alt="University Theater" style="max-width:100%;"/>
        </div>
    </section>
        
<?php include '../view/footerInclude.php' ?>