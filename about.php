<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - E-Learning Platform</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
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

        .mission-section {
            background: #f4f4f9;
            padding: 60px 0;
            text-align: center;
        }

        .mission-section h2 {
            font-size: 2rem;
            margin-bottom: 20px;
        }

        .mission-section p {
            font-size: 1.1rem;
            line-height: 1.6;
        }

        .team-section {
            padding: 60px 0;
        }

        .team-section h2 {
            font-size: 2rem;
            text-align: center;
            margin-bottom: 40px;
        }

        .team-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .team-member {
            text-align: center;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .team-member img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 15px;
        }

        .team-member h3 {
            font-size: 1.2rem;
            margin-bottom: 10px;
        }

        .team-member p {
            font-size: 0.9rem;
            color: #666;
        }

        .achievements-section {
            background: #f4f4f9;
            padding: 60px 0;
            text-align: center;
        }

        .achievements-section h2 {
            font-size: 2rem;
            margin-bottom: 20px;
        }

        .achievements-grid {
            display: flex;
            justify-content: center;
            gap: 40px;
            flex-wrap: wrap;
        }

        .achievement {
            background: #fff;
            padding: 20px 30px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            max-width: 300px;
        }

        .achievement h3 {
            font-size: 1.2rem;
            margin-bottom: 10px;
        }

        footer {
            background: #1a1a2e;
            color: #fff;
            padding: 20px 0;
            text-align: center;
        }

        footer a {
            color: #e94560;
            margin: 0 10px;
            font-size: 0.9rem;
        }

        footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
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

    <section class="mission-section">
        <div class="container">
            <h2>Our Mission</h2>
            <p>To empower learners worldwide by providing accessible, high-quality online education, fostering growth and innovation in every field.</p>
        </div>
    </section>

    <section class="team-section">
        <div class="container">
            <h2>Meet Our Team</h2>
            <div class="team-grid">
                <div class="team-member">
                    <img src="imag/gabar.jpg" alt="Team Member 1">
                    <h3>Jane Smith</h3>
                    <p>CEO & Founder</p>
                </div>
                <div class="team-member">
                    <img src="imag/will.jpg" alt="Team Member 2">
                    <h3>John Doe</h3>
                    <p>Lead Developer</p>
                </div>
                <div class="team-member">
                    <img src="imag/will1.jpg" alt="Team Member 3">
                    <h3>Emily Davis</h3>
                    <p>Head of Marketing</p>
                </div>
            </div>
        </div>
    </section>

    <section class="achievements-section">
        <div class="container">
            <h2>Our Achievements</h2>
            <div class="achievements-grid">
                <div class="achievement">
                    <h3>500,000+ Learners</h3>
                    <p>We've reached half a million students across the globe.</p>
                </div>
                <div class="achievement">
                    <h3>100+ Courses</h3>
                    <p>Offering a wide range of courses in various fields.</p>
                </div>
                <div class="achievement">
                    <h3>Award-Winning Platform</h3>
                    <p>Recognized for excellence in e-learning innovation.</p>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <p>&copy; 2024 E-Learn. All Rights Reserved. | <a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a></p>
    </footer>
</body>
</html>
