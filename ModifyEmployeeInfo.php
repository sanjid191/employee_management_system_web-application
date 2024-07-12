<?php
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

$employee = null;
$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
            $message = "Employee not Found";
        }

        $stmt->close();
    } elseif (isset($_POST['update'])) {
        $employeeId = $_POST['employeeId'];
        $name = $_POST['name'];
        $age = $_POST['age'];
        $fatherName = $_POST['fatherName'];
        $department = $_POST['department'];
        $position = $_POST['position'];
        $dob = $_POST['dob'];

        // Prepare the SQL statement to update the employee
        $sql = "UPDATE EmployeeDetails SET name=?, age=?, fatherName=?, department=?, position=?, Dateofbarth=? WHERE EmployeeId=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssss", $name, $age, $fatherName, $department, $position, $dob, $employeeId);

        if ($stmt->execute()) {
            $message = "Update Successful";
            // Fetch updated data to display
            $sql_select = "SELECT * FROM EmployeeDetails WHERE EmployeeId = ?";
            $stmt_select = $conn->prepare($sql_select);
            $stmt_select->bind_param("s", $employeeId);
            $stmt_select->execute();
            $result_select = $stmt_select->get_result();
            
            if ($result_select->num_rows > 0) {
                $employee = $result_select->fetch_assoc();
            } else {
                $message = "Employee not Found";
            }

            $stmt_select->close();
        } else {
            $message = "Error updating employee: " . $conn->error;
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
    <title>Update Employee Data</title>
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

    <div class="update_employee_container">
        <h1>Update Employee Data</h1>

        <?php if (!empty($message)): ?>
            <!-- Popup message for success or error -->
            <div class="popup-message <?php echo strpos($message, 'Successful') !== false ? 'success' : 'error'; ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <form action="ModifyEmployeeInfo.php" method="post" class="update_employee_form">
            <div class="update_employee_group">
                <label for="employeeId">Employee ID:</label>
                <input type="text" id="employeeId" name="employeeId" value="<?php echo isset($employee) ? $employee['EmployeeId'] : ''; ?>" required>
                <button type="submit" name="search" class="update_employee_button">Search</button>
            </div>
        </form>

        <?php if ($employee): ?>
            <form action="ModifyEmployeeInfo.php" method="post" class="update_employee_form">
                <div class="update_employee_group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" value="<?php echo $employee['name']; ?>" required>
                </div>
                <div class="update_employee_group">
                    <label for="age">Age:</label>
                    <input type="text" id="age" name="age" value="<?php echo $employee['age']; ?>" required>
                </div>
                <div class="update_employee_group">
                    <label for="fatherName">Father's Name:</label>
                    <input type="text" id="fatherName" name="fatherName" value="<?php echo $employee['fatherName']; ?>" required>
                </div>
                <div class="update_employee_group">
                    <label for="department">Department:</label>
                    <input type="text" id="department" name="department" value="<?php echo $employee['department']; ?>" required>
                </div>
                <div class="update_employee_group">
                    <label for="position">Position:</label>
                    <input type="text" id="position" name="position" value="<?php echo $employee['position']; ?>" required>
                </div>
                <div class="update_employee_group">
                    <label for="dob">Date of Birth:</label>
                    <input type="text" id="dob" name="dob" value="<?php echo $employee['Dateofbarth']; ?>" required>
                </div>
                <div class="update_employee_group">
                    <label for="salary">Salary:</label>
                    <input type="text" id="salary" name="salary" value="<?php echo $employee['salary']; ?>" required>
                </div>
                <div class="update_employee_group">
                    <label for="address">Address:</label>
                    <input type="text" id="address" name="address" value="<?php echo $employee['address']; ?>" required>
                </div>
                <div class="update_employee_group">
                    <label for="phoneNum">Phone Number:</label>
                    <input type="text" id="phoneNum" name="phoneNum" value="<?php echo $employee['PhoneNum']; ?>" required>
                </div>
                <div class="update_employee_group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo $employee['email']; ?>" required>
                </div>
                <div class="update_employee_group">
                    <label for="education">Education:</label>
                    <input type="text" id="education" name="education" value="<?php echo $employee['education']; ?>" required>
                </div>
                <div class="update_employee_group">
                    <label for="gender">Gender:</label>
                    <input type="text" id="gender" name="gender" value="<?php echo $employee['gender']; ?>" required>
                </div>

                <input type="hidden" name="employeeId" value="<?php echo $employee['EmployeeId']; ?>">
                <button type="submit" name="update" class="update_employee_button">Update</button>
                <button class="back-button" onclick="location.href='admin_dashboard.php'">Back</button>
            </form>
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
