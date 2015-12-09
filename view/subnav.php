<?php
    //navItems is an array that has the title along with the link passed into it
    //ex. $navItems[0]['title'] = "Fundraising";
    //ex. $navItems[0]['link'] = "../about/fundraising";
?>
        <div id="subNav">
            <ul>
                <?php foreach ($navItems as $item) { ?>
                <li><a href="<?php echo $item['link'] ?>"><?php echo $item['title'] ?></a></li>
                <?php } ?>
            </ul>
        </div>