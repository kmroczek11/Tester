<?php
        $conn = @new mysqli('localhost', 'root', '', 'tester');
        if ($conn->connect_errno) die('No Connection.');//errno zawiera numery błędów
        $table = $conn->query("SELECT * FROM questions");
        $row = $table->fetch_array();
        echo ("<table class='table table-hover table-dark text-center'");
        echo ("<thead><tr><th scope='col'>#</th><th scope='col'>Pytanie</th><th scope='col'>Odpowiedź A</th>
        <th scope='col'>Odpowiedź B</th><th scope='col'>Odpowiedź C</th><th scope='col'>Odpowiedź D</th>
        <th scope='col'>Poprawna</th><th scope='col'>Usuń</th><th scope='col'>Edytuj</th></tr></thead>");
        while ($row){
            echo ("<tr><th class='align-middle' scope='row'>".$row["question_id"]."</th>
            <td class='align-middle'>".$row["question"]."</td><td class='align-middle'>".$row["answer_a"]."</td>
            <td class='align-middle'>".$row["answer_b"]."</td><td class='align-middle'>".$row["answer_c"]."</td>
            <td class='align-middle'>".$row["answer_d"]."</td><td class='align-middle'>".$row["correct"]."</td>
            <td><a href='admin.php?question_id=".$row["question_id"]."&action=delete'><span class='fa fa-trash'></td>
            <td><a href='admin.php?question_id=".$row["question_id"]."&action=edit'><span class='fa fa-edit'></td>
            </tr>");
            $row = $table->fetch_array();
        }
        echo ("</table>");

        if (isset($_GET['question_id'])){
            $question_id = $_GET['question_id'];
            if ($_GET['action'] == 'delete'){
                $sql = "DELETE FROM questions WHERE question_id=".$question_id."";
                $delete = $conn->query($sql) or die ("Error while deleting question");
                if ($delete === TRUE){
                header("Location: admin.php");
                exit;
                }
            }
        }
?>