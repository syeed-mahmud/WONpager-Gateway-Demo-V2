<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WONPager Gatewaydemo V2</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="w-full h-full bg-no-repeat bg-cover bg-left" style="background-image: url(images/bg.jpg);">
    <div class="flex min-h-full flex-col justify-center px-6 py-1 lg:px-8">
        <div class="sm:mx-auto mt-10 sm:w-full sm:max-w-sm">
            <img class="mx-auto h-40 w-40" src="images/Logo.png" alt="WONPager Logo">
            <h2 class="mt-2 text-center text-2xl font-bold leading-9 tracking-tight text-white">Sign in to your account</h2>
        </div>

        <div class="mt-2 sm:mx-auto sm:w-full sm:max-w-sm">
            <form class="space-y-6" method="POST">
                <!-- Selection Tab -->
                <div>
                    <label for="module" class="block text-sm font-medium leading-6 text-white">Select Module</label>
                    <div class="mt-2">
                        <select id="module" name="module" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            <option value="" disabled selected>Select a module</option>
                            <option value="module1">Module 1</option>
                            <option value="module2">Module 2</option>
                            <option value="module3">Module 3</option>
                            <option value="module4">Module 4</option>
                            <option value="module5">Module 5</option>
                            <option value="module6">Module 6</option>
                        </select>
                    </div>
                </div>
                <!-- User Id tab -->
                <div>
                    <label for="user_name" class="block text-sm font-medium leading-6 text-white">User Name</label>
                    <div class="mt-2">
                        <input id="user_name" name="user_name" type="text" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>
                <!-- password tab -->
                <div>
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-sm font-medium leading-6 text-white">Password</label>
                    </div>
                    <div class="mt-2">
                        <input id="password" name="password" type="password" autocomplete="current-password" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>
                <!-- submit button -->
                <div>
                    <button type="submit" class="flex w-full justify-center rounded-md bg-orange-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-orange-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-orange-600">Sign in</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>



<!-- PHP Backend -->

<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['user_name'];
    $password = $_POST['password'];
    $module = $_POST['module'];

    $servername = "localhost";
    $db_username = "root"; 
    $db_password = "";     
    $dbname = "wonpagerv2";  // Make sure the database name is correct.

    // Create connection
    $conn = new mysqli($servername, $db_username, $db_password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind
    $stmt = $conn->prepare("SELECT password, mod1, mod2, mod3, mod4, mod5, mod6 FROM userlist WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($reg_password, $mod1, $mod2, $mod3, $mod4, $mod5, $mod6);
        $stmt->fetch();

        // Verify the password
        if ($password === $reg_password) {
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
                $_SESSION['user_name'] = $username;
                $_SESSION['module'] = $module;
            
                // Redirect to the appropriate module page
                switch ($module) {
                    case "module1":
                        header("Location: module1.php");
                        break;
                    case "module2":
                        header("Location: module2.php");
                        break;
                    case "module3":
                        header("Location: module3.php");
                        break;
                    case "module4":
                        header("Location: module4.php");
                        break;
                    case "module5":
                        header("Location: module5.php");
                        break;
                    case "module6":
                        header("Location: module6.php");
                        break;
                    default:
                        echo "Invalid module selected.";
                        break;
                }
                exit;
            } else {
                echo "<script>alert('You don\'t have access to that module.');</script>";
            }
        } else {
            echo "<script>alert('Invalid password.');</script>";
        }
    } else {
        echo "<script>alert('Invalid username.');</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
