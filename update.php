<?php 
include 'config/db.php';

if (!isset($_GET['id'])) {
    die("<p style='color:red;'>No student ID provided.</p>");
}
$id = (int)$_GET['id'];


$stmt = $pdo->prepare("SELECT * FROM students WHERE id = ?");
$stmt->execute([$id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$row) {
    die("<p style='color:red;'>Student not found.</p>");
}


if (isset($_POST['update'])) {
    $student_no = trim($_POST['student_no']);
    $fullname = trim($_POST['fullname']);
    $branch = trim($_POST['branch']);
    $email = trim($_POST['email']);
    $contact = trim($_POST['contact']);

    $update = $pdo->prepare("UPDATE students SET student_no = ?, fullname = ?, branch = ?, email = ?, contact = ? WHERE id = ?");
    $update->execute([$student_no, $fullname, $branch, $email, $contact, $id]);

    echo "<script>alert('Updated successfully.'); window.location.href='read.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Record</title>
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
            background-color: #007BFF;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover { background-color: #0069d9; }
    </style>
</head>
<body>
    <h1>Update Student Record</h1>
    <form method="POST">
  <input type="text" name="student_no" value="<?= htmlspecialchars($row['student_no']) ?>" required>
  <input type="text" name="fullname" value="<?= htmlspecialchars($row['fullname']) ?>" required>

  <select name="branch" required>
    <option value="Computer Science" <?= $row['branch']=='Computer Science'?'selected':'' ?>>Computer Science</option>
    <option value="Information Technology" <?= $row['branch']=='Information Technology'?'selected':'' ?>>Information Technology</option>
    <option value="Electrical Engineering" <?= $row['branch']=='Electrical Engineering'?'selected':'' ?>>Electrical Engineering</option>
    <option value="Mechanical Engineering" <?= $row['branch']=='Mechanical Engineering'?'selected':'' ?>>Mechanical Engineering</option>
    <option value="Civil Engineering" <?= $row['branch']=='Civil Engineering'?'selected':'' ?>>Civil Engineering</option>
  </select>

  <input type="email" name="email" value="<?= htmlspecialchars($row['email']) ?>" required>
  <input type="text" name="contact" value="<?= htmlspecialchars($row['contact']) ?>">

  <button type="submit" name="update">Update</button>

    <div style="text-align:center;">
        <a href="read.php">Back to Student Records</a>
    </div>
</form>
</body>
</html>