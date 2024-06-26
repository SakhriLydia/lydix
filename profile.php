<?php
require_once("includes/header.php");
require_once("includes/classes/Account.php");
require_once("includes/classes/FormSanitizer.php");
require_once("includes/classes/Constants.php");

if (isset($_POST["saveDetailsButton"])) {
  $account = new Account($con);
  $firstName = FormSanitizer::sanitizeFormString($_POST["firstName"]);
  $lastName = FormSanitizer::sanitizeFormString($_POST["lastName"]);
  $email = FormSanitizer::sanitizeFormEmail($_POST["email"]);

  if ($account->updateDetails($firstName, $lastName, $email, $userLoggedIn)) {
    //success
    echo "success";
  } else {
    //failure
    echo "failure";
  }
}
?>


<div class="settingsContainer column">
  <div class="formSection">
    <form method="$_POST">
      <h2>User details</h2>

      <?php
      $user = new User($con, $userLoggedIn);
      $firstName = isset($_POST["firstName"]) ? $_POST["firstName"] : $user->getFirstName();
      $lastName = isset($_POST["lastName"]) ? $_POST["lastName"] : $user->getLastName();
      $email = isset($_POST["email"]) ? $_POST["email"] : $user->getEmail();
      ?>


      <input type="text" name="firstName" placeholder="First name" value="<?php echo $firstName; ?>">
      <input type="text" name="lastName" placeholder="Last name" value="<?php echo $lastName; ?>">
      <input type="email" name="email" placeholder="email" value="<?php echo $email; ?>">

      <input type="submit" name="saveDetailsButton" value="Save">
    </form>
  </div>

  <div class="formSection">
    <form method="$_POST">
      <h2>Update password</h2>
      <input type="password" name="oldPassword" placeholder="Old password">
      <input type="password" name="newPassword" placeholder="New password">
      <input type="password" name="newPassword2" placeholder="Confirm new password">

      <input type="submit" name="savePasswordButton" value="Save">
    </form>
  </div>

</div>