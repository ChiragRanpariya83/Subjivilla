<?php
session_start();
include('admin/includes/config.php');

if (isset($_POST['register'])) {

    $uname = $_POST['username'];
    $email = $_POST['email'];
    $pwd = $_POST['pass'];
    $cpwd = $_POST['cpass'];
    $mnum = $_POST['mnum'];
    $adrs = $_POST['address'];

    $qry = "SELECT c_email FROM customer WHERE c_email='$email'";
    $res = mysqli_query($conn, $qry);
    $row = mysqli_num_rows($res);

    if (!empty($_POST)) {
        $_SESSION['error'] = array();
        extract($_POST);
        if (empty($uname)) {
            $_SESSION['error']['uname'] = "Please Enter Username";
        }
        if (empty($email)) {
            $_SESSION['error']['email'] = "Please Enter Email";
        }
        if (empty($mnum)) {
            $_SESSION['error']['mnum'] = "Please Enter Mobile Number";
        }
        if (empty($adrs)) {
            $_SESSION['error']['adrs'] = "Please Enter Your Address";
        }
        if (empty($pwd) || empty($cpwd)) {
            $_SESSION['error']['pwd'] = "Please Enter Password & Confirm Password";
        } else if ($pwd != $cpwd) {
            $_SESSION['error']['pwd'] = "Password Doesn't Match";
        } else if (strlen($pwd) < 5) {
            $_SESSION['error']['pwd'] = "Please Enter More Than 5 Character";
        }
        if (!empty($_SESSION['error'])) {
            header("location:register.php");
        } else {
            if (!empty($row)) {
                $_SESSION['email1'] = "Email Already Used";
                header("location:login.php");
            } else {
                $query = "INSERT INTO customer(c_username, c_email, c_pwd, c_phone, c_address)
                          VALUES('$uname','$email', '$pwd', '$mnum', '$adrs')";
                mysqli_query($conn, $query);
                $_SESSION['Success'] = "You are Successfully Registered. Please Login";
                header("location:login.php");
            }
        }
    } else {
        header("location:register.php");
    }
}

else if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $pwd = $_POST['pwd'];

    $qry = "SELECT * FROM customer WHERE c_email='$email' AND c_pwd='$pwd'";
    $res = mysqli_query($conn, $qry);
    $row = mysqli_num_rows($res);

    if ($row == 0) {
        $_SESSION['wrong'] = "Email or Password is Wrong";
        header("location:login.php");
    } else {
        $_SESSION['login'] = mysqli_fetch_assoc($res);
        header("location:my-account.php");
    }
}

else if (isset($_POST['update'])) {
    extract($_POST);
    $query = "UPDATE customer SET c_address ='$adrs' WHERE c_id='$id'";
    mysqli_query($conn, $query);
    $_SESSION['updated'] = "Address Successfully Updated";
    $_SESSION['login']['c_address'] = "$adrs";
    header("location:my-account.php");
}

?>
