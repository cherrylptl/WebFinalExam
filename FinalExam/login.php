<?php
// Start session
session_start(); 
include('includes/db_connection.php');

if (!empty($_POST)) { 
    $username = $db->real_escape_string(htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8'));
    $password = $db->real_escape_string(htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8'));

    // SQL statement
    $stmt = $db->prepare("SELECT * FROM `user_login` WHERE `username` = ? AND `password` = ?");
    $stmt->bind_param('ss', $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $_SESSION['username'] = $row['username'];
            header('Location:allregistrations.php');
            exit();
        }
    } else {
        // Username or password is incorrect message
        $errorMessage = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Final Exam</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Poppins" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body>
    <div class="container">
        <header class="header">
            <h1 class="green-text">Veterinary Clinic</h1>
        </header>
        <div class="nav">
            <?php include('includes/nav.php'); ?>
            <div class="message">
                <?php
                if (isset($_SESSION['username'])) {
                    echo "Welcome ". $_SESSION['username'];
                }
                ?>
            </div> 
        </div>
        <div class="login">
            <form name="myform" method="POST" action="">
                <div class="slider">
                    <h1>Login</h1>
                    <br>
                    <label>Username</label>
                    <input id="username" type="text" name="username"><br />
                    <label>Password</label>
                    <input id="password" type="password" name="password"><br />
                    <br><br>
                    <input type="submit" value="Login">
                    <div class="message">
                        <?php
                        if (isset($errorMessage)) {
                            echo $errorMessage;
                        }
                        ?>
                    </div>
                </div>
            </form>
        </div>
        <br>
        <footer>
            <p>&copy; 2024 Veterinary Clinic PVT LTD. All rights reserved.</p>
        </footer>
    </div>
</body>
</html>
