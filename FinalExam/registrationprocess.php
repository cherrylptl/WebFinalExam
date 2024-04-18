<?php
session_start();
include('includes/db_connection.php');

// Check if any value is null or empty
function isNullOrEmpty($value) {
    return !isset($value) || empty($value);
}

// Validate telephone number format
function validateTelephone($telephone) {
    return preg_match("/^\(\d{3}\) \d{3}-\d{4}$/", $telephone);
}

// Validate email format
function validateEmail($email) {
    return preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $email);
}

// Check if any field is null or empty
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fieldsToCheck = array('patientName', 'patientType', 'nameOfOwner', 'address', 'telephone', 'email');
    $errorMessages = array(); // Array to store error messages

    // Check all fields for emptiness
    foreach ($fieldsToCheck as $field) {
        if (!isset($_POST[$field]) || isNullOrEmpty($_POST[$field])) {
            $errorMessages[$field] = "$field cannot be empty.";
        }
    }

    // Validate telephone format
    if (!validateTelephone($_POST['telephone'])) {
        $errorMessages['telephone'] = "Invalid telephone number format. eg: (NNN) NNN-NNNN";
    }

    // Validate email format
    if (!validateEmail($_POST['email'])) {
        $errorMessages['email'] = "Invalid email format. eg: test@test.com";
    }

    if (!empty($errorMessages)) {
        // Display all error messages
        foreach ($errorMessages as $field => $errorMessage) {
            echo "Error: $errorMessage<br>";
        }
        exit;
    }

    // Retrieve form data
    $patientName = $_POST['patientName'];
    $patientType = $_POST['patientType'];
    $nameOfOwner = $_POST['nameOfOwner'];
    $address = $_POST['address'];
    $telephone = $_POST['telephone'];
    $email = $_POST['email'];

    $sql = "INSERT INTO patient (patientName, patientType, nameOfOwner, address, telephone, email) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $db->prepare($sql);
    $stmt->bind_param('ssssss', $patientName, $patientType, $nameOfOwner, $address, $telephone, $email);
    
    if ($stmt->execute()) {
        echo "Registration successful.";
        // Prepare the response text
        $responseText = "<br>";
        $responseText .= "Patient Name: $patientName<br>";
        $responseText .= "Patient Type: $patientType<br>";
        $responseText .= "Name of Owner: $nameOfOwner<br>";
        $responseText .= "Address: $address<br>";
        $responseText .= "Telephone: $telephone<br>";
        $responseText .= "Email: $email<br>";

        // Return the response text
        echo $responseText;
    } else {
        echo "Error inserting record: " . $stmt->error;
    }
    
    $stmt->close();
    $db->close();
} else {
    echo "Invalid request method!";
}
?>
