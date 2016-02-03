<?php
    $title = 'Bus Schedules';
    include '../view/headerInclude.php';
?>

    <section>
        <?php
            $navItems = array();
            $navItems[0]['title'] = 'ATA Schedule';
            //$navItems[0]['link'] = '../bus/#ata';
            $navItems[0]['link'] = "http://www.clarion.edu/student-life/campus-safety/parking-on-campus/ATA-BUS-SCHEDULE-2015.pdf";
            $navItems[1]['title'] = 'Bus Break';
            $navItems[1]['link'] = '../bus/#break';
            include '../view/subnav.php';
            (new Subnav)->addSubnav($navItems);
        ?>
        <div class="hasSubNav">
            <h1><?php echo $content['Title'] ?></h1>
            <a name='ata'>
                <div class='staticContent'>
                    <?php echo $content['Content'] ?>
                    <?php if (userIsAuthorized("editContent")) { ?>
                    <br />
                    <input type="button" name="editButton" id='editButton' value='Edit' 
                           onclick='document.location="../content/edit?ContentID=<?php echo $content['ContentID'] ?>";' />
                    <?php } ?>
                </div>
                <img style='max-width:100%;' src='../img/Clarion_Fall_2015_0099.jpg' alt='Clarion Bus' />
            </a>
            <a name='break'>
                <h1><?php echo $break['Title'] ?></h1>
                <div class='staticContent'>
                    <?php echo $break['Content'] ?>
                    <?php if (userIsAuthorized("editContent")) { ?>
                    <br />
                    <input type="button" name="editButton" id='editButton' value='Edit' 
                           onclick='document.location="../content/edit?ContentID=<?php echo $break['ContentID'] ?>";' />
                    <?php } ?>
                </div>
                
            </a>
        </div>
    </section>

<?php include '../view/footerInclude.php' ?>