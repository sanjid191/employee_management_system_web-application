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

$sql = "SELECT * FROM AdminNotice";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Notice</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="view_all_applications_container">
        <h1>Admin Notice</h1>
        <table id="applicationsTable">
            <thead>
                <tr>
                    <th>Serial </th>
                    <th>Admin Name</th>
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
                        echo "<td>" . $row["AdminName"] . "</td>";
                        echo "<td>" . $row["Subject"] . "</td>";
                        echo "<td>" . $row["NoticeText"] . "</td>";
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

    <button class="back-button" onclick="location.href='employee_dashboard.html'">Back</button>

</body>
</html>
