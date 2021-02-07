<!DOCTYPE html>
<html lang="en">

<head>
  <title>Registration Page</title>
</head>

<body>
  <h1>Registation</h1>
  <form>
    <table>
      <tr>
        <td>
          First Name:
        </td>
        <td>
          <input type="text" name="name">
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
          <input type="password" name="password">
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
</body>

</html>