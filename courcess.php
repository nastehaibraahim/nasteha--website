<?php
session_start();
include('connect.php');

// Fetching all the courses from the database
$query = "SELECT * FROM coursess";
$result = mysqli_query($conn, $query);
$courses = mysqli_fetch_all($result, MYSQLI_ASSOC);

// If a course is clicked, fetch its lessons
if (isset($_GET['course_id'])) {
    $course_id = $_GET['course_id'];
    $lesson_query = "SELECT * FROM lessons WHERE course_id = $course_id";
    $lesson_result = mysqli_query($conn, $lesson_query);
    $lessons = mysqli_fetch_all($lesson_result, MYSQLI_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses - E-Learning Platform</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        /* Add your CSS here (same as the one in the main page or modify it accordingly) */
    </style>
</head>
<body>
    <!-- Header Section (same as before) -->
    <header>
        <div class="container header-container">
            <div class="logo">E-Learn</div>
            <nav>
                <ul>
                    <li><a href="home.php">Home</a></li>
                    <li><a href="cources.php">Courses</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Courses Listing -->
    <section class="featured-courses">
        <div class="container">
            <h2>Available Courses</h2>
            <div class="courses-grid">
                <?php foreach ($courses as $course): ?>
                <div class="course-card">
                    <img src="images/<?php echo $course['course_image']; ?>" alt="<?php echo $course['course_name']; ?>">
                    <div class="course-content">
                        <h3 class="course-title"><?php echo $course['course_name']; ?></h3>
                        <p class="course-description"><?php echo $course['course_description']; ?></p>
                        <a href="cources.php?course_id=<?php echo $course['course_id']; ?>" class="enroll-btn">View Lessons</a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <?php if (isset($lessons)): ?>
    <!-- Lessons Section -->
    <section class="course-lessons">
        <div class="container">
            <h2>Lessons for <?php echo $courses[$course_id - 1]['course_name']; ?></h2>
            <div class="lessons-list">
                <?php foreach ($lessons as $lesson): ?>
                <div class="lesson-card">
                    <h3 class="lesson-title"><?php echo $lesson['lesson_title']; ?></h3>
                    <p class="lesson-content"><?php echo $lesson['lesson_content']; ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Footer Section (same as before) -->
    <footer>
        <div class="container footer-container">
            <div class="footer-logo">E-Learn</div>
            <div class="footer-links">
                <a href="#">Privacy Policy</a>
                <a href="#">Terms of Service</a>
                <a href="#">Support</a>
            </div>
            <div class="footer-social">
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-linkedin"></i></a>
            </div>
        </div>
        <div class="footer-copyright">
            &copy; 2024 E-Learn. All Rights Reserved.
        </div>
    </footer>
</body>
</html>
