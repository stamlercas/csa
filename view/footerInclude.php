            <div style="clear:both;"></div>
            <footer>
                <div id="navFooter">
                    <ul>
                        <li><a href="../">home</a></li>
                        <li><a href="../news/">news</a></li>
                        <li><a href="../movies/">movie theater</a></li>
                        <li><a href="../busBreak/">bus</a></li>
                        <li><a href="#">the apple</a></li>
                        <li><a href="../about/">about us</a></li>
                        <?php if (loggedIn()) {
                                echo "<li><a href='../security/index.php?action=SecurityLogOut&RequestedPage=" . urlencode($_SERVER['REQUEST_URI']) . "'>logout, " . $_SESSION['UserName'] . "</a></li>";
                                } else { ?>
                        <li><a href="../security">login</a></li>
                                <?php } ?>
                </div>
                <div style="text-align:center;font-size:small;font-style:italic;">CSA <?php echo date("Y"); ?></div>
                <div style="text-align:center;font-size:x-small;font-style:italic;">Courageous. Confident. Clarion.</div>
            </footer>
        </div>
        
    </body>
</html>

