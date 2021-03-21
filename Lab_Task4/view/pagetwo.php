<?php
session_start();

include('../control/updatecheck.php');


if (empty($_SESSION["username"])) // Destroying All Sessions
{
  header("Location: ../control/login.php"); // Redirecting To Home Page
}

?>

<!DOCTYPE html>
<html>

<body>
    <h2>Profile Page</h2>

    Hii, <h3><?php echo $_SESSION["username"]; ?></h3>
    <br>Your Profile Page.
    <br><br>
    <?php
  $radio1 = $radio2 = $radio3 = "";
  $firstname = $email = $password = $address = "";
  $connection = new db();
  $conobj = $connection->OpenCon();

  $userQuery = $connection->CheckUser($conobj, "student", $_SESSION["username"], $_SESSION["password"]);

  if ($userQuery->num_rows > 0) {

    // output data of each row
    while ($row = $userQuery->fetch_assoc()) {
      $firstname = $row["firstname"];
      $email = $row["email"];
      $password = $row["password"];
      $address = $row["address"];
      $date = $row["dob"];
      $profession = $row["profession"];
      $interest = $row["interests"];


      if ($row["gender"] == "female") {
        $radio1 = "checked";
      } else if ($row["gender"] == "male") {
        $radio2 = "checked";
      } else {
        $radio3 = "checked";
      }
      if ($row["profession"] == "Academician") {
        $select2 = $profession . "selected";
      } else if ($row["profession"] == "student") {
        $select3 = $profession . "selected";
      } else {
        $select1 = $profession . "selected";
      }

      if ($row["interests"] == "music") {
        $radio4 = $interest . "checked";
      } else if ($row["interests"] == "sports") {
        $radio5 = $interest . "checked";
      } else {
        $radio6 = $interest . "checked";
      }

      // $pattern = "/[\/]/";
      // $dob = preg_split($pattern, $date);
      // $setdate = $dob[2] . "-" . $dob[1] . "-" . $dob[0];
    }
  } else {
    echo "0 results";
  }



  ?>
    <form action='' method='post'>
        <?php echo $error; ?>
        firstname : <input type='text' name='firstname' value="<?php echo $firstname; ?>"> <br>
        password : <input type='text' name='password' value="<?php echo $password; ?>"> <br>
        email : <input type='text' name='email' value="<?php echo $email;  ?>"> <br>
        Gender:
        <input type='radio' name='gender' value='female' <?php echo $radio1; ?>>Female
        <input type='radio' name='gender' value='male' <?php echo $radio2; ?>>Male
        <input type='radio' name='gender' value='other' <?php $radio3; ?>> Other
        <br>
        Address : <input type='text' name='address' value="<?php echo $address; ?>"> <br>
        Birthday: <input type="date" name='dob' value="<?php echo $date; ?>" <br>
        <br> Profession : <select name="profession">
            <option value="<?php $select1; ?>">Select</option>}
            <option value="<?php $select2; ?>">Academician</option>
            <option value="<?php $select3; ?>">Student</option>

        </select>
        <br>
        Interest:
        <input type='radio' id='interests' name='interests' value="'music'<?php echo $radio4; ?>">music
        <input type='radio' id='interests' name='interests' value="'sports' <?php echo $radio5; ?>">sports
        <input type='radio' id='interests' name='interests' value="'other'<?php $radio6; ?>"> Other
        <br>
        <input name='update' type='submit' value='Update'>

        <br>
        <br>
        <a href=" ../view/pageone.php">Back </a>

        <a href="../control/logout.php"> logout</a>

</body>

</html>