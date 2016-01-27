<?php
    $title = 'Bus Schedules';
    include '../view/headerInclude.php';
?>

    <section>
        <?php
            $navItems = array();
            $navItems[0]['title'] = 'ATA Schedule';
            $navItems[0]['link'] = '../bus/#ata';
            $navItems[1]['title'] = 'Bus Break';
            $navItems[1]['link'] = '../bus/#break';
            include '../view/subnav.php';
        ?>
        <div class="hasSubNav">
            <a name='ata'>
                <h1>Bus Schedule</h1>
                <img style ='max-width:100%;' src="../img/bus/ATA_FR_CAT-BUS_701022_CAMPUS_WEB.png" alt="Bus Schedule 2015" />
            </a>
            <a name='break'>
                <h1>Bus Schedule for Winter Break</h1>
                <div>
                    The Clarion Students' Association provides transportation by bus to the students of Clarion University to the eastern 
                    part of Pennsylvania.  CSA sponsors these trips at Thanksgiving, Holiday Break, and Spring Break. 
                    The bus has scheduled stops at three locations, Harrisburg, King of Prussia, and Philadelphia's 30th Street Station. 
                    Students can coordinate connecting travel arrangements at 30th Street Station for points north or south. CSA 
                    accepts reservations for students on a first come, first served basis.  A reservation is secured by completing a 
                    reservation form and returning it to the CSA office, along with payment in full for the trip.  We accept MasterCard,
                    Visa, and Discover.  All checks should be made payable to CSA.  Rates are subject to change.  Please refer to the 
                    reservation form for the current bus fare and further details.  Students must show ID to board the bus.  No 
                    exceptions.
                </div>
                <br />
                <div class="underlineLink">
                    Link: <a href="../data/BusSchedule/BreakBusFlyerSmall-Christmas2015.pdf">Click Here</a>
                </div>
            </a>
        </div>
    </section>
