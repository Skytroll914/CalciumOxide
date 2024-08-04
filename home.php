<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Credit Card Fraud Detection Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/PapaParse/5.3.0/papaparse.min.js"></script>

    <style>
    .navbar {
        background-image: url('https://static.vecteezy.com/system/resources/previews/023/221/109/non_2x/banking-and-finance-concept-digital-connect-system-financial-and-banking-technology-with-integrated-circles-glowing-line-icons-and-on-blue-background-design-vector.jpg');
        opacity: 0.9;
        height: 150px;
    }

    .tFont {
        font-family: 'Georgia', serif;
        font-size: 100pc;
        font-weight:bold;
        text-align: center;

    }

    @keyframes moveTitle {
            0% {
                text-shadow: 0 0 5px #fff, 0 0 10px #fff, 0 0 15px #fff, 0 0 20px #ff00ff, 0 0 30px #ff00ff, 0 0 40px #ff00ff, 0 0 55px #ff00ff, 0 0 75px #ff00ff;
                transform: translateX(0);
            }
            50% {
                text-shadow: 0 0 5px #fff, 0 0 10px #fff, 0 0 15px #ff0000, 0 0 20px #ff0000, 0 0 30px #ff0000, 0 0 40px #ff0000, 0 0 55px #ff0000, 0 0 75px #ff0000;
                transform: translateX(20px);
            }
            100% {
                text-shadow: 0 0 5px #fff, 0 0 10px #fff, 0 0 15px #fff, 0 0 20px #00ffff, 0 0 30px #00ffff, 0 0 40px #00ffff, 0 0 55px #00ffff, 0 0 75px #00ffff;
                transform: translateX(0);
            }
        }
    
    .navbar-brand {
        color: rgba(255, 255, 255, 0.5); /* Decrease opacity of the navbar brand text */
            font-family: 'Georgia', serif; /* Serif font for the brand name */
            font-size: 2.5em; /* Adjust font size */
            font-weight: bold; /* Bold text */
            text-align: center; /* Center align text */
            width: 100%; /* Ensure it spans the full width of the navbar */
            animation: moveTitle 5s infinite linear;
        }

        .navbar-nav {
            position: absolute;
            right: 0;
            bottom: 0;
            margin: 0;
            padding: 0;
        }

        .card {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            transition: 0.3s;
        }

        .card:hover {
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.4);
            transform: translateY(-10px);
        }
        .table-container {
            width: 100%;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 12px 15px;
            text-align: center;
            border-bottom: 1px solid #dddddd;
        }

        th {
            background-color: #5152b4;
            color: #ffffff;
        }

        tr:nth-of-type(even) {
            background-color: #f3f3f3;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        a {
            color: #9798d1;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .back-button {
            position: absolute;
            bottom: 10px;
            right: 10px;
        }

        .back-button button {
            background-color: #866ee5;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
        }

        .back-button button:hover {
            background-color: #051e81;
        }

        .table-container {
            width: 100%;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 12px 15px;
            text-align: center;
            border-bottom: 1px solid #dddddd;
        }

        th {
            background-color: #5152b4;
            color: #ffffff;
        }

        tr:nth-of-type(even) {
            background-color: #f3f3f3;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        a {
            color: #9798d1;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .back-button {
            position: absolute;
            bottom: 10px;
            right: 10px;
        }

        .back-button button {
            background-color: #866ee5;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
        }

        .back-button button:hover {
            background-color: #051e81;
        }

    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Credit Card Fraud Detection</a>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="logout.html" onclick="alert('Click OK to logout')">(Logout)</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-4">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button"
                    role="tab" aria-controls="home" aria-selected="true">Dashboard</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="batch-tab" data-bs-toggle="tab" data-bs-target="#batch" type="button"
                    role="tab" aria-controls="batch" aria-selected="false">Transaction History Data Simulation</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="fraud-customer-tab" data-bs-toggle="tab" data-bs-target="#fraud-customer"
                    type="button" role="tab" aria-controls="fraud-customer" aria-selected="false">Fraud Customer
                    List</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="analytics-tab" data-bs-toggle="tab" data-bs-target="#analytics"
                    type="button" role="tab" aria-controls="analytics" aria-selected="false">Analytics</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="single-tab" data-bs-toggle="tab" data-bs-target="#single" type="button"
                    role="tab" aria-controls="single" aria-selected="false">Real Time Transaction Data
                    Simulation</button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <!-- Dashboard Tab -->
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="mt-4">
                    <h1 class="mb-4">Welcome to the Fraud Detection Dashboard</h1>
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Transaction History Data Simulation</h5>
                                    <p class="card-text">Upload and analyze multiple transactions at once.</p>
                                    <button class="btn btn-primary" onclick="document.getElementById('batch-tab').click()">Go to Transaction History Data Simulation</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Real Time Transaction Data Simulation</h5>
                                    <p class="card-text">Check a single transaction for fraud.</p>
                                    <button class="btn btn-primary" onclick="document.getElementById('single-tab').click()">Go to Real Time Transaction Data Simulation</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Analytics</h5>
                                    <p class="card-text">View fraud detection statistics and trends.</p>
                                    <button class="btn btn-primary" onclick="document.getElementById('analytics-tab').click()">Go to Analytics</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Fraud Customer List</h5>
                                    <p class="card-text">View the list of credit card fraud customers</p>
                                    <button class="btn btn-primary" onclick="document.getElementById('fraud-customer-tab').click()">Go to Credit Card Fraud Customer List</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Transaction History Data Simulation Tab -->
            <div class="tab-pane fade" id="batch" role="tabpanel" aria-labelledby="batch-tab">
                <div class="mt-4">
                    <h1 class="mb-4">Batch Analysis</h1>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Upload Transactions</h5>
                            <form id="batchUploadForm">
                                <div class="mb-3">
                                    <label for="transactionFile" class="form-label">Select transaction file (CSV)</label>
                                    <input type="file" class="form-control" id="transactionFile" accept=".csv" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Analyze Batch</button>
                            </form>
                        </div>
                    </div>
                    <div class="mt-5" id="analysisResults" style="display: none;">
                        <h2>Analysis Results</h2>
                        <div id="resultsContent"></div>
                        <button id="downloadReport" class="btn btn-success mt-3">
                            <i class="bi bi-download"></i> Download Report
                        </button>
                        <button id="fraudCustomerList" class="btn btn-info mt-3">
                            Fraud Customer List
                        </button>
                    </div>
                </div>
            </div>

            <!-- Fraud Customer List Tab -->
            <div class="tab-pane fade" id="fraud-customer" role="tabpanel" aria-labelledby="fraud-customer-tab">
                <div class="mt-4">
                    <h1>Credit Card Fraud Customer<br></h1>
                    <div class="table-container">
                        <table>
                            <tr>
                                <th>No</th>
                                <th>Credit Card Number</th>
                                <th>Customer Details</th>
                                <th>Report Link</th>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>---- ---- 9789</td>
                                <td><a href="cusInfo.php">Tan Chee Kang</a></td>
                                <td><a href="fraudReport.php">status</a></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>---- ---- 2123</td>
                                <td><a href="cusInfo.php">Chia Xiang </a></td>
                                <td><a href="fraudReport.php">status</a></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>---- ---- 8954</td>
                                <td><a href="cusInfo.php">Bong Jin Gang</a></td>
                                <td><a href="fraudReport.php">status</a></td>
                            </tr>
                        </table>
                    </div>
                    <div class="back-button">
                        <button onclick="goToMainPage()">Back</button>
                    </div>
                </div>

            </div>
        </div>

            <!-- Analytics Tab -->
            <div class="tab-pane fade" id="analytics" role="tabpanel" aria-labelledby="analytics-tab">
                <div class="mt-4">
                    <h1 class="mb-4">Analytics Dashboard</h1>
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Fraud Detection Rate</h5>
                                    <canvas id="fraudDetectionChart"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Transaction Volume</h5>
                                    <canvas id="transactionVolumeChart"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Transaction Volume</h5>
                                    <iframe id="transactionVolumeChart" title="Calculated fraud" width="1140" height="541.25" src="https://app.powerbi.com/reportEmbed?reportId=782f7dd3-6eb5-48ec-b52b-01fb9aec0fcb&autoAuth=true&ctid=4edf9354-0b3b-429a-bb8f-f21f957f1d1c" frameborder="0" allowFullScreen="true"></iframe>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="card mt-4">
                        <div class="card-body">
                            <h5 class="card-title">Recent Alerts</h5>
                            <ul class="list-group">
                                <li class="list-group-item">Suspicious activity detected on Card ending 1234 - 2023-08-03</li>
                                <li class="list-group-item">Unusual transaction pattern for merchant XYZ - 2023-08-02</li>
                                <li class="list-group-item">High-value transaction flagged for review - 2023-08-01</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Single Transaction Check Tab -->
            <div class="tab-pane fade" id="single" role="tabpanel" aria-labelledby="single-tab" style="z-index: 1;">
                <div class="mt-4">
                    <h1 class="mb-4">Real Time Transaction Data Simulation</h1>
                    <div class="card">
                        <div class="card-body">
                    <?php
                            if (isset($_POST['predict'])){ 
                            
                        include 'capaian.php';

                        $TransID=$_POST['browser'];
                        $SQLTrans="SELECT * FROM transactions inner join customer on transactions.CustomerID=customer.CustomerID where transactions.TransactionID = $TransID;";
                        $run=mysqli_query($capaiDB,$SQLTrans);
                        $data=mysqli_fetch_array($run);
                        if(empty($data['TransactionID'])){
                        ?>
                        <script type="text/javascript">
                            window.alert("Transactional ID not found. Please Try again!");
                            window.location='home.php';
                        </script>   
                        <?php }else{

                           ?> 

                           <script>

            function Predict(){
            const data = {
                trans_date_trans_time: "<?php echo $data['Trans_date'] ?> <?php echo $data['Trans_time'] ?>",
                cc_num: "trash",
                merchant: "<?php echo $data['Merchant'] ?>",
                category: "<?php echo $data['Category'] ?>",
                amt:"<?php echo $data['Amount'] ?>",
                first:"<?php echo $data['CustFname'] ?>",
                last: "<?php echo $data['CustLname'] ?>",
                gender: "<?php echo $data['Gender'] ?>",
                street: "<?php echo $data['Street'] ?>",
                city: "<?php echo $data['City'] ?>",
                state: "<?php echo $data['State'] ?>",
                zip: "<?php echo $data['Zip'] ?>",
                lat: "<?php echo $data['Latitude'] ?>",
                long: "<?php echo $data['Longtitude'] ?>",
                city_pop: "<?php echo $data['City_population'] ?>",
                job: "<?php echo $data['Job'] ?>",
                dob: "<?php echo $data['DOB'] ?>",
                trans_num: "<?php echo $data['TransactionID'] ?>",
                unix_time: "<?php echo $data['Unix_time'] ?>",
                merch_lat: "<?php echo $data['Merch_latitude'] ?>",
                merch_long: "<?php echo $data['Merch_longtitude'] ?>"
            };

            fetch('http://127.0.0.1:5000/predict', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                // Handle prediction result
                window.alert('Prediction: ' + data.prediction);
            })
            .catch(error => console.error('Error:', error));
        }


        Predict();
    </script>


                        
                            <script type="text/javascript">
                                window.location='home.php';
                            </script>
                            <?php
                        }
                        }else{
                            ?>
                            <h5 class="card-title">Enter Transaction ID</h5>
                            <form action=" " method="POST">
                                <div class="mb-3">
                                    <label for="TransactionalID" class="form-label">Transaction ID: </label>
                                    <input list="browsers" name="browser" id="browser">
                        <datalist id="browsers"><?php 

                        include 'capaian.php';
                        $SQLTrans="SELECT * FROM transactions ;";
                        $run=mysqli_query($capaiDB,$SQLTrans);
                        while($data=mysqli_fetch_array($run)){
 
    ?>
    <option value="<?php echo $data['TransactionID'] ?>" > 
    <?php } ?>    
  </datalist>
                                </div>
                                
                                <input type="submit" name="predict" value="Check">
                            </form>
                        <?php } ?>    
                        </div>
                    </div>
                    <div class="mt-5">
                        <h2>Check Result</h2>
                        <p id="singleCheckResult">The result of the fraud check will be displayed here.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const batchUploadForm = document.getElementById('batchUploadForm');
            const analysisResults = document.getElementById('analysisResults');
            const resultsContent = document.getElementById('resultsContent');
            const downloadReport = document.getElementById('downloadReport');
            const fraudCustomerList = document.getElementById('fraudCustomerList');

            const singleCheckResult = document.getElementById('singleCheckResult');
            let fraudData = [];

            batchUploadForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const file = document.getElementById('transactionFile').files[0];
                if (file) {
                    Papa.parse(file, {
                        header: true,
                        complete: function(results) {
                            const data = results.data;
                            const totalTransactions = data.length;
                            const flaggedFraud = data.filter(row => row.is_fraud == 1);
                            const fraudCount = flaggedFraud.length;
                            const fraudRate = (fraudCount / totalTransactions) * 100;

                            // Update results content
                            resultsContent.innerHTML = `
                                <p>Analyzed ${file.name}</p>
                                <p>Total Transactions: ${totalTransactions}</p>
                                <p>Flagged as Potential Fraud: ${fraudCount}</p>
                                <p>Fraud Detection Rate: ${fraudRate.toFixed(2)}%</p>
                            `;
                            fraudData = flaggedFraud; // Store fraud data
                            analysisResults.style.display = 'block';

                            // Update Analytics Charts
                            updateFraudDetectionChart(fraudRate);
                            updateTransactionVolumeChart(totalTransactions, fraudCount);
                        }
                    });
                }
            });

            downloadReport.addEventListener('click', function() {
                const reportContent = `
Batch Analysis Report
----------------------
File Analyzed: ${document.getElementById('transactionFile').files[0].name}
Total Transactions: ${fraudData.length}
Flagged as Potential Fraud: ${fraudData.length}
Fraud Detection Rate: ${(fraudData.length / fraudData.length * 100).toFixed(2)}%

Detailed Transaction Analysis:
[Here you would include a detailed breakdown of flagged transactions]
                `;

                const blob = new Blob([reportContent], { type: 'text/plain' });
                const url = URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = 'fraud_analysis_report.txt';
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
                URL.revokeObjectURL(url);
            });

            fraudCustomerList.addEventListener('click', function() {
                if (fraudData.length > 0) {
                    let csvContent = "data:text/csv;charset=utf-8,";
                    csvContent += "CustomerID,Amount,MerchantCode,TransactionDate\n"; // Adjust columns as needed
                    fraudData.forEach(row => {
                        csvContent += `${row.CustomerID},${row.Amount},${row.MerchantCode},${row.TransactionDate}\n`; // Adjust columns as needed
                    });

                    const encodedUri = encodeURI(csvContent);
                    const link = document.createElement('a');
                    link.setAttribute('href', encodedUri);
                    link.setAttribute('download', 'fraud_customer_list.csv');
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                } else {
                    alert('No fraud transactions to display.');
                }
            });

            
            // Initialize Charts
            const fraudDetectionCtx = document.getElementById('fraudDetectionChart').getContext('2d');
            const transactionVolumeCtx = document.getElementById('transactionVolumeChart').getContext('2d');

            const fraudDetectionChart = new Chart(fraudDetectionCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Fraud', 'Legitimate'],
                    datasets: [{
                        label: 'Fraud Detection Rate',
                        data: [0, 100],
                        backgroundColor: ['#ff6384', '#36a2eb'],
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true
                }
            });

            const transactionVolumeChart = new Chart(transactionVolumeCtx, {
                type: 'bar',
                data: {
                    labels: ['Fraudulent', 'Non-Fraudulent'],
                    datasets: [{
                        label: 'Transaction Volume',
                        data: [0, 0],
                        backgroundColor: ['#ff6384', '#36a2eb']
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Functions to update charts
            function updateFraudDetectionChart(fraudRate) {
                fraudDetectionChart.data.datasets[0].data = [fraudRate, 100 - fraudRate];
                fraudDetectionChart.update();
            }

            function updateTransactionVolumeChart(total, fraud) {
                transactionVolumeChart.data.datasets[0].data = [fraud, total - fraud];
                transactionVolumeChart.update();
            }
        });
    </script>
</body>

</html>
