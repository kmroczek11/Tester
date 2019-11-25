<nav class="navbar navbar-expand-lg navbar-light">
  <a class="navbar-brand"><img width=100 height=100 src="../assets/logo.png"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item
        <?php 
        if (strpos($_SERVER['REQUEST_URI'], 'admin'))
          echo (" active");
        ?>">
          <a class="nav-link" href="admin.php">Pytania</a>
        </li>
        <li class="nav-item
        <?php 
        if (strpos($_SERVER['REQUEST_URI'], 'deleteUsers'))
          echo (" active");
        ?>">
          <a class="nav-link" href="deleteUsers.php">Usuwanie użytkowników</a>
        </li>
        <li class="nav-item
        <?php 
        if (strpos($_SERVER['REQUEST_URI'], 'stats'))
          echo (" active");
        ?>">
          <a class="nav-link" href="stats.php">Statystyki</a>
        </li>
      </ul>
      <h1>Witaj, admin!</h1>
    </div>
</nav>