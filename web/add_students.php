<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f7f9fc;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: #ffffff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }
        h2 {
            font-weight: 700;
            color: #333;
            text-align: center;
            margin-bottom: 30px;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 10px;
            font-weight: 500;
        }
        input[type="text"], textarea, input[type="file"] {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #ddd;
            width: 100%;
        }
        button {
            padding: 10px;
            background-color: #007bff;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Add New Student</h2>
        <form action="process_student.php" method="post" enctype="multipart/form-data">
            <label for="student_id">Student ID:</label>
            <input type="text" id="student_id" name="student_id" required>

            <label for="full_name">Full Name:</label>
            <input type="text" id="full_name" name="full_name" required>

            <label for="name_with_initial">Name with Initial:</label>
            <input type="text" id="name_with_initial" name="name_with_initial" required>

            <label for="address">Address:</label>
            <textarea id="address" name="address" rows="4"></textarea>

            <label for="whatsapp_no">WhatsApp No:</label>
            <input type="text" id="whatsapp_no" name="whatsapp_no">

            <label for="parent_no">Parent No:</label>
            <input type="text" id="parent_no" name="parent_no">

            <label for="photo">Photo:</label>
            <input type="file" id="photo" name="photo">

            <label for="order_no">Order No:</label>
            <input type="text" id="order_no" name="order_no">

            <label for="grade">Grade:</label>
            <input type="text" id="grade" name="grade" required>

            <button type="submit">Add Student</button>
        </form>
    </div>
</body>
</html>
