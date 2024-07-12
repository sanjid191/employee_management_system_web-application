<?php
// fetch_all_applications.php
$servername = "localhost";
$username = "root";
$password = "Sanjid#191";
$dbname = "EmployeeDataWeb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM EmployeeApplications";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Applications</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="view_all_applications_container">
        <h1>Employee Applications</h1>
        <table id="applicationsTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Employee ID</th>
                    <th>Subject</th>
                    <th>Application Text</th>
                    <th>Submission Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    // Output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["name"] . "</td>";
                        echo "<td>" . $row["EmployeeId"] . "</td>";
                        echo "<td>" . $row["subject"] . "</td>";
                        echo "<td>" . $row["applicationText"] . "</td>";
                        echo "<td>" . $row["submissionDate"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No applications found</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>

    <button class="back-button" onclick="location.href='admin_dashboard.html'">Back</button>

</body>
</html>
