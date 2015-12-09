<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width" />
        
        <script src='../js/jquery-2.1.3.js'></script>
        <script src='../js/jquery.slicknav.js'></script>
        <script src='../js/main.js'></script>
        <script src='../js/jssor.js'></script>
        <script src='../js/jssor.slider.js'></script>
        <script src="../js/tinymce/tinymce.min.js"></script>
        
        <link rel="shortcut icon" href="../img/favicon.ico" />
        <link rel="stylesheet" href="../css/main.css" />
        <link rel='stylesheet' href='../css/slicknav.min.css' />
        <link rel='stylesheet' href='../css/mobile.css' media="only screen and (max-device-width: 480px)" />
        <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Oswald:700|Open+Sans:400,700|Lora:400italic,700italic" />
        <title><?php echo $title ?></title>
    </head>
    <body>
        
        <div id="wrapper">
            <header>
                <div id="headerTitle">
                    <img src='../img/title.png' alt="Clarion Students' Association" />
                </div>
                
                <nav>
                    <hr />
                    <ul id='nav'>
                        <li><a href="../" id='homeNav'>home</a></li><span class="navSeperator"> | </span>
                        <li><a href="../news/" id='newsNav'>news</a></li><span class="navSeperator"> | </span>
                        <li><a href="../movies/" id="movieNav">university theater</a></li><span class="navSeperator"> | </span>
                        <li><a href="../apple/" id="appleNav">the apple</a></li><span class="navSeperator"> | </span>
                        <li><a href='../bus/' id='transportationNav'>bus</a></li><span class="navSeperator"> | </span>
                        <li><a href="../about/" id='aboutNav'>about us</a></li>
                        <?php if (userIsAuthorized("admin")) { ?>
                        <span class="navSeperator"> | </span><li><a href='../admin/' id="adminNav">admin</a></li>
                        <?php } ?>
                        <?php if (loggedIn()) {
                                echo "<span class='navSeperator'> | </span><li><a href='../security/index.php?action=SecurityLogOut&RequestedPage=" . urlencode($_SERVER['REQUEST_URI']) . "'>logout, " . $_SESSION['UserName'] . "</a></li>";
                                }?>
                    </ul>
                    <hr />
                </nav>
                
            </header>