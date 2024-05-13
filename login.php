<?php
require_once("includes/Config.php");
require_once("includes/classes/FormSanitizer.php");
require_once("includes/classes/Constants.php");
require_once("includes/classes/Account.php");

$account = new Account($con);

if (isset($_POST["submitButton"])) {

  $username = FormSanitizer::sanitizeFormUsername($_POST["username"]);
  $password = FormSanitizer::sanitizeFormPassword($_POST["password"]);

  $success = $account->login($username, $password);

  if ($success) {
    $_SESSION["userLoggedIn"] = $username;
    header("Location: index.php");
  }
}

function getInputValue($name)
{
  if (isset($_POST[$name])) {
    echo $_POST[$name];
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome to Lydix</title>
  <link rel="stylesheet" type="text/css" href="assets/style/style1.css">
</head>

<body>
  <div id="particles-js"></div> <!-- Particles JS background -->
  <div class="mouse-light"></div>

  <div class="signInContainer">
    <div class="column">
      <div class="header">
        <img src="assets/images/logo.png" alt="Site logo">
        <h3>Sign In</h3>
        <span>to continue to Lydix</span>
      </div>

      <form method="POST">
        <?php echo $account->getError(Constants::$loginFailed); ?>
        <input type="text" name="username" placeholder="Username" value="<?php getInputValue("username"); ?>" required>

        <input type="password" name="password" placeholder="Password" required>

        <input type="submit" name="submitButton" value="SUBMIT">
      </form>

      <a href="register.php" class="signInMessage">Need an account? Sign up here!</a>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
  <script src="assets/scripts/background.js"></script>
</body>

</html>