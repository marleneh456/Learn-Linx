<?php
session_start();
$name = isset($_SESSION['name']) ? $_SESSION['name'] : null;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Support - Learn Linx</title>
    <link href="Home.css" type="text/css" rel ="stylesheet">
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
    <a href="<?php echo isset($_SESSION['name']) ? 'dashboard.php' : 'Home.html'; ?>">
        <img src="logo.png" alt="Learn Linx Logo">
    </a>
    <ul>
    <?php if (isset($_SESSION['name'])): ?>
        <li><a href="dashboard.php">Home</a></li>
        <li><a href="Video.html">Courses</a></li>
        <li><a href="test-scores.php">Test Scores</a></li>
        <li><a href="support.php">Support</a></li>
    <?php else: ?>
        <li><a href="Home.html">Home</a></li>
        <li><a href="support.php">Support</a></li>
        <li><a href="index.php">Login/Signup</a></li>
    <?php endif; ?>
    </ul>
</div>


<!-- Main Content -->
<div class="support-container">
    <h1>Support Contacts</h1>
    <?php if ($name): ?>
        <p>Welcome, <strong><?php echo htmlspecialchars($name); ?></strong>!</p>
    <?php endif; ?>
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