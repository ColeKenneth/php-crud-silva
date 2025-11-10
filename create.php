<?php 
include 'config/db.php';
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_no = trim($_POST['student_no']);
    $fullname = trim($_POST['fullname']);
    $branch = trim($_POST['branch']);
    $email = trim($_POST['email']);
    $contact = trim($_POST['contact']);

    $stmt = $pdo->prepare("SELECT COUNT(*) FROM students WHERE student_no = ?");
    $stmt->execute([$student_no]); 

    if ($stmt->fetchColumn() > 0) {
        $errors[] = "Student number already exists.";
    } else {
        $stmt = $pdo->prepare("INSERT INTO students (student_no, fullname, branch, email, contact) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$student_no, $fullname, $branch, $email, $contact]);
        echo "<script>alert('Student successfully added!'); window.location.href='read.php';</script>";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Record</title>
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
        form {
            font-family: "Nunito Sans", sans-serif;
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            max-width: 400px;
            margin: auto;
        }
        input, select {
            font-family: "Nunito Sans", sans-serif;
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            font-family: "Nunito Sans", sans-serif;
            background-color: #28a745;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover { background-color: #218838; }
    </style>
</head>
<body>
    <h1>Create Student Record</h1>

    <?php if (!empty($errors)): ?>
        <div style="color:red;">
            <?php foreach ($errors as $error): ?>
                <p><?= htmlspecialchars($error) ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form action="create.php" method="POST">
        <input type="text" name="student_no" placeholder="Student Number" required>
        <input type="text" name="fullname" placeholder="Full Name" required>
        <select name="branch" class="branch" required>
            <option value="">Select Branch</option>
            <option value="Computer Science">Computer Science</option>
            <option value="Information Technology">Information Technology</option>
            <option value="Electrical Engineering">Electrical Engineering</option>
            <option value="Mechanical Engineering">Mechanical Engineering</option>
            <option value="Civil Engineering">Civil Engineering</option>
        </select>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="contact" placeholder="Contact Number" required>
        <button type="submit" name="submit">Create Record</button>
        <button type="button" onclick="window.location.href='home.php'">Back to Home</button>
    </form>
</body>
</html>