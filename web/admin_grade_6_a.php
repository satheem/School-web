<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header('Location: login.php');
    exit();
}

$host = 'localhost'; // Your database host
$db = 'school';      // Your database name
$user = 'root';      // Your database username
$pass = '';          // Your database password

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch students
$sql = "SELECT student_id, full_name, name_with_initial, address, whatsapp_no, parent_no, photo, order_no FROM students";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Students</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f7f9fc;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: #ffffff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }
        .logo {
            display: block;
            max-width: 150px;
            margin: 0 auto 20px;
        }
        h2 {
            font-weight: 700;
            color: #333;
            text-align: center;
            margin-bottom: 30px;
        }
        .button {
            display: block;
            width: 200px;
            margin: 0 auto 20px;
            padding: 10px;
            text-align: center;
            background: #007bff;
            color: white;
            font-size: 1.2em;
            text-decoration: none;
            border-radius: 5px;
        }
        .button:hover {
            background: #0056b3;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .student-photo {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 50%;
        }
        .add-student {
            font-size: 1.5em;
            color: #007bff;
            text-decoration: none;
            margin: 10px 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .add-student:hover {
            color: #0056b3;
        }
        .add-icon {
            margin-right: 8px;
        }
        .logout-link {
            text-align: center;
            margin-top: 20px;
        }
        .logout-link a {
            color: #e74c3c;
            text-decoration: none;
            font-weight: 700;
            font-size: 1.2em;
            transition: color 0.3s ease;
        }
        .logout-link a:hover {
            color: #c0392b;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="img/logo3.png" alt="School Logo" class="logo">
        <a href="add_students.php" class="button">Add Student</a>
        <h2>Student List</h2>
                <table>
            <thead>
                <tr>
                    <th>Photo</th>
                    <th>Order No</th>
                    <th>Student ID</th>
                    <th>Full Name</th>
                    <th>Name with Initial</th>
                    <th>Address</th>
                    <th>WhatsApp No</th>
                    <th>Parent's No</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><img src="<?php echo htmlspecialchars($row['photo']); ?>" alt="Student Photo" class="student-photo"></td>
                            <td><?php echo htmlspecialchars($row['order_no']); ?></td>
                            <td><?php echo htmlspecialchars($row['student_id']); ?></td>
                            <td><?php echo htmlspecialchars($row['full_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['name_with_initial']); ?></td>
                            <td><?php echo htmlspecialchars($row['address']); ?></td>
                            <td><?php echo htmlspecialchars($row['whatsapp_no']); ?></td>
                            <td><?php echo htmlspecialchars($row['parent_no']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8">No students found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <div class="logout-link">
            <a href="logout.php">Logout</a>
        </div>
    </div>
</body>
</html>
<?php
$conn->close();
?>
