<?php
session_start();


if (!isset($_SESSION['user_name'])) {
    header("Location: login.php");
    exit;
}

$servername = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "wonpagerv2";


$conn = new mysqli($servername, $db_username, $db_password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $module = $_POST['module'];
    $username = $_SESSION['user_name'];

    $stmt = $conn->prepare("SELECT mod1, mod2, mod3, mod4, mod5, mod6 FROM userlist WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($mod1, $mod2, $mod3, $mod4, $mod5, $mod6);
        $stmt->fetch();

        // Check module access
        $module_access = false;
        switch ($module) {
            case "module1":
                $module_access = $mod1;
                break;
            case "module2":
                $module_access = $mod2;
                break;
            case "module3":
                $module_access = $mod3;
                break;
            case "module4":
                $module_access = $mod4;
                break;
            case "module5":
                $module_access = $mod5;
                break;
            case "module6":
                $module_access = $mod6;
                break;
        }

        if ($module_access) {
            $_SESSION['module'] = $module;

            // Redirect to the appropriate module page
            header("Location: $module.php");
            exit;
        } else {
            echo "<script>alert('You don\'t have access to that module.');</script>";
        }
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Module Library</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <style>
        body {
            background-image: url('images/bg image.jpg');
            background-color: aquamarine;
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        .custom-button:hover {
            background-color: #00233F;
            border-color: #00233F;
        }

        .custom-logo{
            background-color: antiquewhite;
        }

        .logout-btn {
      position: absolute;
      top: 20px;
      right: 20px;
    }
    </style>
</head>
<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12 text-center">
            <a href="logout.php" class="logout-btn btn btn-danger">Logout</a>
                <img src="images/logo image.png" alt="Wonpager Logo" class="img-fluid custom-logo" width="250">
                <h1 class="display-4 mt-4" style="font-weight: bold; color: #00233F;">Library of WONpager Modules</h1>
            </div>
        </div>

        <form method="POST" action="">
            <div class="row mt-5">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body d-flex align-items-center">
                            <button type="submit" name="module" value="module1" class="btn btn-secondary btn-lg custom-button">Select Module #1</button>
                            <h2 class="ms-3 mb-0">Strategy Clarification on 1 page</h2>
                        </div>
                    </div>
                    <div class="card mt-4">
                        <div class="card-body d-flex align-items-center">
                            <button type="submit" name="module" value="module2" class="btn btn-secondary btn-lg custom-button">Select Module #2</button>
                            <h2 class="ms-3 mb-0">Strategy Deployment among Executives</h2>
                        </div>
                    </div>
                    <div class="card mt-4">
                        <div class="card-body d-flex align-items-center">
                            <button type="submit" name="module" value="module3" class="btn btn-secondary btn-lg custom-button">Select Module #3</button>
                            <h2 class="ms-3 mb-0">Executive Empowerment for Individuals</h2>
                        </div>
                    </div>
                    <div class="card mt-4">
                        <div class="card-body d-flex align-items-center">
                            <button type="submit" name="module" value="module4" class="btn btn-secondary btn-lg custom-button">Select Module #4</button>
                            <h2 class="ms-3 mb-0">Executive Project Management</h2>
                        </div>
                    </div>
                    <div class="card mt-4">
                        <div class="card-body d-flex align-items-center">
                            <button type="submit" name="module" value="module5" class="btn btn-secondary btn-lg custom-button">Select Module #5</button>
                            <h2 class="ms-3 mb-0">Executive Coaching and Leadership Development</h2>
                        </div>
                    </div>
                    <div class="card mt-4 mb-5">
                        <div class="card-body d-flex align-items-center">
                            <button type="submit" name="module" value="module6" class="btn btn-secondary btn-lg custom-button">Select Module #6</button>
                            <h2 class="ms-3 mb-0">Diagnostics and Imperatives to address</h2>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>
