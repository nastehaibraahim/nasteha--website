<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
            color: #333;
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 280px;
            background-color: #2c3e50;
            color: white;
            padding: 20px;
            position: fixed;
            height: 100vh;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 1.8em;
            font-weight: bold;
        }

        .sidebar ul {
            list-style: none;
        }

        .sidebar ul li {
            margin: 20px 0;
        }

        .sidebar ul li a {
            text-decoration: none;
            color: #ecf0f1;
            font-size: 1.1em;
            display: block;
            padding: 10px;
            border-radius: 5px;
            transition: background 0.3s ease;
        }

        .sidebar ul li a:hover {
            background-color: #34495e;
        }

        .main-content {
            margin-left: 280px;
            padding: 30px;
            flex-grow: 1;
        }

        .header {
            background-color: #2980b9;
            color: white;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
        }

        .header h1 {
            font-size: 2em;
            margin: 0;
        }

        .courses {
            margin-top: 20px;
        }

        .courses h2 {
            font-size: 1.8em;
            margin-bottom: 20px;
            color: #34495e;
        }

        .course {
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            padding: 20px;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .course-content {
            flex-grow: 1;
        }

        .course-title {
            font-size: 1.5em;
            margin-bottom: 10px;
            color: #2c3e50;
        }

        .course p {
            margin-bottom: 10px;
            font-size: 1em;
            color: #7f8c8d;
        }

        .button-group {
            display: flex;
            gap: 10px;
        }

        .button {
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            color: white;
            font-size: 1em;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .view-button {
            background-color: #27ae60;
        }

        .view-button:hover {
            background-color: #1e8449;
        }

        .download-button {
            background-color: #2980b9;
        }

        .download-button:hover {
            background-color: #21618c;
        }

        .video-container {
            margin-top: 15px;
            max-width: 300px;
        }

        video {
            width: 100%;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .comments-section {
            margin-top: 20px;
        }

        .comments-section h4 {
            margin-bottom: 10px;
            font-size: 1.2em;
            color: #2c3e50;
        }

        .comments-section form {
            margin-bottom: 20px;
        }

        .comments-section textarea {
            width: 100%;
            height: 60px;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            font-size: 1em;
        }

        .comments-section button {
            margin-top: 10px;
            padding: 10px 15px;
            background-color: #27ae60;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .comments-section button:hover {
            background-color: #1e8449;
        }

        .comment {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .comment p {
            margin: 0;
        }
    </style>
</head>
<body>
    <?php
    // Database configuration
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $dbname = 'login';

    // Connect to the database
    $conn = new mysqli($host, $user, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch courses from the database
    $sql = "SELECT * FROM course"; // Assuming you have a `course` table
    $result = $conn->query($sql);

    // Handle new comment submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['course_id'], $_POST['comment'])) {
        // Sanitize and store the comment
        $course_id = $_POST['course_id'];
        $comment = $conn->real_escape_string($_POST['comment']);
        
        // Insert comment into the database
        $conn->query("INSERT INTO comments (course_id, comment) VALUES ('$course_id', '$comment')");
    }
    ?>

    <div class="sidebar">
        <h2>Dashboard</h2>
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">My Courses</a></li>
            <li><a href="#">Profile</a></li>
            <li><a href="#">Settings</a></li>
            <li><a href="examination.php">Exams</a></li>
        </ul>
    </div>
    <div class="main-content">
        <div class="header">
            <h1>Welcome to Your Dashboard</h1>
        </div>
        <div class="courses">
            <h2>Your Courses</h2>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="course">
                        <div class="course-content">
                            <h3 class="course-title"><?php echo $row['title']; ?></h3>
                            <p><?php echo $row['description']; ?></p>
                            <div class="video-container">
                                <?php if (!empty($row['video_link'])): ?>
                                    <video controls>
                                        <source src="<?php echo $row['video_link']; ?>" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                <?php else: ?>
                                    <p>No video available for this course.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="button-group">
                            <a href="<?php echo $row['material_link']; ?>" class="button download-button" download>Download Material</a>
                        </div>
                        <div class="comments-section">
                            <h4>Comments</h4>
                            <form method="post">
                                <textarea name="comment" placeholder="Write a comment..."></textarea>
                                <input type="hidden" name="course_id" value="<?php echo $row['id']; ?>">
                                <button type="submit">Post Comment</button>
                            </form>
                            <?php
                            $course_id = $row['id'];
                            // Fetch comments for the course
                            $comment_result = $conn->query("SELECT * FROM comments WHERE course_id = '$course_id'");
                            if ($comment_result->num_rows > 0):
                                while ($comment_row = $comment_result->fetch_assoc()): ?>
                                    <div class="comment">
                                        <p><?php echo $comment_row['comment']; ?></p>
                                    </div>
                                <?php endwhile;
                            else: ?>
                                <p>No comments yet.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No courses available.</p>
            <?php endif; ?>
        </div>
    </div>

    <?php
    // Close the database connection
    $conn->close();
    ?>
</body>
</html>
