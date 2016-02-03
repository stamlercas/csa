<?php
    //navItems is an array that has the title along with the link passed into it
    //ex. $navItems[0]['title'] = "Fundraising";
    //ex. $navItems[0]['link'] = "../about/fundraising";

class Subnav
{
    function addSubnav($navItems, $fbIframe = null)
    {
        echo '<div id="subNav">' .
            '<ul>';
        foreach ($navItems as $item) 
        {
            echo '<li><a href="' . $item['link'] . '">' . $item['title'] . '</a></li>';
        }
        echo "</ul>";
        if ($fbIframe != null)
        {
            echo $fbIframe;
        }
        echo "</div>";
    }
}
?>
<!--
        <div id="subNav">
            <ul>
                <?php foreach ($navItems as $item) { ?>
                <li><a href="<?php echo $item['link'] ?>"><?php echo $item['title'] ?></a></li>
                <?php } ?>
            </ul>
        </div> -->