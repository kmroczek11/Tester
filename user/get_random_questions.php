<?php
    $conn = @new mysqli('localhost', 'root', '', 'tester');
    if ($conn->connect_errno) die('No Connection.');//errno zawiera numery błędów
    $sql = "SELECT * from questions order by rand() limit 10";
    $randQuestions = $conn->query($sql) or die ("Error while getting random questions");
    $success = true;
    if (isset($_POST["finishTest"])){
        // if (sizeof($_POST) == 11){
        //     header('Refresh: 0; url=show_stats.php');
        //     exit;
        // }else{
        //     $success = false;
        // }
        unset($_POST['finishTest']);
        $_SESSION['userAnswers'] = array();
        foreach ($_POST as $correctAnswer) {
            array_push($_SESSION['userAnswers'], $correctAnswer);
        }
        header('Refresh: 0; url=show_stats.php');
        exit;
    } else{
        $_SESSION['correctAnswers'] = array();
    }

    echo ("<form method='post' action='user.php'>");
    $row = $randQuestions->fetch_array();
    while ($row){
        array_push($_SESSION['correctAnswers'], $row['correct']);
        echo ("
        <div class='header'>"
            .$row['question'].
        "</div>
        <div class='form-check'>
            <div class='custom-control custom-radio custom-control-inline'>
                <input name='".$row['question_id']."' id='".$row['answer_a']."' type='radio' value='A' checked class='custom-control-input'>
                <label class='custom-control-label' for='".$row['answer_a']."'>A</label>
            </div>"
            .$row['answer_a'].
        "</div>
        <div class='form-check'>
            <div class='custom-control custom-radio custom-control-inline'>
                <input name='".$row['question_id']."' id='".$row['answer_b']."' type='radio' value='B' class='custom-control-input'>
                <label class='custom-control-label' for='".$row['answer_b']."'>B</label>
            </div>"
            .$row['answer_b'].
        "</div>
        <div class='form-check'>
             <div class='custom-control custom-radio custom-control-inline'>
                 <input name='".$row['question_id']."' id='".$row['answer_c']."' type='radio' value='C' class='custom-control-input'>
                <label class='custom-control-label' for='".$row['answer_c']."'>C</label>
             </div>"
            .$row['answer_c'].
        "</div>
        <div class='form-check'>
            <div class='custom-control custom-radio custom-control-inline'>
                <input name='".$row['question_id']."' id='".$row['answer_d']."' type='radio' value='D' class='custom-control-input'>
                <label class='custom-control-label' for='".$row['answer_d']."'>D</label>
            </div>"
            .$row['answer_d'].
        "</div>"
        );
        $row = $randQuestions->fetch_array();
    }
    if (!$success)
    echo("<div class='alert alert-danger' role='alert'>
      Zaznacz wszystkie odpowiedzi
      </div>");

    echo ('<input name="finishTest" id="finishTest" class="btn btn-success" type="submit" value="Zakończ test"></form>');
?>