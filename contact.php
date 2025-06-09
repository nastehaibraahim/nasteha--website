<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - E-Learning Platform</title>
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

        .contact-header {
            background: #f4f4f9;
            padding: 60px 0;
            text-align: center;
        }

        .contact-header h1 {
            font-size: 2.5rem;
            margin-bottom: 10px;
        }

        .contact-form-section {
            padding: 60px 0;
            background: #fff;
        }

        .contact-form {
            max-width: 600px;
            margin: 0 auto;
            background: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .contact-form h2 {
            font-size: 1.8rem;
            margin-bottom: 20px;
            text-align: center;
        }

        .contact-form label {
            display: block;
            font-weight: 500;
            margin-bottom: 5px;
        }

        .contact-form input, .contact-form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
        }

        .contact-form button {
            background: #1a1a2e;
            color: #fff;
            border: none;
            padding: 15px 30px;
            font-size: 1rem;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
            display: block;
            margin: 0 auto;
        }

        .contact-form button:hover {
            background: #4e4e69;
        }

        .other-contact {
            text-align: center;
            padding: 40px 0;
            background: #f4f4f9;
        }

        .other-contact h2 {
            font-size: 1.8rem;
            margin-bottom: 20px;
        }

        .other-contact p {
            font-size: 1rem;
            margin-bottom: 10px;
        }

        .map-section {
            padding: 40px 0;
            text-align: center;
        }

        .map-section iframe {
            width: 100%;
            max-width: 800px;
            height: 400px;
            border: none;
            border-radius: 8px;
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
                    <li><a href="courses.php">Courses</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section class="contact-header">
        <div class="container">
            <h1>Contact Us</h1>
            <p>We would love to hear from you! Reach out to us using the form below or through any of the methods listed.</p>
        </div>
    </section>

    <section class="contact-form-section">
        <div class="container">
            <div class="contact-form">
                <h2>Get in Touch</h2>
                <form action="#" method="post">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" required>

                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>

                    <label for="message">Message</label>
                    <textarea id="message" name="message" rows="5" required></textarea>

                    <button type="submit">Send Message</button>
                </form>
            </div>
        </div>
    </section>

    <section class="other-contact">
        <div class="container">
            <h2>Other Ways to Reach Us</h2>
            <p>Email: contact@elearn.com</p>
            <p>Phone: +1-800-555-1234</p>
            <p>Address: 123 Learning Lane, Knowledge City, EduState, 56789</p>
        </div>
    </section>

    <section class="map-section">
        <div class="container">
            <h2>Our Location</h2>
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3153.835434509448!2d-122.4194154846809!3d37.77492977975998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8085815807d6e2a3%3A0x0!2zTGVhcm5pbmcgU3RyZWV0LCBTYW4gRnJhbmNpc2Nv!5e0!3m2!1sen!2sus!4v1635561184894!5m2!1sen!2sus"
                allowfullscreen="" loading="lazy">
            </iframe>
        </div>
    </section>

    <footer>
        <p>&copy; 2024 E-Learn. All Rights Reserved. | <a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a></p>
    </footer>
</body>
</html>
