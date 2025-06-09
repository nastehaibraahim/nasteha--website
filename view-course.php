<?php
require_once 'connect.php';

// Check if course_id is passed
if (isset($_GET['course_id'])) {
    $course_id = $_GET['course_id'];

    // Fetch course details
    $query = "SELECT * FROM courses WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $course_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($course = $result->fetch_assoc()) {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?php echo htmlspecialchars($course['title']); ?></title>
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
                    color: #333;
                }
]                .content {
                    background-color: #fff;
                    padding: 15px;
                    margin-bottom: 15px;
                    border-radius: 8px;
                    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
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
            <a href="download.php?file=<?php echo urlencode($course['file_path']); ?>" class="download-button" download>Download Course Material</a>
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
