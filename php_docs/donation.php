<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FoodSaver - Donation Form</title>

    <!-- Favicon, CSS & JS -->
    <link rel="icon" href="../assets/logo.png" type="image/png" sizes="16x16">
    <link rel="stylesheet" href="../styles/common.css">
    <link rel="stylesheet" href="../styles/donation.css">

    <!-- Font Awesome icons CDN -->
    <script src="https://use.fontawesome.com/4e51920be5.js"></script>

    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>

<body>
    <section class="container">
        <h1 class="center">MAKE A FOOD DONATION</h1>

        <form id="donation-form" class="form-container" method="POST" enctype="multipart/form-data"
            action="donation.php">

            <!-- Name -->
            <label><b>Restaurant Name</b></label>
            <input placeholder="Enter Restaurant name" name="restaurantName" required>

            <!-- Location -->
            <label><b>Restaurant Location</b></label>
            <input placeholder="Enter Restaurant location" name="location" required>

            <!-- Food Category -->
            <label><b>Food Category</b></label> Choose multiple options by pressing the command/ctrl key
            <br>
            <select class="mdb-select colorful-select dropdown-primary md-form" name="category[]" multiple
                searchable="Search here..">
                <option value="Vegetarian">Vegetarian</option>
                <option value="Non-Vegetarian">Non-Vegetarian</option>
                <option value="Halal">Halal</option>
            </select>
            <br>

            <!-- Date & Time -->
            <br>
            <label><b>Specify a date and time for donation:</b></label>
            <input type="datetime-local" name="pickUpTime" required>

            <!-- Supply -->
            <label><b>Specify food amount by how many people it is sufficient for:</b></label>
            <input type="number" step="1" placeholder="Specify food capacity" name="quantity" required>

            <!-- Special Instructions -->
            <label><b>Special Instructions</b></label>
            <input placeholder="Enter any special instructions" name="specialInstructions">

            <!-- Images -->
            <br>
            <label><b>Upload an image:</b></label>
            <input type="file" name="image">

            <!-- Submit & Cancel -->
            <button type="submit" class="btn">Submit Donation</button>
        </form>
    </section>
</body>

</html>

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
    $restaurantName = $_POST["restaurantName"];
    $location = $_POST["location"];
    $categories = implode(", ", $_POST["category"]);
    $pickUpTime = $_POST["pickUpTime"];
    $quantity = $_POST["quantity"];
    $specialInstructions = $_POST["specialInstructions"];

    // Create the 'uploads' directory if it doesn't exist
    $target_dir = "uploads/";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    // Upload Image
    $file_name = basename($_FILES["image"]["name"]);
    $target_file = $target_dir . uniqid() . "_" . $file_name;

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        // Insert data into the 'donation' table
        $sql = "INSERT INTO donation (restaurantName, location, categories, pickUpTime, quantity, specialInstructions, image) 
                VALUES ('$restaurantName', '$location', '$categories', '$pickUpTime', '$quantity', '$specialInstructions', '$target_file')";

        if ($conn->query($sql) === TRUE) {
            echo "Donation submitted successfully!";
            // Redirect to index.php after 1 second
            header("refresh:1;url=index.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error uploading the file.";
    }
}

// Close the database connection
$conn->close();
?>
