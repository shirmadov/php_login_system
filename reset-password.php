<?php
require "header.php";
?>

<div class="container">
<main>
    <h1>Reset your password</h1>
    <p>An e-mail will be send to you with instructions on how to reset your password.</p>
   <form action="includes/reset-request.inc.php" method="POST">
    <input type="email" name="email" placeholder="Enter your e-email address ...">
    <button type="submit" name="reset-request-submit">Receive new password</button>
   </form>

   <?php
   if(isset($_GET["reset"])){
        if( $_GET["reset"] == "success" ){
            echo '<p class="">Check your e-mail!</p>';
        }
   }
   ?>
</main> 
</div>

<?php
require "footer.php";
?>