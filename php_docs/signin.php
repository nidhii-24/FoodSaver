<?php
// Connect to the MySQL database
$servername = "localhost"; // Usually "localhost"
$username = "root";
$password = "";
$dbname = "users"; // Update to your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Start a session
session_start();

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Retrieve user data from the database
    $sql = "SELECT * FROM user_info WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // User found, verify password
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            // Store the username in the session
            $_SESSION["username"] = $username;
            echo "Login successful! Redirecting...";
            echo '<script>
                    setTimeout(function(){
                        window.location.href = "index.php";
                    }, 1000);
                  </script>';
        } else {
            echo "Incorrect password.";
        }
    } else {
        echo "User not found.";
    }
}

// Close the database connection
$conn->close();
?>
