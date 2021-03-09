<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $msg = "";
    $id = "";
    $validateid = "";
    $validatename = "";
    $validatepcode = "";
    $validateprofile = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_REQUEST["eid"];
        $name = $_REQUEST["ename"];
        $email = $_REQUEST["email"];
        $birthday = $_REQUEST["birthday"];
        $street = $_REQUEST["street"];
        $state = $_REQUEST["state"];
        $pcode = $_REQUEST["pcode"];
        $country = $_REQUEST["country"];
        $target_dir = "../uploads/";
        $target_file = $target_dir . $_FILES["filetoupload"]["name"];


        if (empty($id) || empty($name) || empty($email) || empty($street) || empty($state) || empty($pcode)) {
            $msg = "All fields are required";
        } else if (!preg_match("/[0-9-]/", $id)) {
            $msg = "Employee ID will allow Numeric and ‘-’symbol ";
        } else if (!preg_match("/[a-zA-Z]/", $name)) {
            $msg = "Employee name Shoulb be alpha numeric";
        } else if (!preg_match("/[0-9]/", $pcode)) {
            $msg = "Post code will only allow numeric values";
        } else if (!isset($_REQUEST["birthday"])) {
            $msg = "you have to select birthday";
        } else if (!isset($_REQUEST['country'])) {

            $msg = "you have to select at least one country";
        } else if (!move_uploaded_file($_FILES["filetoupload"]["tmp_name"], $target_file)) {

            $msg = "Select a File";
        } else {

            $validateid = $id;
            $_SESSION["eid"] = $id;
            $_SESSION["ename"] = $name;
            $_SESSION["email"] = $email;
            $_SESSION["birthday"] = $birthday;
            $_SESSION["state"] = $state;
            $_SESSION["street"] = $street;
            $_SESSION["pcode"] = $pcode;
            $_SESSION["country"] = $country;
            $_SESSION["filetoupload"] = $_FILES["filetoupload"]["type"];
            header("location: Success.php");
        }
    }
    ?>
</body>

</html>