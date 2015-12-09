<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        
        <script src='js/jquery-2.1.3.js'></script>
        <script src='js/main.js'></script>
        
        <link rel="stylesheet" href="css/main.css" />
        <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Oswald:700|Open+Sans:400,700|Lora:400italic,700italic" />
        <title>Clarion Students' Association</title>
    </head>
    <body>
        
        <div id="wrapper">
            <header>
                <div id="headerTitle">
                    <img src='img/title.png' alt="Clarion Students' Association" />
                </div>
                <hr />
                <nav>
                    <a href="#" id='homeNav'>home</a> | 
                    <a href="#" id='newsNav'>news</a> | 
                    <a href="#" id="movieNav">movie theater</a> | 
                    <a href="#" id='aboutNav'>about us</a>
                </nav>
                <hr />
            </header>
            
            <section>
                <div style="background-color:yellow;" id="content">
                    <h1>CONTENT HERE</h1>
                </div>
                <div style="background-color:yellow;" id='sidebar'>
                    <h1>SIDEBAR</h1>
                </div>
                <div style="clear:both"></div>
                
            </section>
            
            <footer>
                <div id="navFooter">
                    <ul>
                        <li><a href="#">home</a></li>
                        <li><a href="#">news</a></li>
                        <li><a href="#">movie theater</a></li>
                        <li><a href="#">about us</a></li>
                </div>
                <div style="text-align:center;font-size:small;font-style:italic;">CSA <?php echo date("Y"); ?></div>
            </footer>
        </div>
        
    </body>
</html>
