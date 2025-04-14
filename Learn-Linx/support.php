<?php
session_start();

// Redirect if not logged in
if (!isset($_SESSION['name'])) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Support - Learn Linx</title>
    <link rel="stylesheet" href="Home.css">
    <link href='https://fonts.googleapis.com/css?family=Oswald' rel='stylesheet'>
    <style>
        .support-container {
            text-align: center;
            margin-top: 30px;
        }
        .support-list {
            display: inline-block;
            text-align: left;
            margin-top: 20px;
            font-size: 18px;
        }
        .support-list li {
            margin: 10px 0;
        }
    </style>
</head>
<body>

<!-- Navigation Bar -->
<div class="navigationbar">
    <img src="logo.png" alt="Learn Linx Logo">
    <ul>
        <li><a href="dashboard.php">Home</a></li>
        <li><a href="Video.html">Courses</a></li>
        <li><a href="test-scores.php">Test Scores</a></li>
        <li><a href="support.php">Support</a></li>
    </ul>
</div>

<!-- Main Content -->
<div class="support-container">
    <h1>Support Contacts</h1>
    <p>If you need help or have questions, you can contact any of the team members below:</p>

    <ul class="support-list">
        <li><strong>Marlene Habib:</strong> <a href="mailto:MarleneHabib@LearnLinx.com" target="_blank">MarleneHabib@LearnLinx.com</a></li>
        <li><strong>Vardhan Jalluri:</strong> <a href="mailto:VardhanJalluri@LearnLinx.com" target="_blank">VardhanJalluri@LearnLinx.com</a></li>
        <li><strong>Himashaili Donavalli:</strong> <a href="mailto:HimashailiDonavalli@LearnLinx.com" target="_blank">HimashailiDonavalli@LearnLinx.com</a></li>
        <li><strong>Shreeji Patel:</strong> <a href="mailto:ShreejiPatel@LearnLinx.com" target="_blank">ShreejiPatel@LearnLinx.com</a></li>
        <li><strong>Kevin Patel:</strong> <a href="mailto:KevinPatel@LearnLinx.com" target="_blank">KevinPatel@LearnLinx.com</a></li>
    </ul>
</div>

</body>
</html>
