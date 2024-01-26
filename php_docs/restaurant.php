
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Page</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            color: #2ecc71;
            margin-top: 30px;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            background: white;
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background: #2ecc71;
            color: white;
            position: sticky;
            top: 0;
        }

        tr:hover {
            background: #f5f5f5;
        }

        @media (max-width: 768px) {
            table {
                width: 100%;
            }
        }
    </style>
</head>

<body>

    <h2>Restaurant Data</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>User Type</th>
            <th>Description</th>
            <th>Location</th>
        </tr>

        <?php
        // Your PHP code here
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "users";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM organizations WHERE user_type = 'Restaurant'";
        $result = $conn->query($sql);

        if ($result === false) {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["name"] . "</td>";
                echo "<td>" . $row["user_type"] . "</td>";
                echo "<td>" . $row["description"] . "</td>";
                echo "<td>" . $row["location"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No restaurant data found</td></tr>";
        }

        $conn->close();
        ?>

    </table>

</body>

</html>
