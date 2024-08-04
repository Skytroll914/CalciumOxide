<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Information</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/PapaParse/5.3.0/papaparse.min.js"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        .container {
            width: 100%;
            max-width: 800px;
            margin: auto;
        }

        h2 {
            text-align: center;
        }

        .section {
            margin-bottom: 20px;
        }

        .section h3 {
            border-bottom: 1px solid #000;
            padding-bottom: 5px;
            margin-bottom: 10px;
        }

        .details,
        .transactions {
            width: 100%;
            border-collapse: collapse;
        }

        .details td,
        .transactions th,
        .transactions td {
            padding: 10px;
            border: 1px solid #000;
        }

        .transactions th {
            background-color: #f2f2f2;
        }

        .input-form {
            text-align: center;
            margin-bottom: 20px;
        }

        .navbar {
            background-image: url('https://static.vecteezy.com/system/resources/previews/023/221/109/non_2x/banking-and-finance-concept-digital-connect-system-financial-and-banking-technology-with-integrated-circles-glowing-line-icons-and-on-blue-background-design-vector.jpg');

            opacity: 0.9;
            height: 150px;
        }

        .tFont {
            font-family: 'Georgia', serif;
            font-size: 100pc;
            font-weight: bold;
            text-align: center;

        }

        .navbar-brand {
            color: rgba(255, 255, 255, 0.5);
            /* Decrease opacity of the navbar brand text */
            font-family: 'Georgia', serif;
            /* Serif font for the brand name */
            font-size: 2.5em;
            /* Adjust font size */
            font-weight: bold;
            /* Bold text */
            text-align: center;
            /* Center align text */
            width: 100%;
            /* Ensure it spans the full width of the navbar */
        }

        .navbar-nav {
            position: absolute;
            right: 0;
            bottom: 0;
            margin: 0;
            padding: 0;
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/PapaParse/5.3.0/papaparse.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Credit Card Fraud Detection</a>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#"
                        onclick="alert('Logout functionality would be implemented here.')">(Logout)</a>
                </li>
            </ul>
        </div>
    </nav>




    <div class="container">
        <h2 style="margin-top: 20px" ;><strong>Customer Information</strong></h2>

        <div id="customer-info">
            <div class="section">
                <h3>Basic Details</h3>
                <table class="details">
                    <tr>
                        <td><strong>Name:</strong></td>
                        <td id="name">Tan Chee Kang</td>
                    </tr>
                    <tr>
                        <td><strong>Account Number:</strong></td>
                        <td id="account-number">---- ---- ---- 5623</td>
                    </tr>
                    <tr>
                        <td><strong>Email:</strong></td>
                        <td id="email">---ng6@gmail.com</td>
                    </tr>
                    <tr>
                        <td><strong>Phone:</strong></td>
                        <td id="phone">--- --- 2269</td>
                    </tr>
                    
                </table>
            </div>

            <div class="section">
                <h3>Account Details</h3>
                <table class="details">
                    <tr>
                        <td><strong>Account Balance: 2,000.00</strong></td>
                        <td id="account-balance"></td>
                    </tr>
                    <tr>
                        <td colspan="2"><strong>Recent Transactions:</strong></td>
                    </tr>
                </table>
                <table class="transactions" id="transactions-table">
                    <tr>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Merchant</th>
                    </tr>
                </table>
                <table class="details">
                    <tr>
                        <td><strong>Linked Cards:</strong></td>
                    </tr>
                    <tbody id="linked-cards-table">
                        <!-- Linked cards will be populated here -->
                    </tbody>
                </table>
            </div>
        </div>
        <div class="back-button">
            <button onclick="goToMainPage()">Back</button>
        </div>
    </div>
    <script>
        function fetchCustomerInfo() {
            const accountNumber = document.getElementById('account-number-input').value.trim();

            fetch('/Fraud Dataset.csv')  // Ensure the path is correct
                .then(response => response.text())
                .then(text => {
                    console.log("CSV Data Fetched: ", text);
                    Papa.parse(text, {
                        header: true,
                        complete: function (results) {
                            console.log("Parsed CSV Results: ", results);
                            const customer = results.data.find(row => row.cc_num && row.cc_num.trim() === accountNumber);
                            console.log("Customer Found: ", customer);
                            if (customer) {
                                // Basic Details
                                document.getElementById('name').textContent = (customer.first || '') + ' ' + (customer.last || 'N/A');
                                document.getElementById('account-number').textContent = customer.cc_num || 'N/A';
                                document.getElementById('email').textContent = customer.email || 'N/A';
                                document.getElementById('phone').textContent = customer.phone || 'N/A';
                                document.getElementById('address').textContent = customer.street || 'N/A';

                                // Account Details
                                document.getElementById('account-balance').textContent = customer.balance || 'N/A';

                                // Parse and render transactions
                                renderTransactions(results.data, accountNumber);

                                // Parse and render linked cards
                                renderLinkedCards(results.data, accountNumber);
                            } else {
                                alert('Customer not found.');
                                clearCustomerInfo();
                            }
                        },
                        error: function (error) {
                            console.error('Error parsing CSV:', error);
                        }
                    });
                })
                .catch(error => console.error('Error fetching CSV:', error));
        }

        function renderTransactions(data, accountNumber) {
            const transactionsTable = document.getElementById('transactions-table');
            transactionsTable.innerHTML = `
                <tr>
                    <th>Date</th>
                    <th>Amount</th>
                    <th>Merchant</th>
                </tr>
            `;
            const transactions = data.filter(row => row.cc_num && row.cc_num.trim() === accountNumber && row.trans_date_trans_time && row.amt && row.merchant);
            transactions.forEach(t => {
                transactionsTable.innerHTML += `
                    <tr>
                        <td>${t.trans_date_trans_time || 'N/A'}</td>
                        <td>${t.amt || 'N/A'}</td>
                        <td>${t.merchant || 'N/A'}</td>
                    </tr>
                `;
            });
        }

        function renderLinkedCards(data, accountNumber) {
            const linkedCardsTable = document.getElementById('linked-cards-table');
            const linkedCards = data.filter(row => row.cc_num && row.cc_num.trim() === accountNumber).map(row => `Card Ending in ${row.cc_num.slice(-4)}: ${row.card_type || 'N/A'} - ${row.card_status || 'N/A'}`);
            if (linkedCards.length > 0) {
                linkedCardsTable.innerHTML = linkedCards.map(card => `
                    <tr>
                        <td>${card}</td>
                    </tr>
                `).join('');
            } else {
                linkedCardsTable.innerHTML = '<tr><td>No linked cards available.</td></tr>';
            }
        }

        function clearCustomerInfo() {
            document.getElementById('name').textContent = '';
            document.getElementById('account-number').textContent = '';
            document.getElementById('email').textContent = '';
            document.getElementById('phone').textContent = '';
            document.getElementById('address').textContent = '';
            document.getElementById('account-balance').textContent = '';
            document.getElementById('transactions-table').innerHTML = `
                <tr>
                    <th>Date</th>
                    <th>Amount</th>
                    <th>Merchant</th>
                </tr>
            `;
            document.getElementById('linked-cards-table').innerHTML = '';
        }
        function goToMainPage() {
            window.location.href = 'WP.HTML';
        }
    </script>
</body>

</html>