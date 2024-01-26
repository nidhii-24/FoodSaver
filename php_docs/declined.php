<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FeedOn - Declined Offers</title>

    <style>
        body {
            background: white;
            color: #333;
            font-family: Arial, sans-serif;
        }

        h1.center {
            text-align: center;
            color: black;
        }

        .data.container {
            text-align: center;
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 15px;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>

<body class="bg-dark">

    <h1 class="center">DECLINED OFFERS</h1>

    <!-- Donation card -->
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

        // Fetch declined donations
        $sql = "SELECT * FROM donation WHERE status = 'declined'";
        $result = $conn->query($sql);

        if ($result === false) {
            echo "Error: " . $sql . "<br>" . $conn->error;
            exit;
        }

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>Restaurant Name</th><th>Location</th><th>Date and Time</th><th>Quantity</th><th>Special Instructions</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["restaurantName"] . "</td>";
                echo "<td>" . $row["location"] . "</td>";
                echo "<td>" . $row["pickUpTime"] . "</td>";
                echo "<td>" . $row["quantity"] . "</td>";
                echo "<td>" . $row["specialInstructions"] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p class='center'>No declined donation offers</p>";
        }

        $conn->close();
        ?>
    </div>

    <hr class="center">

</body>

</html>
