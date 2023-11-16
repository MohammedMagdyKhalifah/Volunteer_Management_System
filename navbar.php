<?php
  if (isset($_POST['submit_account'])) {
    $_SESSION['email'] =$user->email;
    header("Location: v_account.php");
    exit();
  }
?>
<nav class="navbar navbar-expand-lg bg-body-secondary mb-3">
  <div class="container-fluid">
    <a class="navbar-brand" href="v_homepage.php">SAEDNAH</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="v_homepage.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="#">Ranking</a>
        </li>
      </ul>
      <form class="d-flex mx-4" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
      <form action="<?php $_SERVER['PHP_SELF']; ?>" name="submit_account" method="POST">
        <button class="btn btn-primary mx-2" type="submit"><?php echo htmlspecialchars($user->name); ?></button>
      </form>

      <button class="btn btn-outline-secondary mx-2" type="submit" name="submit_logout">log out</button>
    </div>
  </div>
</nav>