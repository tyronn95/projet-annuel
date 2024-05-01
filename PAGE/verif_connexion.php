<?php
// Start a new session or resume the existing session
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include your database connection script
require_once 'db_config.php'; 

// Check if the form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the username and password from POST data
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Prepare SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT id, type FROM user WHERE email = ? AND password = ?");
    $stmt->bind_param("ss", $email, $password);

    // Execute the statement
    $stmt->execute();

    // Store the result so we can check if the account exists in the database
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $type);
        $stmt->fetch();

        // Store data in session variables
        $_SESSION['loggedin'] = true;
        $_SESSION['id'] = $id;
        $_SESSION['email'] = $email;
        $_SESSION['type'] = $type;

        // Redirect user to appropriate page based on account type
        switch ($type) {
            case 0: // Admin
                header("location: admin.php");
                exit;
            case 1: // Voyageur
                header("location: voyageur.php");
                exit;
            case 2: // Prestataire
                header("location: prestataire.php");
                exit;
            case 3: // Proprietaire
                header("location: calendrier_bailleur.php");
                exit;
            default:
                // Redirect to default page or show error
        }
    } else {
        // Username or password is incorrect
        // Handle error - perhaps redirect back to login with a message
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>
