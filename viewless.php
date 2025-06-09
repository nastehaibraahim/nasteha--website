<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "login");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the course ID from the query string
$course_id = $_GET['course_id'];

// Fetch lessons for this course
$sql = "SELECT * FROM lessons WHERE course_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $course_id);
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Lessons</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .lesson {
            background: #f9f9f9;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .lesson-title {
            font-size: 1.2em;
            color: #333;
        }
        .lesson-content {
            color: #666;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Lessons</h1>
    </div>

    <?php if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="lesson">
                <h3 class="lesson-title"><?php echo $row['title']; ?></h3>
                <p class="lesson-content"><?php echo nl2br($row['content']); ?></p>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No lessons available for this course.</p>
    <?php endif; ?>

</body>
</html>

<?php
// Close connection
$conn->close();
?>
