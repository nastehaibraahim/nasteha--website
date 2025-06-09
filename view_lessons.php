<?php
// Establish Database Connection
$conn = new mysqli("localhost", "root", "", "login");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ensure the course ID is provided and is valid
if (!isset($_GET['course_id']) || !is_numeric($_GET['course_id'])) {
    die("Error: Invalid or missing course ID.");
}

$course_id = intval($_GET['course_id']); // Sanitize input

// Fetch course details, including material link
$courseQuery = "SELECT * FROM course WHERE id = ?";
$courseStmt = $conn->prepare($courseQuery);
$courseStmt->bind_param("i", $course_id);
$courseStmt->execute();
$courseResult = $courseStmt->get_result();

// Fetch lessons related to the course
$lessonsQuery = "SELECT * FROM lessons WHERE course_id = ?";
$lessonsStmt = $conn->prepare($lessonsQuery);
$lessonsStmt->bind_param("i", $course_id);
$lessonsStmt->execute();
$lessonsResult = $lessonsStmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Lessons - Course Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }

        .container {
            width: 80%;
            margin: auto;
            padding: 20px;
        }

        .course-header {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .course-header h1 {
            margin: 0;
            font-size: 2em;
        }

        .course-material {
            margin-top: 20px;
        }

        .lesson {
            background: #fff;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .lesson-title {
            font-size: 1.5em;
            margin-bottom: 10px;
        }

        .lesson-content {
            color: #666;
        }

        .view-link {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #28a745;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }

        .view-link:hover {
            background-color: #218838;
        }

        .material-link {
            padding: 10px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            margin-top: 10px;
        }

        .material-link:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <?php
    // Check if the course exists
    if ($courseResult->num_rows > 0) {
        // Fetch course data
        $course = $courseResult->fetch_assoc();
        ?>

        <!-- Course Header -->
        <div class="course-header">
            <h1><?php echo htmlspecialchars($course['title']); ?></h1>
            <p><strong>Description:</strong> <?php echo nl2br(htmlspecialchars($course['description'])); ?></p>
        </div>

        <!-- Course Material Display (View in Browser) -->
        <div class="course-material">
            <?php if (!empty($course['material_link'])): ?>
                <p><strong>Course Material:</strong> 
                    <a href="<?php echo htmlspecialchars($course['material_link']); ?>" class="material-link" target="_blank">
                        View Course Material
                    </a>
                </p>
            <?php else: ?>
                <p>No course material available.</p>
            <?php endif; ?>
        </div>

        <!-- Lessons Section -->
        <div class="lessons">
            <h2>Lessons</h2>

            <?php if ($lessonsResult->num_rows > 0): ?>
                <?php while ($lesson = $lessonsResult->fetch_assoc()): ?>
                    <div class="lesson">
                        <h3 class="lesson-title"><?php echo htmlspecialchars($lesson['title']); ?></h3>
                        <p class="lesson-content"><?php echo nl2br(htmlspecialchars($lesson['content'])); ?></p>

                        <!-- Lesson Material Link -->
                        <?php if (!empty($lesson['material_link'])): ?>
                            <p><strong>Lesson Material:</strong> 
                                <a href="<?php echo htmlspecialchars($lesson['material_link']); ?>" class="material-link" target="_blank">
                                    View Lesson Material
                                </a>
                            </p>
                        <?php else: ?>
                            <p>No material available for this lesson.</p>
                        <?php endif; ?>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No lessons available for this course.</p>
            <?php endif; ?>
        </div>

    <?php
    } else {
        // Handle case when the course does not exist
        echo "<p>Course not found. Please check the course ID.</p>";
    }

    // Close the prepared statements
    $courseStmt->close();
    $lessonsStmt->close();
    ?>

</div>

</body>
</html>

<?php
// Close database connection
$conn->close();
?>
