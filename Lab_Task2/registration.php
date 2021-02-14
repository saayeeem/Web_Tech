<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  $msg = "";
  $validatename = "";
  $validateemail = "";
  $validatefname = "";
  $validatepass = "";
  $validatecheckbox = "";
  $validateradio = "";
  $v1 = "";
  $v2 = "";
  $v3 = "";
  $vr = "";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = $_REQUEST["fname"];
    $name = $_REQUEST["uname"];
    $email = $_REQUEST["email"];
    $pass = $_REQUEST["pass"];
    $gender = $_REQUEST["gender"];

    if (empty($name) && empty($email) && empty($fname) && empty($pass)) {
      $msg = "All fields are requied";
    } 
    else {
      if ((strlen($name) < 5)) {
        $msg = "your name should be contain 5 characters";
      } else if (empty($email)) {
        $msg = "your email is empty";
      }


      if (!isset($_REQUEST["vehicle1"]) && !isset($_REQUEST["vehicle2"]) && !isset($_REQUEST["vehicle3"])) {
        $validatecheckbox = "you have to select one";
      } else {
        if (isset($_REQUEST["vehicle1"])) {
          $v1 = $_REQUEST["vehicle1"];
        } else if (isset($_REQUEST["vehicle2"])) {
          $v2 = $_REQUEST["vehicle2"];
        } else if (isset($_REQUEST["vehicle3"])) {
          $v3 = $_REQUEST["vehicle3"];
        }
      }

      if (!isset($_REQUEST["gender"])) {
        $msg = "you have to select gender";
      } else {
        $gender = $_REQUEST["gender"];
      }
    }
  }

  ?>

  <title>Registration Page</title>
</head>

<body>
  <h1>Registation</h1>
  <?php echo $msg; ?> <br>
  <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
    <table>
      <tr>
        <td>
          First Name:
        </td>
        <td>
          <input type="text" name="fname">
        </td>
      </tr>
      <tr>
        <td>
          Email:
        </td>
        <td>
          <input type="text" name="email">
        </td>
      </tr>
      <tr>
        <td>
          User Name:
        </td>
        <td>
          <input type="text" name="uname">
        </td>
      </tr>
      <tr>
        <td>
          Password:
        </td>
        <td>
          <input type="password" name="pass">
        </td>
      </tr>
      <tr>
        <td>
          Confirm Password:
        </td>
        <td>
          <input type="password" name="password">
        </td>
      </tr>
      <tr>
        <td>
          Gender:
        </td>
        <td>
          <input type="radio" id="male" name="gender" value="male"> Male
          <input type="radio" id="female" name="gender" value="female">Female
          <input type="radio" id="other" name="gender" value="other">Other
        </td>
      </tr>
      <tr>
        <td>
          Date of Birth:
        </td>
        <td>
          <input type="date" id="birthday" name="birthday">
        </td>
      </tr>
      <tr>
        <td>
          <input type="submit" value="Submit">
          <input type="reset" value="Reset">
        </td>
      </tr>

    </table>
  </form>

  <?php echo $validatefname; ?> <br>
  <?php echo $validateemail; ?> <br>
  <?php echo $validatename; ?> <br>
  <?php echo $validatepass; ?><br>
</body>

</html>