<?php 
include 'config/db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Records</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;600&display=swap" rel="stylesheet">
    <style>
    body {
        font-family: "Nunito Sans", sans-serif;
        background-color: #f4f4f4;
        text-align: center;
        padding: 20px;
    }
    table {
        border-collapse: collapse;
        width: 80%;
        margin: auto;
    }
    th, td {
        border: 1px solid #ddd;
        padding: 8px;
    }
    th {
        background-color: #4CAF50;
        color: white;
    }
    tr:nth-child(even) {
        background-color: #f2f2f2;
    }
    tr:hover {
        background-color: #ddd;
    }
    a {
        color: #007BFF;
        text-decoration: none;
    }
    a:hover {
        text-decoration: underline;
    }
    button {
        font-family: "Nunito Sans", sans-serif;
        background-color: #008CBA;
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        margin-top: 20px;
    }
    </style>
</head>
<body>
    <h1>Student Records</h1> 

    <table>
        <tr>
            <th>Student ID</th>
            <th>Student Number</th>
            <th>Full Name</th>
            <th>Branch</th>
            <th>Email</th>
            <th>Contact</th>
            <th>Date Added</th>
            <th>Actions</th>
        </tr>

        <?php
        try {
            $stmt = $pdo->query("SELECT * FROM students ORDER BY id ASC");
            $students = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($students) {
                foreach ($students as $student) {
                    echo "<tr>
                        <td>" . htmlspecialchars($student['id']) . "</td>
                        <td>" . htmlspecialchars($student['student_no']) . "</td>
                        <td>" . htmlspecialchars($student['fullname']) . "</td>
                        <td>" . htmlspecialchars($student['branch']) . "</td>
                        <td>" . htmlspecialchars($student['email']) . "</td>
                        <td>" . htmlspecialchars($student['contact']) . "</td>
                        <td>" . htmlspecialchars($student['date_added']) . "</td>
                        <td>
                            <a href='update.php?id=" . $student['id'] . "'>Edit</a> |
                            <a href='delete.php?id=" . $student['id'] . "'>Delete</a>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='8'>No records found.</td></tr>";
            }
        } catch (PDOException $e) {
            echo "<tr><td colspan='8' style='color:red;'>Error: " . $e->getMessage() . "</td></tr>";
        }
        ?>
    </table>

    <button onclick="window.location.href='create.php'">Add New Student</button>
    <button onclick="window.location.href='home.php'">Back to Home</button>
</body>
</html>

