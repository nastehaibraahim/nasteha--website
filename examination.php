<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Exam with Certificate Generator</title>
    <style>
        /* Global Styles */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f7f8fa;
            margin: 0;
            padding: 0;
            color: #333;
        }
        
        .container {
            max-width: 800px;
            margin: 50px auto;
            background: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            font-size: 2.5em;
            color: #333;
            margin-bottom: 30px;
        }

        h2 {
            text-align: center;
            font-size: 1.6em;
            color: #555;
            margin-bottom: 20px;
        }

        /* Question Styles */
        .question {
            margin-bottom: 25px;
        }

        .question label {
            display: block;
            font-size: 1.1em;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .question input[type="radio"] {
            margin-right: 10px;
        }

        /* Button Styles */
        button {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 1.1em;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 20px;
        }

        button:hover {
            background-color: #0056b3;
        }

        button:focus {
            outline: none;
        }

        .result {
            margin: 30px 0;
            text-align: center;
            font-size: 1.2em;
            font-weight: bold;
        }

        /* Certificate Button */
        #downloadButton {
            display: none;
            background-color: #28a745;
        }

        #downloadButton:hover {
            background-color: #218838;
        }

        .footer {
            text-align: center;
            margin-top: 50px;
            font-size: 0.9em;
            color: #777;
        }

    </style>
</head>
<body>
    <div class="container">
        <h1>Online Exam</h1>
        <h2>Test Your Knowledge</h2>
        <form id="examForm">
            <div class="question">
                <label>1. What is 2 + 2?</label>
                <input type="radio" name="q1" value="4"> 4
                <input type="radio" name="q1" value="3"> 3
                <input type="radio" name="q1" value="5"> 5
            </div>
            <div class="question">
                <label>2. What is the capital of France?</label>
                <input type="radio" name="q2" value="Paris"> Paris
                <input type="radio" name="q2" value="London"> London
                <input type="radio" name="q2" value="Berlin"> Berlin
            </div>
            <div class="question">
                <label>3. What is the color of the sky?</label>
                <input type="radio" name="q3" value="Blue"> Blue
                <input type="radio" name="q3" value="Green"> Green
                <input type="radio" name="q3" value="Yellow"> Yellow
            </div>
            <button type="button" onclick="calculateResult()">Submit Exam</button>
        </form>

        <div class="result" id="result"></div>
        <button id="downloadButton" onclick="downloadCertificate()">Download Certificate</button>
    </div>

    <div class="footer">
        <p>&copy; 2024 Online Exam Platform. All rights reserved.</p>
    </div>

    <script>
        function calculateResult() {
            const correctAnswers = {
                q1: '4',
                q2: 'Paris',
                q3: 'Blue'
            };
            let score = 0;
            const form = document.getElementById('examForm');

            for (const [question, answer] of Object.entries(correctAnswers)) {
                const selectedOption = form[question] && form[question].value;
                if (selectedOption === answer) {
                    score++;
                }
            }

            const totalQuestions = Object.keys(correctAnswers).length;
            const grade = (score / totalQuestions) * 100;
            let resultText = `You scored ${score} out of ${totalQuestions}. Grade: ${grade.toFixed(2)}%.`;

            if (grade >= 50) {
                resultText += ' Congratulations! You passed!';
                document.getElementById('downloadButton').style.display = 'block';
            } else {
                resultText += ' Unfortunately, you did not pass.';
            }

            document.getElementById('result').innerText = resultText;
        }

        function downloadCertificate() {
            const link = document.createElement('a');
            const certificateText = `Certificate of Achievement\n\nThis is to certify that you successfully passed the exam with a grade of 50% or higher.`;
            const blob = new Blob([certificateText], { type: 'text/plain' });
            link.href = URL.createObjectURL(blob);
            link.download = 'Certificate.txt';
            link.click();
        }
    </script>
</body>
</html>
