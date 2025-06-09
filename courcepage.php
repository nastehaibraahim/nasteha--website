<?php
session_start();
require_once 'connect.php'; // Assuming db.php contains the database connection

// Check if the student is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: student.php");
    exit();
}

// Get the courses that the student is enrolled in
$user_id = $_SESSION['user_id'];
$query = "SELECT courses.id, courses.title, courses.description, courses.file_path
          FROM courses
          JOIN enrollments ON courses.id = enrollments.course_id
          WHERE enrollments.user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Courses</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .course {
            background-color: #fff;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .course h3 {
            margin-top: 0;
        }
        .course p {
            color: #555;
        }
        .button-group {
            display: flex;
            gap: 10px;
        }
        .download-button {
            padding: 10px 15px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .download-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Your Courses</h1>

    <?php while ($course = $result->fetch_assoc()) { ?>
        <div class="course">
            <h3><?php echo htmlspecialchars($course['title']); ?></h3>
            <p><?php echo htmlspecialchars($course['description']); ?></p>
            <div class="button-group">
                <a href="view-course.php?course_id=<?php echo $course['id']; ?>" class="view-button">View Course</a>
                <a href="download.php?file=<?php echo urlencode($course['file_path']); ?>" class="download-button" download>Download Material</a>
            </div>
        </div>
    <?php } ?>

</div>

</body>
</html>

