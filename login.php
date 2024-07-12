<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "Sanjid#191";
$dbname = "EmployeeDataWeb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['username'], $_POST['password'], $_POST['role'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    if ($role == 'admin') {
        $sql = "SELECT * FROM AdminInfo WHERE username = ? AND password = ?";
    } else {
        $sql = "SELECT * FROM EmployeeDetails WHERE EmployeeId = ? AND EmployeeId = ?";
    }

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $role;
        if ($role == 'admin') {
            $response = ['success' => true, 'redirect' => 'admin_dashboard.html'];
        }
    } else {
        $response = ['success' => false];
    }

    if ($result->num_rows > 0) {
        $_SESSION['EmployeeId'] = $username;
        $_SESSION['role'] = $role;
        if ($role == 'employee') {
            $response = ['success' => true, 'redirect' => 'employee_dashboard.html'];
        }
    } else {
        $response = ['success' => false];
    }

    $stmt->close();
} else {
    $response = ['success' => false, 'error' => 'Incomplete form submission'];
}

$conn->close();

echo json_encode($response);
?>
