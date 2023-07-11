<?php
/**
 * Version 1.0.1
 */
require 'dbh.inc.php';

if (!$_SERVER["REQUEST_METHOD"] === "POST") {
    header("Location: ../index.php");
    exit();
}

$mailuid = $_POST['mailuid'];
$password = $_POST['pwd'];

if (empty($mailuid) || empty($password)) {
    header("Location: ../index.php?error=emptyfields");
    exit();
}

$sql = "SELECT * FROM users WHERE uidUsers=? OR emailUsers=?;";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: ../index.php?error=emptyfields");
    exit();
}

mysqli_stmt_bind_param($stmt, 'ss', $mailuid, $mailuid);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);


if (!$row) {
    header("Location: ../index.php?error=nouser");
    exit();
}

$pwdCheck = password_verify($password, $row['pwdUsers']);
if ($pwdCheck == false) {
    header("Location: ../index.php?error=wrongpassword");
    exit();
}

session_start();
$_SESSION['userId'] = $row['idUsers'];
$_SESSION['userUid'] = $row['uidUsers'];
header("Location: ../index.php?login=success");
exit();



/**
 * Version 1.0.0
 */
// if (isset($_POST['login-submit'])) {
//     require 'dbh.inc.php';

//     $mailuid = $_POST['mailuid'];
//     $password = $_POST['pwd'];

//     if (empty($mailuid) || empty($password)) {
//         header("Location: ../index.php?error=emptyfields");
//         exit();
//     } else {


//         $sql = "SELECT * FROM users WHERE uidUsers=? OR emailUsers=?;";
//         $stmt = mysqli_stmt_init($conn);
//         if (!mysqli_stmt_prepare($stmt, $sql)) {
//             header("Location: ../index.php?error=emptyfields");
//             exit();
//         } else {
//             mysqli_stmt_bind_param($stmt, 'ss', $mailuid, $mailuid);
//             mysqli_stmt_execute($stmt);
//             $result = mysqli_stmt_get_result($stmt);
//             var_dump(!mysqli_fetch_assoc($result));

//             if ($row = mysqli_fetch_assoc($result)) {
//                 $pwdCheck = password_verify($password, $row['pwdUsers']);
//                 if ($pwdCheck == false) {
//                     header("Location: ../index.php?error=wrongpassword");
//                     exit();
//                 } else if ($pwdCheck == true) {
//                     session_start();
//                     $_SESSION['userId'] = $row['idUsers'];
//                     $_SESSION['userUid'] = $row['uidUsers'];

//                     header("Location: ../index.php?login=success");
//                     exit();
//                 } else {
//                     header("Location: ../index.php?error=wrongpassword");
//                     exit();
//                 }
//             } else {
//                 header("Location: ../index.php?error=nouser");
//                 exit();
//             }


//         }


//     }
// } else {
//     header("Location: ../index.php");
//     exit();
// }