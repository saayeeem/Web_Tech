<?php
include('db.php');
session_start(); 

 $error="";
// store session data
$msg = "";
$validatename = "";
$validateemail = "";
$validatefname = "";
$validatepass = "";
$validatecpass = "";
$validateradio = "";
$gender = "";
$birthday = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = $_REQUEST["fname"];
    $uname = $_REQUEST["uname"];
    $email = $_REQUEST["email"];
    $pass = $_REQUEST["pass"];
    $cpass = $_REQUEST["cpass"];
    $pattern1 = "'/^[a-zA-Z-.-_' ]*$/'";
    $pattern2 = "'/^[a-zA-Z-.-_' ]*$/'";
    $pattern3 = "'/^[a-zA-Z-.-_' ]*$/'";

    if (empty($uname) || empty($email) || empty($fname) || empty($pass) || empty($cpass)) {
        $msg = "All fields are requied";
    } else if ((strlen($uname) < 5) || (!preg_match($pattern1, $uname))) {
        $msg = "your user name name should be contain 5 characters and alpha numeric characters, period, dash or underscore";
    } else if ((strlen($pass) < 8) && (strlen($pass) < 8)) {
        $msg = "your password should be contain 8 characters";
    } else if (strpos($email, "@") === false) {
        $msg = "Email address must contain @";
    } else if (!isset($_REQUEST["gender"])) {
        $msg = "you have to select gender";
    } else if ($pass != $cpass) {
        $msg = "you have to write both password correctly";
    } else if (!isset($_REQUEST["birthday"])) {
        $msg = "you have to select birthday";
    } else {
        $connection = new db();
        $conobj = $connection->OpenCon();

        $userQuery = $connection->InsertUser($conobj, "registration", $fname,$uname,$email,$birthday,$gender, $password);

        if ($userQuery->num_rows > 0) {

            $_SESSION['username'] = $_POST['username'];
            $_SESSION['password'] = $_POST['password'];
        } else {
            $error = "Username or Password is invalid";
        }
        $connection->CloseCon($conobj);
        echo "Output";
        $validatefname = "your full name is " . $fname;
        $validateemail = "your email is " . $email;
        $validatename = "your name is " . $uname;
        $validatepass = "your password is " . $pass;
        $validatecpass = "your password is " . $cpass;
        $gender = "your gender is " . $_REQUEST["gender"];
        $birthday = "your birthday is " . $_REQUEST["birthday"];
    }
}

?>