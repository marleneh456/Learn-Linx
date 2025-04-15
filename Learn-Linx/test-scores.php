<?php
session_start();
if (!isset($_SESSION['name'])) {
    header("Location: index.php");
    exit;
}

$conn = new mysqli("localhost", "root", "", "learn_linx");
$user = $_SESSION['name'];

// Handle deletion
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $stmt = $conn->prepare("DELETE FROM quiz_scores WHERE id = ? AND user_name = ?");
    $stmt->bind_param("is", $delete_id, $user);
    $stmt->execute();
    header("Location: test-scores.php");
    exit;
}

$sql = "SELECT id, course_name, score, total, taken_on FROM quiz_scores WHERE user_name = ? ORDER BY taken_on DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Your Test Score History</title>
    <link href="style.css" rel="stylesheet" />
    <link href='https://fonts.googleapis.com/css?family=Oswald' rel='stylesheet'>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <a id="top"></a>
    <style>
        body {
            font-family: Arial;
            background:rgb(90, 76, 173); /* Purple background */
            color: white;
            text-align: center;
        }
        table {
            border-collapse: collapse;
            width: 800px;
            height: 100px;
            margin: auto;
            background: white;
            color: black;
            font-size: 18px;
            text-align: center;
        }
        th, td {
            border: 5px solid #A9A9A9;
            padding: 10px;
        }
        th {
            background-color: #6b2390;
            color: white;
        }
        .pdf-button{
            background-color: #2d5986;
            color: white;
            padding: 8px 15px;
            border: none;
            cursor: pointer;
            font-size: 14px;
            margin: 4px;
            border-radius: 10px;
            transition: background-color 0.8s ease;
        }

        .pdf-button:hover {
            background-color:rgb(62, 134, 205);
        }

        .delete-button {
            background-color: #b22222;
            color: white;
            padding: 8px 15px;
            border: none;
            cursor: pointer;
            font-size: 14px;
            margin: 4px;
            transition: background-color 0.8s ease;
        }
        .delete-button:hover {
            background-color:rgb(211, 65, 65);
        }
    </style>
</head>
<body>

<div class="navigationbar">
        <a href="dashboard.php">
            <img src="logo.png" alt="Learn Linx Logo">
        </a>
    <ul>
        <li><a href="dashboard.php">Home</a></li>
        <li><a href="Video.html">Courses</a></li>
        <li><a href="test-scores.php">Test Scores</a></li>
        <li><a href="support.php">Support</a></li>
    </ul>
</div>

<h1>Your Test Score History</h1>

<?php if ($result->num_rows > 0): ?>
    <button class="pdf-button" onclick="downloadPDF()">Download as PDF</button>
    <br>
    <br>
    <div id="score-table">
        <table>
        <tr>
            <th>Course</th>
            <th>Score</th>
            <th>Total</th>
            <th>Percentage</th>
            <th>Date Taken</th>
            <th>Action</th>
        </tr>

            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
    <td><?= htmlspecialchars($row['course_name']) ?></td>
    <td><?= $row['score'] ?></td>
    <td><?= $row['total'] ?></td>
    <td><?= round(($row['score'] / $row['total']) * 100) ?>%</td>
    <td><?= date("m/d/Y h:i A", strtotime($row['taken_on'])) ?></td>
    <td>
        <form method="get" onsubmit="return confirm('Are you sure you want to delete this score?');">
            <input type="hidden" name="delete_id" value="<?= $row['id'] ?>">
            <input type="submit" class="delete-button" value="Delete">
        </form>
    </td>
</tr>

            <?php endwhile; ?>
        </table>
    </div>
<?php else: ?>
    <p>No test scores found. Go try a quiz!</p>
<?php endif; ?>

<script>
function downloadPDF() {
    const { jsPDF } = window.jspdf;

    // Hide the Action column before capture
    const table = document.querySelector("#score-table table");
    const actionHeaders = table.querySelectorAll("th:last-child, td:last-child");
    actionHeaders.forEach(el => el.style.display = 'none');

    html2canvas(table).then(canvas => {
        const doc = new jsPDF();
        const imgData = canvas.toDataURL("image/png");
        const imgProps = doc.getImageProperties(imgData);
        const pdfWidth = doc.internal.pageSize.getWidth();
        const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;

        doc.addImage(imgData, "PNG", 10, 10, pdfWidth - 20, pdfHeight + 10);
        doc.save("Test_Score_History.pdf");

        // Restore the Action column after capture
        actionHeaders.forEach(el => el.style.display = '');
    });
}
</script>
<br>
<!-- Bookmark to go the top -->     
<a href="#top">Go to the top</a>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>