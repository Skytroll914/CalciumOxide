<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <title>Fraud Report</title>
    <style>
        body {
            background-image: url('https://www.forter.com/wp-content/uploads/2023/01/gartner-market-blog.png'); /* Replace with your image URL */
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background: rgba(255, 255, 255, 1.0); /* Slightly transparent background */
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }
        h1 {
            text-align: center;
            color: #343a40;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            font-weight: 600;
            margin-bottom: 8px;
            color: #495057;
        }
        input, textarea, select {
            width: 100%;
            padding: 12px;
            margin-top: 5px;
            border: 1px solid #ced4da;
            border-radius: 6px;
            box-sizing: border-box;
            font-size: 16px;
        }
        input:focus, textarea:focus, select:focus {
            border-color: #80bdff;
            outline: none;
            box-shadow: 0 0 0 0.2rem rgba(38, 143, 255, 0.25);
        }
        button {
            padding: 12px;
            background-color: #007bff;
            color: #ffffff;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 18px;
            display: block;
            width: 100%;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #0056b3;
        }
        .form-actions {
            display: flex;
            justify-content: center;
        }
        .other-field {
            display: none;
            margin-top: 10px;
        }
        .other-field input {
            font-size: 16px;
        }
        .radio-group {
            display: flex;
            align-items: center;
            gap: 20px; /* Adjust spacing between options */
        }
        .radio-group label {
            display: flex;
            align-items: center;
            cursor: pointer;
            font-size: 16px;
            padding: 10px;
            border: 2px solid #ced4da; /* Border around each option */
            border-radius: 6px;
            background-color: #f8f9fa; /* Light background for better visibility */
            transition: border-color 0.2s, background-color 0.2s;
        }
        .radio-group input[type="radio"] {
            appearance: none; /* Remove default styling */
            background-color: #fff;
            border: 1px solid #ced4da;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            cursor: pointer;
            outline: none;
            position: relative;
            transition: background-color 0.2s, border-color 0.2s;
            margin-right: 20px; /* Space between radio button and text */
        }
        .radio-group input[type="radio"]:checked {
            background-color: #007bff;
            border-color: #007bff;
        }
        .radio-group input[type="radio"]:checked::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 10px;
            height: 10px;
            background-color: #fff;
            border-radius: 50%;
            transform: translate(-50%, -50%);
        }
        .radio-group label:hover {
            border-color: #0056b3; /* Darker border color on hover */
            background-color: #e9ecef; /* Slightly darker background on hover */
        }
        .navbar {
            background-image: url('https://www.forter.com/wp-content/uploads/2023/01/gartner-market-blog.png'); /* Same image as container */
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center;
            opacity: 0.9; /* Adjust opacity as needed */
            height: 150px;
        }
        .navbar-brand {
        color: rgba(255, 255, 255, 0.8); /* Decrease opacity of the navbar brand text */
            font-family: 'Georgia', serif; /* Serif font for the brand name */
            font-size: 2.5em; /* Adjust font size */
            font-weight: bold; /* Bold text */
            text-align: center; /* Center align text */
            width: 100%; /* Ensure it spans the full width of the navbar */
        }
        .navbar-nav {
            position: absolute;
            right: 0;
            bottom: 0;
            margin: 0;
            padding: 0;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Credit Card Fraud Detection</a>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="hello.html" >(Return to Customer Info List)</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <h1>Fraud Report</h1>
        <form id="fraudReportForm" action="/submit-report" method="POST">
            <!-- Link adminID automatically -->
            <div class="form-group">
                <label for="adminID">Admin ID</label>
                <input type="text" id="adminID" name="adminID" required>
            </div> <!-- Modify this to 'no need enter ID manually -->
            <div class="form-group">
                <label for="contactDate">Date of Contact</label>
                <input type="date" id="contactDate" name="contactDate" required>
            </div>
            <div class="form-group">
                <label for="fraudType">Type of Fraud</label>
                <select id="fraudType" name="fraudType" required>
                    <option value="">Select an option</option>
                    <option value="Phishing">Phishing</option>
                    <option value="Identity Theft">Identity Theft</option>
                    <option value="Credit Card Fraud">Credit Card Fraud</option>
                    <option value="Investment Scam">Investment Scam</option>
                    <option value="Online Scam">Online Scam</option>
                    <option value="Other">Other</option>
                </select>
                <div id="fraudTypeOtherField" class="other-field">
                    <label for="fraudTypeOther">Please specify:</label>
                    <input type="text" id="fraudTypeOther" name="fraudTypeOther">
                </div>
            </div>
            <div class="form-group">
                <label for="problemDescription">Problem Description</label>
                <textarea id="problemDescription" name="problemDescription" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <label for="problemSolved">Problem Solved?</label>
                <select id="problemSolved" name="problemSolved" required>
                    <option value="">Select an option</option>
                    <option value="Resolved">Resolved</option>
                    <option value="Unresolved">Unresolved</option>
                    <option value="Further Investigation Needed">Further Investigation Needed</option>
                    <option value="Unable to Contact">Unable to Contact</option>
                </select>
            </div>
            <div class="form-group">
                <label>Result</label>
                <div class="radio-group" id="result">
                    <label>
                        <input type="radio" id="isAFraud" name="result" value="isAFraud" required>
                        Is a Fraud
                    </label>
                    <label>
                        <input type="radio" id="notAFraud" name="result" value="notAFraud">
                        Not a Fraud
                    </label>
                </div>
            </div> 
            <div class="form-actions">
                <button type="submit">Submit</button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('fraudType').addEventListener('change', function() {
            const otherField = document.getElementById('fraudTypeOtherField');
            if (this.value === 'Other') {
                otherField.style.display = 'block';
            } else {
                otherField.style.display = 'none';
            }
        });


    </script>
</body>
</html>
