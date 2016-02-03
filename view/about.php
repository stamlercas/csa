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
        $navItems[2]['title'] = "Forms";
        $navItems[2]['link'] = '../forms/';
        include '../view/subnav.php';
        (new Subnav)->addSubnav($navItems);
        ?> 
        <div class="hasSubNav">
            <h1><?php echo $row['Title'] ?></h1>
            <div class='staticContent'>
                <?php echo $row['Content'] ?>
                <?php if (userIsAuthorized("editContent")) { ?>
                <br />
                <input type="button" name="editButton" id='editButton' value='Edit' 
                       onclick='document.location="../content/edit?ContentID=<?php echo $row['ContentID'] ?>";' />
                <?php } ?>
            </div>
        </div>

    </section>

<?php include '../view/footerInclude.php'; ?>