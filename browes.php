<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle Add New Course
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['title'], $_POST['description'], $_FILES['material'], $_FILES['video'])) {
    $title = htmlspecialchars($_POST['title'], ENT_QUOTES, 'UTF-8');
    $description = htmlspecialchars($_POST['description'], ENT_QUOTES, 'UTF-8');

    // Define upload directories
    $uploadDir = 'uploads/';
    $videoDir = 'uploads/videos/';

    // Ensure directories exist
    if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
    if (!is_dir($videoDir)) mkdir($videoDir, 0777, true);

    // Handle file upload (Material)
    $fileName = uniqid() . "_" . basename($_FILES['material']['name']);
    $uploadFile = $uploadDir . $fileName;

    if (!move_uploaded_file($_FILES['material']['tmp_name'], $uploadFile)) {
        echo "Error uploading material file.";
        exit;
    }

    // Handle video upload
    $allowedVideoTypes = ['video/mp4', 'video/webm', 'video/ogg'];
    $videoName = uniqid() . "_" . basename($_FILES['video']['name']);
    $videoFile = $videoDir . $videoName;

    if (!in_array($_FILES['video']['type'], $allowedVideoTypes) || !move_uploaded_file($_FILES['video']['tmp_name'], $videoFile)) {
        echo "Error uploading video file. Please check the format (MP4, WebM, OGG only).";
        exit;
    }

    // Insert course data into the database
    $stmt = $conn->prepare("INSERT INTO course (title, description, material_link, video_link) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $title, $description, $uploadFile, $videoFile);
    $stmt->execute();
    $stmt->close();
}

// Handle Delete Course
if (isset($_GET['delete'])) {
    $course_id = intval($_GET['delete']);

    // Fetch file paths to delete associated files
    $stmt = $conn->prepare("SELECT material_link, video_link FROM course WHERE id = ?");
    $stmt->bind_param("i", $course_id);
    $stmt->execute();
    $stmt->bind_result($materialLink, $videoLink);
    $stmt->fetch();
    $stmt->close();

    // Delete files
    if (file_exists($materialLink)) unlink($materialLink);
    if (file_exists($videoLink)) unlink($videoLink);

    // Delete course record
    $stmt = $conn->prepare("DELETE FROM course WHERE id = ?");
    $stmt->bind_param("i", $course_id);
    if ($stmt->execute()) {
        $stmt->close();
        header("Location: " . $_SERVER['PHP_SELF']); // Redirect to refresh the page
        exit();
    } else {
        echo "Error deleting course: " . $conn->error;
    }
}

// Fetch courses from the database
$sql = "SELECT * FROM course";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instructor Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            background-color: #f5f5f5;
            color: #333;
        }
        .sidebar {
            width: 250px;
            background-color: #333;
            color: white;
            height: 100vh;
            padding: 20px;
            box-sizing: border-box;
            position: fixed;
        }
        .sidebar h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .sidebar ul {
            list-style: none;
            padding: 0;
        }
        .sidebar ul li {
            margin: 15px 0;
        }
        .sidebar ul li a {
            color: white;
            text-decoration: none;
            font-size: 1rem;
        }
        .sidebar ul li a:hover {
            text-decoration: underline;
        }
        .main-content {
            margin-left: 250px;
            padding: 20px;
            flex-grow: 1;
        }
        .header {
            background-color: #444;
            color: white;
            padding: 20px;
            text-align: center;
        }
        .section {
            margin-top: 20px;
        }
        .section h2 {
            font-size: 1.5em;
            color: #444;
            margin-bottom: 10px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .form-group input, .form-group textarea, .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        .form-group button {
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .form-group button:hover {
            background-color: #218838;
        }
        .course-list {
            margin-top: 20px;
        }
        .course {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #fff;
            margin-bottom: 15px;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .course-details {
            flex-grow: 1;
        }
        .course-title {
            font-size: 1.2em;
            margin: 0 0 5px;
            color: #333;
        }
        .course-actions button {
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            color: white;
            transition: background-color 0.3s ease;
        }
        .edit-button {
            background-color: #007bff;
        }
        .edit-button:hover {
            background-color: #0056b3;
        }
        .delete-button {
            background-color: #dc3545;
        }
        .delete-button:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Instructor Dashboard</h2>
        <ul>
            <li><a href="home.php">Home</a></li>
            <li><a href="adminpannel.php">user mangment</a></li>
        
            
        </ul>
    </div>
    <div class="main-content">
        <div class="header">
            <h1>Welcome, Instructor</h1>
        </div>

        <!-- Add New Course Section -->
        <div class="section">
            <h2>Add New Course</h2>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">Course Title</label>
                    <input type="text" id="title" name="title" placeholder="Enter course title" required>
                </div>
                <div class="form-group">
                    <label for="description">Course Description</label>
                    <textarea id="description" name="description" placeholder="Enter course description" rows="5" required></textarea>
                </div>
                <div class="form-group">
                    <label for="material">Course Material (Upload a file)</label>
                    <input type="file" id="material" name="material" required>
                </div>
                <div class="form-group">
                    <label for="video">Course Video (MP4, WebM, OGG)</label>
                    <input type="file" id="video" name="video" required>
                </div>
                <div class="form-group">
                    <button type="submit">Add Course</button>
                </div>
            </form>
        </div>

        <!-- Existing Courses Section -->
        <div class="section">
            <h2>My Courses</h2>
            <div class="course-list">
                <?php while ($row = $result->fetch_assoc()) { ?>
                <div class="course">
                    <div class="course-details">
                        <h3 class="course-title"><?php echo $row['title']; ?></h3>
                        <p><?php echo $row['description']; ?></p>
                        <p><strong>Material:</strong> <a href="<?php echo $row['material_link']; ?>" target="_blank">Download</a></p>
                        <p><strong>Video:</strong> <a href="<?php echo $row['video_link']; ?>" target="_blank">Watch</a></p>
                        <video controls width="400">
                      <source src="<?php echo $row['video_link']; ?>" type="video/mp4">
                                Your browser does not support the video tag.
                        </video>

                    </div>
                    <div class="course-actions">
                        <a href="edit_course.php?id=<?php echo $row['id']; ?>">
                            <button class="edit-button">Edit</button>
                        </a>
                        <a href="?delete=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this course?');">
                            <button class="delete-button">Delete</button>
                        </a>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <?php $conn->close(); ?>
</body>
</html>
