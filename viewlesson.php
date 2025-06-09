<?php
require_once 'connect.php';

// Check if course_id is passed
if (isset($_GET['course_id'])) {
    $course_id = intval($_GET['course_id']); // Sanitize input

    // Fetch course details
    $courseQuery = "SELECT * FROM course WHERE id = 6";
    $courseStmt = $conn->prepare($courseQuery);
    $courseStmt->bind_param("i", $course_id);
    $courseStmt->execute();
    $courseResult = $courseStmt->get_result();

    if ($course = $courseResult->fetch_assoc()) {
        // Fetch lessons associated with the course
        $lessonQuery = "SELECT * FROM lessons WHERE course_id = 6";
        $lessonStmt = $conn->prepare($lessonQuery);
        $lessonStmt->bind_param("i", $course_id);
        $lessonStmt->execute();
        $lessonResult = $lessonStmt->get_result();
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?php echo htmlspecialchars($course['title']); ?> - Lessons</title>
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
                    background-color: #fff;
                    border-radius: 8px;
                    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                }
                h1 {
                    color: #333;
                    text-align: center;
                }
                .content {
                    margin: 20px 0;
                }
                .lesson {
                    padding: 10px 15px;
                    margin-bottom: 10px;
                    border: 1px solid #ddd;
                    border-radius: 5px;
                    background-color: #f9f9f9;
                }
                .lesson h4 {
                    margin: 0;
                    color: #007bff;
                }
                .lesson p {
                    margin: 5px 0 0;
                    color: #555;
                }
            </style>
        </head>
        <body>

        <div class="container">
            <h1><?php echo htmlspecialchars($course['title']); ?></h1>
            <div class="content">
                <h3>Course Description</h3>
                <p><?php echo htmlspecialchars($course['description']); ?></p>
            </div>

            <div class="lessons">
                <h3>Lessons</h3>
                <?php if ($lessonResult->num_rows > 0): ?>
                    <?php while ($lesson = $lessonResult->fetch_assoc()): ?>
                        <div class="lesson">
                            <h4><?php echo htmlspecialchars($lesson['title']); ?></h4>
                            <p><?php echo htmlspecialchars($lesson['description']); ?></p>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>No lessons available for this course.</p>
                <?php endif; ?>
            </div>
        </div>

        </body>
        </html>
        <?php
    } else {
        echo "Course not found.";
    }
} else {
    echo "Invalid course ID.";
}
?>
