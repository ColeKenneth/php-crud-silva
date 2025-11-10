<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
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
        button {
            font-family: "Nunito Sans", sans-serif;
            background-color: #007BFF;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin: 10px;
        }
        button:hover { background-color: #0069d9; }

    </style>
</head>
<body>
    <h1>Student Branch Directory System</h1>
    <nav>
        <button onclick="location.href='create.php'">Add Student</button>
        <button onclick="location.href='read.php'">View Students</button>
        <button onclick="location.href='read.php'">Update Student</button>
        <button onclick="location.href='read.php'">Delete Student</button>
    </nav>  
</body>
</html>
