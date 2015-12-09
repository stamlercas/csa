<?php
    $title = 'Bus Schedules';
    include '../view/headerInclude.php';
?>

    <section>
        <?php
            $navItems = array();
            $navItems[0]['title'] = 'ATA Schedule';
            $navItems[0]['link'] = '../bus/ata';
            $navItems[1]['title'] = 'Bus Break';
            $navItems[1]['link'] = '../bus/break';
            include '../view/subnav.php';
        ?>
        <div class="hasSubNav">
            
        </div>
    </section>
