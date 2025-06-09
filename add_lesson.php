<?php
session_start();
include('connect.php');

// Check if the user is logged in and is an admin or teacher
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'admin') {
    // Redirect to login or home page if not logged in as admin
    header("Location: login.php");
    exit();
}

// Fetch all courses to display in the dropdown
$query = "SELECT * FROM courses";
$result = mysqli_query($conn, $query);
$courses = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $course_id = $_POST['course_id'];
    $lesson_title = $_POST['lesson_title'];
    $lesson_content = $_POST['lesson_content'];

    // Insert lesson into the database
    $insert_query = "INSERT INTO lessons (course_id, lesson_title, lesson_content) 
                     VALUES ('$course_id', '$lesson_title', '$lesson_content')";
    if (mysqli_query($conn, $insert_query)) {
        echo "<p>Lesson added successfully!</p>";
    } else {
        echo "<p>Error adding lesson: " . mysqli_error($conn) . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Lesson</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        /* Add your CSS for styling */
    </style>
</head>
<body>
    <header>
        <div class="container header-container">
            <div class="logo">E-Learn</div>
            <nav>
                <ul>
                    <li><a href="home.php">Home</a></li>
                    <li><a href="courses.php">Courses</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Add Lesson Form -->
    <section class="add-lesson">
        <div class="container">
            <h2>Add New Lesson</h2>
            <form action="add_lesson.php" method="POST">
                <label for="course_id">Select Course</label>
                <select name="course_id" id="course_id" required>
                    <option value="">--Select a Course--</option>
                    <?php foreach ($courses as $course): ?>
                        <option value="<?php echo $course['course_id']; ?>"><?php echo $course['course_name']; ?></option>
                    <?php endforeach; ?>
                </select>
                <br><br>

                <label for="lesson_title">Lesson Title</label>
                <input type="text" name="lesson_title" id="lesson_title" required>
                <br><br>

                <label for="lesson_content">Lesson Content</label>
                <textarea name="lesson_content" id="lesson_content" rows="10" required></textarea>
                <br><br>

                <button type="submit">Add Lesson</button>
            </form>
        </div>
    </section>
</body>
</html>
