<?php
    $conn = @new mysqli('localhost', 'root', '', 'tester');
    if ($conn->connect_errno) die('No Connection.');//errno zawiera numery błędów
    $sql = "SELECT * from questions order by rand() limit 10";
    $rand_questions = $conn->query($sql) or die ("Error while getting random questions");
    $row = $rand_questions->fetch_array();
    echo ("<form>");
    while ($row){
        echo ("
        <div class='header'>"
            .$row['question'].
        "</div>
        <div class='form-check'>
            <div class='custom-control custom-radio custom-control-inline'>
                <input name='".$row['question_id']."' type='radio' id='A' value='A' class='custom-control-input'>
                <label class='custom-control-label' for='A'>A</label>
            </div>"
            .$row['answer_a'].
        "</div>
        <div class='form-check'>
            <div class='custom-control custom-radio custom-control-inline'>
                <input name='".$row['question_id']."' type='radio' id='B' value='B' class='custom-control-input'>
                <label class='custom-control-label' for='B'>B</label>
            </div>"
            .$row['answer_b'].
        "</div>
            <div class='form-check'>
                <div class='custom-control custom-radio custom-control-inline'>
                    <input name='".$row['question_id']."' type='radio' id='C' value='C' class='custom-control-input'>
                    <label class='custom-control-label' for='C'>C</label>
                </div>"
                .$row['answer_c'].
            "</div>
        <div class='form-check'>
            <div class='custom-control custom-radio custom-control-inline'>
                <input name='".$row['question_id']."' type='radio' id='D' value='D' class='custom-control-input'>
                <label class='custom-control-label' for='D'>D</label>
            </div>"
            .$row['answer_d'].
        "</div>"
        );
        $row = $rand_questions->fetch_array();
    }
    echo ('</form>')
?>