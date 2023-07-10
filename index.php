<?php
require "header.php";
?>

<div class="container">
    <div class="form_card">

        <?php
       

        if (isset($_SESSION['userId'])) {
            ?>
            <form action="includes/logout.inc.php" method="post">

                <button type="submit" name="logout-submit">Logout</button>
            </form>
        <?php } else { ?>
            <form action="includes/login.inc.php" method="post">
                <input type="text" name="mailuid" placeholder="Username ...">
                <input type="password" name="pwd" placeholder="Password ...">
                <button type="submit" name="login-submit">Login</button>
            </form>
            <a class="signup" href="signup.php">Signup</a>
        <?php }
        ?>
    </div>
    <main style="text-align:center;">
        <?php

        if (isset($_SESSION['userId'])) {
            echo '<p class="alart_msg" style="background-color:#24ed4c">You are logged in!</p>';
        } else {
            echo '<p class="alart_msg" style="background-color:#243fed">You are logged out!</p>';
        }
        ?>
        <!-- <p class="alart_msg">You are logged out!</p> -->

    </main>
</div>

<?php
require "footer.php";
?>