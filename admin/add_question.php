<?php
    require_once "functions.php";
  
    $conn = @new mysqli('localhost', 'root', '', 'tester');
    if ($conn->connect_errno) die('No Connection.');//errno zawiera numery błędów

    $question = $answer_a = $answer_b = $answer_c = $answer_d = $correct = "";
    $err = 1;

    if (isset($_POST["correct"])) {
      $question = $_POST["question"];
      $answer_a = $_POST["answer_a"];
      $answer_b = $_POST["answer_b"];
      $answer_c = $_POST["answer_c"];
      $answer_d = $_POST["answer_d"];
      $correct = $_POST["correct"];

      if (empty($question) || empty($answer_a) || empty($answer_b) || empty($answer_c) || empty($answer_d)) {
        $err = 2;
      }
      else {
        $err = 3;
        $question = test_input($question);
        $answer_a = test_input($answer_a);
        $answer_b = test_input($answer_b);
        $answer_c = test_input($answer_c);
        $answer_d = test_input($answer_d);
        add_question($question, $answer_a, $answer_b, $answer_c, $answer_d, $correct);
      }
    }

    function add_question($question, $answer_a, $answer_b, $answer_c, $answer_d, $correct){
      $sql = "INSERT INTO questions (question, answer_a, answer_b, answer_c, answer_d, correct) VALUES ('".$question."','".$answer_a."','".$answer_b."','".$answer_c."','".$answer_d."','".$correct."')";
      $add_question = $GLOBALS['conn']->query($sql) or die ("Error while adding a question");
      if ($add_question === TRUE){
        header('Refresh: 0; url=admin.php');
        exit;
      }
    }
  ?>
<form method="post" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="form-group row">
          <label for="question" class="col-sm-3 col-form-label">Wprowadź pytanie</label>
          <div class="col-sm-8">
            <input name="question" type="text" class="form-control" id="question" placeholder="Pytanie">
          </div>
        </div>
        <fieldset class="form-group">
        <div class="row">
          <legend class="col-form-label col-sm-2 pt-0">Odpowiedź</legend>
          <div class="col-sm-10">
            <div class="form-check">
              <div class="custom-control custom-radio custom-control-inline">
                <input name="correct" checked="true" type="radio" id="A" value="A" class="custom-control-input">
                <label class="custom-control-label" for="A">A</label>
              </div>
              <input name="answer_a" type="text" class="form-check-label">
            </div>

            <div class="form-check">
              <div class="custom-control custom-radio custom-control-inline">
                <input name="correct" type="radio" id="B" value="B" class="custom-control-input">
                <label class="custom-control-label" for="B">B</label>
              </div>
              <input name="answer_b" type="text" class="form-check-label">
            </div>

            <div class="form-check">
              <div class="custom-control custom-radio custom-control-inline">
                <input name="correct" type="radio" id="C" value="C" class="custom-control-input">
                <label class="custom-control-label" for="C">C</label>
              </div>
              <input name="answer_c" type="text" class="form-check-label">
            </div>

            <div class="form-check">
              <div class="custom-control custom-radio custom-control-inline">
                <input name="correct" type="radio" id="D" value="D" class="custom-control-input">
                <label class="custom-control-label" for="D">D</label>
              </div>
              <input name="answer_d" type="text" class="form-check-label">
            </div>

          </div>
        </div>
        </fieldset>
        <input class="btn btn-success" type="submit" value="Dodaj pytanie">
        <?php 
          if ($err == 2)
            echo("<div class='alert alert-danger' role='alert'>
              Pola nie mogą być puste!
              </div>");
          if ($err == 3)
            echo("<div class='alert alert-success' role='alert'>
            Dodano pytanie!
            </div>");
        ?>
</form>