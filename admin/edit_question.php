<?php
    require_once "functions.php";

    $conn = @new mysqli('localhost', 'root', '', 'tester');
    if ($conn->connect_errno) die('No Connection.');//errno zawiera numery błędów

    $question_id = $_GET['question_id'];
    $question = $answer_a = $answer_b = $answer_c = $answer_d = $correct = $id = "";
    $err = 1;

    $sql = "SELECT * FROM questions WHERE question_id=".$question_id."";
    $find_question = $conn->query($sql) or die ("Error while searching for a question");
    $row = $find_question->fetch_array();
    if ($find_question->num_rows == 1){
        $id = $row['question_id'];
        $question = $row['question'];
        $answer_a = $row['answer_a'];
        $answer_b = $row['answer_b'];
        $answer_c = $row['answer_c'];
        $answer_d = $row['answer_d'];
        $correct = $row['correct'];
    }

    if (isset($_POST["edit"])) {

      if (isset($_POST["question"])){
        $question = $_POST["question"];
      }      

      if (isset($_POST["answer_a"])){
        $answer_a = $_POST["answer_a"];
      }

      if (isset($_POST["answer_b"])){
        $answer_b = $_POST["answer_b"];
      }

      if (isset($_POST["answer_c"])){
        $answer_c = $_POST["answer_c"];
      }

      if (isset($_POST["answer_d"])){
        $answer_d = $_POST["answer_d"];
      }

      if (isset($_POST["edit"])){
        $correct = $_POST["edit"];
      }

      $question = test_input($question);
      $answer_a = test_input($answer_a);
      $answer_b = test_input($answer_b);
      $answer_c = test_input($answer_c);
      $answer_d = test_input($answer_d);
      edit_question($question, $answer_a, $answer_b, $answer_c, $answer_d, $correct, $id);
    }

    function edit_question($question, $answer_a, $answer_b, $answer_c, $answer_d, $correct, $id){
      $sql = "UPDATE questions SET question='".$question."', answer_a='".$answer_a."', answer_b='".$answer_b."', answer_c='".$answer_c."', answer_d='".$answer_d."', correct='".$correct."' WHERE question_id='".$id."'";
      $edit_question = $GLOBALS['conn']->query($sql) or die ("Error while editing a question");
      if ($edit_question === TRUE){
        header('Refresh: 0; url=admin.php');
        exit;
      }
    }
  ?>

<form method="post" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="form-group row">
          <label for="question" class="col-sm-3 col-form-label">Edytuj pytanie</label>
          <div class="col-sm-8">
            <input name="question" type="text" class="form-control" id="question" value="<?php echo $question;?>" placeholder="<?php echo $question;?>">
          </div>
        </div>
        <fieldset class="form-group">
        <div class="row">
          <legend class="col-form-label col-sm-2 pt-0">Odpowiedź</legend>
          <div class="col-sm-10">
            <div class="form-check">
              <div class="custom-control custom-radio custom-control-inline">
                <input name="edit" <?php if ($correct == "A") echo "checked";?> type="radio" id="edit_a" value="A" class="custom-control-input">
                <label class="custom-control-label" for="edit_a">A</label>
              </div>
              <input name="answer_a" type="text" class="form-check-label" value="<?php echo $answer_a;?>" placeholder="<?php echo $answer_a;?>">
            </div>

            <div class="form-check">
              <div class="custom-control custom-radio custom-control-inline">
                <input name="edit"  <?php if ($correct == "B") echo "checked";?> type="radio" id="edit_b" value="B" class="custom-control-input">
                <label class="custom-control-label" for="edit_b">B</label>
              </div>
              <input name="answer_b" type="text" class="form-check-label" value="<?php echo $answer_b;?>" placeholder="<?php echo $answer_b;?>">
            </div>

            <div class="form-check">
              <div class="custom-control custom-radio custom-control-inline">
                <input name="edit"  <?php if ($correct == "C") echo "checked";?> type="radio" id="edit_c" value="C" class="custom-control-input">
                <label class="custom-control-label" for="edit_c">C</label>
              </div>
              <input name="answer_c" type="text" class="form-check-label" value="<?php echo $answer_c;?>" placeholder="<?php echo $answer_c;?>">
            </div>

            <div class="form-check">
              <div class="custom-control custom-radio custom-control-inline">
                <input name="edit"  <?php if ($correct == "D") echo "checked";?> type="radio" id="edit_d" value="D" class="custom-control-input">
                <label class="custom-control-label" for="edit_d">D</label>
              </div>
              <input name="answer_d" type="text" class="form-check-label" value="<?php echo $answer_d;?>" placeholder="<?php echo $answer_d;?>">
            </div>

          </div>
        </div>
        </fieldset>
        <input class="btn btn-success" type="submit" value="Edytuj pytanie">
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