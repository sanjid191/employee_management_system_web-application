<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register as Admin</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="registration-container">
        <h1>Register as Admin</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="registration_form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="registration_form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button class="Register-button" type="submit">Register</button>
        </form>
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

            $username = $_POST['username'];
            $password = $_POST['password'];

            // Insert user into database
            $stmt = $conn->prepare("INSERT INTO AdminInfo (username, password) VALUES (?, ?)");
            $stmt->bind_param("ss", $username, $password);

            if ($stmt->execute()) {
                $message = "Registration successful!";
            } else {
                $message = "Registration failed: " . $stmt->error;
            }

            $stmt->close();
            $conn->close();

            // Redirect back to the form with a message
            echo "<p>$message</p>";
        }
        ?>
    </div>

    <button onclick="window.location.href='admin_dashboard.html'" class="back-button">Back</button>

    <script src="script.js"></script>
</body>
</html>
