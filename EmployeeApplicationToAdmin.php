<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Application</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="application_container">
        <h1>Submit Application</h1>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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

            $name = $_POST['name'];
            $employeeId = $_POST['EmployeeId'];
            $subject = $_POST['subject'];
            $applicationText = $_POST['applicationText'];

            $sql = "INSERT INTO EmployeeApplications (name, EmployeeId, subject, applicationText)
                    VALUES (?, ?, ?, ?)";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssss", $name, $employeeId, $subject, $applicationText);

            if ($stmt->execute()) {
                echo "<p class='success_message'>Application submitted successfully.</p>";
            } else {
                echo "<p class='error_message'>Error submitting application. Please try again.</p>";
            }

            $stmt->close();
            $conn->close();
        }
        ?>
        <form action="EmployeeApplicationToAdmin.php" method="post" class="application_form">
            <div class="application_form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="application_form-group">
                <label for="EmployeeId">Employee ID:</label>
                <input type="text" id="EmployeeId" name="EmployeeId" required>
            </div>
            <div class="application_form-group">
                <label for="subject">Subject:</label>
                <input type="text" id="subject" name="subject" required>
            </div>
            <div class="application_form-group">
                <label for="applicationText">Application:</label>
                <textarea id="applicationText" name="applicationText" rows="10" required></textarea>
            </div>
            <div class="application_form-group">
                <button type="submit" class="submit-button">Submit</button>
            </div>
        </form>
        <button onclick="window.location.href='employee_dashboard.html'" class="back-button">Back</button>
    </div>
</body>
</html>
