<?php
    $title = "About Us";
    include '../view/headerInclude.php';
?>
    <section>
        <?php 
        $navItems = array();
        $navItems[0]['title'] = "Fundraising";
        $navItems[0]['link'] = '../about/fundraising';
        $navItems[1]['title'] = "Policies";
        $navItems[1]['link'] = '../policies/';
        include '../view/subnav.php';
        ?> 
        <div class="hasSubNav">
            <h1>About Us</h1>
            <br />
            <br />
            <br />
            <br />
            <br />
            <br />
            <br />
            <br />
            <br />
            <br />
            <br />

            <h1>Board of Directors</h1>
        </div>

    </section>

<?php include '../view/footerInclude.php'; ?>