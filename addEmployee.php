<?php
$servername = "localhost";
$username = "root";
$password = "Sanjid#191";
$dbname = "EmployeeDataWeb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $EmployeeId = $_POST['EmployeeId'];
    $age = $_POST['age'];
    $fatherName = $_POST['fatherName'];
    $department = $_POST['department'];
    $position = $_POST['position'];
    $Dateofbarth = $_POST['Dateofbarth'];
    $salary = $_POST['salary'];
    $address = $_POST['address'];
    $PhoneNum = $_POST['PhoneNum'];
    $email = $_POST['email'];
    $education = $_POST['education'];
    $gender = $_POST['gender'];

    $sql = "INSERT INTO EmployeeDetails (name, EmployeeId, age, fatherName, department, position, Dateofbarth, salary, address, PhoneNum, email, education, gender) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param("sssssssssssss", $name, $EmployeeId, $age, $fatherName, $department, $position, $Dateofbarth, $salary, $address, $PhoneNum, $email, $education, $gender);

    if ($stmt->execute( )) {
        echo "New employee added successfully";
        echo "<script>alert('New employee added successfully');</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
