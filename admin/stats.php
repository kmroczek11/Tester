<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Admin Panel</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/stats.css"/>
</head>
<body>
  <div id="main">
    <?php
      include 'admin_navbar.php';
    ?>
    <div id="left">
      <?php
        $conn = @new mysqli('localhost', 'root', '', 'tester');
        if ($conn->connect_errno) die('No Connection.');//errno zawiera numery błędów
        $table = $conn->query("SELECT * FROM questions");
        $row = $table->fetch_array();
        echo ("<table class='table table-hover text-center'");
        echo ("<thead><tr><th scope='col'>Pytanie</th><th scope='col'>Poprawnych</th><th scope='col'>Niepoprawnych</th></tr></thead>");
        while ($row){
            echo ("<tr>
            <td class='align-middle' scope='row'>".$row["question"]."</td>
            <td class='align-middle'>".$row["correct_amount"]."</td>
            <td class='align-middle'>".$row["incorrect_amount"]."</td>
            </tr>");
            $row = $table->fetch_array();
        }
        echo ("</table>");

        $table = $conn->query("SELECT * FROM questions ORDER BY incorrect_amount DESC LIMIT 10");
        $row = $table->fetch_array();
        echo ("<table class='table table-hover table-dark text-center'");
        echo ("<thead><tr><th scope='col'>Pytanie</th><th scope='col'>Niepoprawnych</th></tr></thead>");
        while ($row){
            echo ("<tr>
            <td class='align-middle' scope='row'>".$row["question"]."</td>
            <td class='align-middle'>".$row["incorrect_amount"]."</td>
            </tr>");
            $row = $table->fetch_array();
        }
        echo ("</table>");
      ?>
    </div>
    <div id="right">
        <?php
            $conn = @new mysqli('localhost', 'root', '', 'tester');
            if ($conn->connect_errno) die('No Connection.');//errno zawiera numery błędów
            $table = $conn->query("SELECT * FROM users");
            $row = $table->fetch_array();
            echo ("<table class='table table-hover table-dark text-center'");
            echo ("<thead><tr><th scope='col'>Login</th><th scope='col'>Poprawnych</th><th scope='col'>Niepoprawnych</th></tr></thead>");
            while ($row){
                if ($row["login"] != "admin"){
                    echo ("<tr>
                    <td class='align-middle' scope='row'>".$row["login"]."</td>
                    <td class='align-middle'>".$row["correct_answers"]."</td>
                    <td class='align-middle'>".$row["incorrect_answers"]."</td>
                    </tr>");
                }
                $row = $table->fetch_array();
            }
            echo ("</table>");

            $table = $conn->query("SELECT * FROM users ORDER BY correct_answers DESC LIMIT 10");
            $row = $table->fetch_array();
            echo ("<table class='table table-hover text-center'");
            echo ("<thead><tr><th scope='col'>Login</th><th scope='col'>Poprawnych</th></tr></thead>");
            while ($row){
                if ($row["login"] != "admin"){
                    echo ("<tr>
                    <td class='align-middle' scope='row'>".$row["login"]."</td>
                    <td class='align-middle'>".$row["correct_answers"]."</td>
                    </tr>");
                }
                $row = $table->fetch_array();
            }
            echo ("</table>");
        ?>
    </div>
</div>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>