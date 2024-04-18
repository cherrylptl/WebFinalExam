<?php
session_start();
include('includes/db_connection.php');

// Redirect to login page if user is not logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
} else {
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
    <link rel="stylesheet" type="text/css" href="css/allregistrations.css">
</head>
<body>
    <header class="header">
        <h1 class="green-text">Veterinary Clinic</h1>
    </header>

    <div class="nav">
        <?php include('includes/nav.php'); ?>
    </div>

    <div class="welcome">
        <?php
        if (isset($_SESSION['username'])) {
            echo "Welcome  " . $_SESSION['username'];
        }
        ?>
    </div> 

    <main class="orderContainer">
        <?php
        $sqlQuery = "SELECT * FROM `patient`";
        $sqlResult = $db->query($sqlQuery); 
        if ($sqlResult->num_rows > 0) {
            // Iterate through the rows
            while ($row = $sqlResult->fetch_assoc()) {
        ?>
                <div class="orderCard">
                    <p><strong>Patient ID:</strong> <?php echo htmlspecialchars($row['patientID']); ?></p>
                    <p><strong>Patient Name:</strong> <?php echo htmlspecialchars($row['patientName']); ?></p>
                    <p><strong>Patient Type:</strong> <?php echo htmlspecialchars($row['patientType']); ?></p>
                    <p><strong>Name of Owner:</strong> <?php echo htmlspecialchars($row['nameOfOwner']); ?></p>
                    <p><strong>Address:</strong> <?php echo htmlspecialchars($row['address']); ?></p>
                    <p><strong>Telephone:</strong> <?php echo htmlspecialchars($row['telephone']); ?></p>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($row['email']); ?></p>
                </div>
        <?php
            }
        } else {
            echo "<h1 class='empty'>No Registrations Found</h1>";
        }
        ?>
    </main>

    <footer>
        <p>&copy; 2024 Veterinary Clinic PVT LTD. All rights reserved.</p>
    </footer>
</body>
</html>
<?php
}
?>
