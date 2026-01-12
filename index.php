<?php session_start(); include_once("db_connect.php"); require_once('utils.php');?>
<!DOCTYPE html>
<html>
    <head>
        <title>VladAir</title>
        <link rel = 'icon' type="image/x-icon" href = 'website_icon.png'>
        <link rel="stylesheet" href="stl.css">
    </head>

    <body>
        <header>
            <a href="index.php"><img src="website_icon.png" alt="website photo" width = "50"></a>
            <?php if(!$_SESSION['isLogged']) : ?>
                <a href='login.php' class = 'login-logout'>Log in</a>
            <?php else:?>
                <form method="post" class = 'login-logout'><button name='logout' type = 'submit'>Log out</button></form>
            <?php endif;?>
            <?php if(isset($_POST['logout'])) logOut();?>
        </header>

        <div id='container'>
            <h2>Welcome to VladAir, here you will find connections in every direction in the world</h2>
            <form method="post" id = 'mainForm'>
                <h3>Find your connection</h3>
                <div class='params'>
                    <label>From</label>
                    <input type="text" name = 'departure'>
                </div>
                <div class='params'>
                    <label id="destinationLabel">To</label>
                    <input type="text" name = 'destination'>
                </div>
                <button type="submit">Find</button>
            </form>
            <div id = 'result'>
                <form method="post">
                <?php
                if(isset($_POST['departure']) && isset($_POST['destination'])){
                    searchConnections($conn, $_POST['departure'], $_POST['destination']);
                }
                ?>
                </form>
            </div>
        </div>

        <footer>
            <div>
                <h3>Contact Us:</h3>
                <p>+48 42 675 87 16</p>
                <p>+48 42 652 94 01</p>
            </div>
            <div>
                <h3>Also visit</h3>
                <a href="https://babinski.home.pl/">https://babinski.home.pl</a>
            </div>
        </footer>

    </body>

</html>
