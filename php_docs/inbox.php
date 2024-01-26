<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FeedOn - Inbox</title>

    <style>
        body {
            background: white;
            color: #333;
            font-family: Arial, sans-serif;
        }

        h1.center {
            text-align: center;
            color: green; /* Change to green color */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 15px;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        .center {
            text-align: center;
        }
        .donation-card img {
    max-width: 100%; /* Make sure the image doesn't exceed the container */
    height: auto;
    margin-bottom: 10px;
    max-height: 150px; /* Set a maximum height for the image */
}

        .inbox-btn {
            background: green; /* Change to green color */
            color: white; /* Change to white color */
            padding: 10px 15px;
            border: none;
            cursor: pointer;
            margin: 5px;
        }

        .data {
            background: white;
            color: #333;
        }

        .donation-card {
            background: white;
            color: #333;
            border: 1px solid #ccc;
            padding: 15px;
            margin-bottom: 15px;
        }

        .donation-card img {
            max-width: 100%; /* Make sure the image doesn't exceed the container */
            height: auto;
            margin-bottom: 10px;
        }

        .center hr {
            background-color: #333;
        }
    </style>

</head>

<body class="bg-dark">

    <h1 class="center">DONATION OFFERS</h1>

    <!-- Donation card -->
    <div class="center">
        <button onclick="listUnreadInbox()" class="inbox-btn">UNREAD
            <span id="numOfUnread" class="badge"></span>
        </button>
        <button onclick="window.location.href='accepted.php'" class="inbox-btn">ACCEPTED</button>
        <button onclick="window.location.href='declined.php'" class="inbox-btn">DECLINED</button>
    </div>

    <div class="data container">
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "users";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Add status column if not exists
    $conn->query("ALTER TABLE donation ADD COLUMN IF NOT EXISTS status VARCHAR(255) DEFAULT 'unread'");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["accept"])) {
            $donationId = $_POST["accept"];
            $conn->query("UPDATE donation SET status = 'accepted' WHERE id = $donationId");
        } elseif (isset($_POST["decline"])) {
            $donationId = $_POST["decline"];
            $conn->query("UPDATE donation SET status = 'declined' WHERE id = $donationId");
        }
    }

    $sql = "SELECT * FROM donation WHERE status = 'unread'";
    $result = $conn->query($sql);

    if ($result === false) {
        echo "Error: " . $sql . "<br>" . $conn->error;
        exit;
    }

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='donation-card'>";
            // Check if the image column exists in the result set
            if (isset($row["image"])) {
                echo "<img src='" . $row["image"] . "' alt='Donation Image'>";
            } else {
                echo "<p>No image available</p>";
            }
            echo "<h3>" . $row["restaurantName"] . "</h3>";
            echo "<p>Location: " . $row["location"] . "</p>";
            echo "<p>Date and Time: " . $row["pickUpTime"] . "</p>";
            echo "<p>Quantity: " . $row["quantity"] . "</p>";
            echo "<p>Special Instructions: " . $row["specialInstructions"] . "</p>";
            echo "<form method='post'>";
            echo "<input type='hidden' name='accept' value='" . $row["id"] . "' />";
            echo "<button type='submit'>Accept</button>";
            echo "</form>";
            echo "<form method='post'>";
            echo "<input type='hidden' name='decline' value='" . $row["id"] . "' />";
            echo "<button type='submit'>Decline</button>";
            echo "</form>";
            echo "</div>";
        }
    } else {
        echo "<p class='center'>No unread donation offers</p>";
    }

    $conn->close();
    ?>
    </div>

    <hr class="center">

</body>

</html>
