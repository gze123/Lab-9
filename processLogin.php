<?php
session_start();
include_once("config.php");

$email = $pwd = $action = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit'])) {

        $email = $_POST['email'];
        $pwd  = $_POST['password'];
        $sql = "SELECT id,email,password FROM members where email=?";
        if ($stmt = mysqli_prepare($mysqli, $sql)) {
            mysqli_stmt_bind_param($stmt, 's', $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);

            if (mysqli_stmt_num_rows($stmt) == 1) {
                mysqli_stmt_bind_result($stmt, $userid, $emaildb, $hash);
                while (mysqli_stmt_fetch($stmt)) {
                    $id = $userid;
                }
                if (password_verify($pwd, $hash)) {
                    echo "Password match";
                    $action = "success";

                    $_SESSION['logged_in'] = true;
                    $_SESSION['user_id'] = $id;
                    $_SESSION['user_email'] = $email;

                    header("location:memberProfile.php?action=$action");
                } else {
                    echo "invalid password";
                    $action = "login_failed";
                    header("location:profile.php?action=$action");
                }
            } else {
                echo "Please sign up";
                $action = "login_failed";
                header("location:profile.php?action=$action");
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($mysqli);
}
