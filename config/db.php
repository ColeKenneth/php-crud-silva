<?php
session_start();

$DB_HOST = 'localhost';
$DB_PASS = '';
$DB_NAME = 'branch_directory';
$DB_USER = 'root';

try {
    $pdo = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", $DB_USER, $DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>