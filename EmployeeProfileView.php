<?php
session_start();
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

$employeeData = null;
$error = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $employeeId = $_POST['employeeId'];

    $sql = "SELECT * FROM EmployeeDetails WHERE EmployeeId = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $employeeId);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $employeeData = $result->fetch_assoc();
        } else {
            $error = "No employee found with the provided ID.";
        }
    } else {
        $error = "Failed to execute query.";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Profile</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="profile_container">
        <div class="profile_header">
            <h1>Employee Profile</h1>
        </div>
        
        <div class="profile_search">
            <form method="POST" action="EmployeeProfileView.php">
                <input type="text" name="employeeId" placeholder="Enter Employee ID" required>
                <button type="submit">Search</button>
            </form>
        </div>

        <?php if (isset($employeeData)) { ?>
            <div class="profile_content">
                <div class="profile_pic">
                    <img src="EmpProPic.jpg" alt="Profile Picture" id="profilePicture">
                </div>

                <div class="profile_details" id="profileDetails">
                    <h2><?php echo htmlspecialchars($employeeData['name']); ?></h2>
                    <p><strong>Employee ID:</strong> <?php echo htmlspecialchars($employeeData['EmployeeId']); ?></p>
                    <p><strong>Age:</strong> <?php echo htmlspecialchars($employeeData['age']); ?></p>
                    <p><strong>Father's Name:</strong> <?php echo htmlspecialchars($employeeData['fatherName']); ?></p>
                    <p><strong>Department:</strong> <?php echo htmlspecialchars($employeeData['department']); ?></p>
                    <p><strong>Position:</strong> <?php echo htmlspecialchars($employeeData['position']); ?></p>
                    <p><strong>Date of Birth:</strong> <?php echo htmlspecialchars($employeeData['Dateofbarth']); ?></p>
                    <p><strong>Salary:</strong> <?php echo htmlspecialchars($employeeData['salary']); ?></p>
                    <p><strong>Address:</strong> <?php echo htmlspecialchars($employeeData['address']); ?></p>
                    <p><strong>Phone Number:</strong> <?php echo htmlspecialchars($employeeData['PhoneNum']); ?></p>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($employeeData['email']); ?></p>
                    <p><strong>Education:</strong> <?php echo htmlspecialchars($employeeData['education']); ?></p>
                    <p><strong>Gender:</strong> <?php echo htmlspecialchars($employeeData['gender']); ?></p>
                </div>
            </div>
        <?php } elseif (isset($error)) { ?>
            <div class="error_message">
                <p><?php echo $error; ?></p>
            </div>
        <?php } ?>

    </div>

    <button onclick="window.location.href='employee_dashboard.html'" class="back-button">Back</button>

    <script src="profile.js"></script>
</body>
</html>
