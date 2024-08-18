<?php
session_start();
$username = $_SESSION['user_name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Module Page</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <style>
    body {
      text-align: center;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .content-box {
      background-color: #20c997;
      color: black;
      padding: 20px;
      border: 3px solid black;
      margin-top: 20px;
    }
    .logout-btn {
      position: absolute;
      top: 20px;
      right: 20px;
    }
  </style>
</head>
<body>
  <div class="container text-center">
  <a href="logout.php" class="logout-btn btn btn-danger">Logout</a>
    <h1 class="mt-5">Logged In : <?php echo htmlspecialchars($username) ?></h1>
    <div class="content-box mx-auto mt-5">
      <p>This is the Content of Module 1</p>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
