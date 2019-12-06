<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Tester</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="css/user.css"/>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.3/Chart.bundle.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>
  <div id="main">
    <?php
      session_start();
      include 'user_navbar.php';
    ?>
    <div id="left">
      <?php
        $correct = 0;
        $incorrect = 0;
        $conn = @new mysqli('localhost', 'root', '', 'tester');
        if ($conn->connect_errno) die('No Connection.');//errno zawiera numery błędów

        for ($i = 0; $i < sizeof($_SESSION['userAnswers']); $i++) {
          if ($_SESSION['userAnswers'][$i] == $_SESSION['correctAnswers'][$i]->correct){
            $correct += 1;
            $sql = "UPDATE questions
            SET correct_amount=correct_amount + 1
            WHERE question_id='".$_SESSION['correctAnswers'][$i]->question_id."'";
          }
          else{
            $incorrect += 1;
            $sql = "UPDATE questions
            SET incorrect_amount=incorrect_amount + 1
            WHERE question_id='".$_SESSION['correctAnswers'][$i]->question_id."'";
          }
          $rs = $conn->query($sql) or die ("Error while updating questions correct and incorrect amount");
        } 
        echo("<p class='h1'>Poprawnych: ".$correct."</p>");
        echo("<p class='h1'>Niepoprawnych: ".$incorrect."</p>");

        $sql = "SELECT * FROM users WHERE login='".$_SESSION['login']."'";
        $rs = $conn->query($sql) or die ("Error while finding user");
        $row = $rs->fetch_array();
        $correct_answers = $row['correct_answers'] + $correct;
        $incorrect_answers = $row['incorrect_answers'] + $incorrect;
        $sql = "UPDATE users
        SET correct_answers='".$correct_answers."', incorrect_answers='".$incorrect_answers."'
        WHERE login='".$_SESSION['login']."'";
        $rs = $conn->query($sql) or die ("Error while updating answers");
      ?>

      <div id="canvas-holder" style="width:50%">
        <canvas id="chart-area"></canvas>
      </div>
      <script>
        var randomScalingFactor = function() {
        return Math.round(Math.random() * 100);
        };
        var randomColorFactor = function() {
          return Math.round(Math.random() * 255);
        };
        var randomColor = function(opacity) {
          return 'rgba(' + randomColorFactor() + ',' + randomColorFactor() + ',' + randomColorFactor() + ',' + (opacity || '.3') + ')';
        };

        var correct = "<?php echo $correct ?>";
        var incorrect = "<?php echo $incorrect ?>";
        var config = {
          type: 'doughnut',
          data: {
            datasets: [{
              data: [
                correct,
                incorrect
              ],
              backgroundColor: [
                "green",
                "red"
              ],
            }],
            labels: [
              "Poprawnych",
              "Niepoprawnych"
            ]
          },
          options: {
            responsive: true,
            legend: {
              position: 'bottom',
            },
            title: {
              display: false,
              text: 'Odpowiedzi'
            },
            animation: {
              animateScale: true,
              animateRotate: true
            },
            tooltips: {
              callbacks: {
                label: function(tooltipItem, data) {
                  var dataset = data.datasets[tooltipItem.datasetIndex];
                  var meta = dataset._meta[Object.keys(dataset._meta)[0]];
                  var total = meta.total;
                  var currentValue = dataset.data[tooltipItem.index];
                  var percentage = parseFloat((currentValue/total*100).toFixed(1));
                  return currentValue + ' (' + percentage + '%)';
                },
                title: function(tooltipItem, data) {
                  return data.labels[tooltipItem[0].index];
                }
              }
            },
          }
        };


        var ctx = document.getElementById("chart-area").getContext("2d");
        window.myDoughnut = new Chart(ctx, config)
      </script>
  </div>

  <div id="right">
      <?php
        $conn = @new mysqli('localhost', 'root', '', 'tester');
        if ($conn->connect_errno) die('No Connection.');//errno zawiera numery błędów
        $table = $conn->query("SELECT * FROM users ORDER BY correct_answers DESC LIMIT 10");
        $row = $table->fetch_array();
        echo ("<table class='table table-hover table-dark text-center'");
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
</body>
</html>