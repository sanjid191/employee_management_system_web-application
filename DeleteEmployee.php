<?php
$servername = "localhost";
$username = "root";
$password = "Sanjid#191";
$dbname = "EmployeeDataWeb";

// Initialize variables
$employee = null;
$message = '';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['search'])) {
        $employeeId = $_POST['employeeId'];

        // Prepare the SQL statement to fetch the employee
        $sql = "SELECT * FROM EmployeeDetails WHERE EmployeeId = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $employeeId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $employee = $result->fetch_assoc();
        } else {
            $message = "Employee not found with ID $employeeId.";
        }

        $stmt->close();
    } elseif (isset($_POST['delete'])) {
        $employeeId = $_POST['employeeId'];

        // Prepare the SQL statement to delete the employee
        $sql = "DELETE FROM EmployeeDetails WHERE EmployeeId = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $employeeId);

        if ($stmt->execute()) {
            $message = "Delete Successful"; // Set success message
            $employee = null; // Clear the employee details after deletion
        } else {
            $message = "Error deleting employee: " . $conn->error;
        }

        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Employee</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Popup message styles */
        .popup-message {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 20px;
            border-radius: 5px;
            display: none;
            z-index: 1000;
        }

        .popup-message.show {
            display: block;
        }
    </style>
</head>
<body>

    <div class="delete_employee_container">
        <h1>Delete Employee</h1>

        <?php if (!empty($message)): ?>
            <!-- Popup message for success or error -->
            <div class="popup-message <?php echo strpos($message, 'Successful') !== false ? 'success' : 'error'; ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <form action="DeleteEmployee.php" method="post" class="delete_employee_form">
            <div class="delete_employee_group">
                <label for="employeeId">Employee ID:</label>
                <input type="text" id="employeeId" name="employeeId" value="<?php echo isset($employee) ? $employee['EmployeeId'] : ''; ?>" required>
                <button type="submit" name="search" class="delete_employee_button">Search</button>
            </div>
        </form>

        <?php if ($employee): ?>
            <div class="employee_details">
                <h2>Employee Details</h2>
                <p><strong>Name:</strong> <?php echo $employee['name']; ?></p>
                <p><strong>Age:</strong> <?php echo $employee['age']; ?></p>
                <p><strong>Father's Name:</strong> <?php echo $employee['fatherName']; ?></p>
                <p><strong>Department:</strong> <?php echo $employee['department']; ?></p>
                <p><strong>Position:</strong> <?php echo $employee['position']; ?></p>
                <p><strong>Date of Birth:</strong> <?php echo $employee['Dateofbarth']; ?></p>
                <p><strong>Salary:</strong> <?php echo $employee['salary']; ?></p>
                <p><strong>Address:</strong> <?php echo $employee['address']; ?></p>
                <p><strong>Phone Number:</strong> <?php echo $employee['PhoneNum']; ?></p>
                <p><strong>Email:</strong> <?php echo $employee['email']; ?></p>
                <p><strong>Education:</strong> <?php echo $employee['education']; ?></p>
                <p><strong>Gender:</strong> <?php echo $employee['gender']; ?></p>

                <form action="DeleteEmployee.php" method="post">
                    <input type="hidden" name="employeeId" value="<?php echo $employee['EmployeeId']; ?>">
                    <button type="submit" name="delete" class="delete_employee_button">Delete</button>
                </form>
            </div>
        <?php endif; ?>

        <button class="back-button" onclick="location.href='admin_dashboard.html'">Back</button>
    </div>

    <script>
        // Display popup message
        window.onload = function() {
            var popup = document.querySelector('.popup-message');
            if (popup) {
                setTimeout(function() {
                    popup.classList.add('show');
                    setTimeout(function() {
                        popup.classList.remove('show');
                    }, 3000); // Hide after 3 seconds
                }, 500); // Delay showing for 0.5 seconds
            }
        };
    </script>

</body>
</html>
