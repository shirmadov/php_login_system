<?php
require "header.php";
?>

<div class="container">
<main>
    <h1>Signup</h1>
    <?php
    if(isset($_GET['error'])){
        if($_GET['error']=='emptyfields'){
            echo '<p style="color:red">Fill in all fields</p>';
        }
        else if($_GET['error']=='invalidmailuid'){
            echo '<p style="color:red">Invalid username or email</p>';
        }
        else if($_GET['error']=='invalidmail'){
            echo '<p style="color:red">Invalid email</p>';
        }
        else if($_GET['error']=='invaliduid'){
            echo '<p style="color:red">Invalid username</p>';
        }
        else if($_GET['error']=='passwordcheck'){
            echo '<p style="color:red">Passwords Not match</p>';
        }else{
            echo '<p style="color:red">Something Wrong</p>';
        }
    }
    ?>
    <form action="includes/signup.inc.php" method="post">
        <input type="text" name="uid" placeholder="Username">
        <input type="email" name="mail" placeholder="E-mail">
        <input type="password" name="pwd" placeholder="Password">
        <input type="password" name="pwd-repeat" placeholder="Repeat Password">
        <button type="submit" name="signup-submit">Signup</button>
    </form>
</main> 
</div>

<?php
require "footer.php";
?>