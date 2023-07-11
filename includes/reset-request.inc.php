<?php

if(isset($_POST["reset-request-submit"])){

    $selector = bin2hex(random_bytes(8));
    $token = random_bytes(32);
    $url = "www.wagt.space/forgottenpwd/create-new-password.php?selector=".$selector."&validator=".bin2hex($token);

    $expires = date("U")+1800;

    require 'dbh.inc.php';

    $userEmail = $_POST['email'];
    $sql = "DELETE FROM pwdreset WHERE pwdResetEmail=?;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "There was an error!";
    }
    else{
        mysqli_stmt_bind_param($stmt, "s", $userEmail);
        mysqli_stmt_execute($stmt);
    }

    $sql = "INSERT INTO pwdreset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES (?, ?, ?, ?);";

    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "There was an error!";
    }
    else{
        $hashedToken = password_hash($token, PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($stmt, "ssss", $userEmail, $selector, $hashedToken, $expires);
        mysqli_stmt_execute($stmt);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    $to = $userEmail;

    $subject = 'Reset your password for wagt.space';
    $message = '<p>We recieved a password reset request. The link to reset your password. You can ignore this email</p>';
    $message .= '<p>Here is your password reset link:<br><a href="'.$url.'">'.$url.'</a></p>';

    $headers = "From: wagt <sapa.shirmadov@mail.ru>\r\n";
    $headers .= "Reply-To: sapa.shirmadov@mail.ru\r\n";
    $headers .= "Content-type: text/html\r\n";

    mail($to, $subject, $message, $headers);

    header("Location: ../reset-password.php?reset=success");

}
else{
    header("Location: ../index.php");
}