<?php
$servername = "localhost"; // Usually "localhost"
$username = "root";
$password = "";
$dbname = "users";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name-input"];
    $userType = $_POST["user-type"];
    $description = $_POST["description-input"];
    $location = $_POST["location-input"];

    // Insert data into the 'organizations' table
    $sql = "INSERT INTO organizations (name, user_type, description, location) VALUES ('$name', '$userType', '$description', '$location')";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
        // Redirect to index.php after 1 second
        header("refresh:1;url=index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
