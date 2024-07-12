<?php
// fetch_all_employees.php
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

$sql = "SELECT * FROM EmployeeDetails";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Employee Data</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="view_all_employee_container">
        <h1>View All Employee Data</h1>
        <table id="employeeTable">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Employee ID</th>
                    <th>Age</th>
                    <th>Father's Name</th>
                    <th>Department</th>
                    <th>Position</th>
                    <th>Date of Birth</th>
                    <th>Salary</th>
                    <th>Address</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th>Education</th>
                    <th>Gender</th>
                </tr>
            </thead>
            <tbody id="employeeDataBody">
                <?php
                if ($result->num_rows > 0) {
                    // Output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["name"] . "</td>";
                        echo "<td>" . $row["EmployeeId"] . "</td>";
                        echo "<td>" . $row["age"] . "</td>";
                        echo "<td>" . $row["fatherName"] . "</td>";
                        echo "<td>" . $row["department"] . "</td>";
                        echo "<td>" . $row["position"] . "</td>";
                        echo "<td>" . $row["Dateofbarth"] . "</td>";
                        echo "<td>" . $row["salary"] . "</td>";
                        echo "<td>" . $row["address"] . "</td>";
                        echo "<td>" . $row["PhoneNum"] . "</td>";
                        echo "<td>" . $row["email"] . "</td>";
                        echo "<td>" . $row["education"] . "</td>";
                        echo "<td>" . $row["gender"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='13'>No employees found</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
    <button onclick="window.location.href='admin_dashboard.html'" class="back-button">Back</button>

</body>
</html>
