<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Notice</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="application_container">
        <h1>Submit Notice</h1>
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

            $adminName = $_POST['adminName'];
            $subject = $_POST['subject'];
            $noticeText = $_POST['noticeText'];

            $sql = "INSERT INTO AdminNotice (AdminName, subject, NoticeText)
                    VALUES (?, ?, ?)";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $adminName, $subject, $noticeText);

            if ($stmt->execute()) {
                echo "<p class='success_message'>Notice submitted successfully.</p>";
            } else {
                echo "<p class='error_message'>Error submitting notice. Please try again.</p>";
            }

            $stmt->close();
            $conn->close();
        }
        ?>
        <form action="SendNoticeToEmployee.php" method="post" class="application_form">
            <div class="application_form-group">
                <label for="adminName">Admin Name:</label>
                <input type="text" id="adminName" name="adminName" required>
            </div>
            <div class="application_form-group">
                <label for="subject">Subject:</label>
                <input type="text" id="subject" name="subject" required>
            </div>
            <div class="application_form-group">
                <label for="noticeText">Notice:</label>
                <textarea id="noticeText" name="noticeText" rows="10" required></textarea>
            </div>
            <div class="application_form-group">
                <button type="submit" class="submit-button">Submit</button>
            </div>
        </form>
        <button onclick="window.location.href='admin_dashboard.html'" class="back-button">Back</button>
    </div>
</body>
</html>
