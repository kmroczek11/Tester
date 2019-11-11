<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Admin Panel</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="css/admin.css"/>
</head>
<body>
  <?php
  ?>
  <nav class="navbar navbar-expand-lg navbar-light">
  <a class="navbar-brand"><img width=100 height=100 src="assets/logo.png"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="<?php htmlspecialchars($_SERVER["PHP_SELF"]);?>">Dodawanie pytań <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="deleteUsers.php">Usuwanie użytkowników</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="stats.php">Statystyki</a>
        </li>
      </ul>
      <h1>Witaj, admin!</h1>
    </div>
  </nav>

  <form>
    <div class="form-group row">
      <label for="question" class="col-sm-3 col-form-label">Wprowadź pytanie</label>
      <div class="col-sm-8">
        <input type="text" class="form-control" id="question" placeholder="Pytanie">
      </div>
    </div>
    <fieldset class="form-group">
    <div class="row">
      <legend class="col-form-label col-sm-2 pt-0">Odpowiedź</legend>
      <div class="col-sm-10">
        <div class="form-check">
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="A" name="answer" class="custom-control-input">
            <label class="custom-control-label" for="A">A</label>
          </div>
          <input type="text" class="form-check-label">
        </div>

        <div class="form-check">
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="B" name="answer" class="custom-control-input">
            <label class="custom-control-label" for="B">B</label>
          </div>
          <input type="text" class="form-check-label">
        </div>

        <div class="form-check">
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="C" name="answer" class="custom-control-input">
            <label class="custom-control-label" for="C">C</label>
          </div>
          <input type="text" class="form-check-label">
        </div>

        <div class="form-check">
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="D" name="answer" class="custom-control-input">
            <label class="custom-control-label" for="D">D</label>
          </div>
          <input type="text" class="form-check-label">
        </div>

      </div>
    </div>
  </fieldset>
  <button type="submit" class="btn btn-success">Dodaj</button>
  </form>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>