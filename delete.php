<?php 
include 'config/db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;600&display=swap" rel="stylesheet">
<title>Delete Student</title>
<style>
    body { 
        font-family: "Nunito Sans", sans-serif; 
        margin: 40px; 
        background: #ffe6e6; 
        text-align: center; 
    }
    button { 
        font-family: "Nunito Sans", sans-serif;
        padding: 8px 15px; 
        border: none; 
        cursor: pointer; 
        border-radius: 4px; 
    }
    .confirm { 
        font-family: "Nunito Sans", sans-serif;
        background: red; 
        color: white; 
    }
    .cancel { 
        font-family: "Nunito Sans", sans-serif;
        background: gray; 
        color: white; 
    }
</style>
</head>
<body>
<h2>Confirm Delete</h2>

<?php
if (!isset($_GET['id'])) {
    die("<p style='color:red;'>No student ID provided.</p>");
}

$id = (int)$_GET['id'];


$stmt = $pdo->prepare("SELECT fullname FROM students WHERE id = ?");
$stmt->execute([$id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$row) {
    die("<p style='color:red;'>Student not found.</p>");
}


if (isset($_POST['confirm'])) {
    $delete = $pdo->prepare("DELETE FROM students WHERE id = ?");
    $delete->execute([$id]);

    echo "<script>alert('Student deleted successfully!'); window.location.href='read.php';</script>";
    exit;
}
?>

<p>Are you sure you want to delete <b><?= htmlspecialchars($row['fullname']) ?></b>?</p>

<form method="POST">
  <button type="submit" name="confirm" class="confirm">Yes, Delete</button>
  <button type="button" class="cancel" onclick="window.location.href='read.php'">Cancel</button>
</form>