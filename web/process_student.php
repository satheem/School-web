<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header('Location: login.php');
    exit();
}

// Database connection
$mysqli = new mysqli("localhost", "root", "", "school");

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect form data
    $student_id = $_POST['student_id'];
    $full_name = $_POST['full_name'];
    $name_with_initial = $_POST['name_with_initial'];
    $address = $_POST['address'];
    $whatsapp_no = $_POST['whatsapp_no'];
    $parent_no = $_POST['parent_no'];
    $order_no = $_POST['order_no'];
    $grade = $_POST['grade'];

    // Handle file upload
    $photo = '';
    if (!empty($_FILES['photo']['name'])) {
        $photo = $_FILES['photo']['name'];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($photo);
        if (move_uploaded_file($_FILES['photo']['tmp_name'], $target_file)) {
            // File uploaded successfully
        } else {
            echo "Error uploading file.";
            exit(); // Stop further execution
        }
    }

    // Insert student data into the database
    $query = "INSERT INTO students (student_id, full_name, name_with_initial, address, whatsapp_no, parent_no, photo, order_no, grade) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $mysqli->prepare($query);
    if ($stmt) {
        $stmt->bind_param("ssssssssi", $student_id, $full_name, $name_with_initial, $address, $whatsapp_no, $parent_no, $photo, $order_no, $grade);
        if ($stmt->execute()) {
            // Redirect to the grade dashboard after adding the student
            header("Location: admin_grade_$grade.php");
            exit();
        } else {
            echo "Error executing query: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $mysqli->error;
    }
}
$mysqli->close();
?>
