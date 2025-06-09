<?php
session_start();
include('connect.php');
$studentRegistrationUrl = 'student.php';
$teacherRegistrationUrl = 'index.php';

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Learning Platform</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        /* Global Styles */
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }

        /* Header */
        header {
            background: #1a1a2e;
            color: #fff;
            padding: 20px 0;
        }

        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 24px;
            font-weight: 700;
        }

        nav ul {
            display: flex;
            list-style: none;
            gap: 20px;
        }

        nav ul li {
            padding: 5px 10px;
            transition: background 0.3s;
        }

        nav ul li:hover {
            background: #4e4e69;
            border-radius: 5px;
        }

        .hero {
            background: linear-gradient(to bottom right, #1a1a2e, #16213e);
            color: #fff;
            text-align: center;
            padding: 80px 20px;
        }

        .hero h1 {
            font-size: 3rem;
            margin-bottom: 20px;
        }

        .hero p {
            font-size: 1.2rem;
            margin-bottom: 30px;
        }

        .hero button {
            background: #e94560;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 1rem;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .hero button:hover {
            background: #c53850;
        }

        .featured-courses {
            padding: 50px 0;
            background: #f4f4f9;
        }

        .featured-courses h2 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 2rem;
        }

        .courses-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .course-card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s;
        }

        .course-card:hover {
            transform: scale(1.05);
        }

        .course-card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }

        .course-content {
            padding: 15px;
        }

        .course-title {
            font-size: 1.2rem;
            margin-bottom: 10px;
            font-weight: 500;
        }

        .course-description {
            font-size: 0.9rem;
            color: #555;
            margin-bottom: 15px;
        }

        .enroll-btn {
            background: #1a1a2e;
            color: #fff;
            border: none;
            padding: 8px 15px;
            font-size: 0.9rem;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .enroll-btn:hover {
            background: #4e4e69;
        }

        /* Footer */
        footer {
            background: #1a1a2e;
            color: #fff;
            padding: 30px 0;
        }

        .footer-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }

        .footer-container div {
            margin: 10px 0;
        }

        .footer-logo {
            font-size: 20px;
            font-weight: 700;
        }

        .footer-links {
            display: flex;
            gap: 15px;
        }

        .footer-links a {
            color: #fff;
            font-size: 0.9rem;
        }

        .footer-social {
            display: flex;
            gap: 10px;
        }

        .footer-social a {
            color: #fff;
            font-size: 1.2rem;
            transition: color 0.3s;
        }

        .footer-social a:hover {
            color: #e94560;
        }

        .footer-copyright {
            text-align: center;
            margin-top: 20px;
            font-size: 0.8rem;
            color: #aaa;
        }
    </style>
</head>
<body>
    <!-- Header Section -->
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

    <!-- Hero Section -->
   
<section class="hero">
    <div class="container">
        <h1>Empower Your Learning Journey</h1>
        <p>Access thousands of courses from experts across the globe. Anytime. Anywhere.</p>
        <!-- Button for Student Registration -->
        <button onclick="window.location.href='<?php echo $studentRegistrationUrl; ?>';">Student Registration</button>
        <!-- Button for Teacher Registration -->
        <button onclick="window.location.href='<?php echo $teacherRegistrationUrl; ?>';">Teacher Registration</button>
        
    </div>
</section>

    <!-- Featured Courses Section -->
    <section class="featured-courses">
        <div class="container">
            <h2>learnning methods</h2>
            <div class="courses-grid">
                <div class="course-card">
                    <img src="imag/bakground.jpg.jpg" alt="Course 1">
                    <div class="course-content">
                        <h3 class="course-title">Synchrones</h3>
                        <p class="course-description">Learn the fundamentals of web development and build your first website.</p>
                        <a href="student.php">
                           <button class="enroll-btn">Enroll Now</button>
                        </a>
                    </div>
                </div>

                <div class="course-card">
                    <img src="imag/will1.jpg" alt="Course 2">
                    <div class="course-content">
                        <h3 class="course-title">Asynchrones</h3>
                        <p class="course-description">Master the basics of data analysis and visualization using Python.</p>
                        <a href="student.php">
                           <button class="enroll-btn">Enroll Now</button>
                        </a>
                    </div>
                </div>

                <div class="course-card">
                    <img src="imag/123.jpg" alt="Course 3">
                    <div class="course-content">
                        <h3 class="course-title">Blended</h3>
                        <p class="course-description">Unlock your creativity and design stunning visuals for any platform.</p>
                        <a href="student.php">
                           <button class="enroll-btn">Enroll Now</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="featured-courses">
        <div class="container">
            <h2>Featured Courses</h2>
            <div class="courses-grid">
                <div class="course-card">
                    <img src="imag/6444949d-2e6f-4e30-9c59-58be89eceef1.jpg" alt="Course 1">
                    <div class="course-content">
                        <h3 class="course-title">Web Development Basics</h3>
                        <p class="course-description">Learn the fundamentals of web development and build your first website.</p>
                        <a href="student.php">
                           <button class="enroll-btn">Enroll Now</button>
                        </a>
                    </div>
                </div>

                <div class="course-card">
                    <img src="imag/a9ffad36-ebc9-4cd5-805a-603ff54a84b2.jpg" alt="Course 2">
                    <div class="course-content">
                        <h3 class="course-title">Data Science Essentials</h3>
                        <p class="course-description">Master the basics of data analysis and visualization using Python.</p>
                        <a href="student.php">
                           <button class="enroll-btn">Enroll Now</button>
                        </a>
                    </div>
                </div>

                <div class="course-card">
                    <img src="imag/e4fc601e-185d-4ef9-9b8d-f83bd18f2542.jpg" alt="Course 3">
                    <div class="course-content">
                        <h3 class="course-title">Graphic Design Mastery</h3>
                        <p class="course-description">Unlock your creativity and design stunning visuals for any platform.</p>
                        <a href="cource details.php">
                           <button class="enroll-btn">Enroll Now</button>
                         </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer Section -->
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

