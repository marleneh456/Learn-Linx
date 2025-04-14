<?php
session_start();

$user = $_SESSION['name']; // Get the logged in user's name
$course = $_POST['course']; // Get course name like HTML
$score = $_POST['score'];   // Score the user got
$total = $_POST['total'];   // Total number of quiz questions

$conn = new mysqli("localhost", "root", "", "learn_linx");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("INSERT INTO quiz_scores (user_name, course_name, score, total) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssii", $user, $course, $score, $total);
$stmt->execute();
$stmt->close();
$conn->close();
?>
