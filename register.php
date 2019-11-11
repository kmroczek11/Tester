<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tester Login Page</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/index.css"/>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>
<?php
  session_start();

  $conn = @new mysqli('localhost', 'root', '', 'tester');
  if ($conn->connect_errno) die('No Connection.');//errno zawiera numery błędów

  $login = $password = "";
  $loginErr = $passErr = "";
  $success = false;

  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $login = $_POST["login"];
    $password = $_POST["password"];

    if (empty($login)) {
      $loginErr = "Login jest wymagany";
    }else if (strlen($login) < 6){
      $loginErr = "Login musi zawierać co najmniej 6 znaków";
    } 
    else {
      $login = test_input($login);
    }

    if (empty($password)) {
      $passErr = "Hasło jest wymagane";
    } else if (strlen($password) < 6){
      $passErr = "Hasło musi zawierać co najmniej 6 znaków";
    }
    else {
      $password = test_input($password);
      loginExists($login);
    }

    if ($loginErr == "" && $passErr == ""){
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (login, password) VALUES ('".$login."','".$hash."')";
        $rs = $conn->query($sql) or die ("Error while creating user");
        $success = true;
      }
  }

  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  function loginExists($login){
    $sql = "SELECT login FROM users WHERE login='".$login."'";
    $rs = $GLOBALS['conn']->query($sql) or die ("Error while checking user existance");
    if ($rs->num_rows > 0){
      $GLOBALS['loginErr'] = "Użytkownik o podanym loginie już istnieje";
    }
  }
  ?>
  <form method="post" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <h1>Zarejestruj</h1>
    <div class="form-group">
      <label for="login">Login:</label>
      <input type="login" class="form-control" id="login" name="login">
      <?php if ($loginErr != "")
      echo ("<div class='alert alert-danger'>$loginErr</div>")
      ?>
    </div>
    <div class="form-group">
      <label for="pwd">Hasło:</label>
      <input type="password" class="form-control" id="pwd" name="password">
      <?php if ($passErr != "")
        echo ("<div class='alert alert-danger'>$passErr</div>")
      ?>
    </div>
    <a href="login.php">Zaloguj</a><br/>
    <button type="submit" class="btn btn-success">Zarejestruj</button>
    <?php if ($success)
      echo("<div class='alert alert-success' role='alert'>
        Zarejestrowano pomyślnie!
        </div>");
    ?>
  </form>
  </body>
</body>
</html>