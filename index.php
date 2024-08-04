<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calcium Oxide Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            height: 100vh;
            overflow: hidden;
        }
        .left-panel {
            flex: 1;
            background-image: url('https://assets.bizclikmedia.net/1800/b1d8eb071749707d01ab0f10d30d7c76:eb7186956ac37e35518e4f002b0c12fa/gettyimages-1050855182.jpg');
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .left-panel::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.3); /* Darker overlay */
            filter: blur(8px); /* Increased blur effect */
            z-index: 1;
        }
        .left-panel h1 {
            position: relative;
            z-index: 2;
            font-size: 2.5rem;
            margin: 0;
            padding: 0 2rem;
            font-weight: bold;
        }
        .right-panel {
            flex: 1;
            padding: 2rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background-color: #f7f9fc;
            box-shadow: -4px 0 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            font-size: 1.8rem;
            margin-bottom: 1.5rem;
            color: #333;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }
        input {
            padding: 0.75rem;
            border: 1px solid #ced4da;
            border-radius: 8px;
            font-size: 1rem;
        }
        input:focus {
            border-color: #80bdff;
            outline: none;
            box-shadow: 0 0 0 0.2rem rgba(38, 143, 255, 0.25);
        }
        button {
            padding: 0.75rem;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1.1rem;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #0056b3;
        }
        .forgot-password {
            text-align: right;
            margin-bottom: 1rem;
        }
        .signup-link {
            margin-top: 1rem;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="left-panel">
        <h1>Welcome to Calcium Oxide Fraud Detection and Prevention System</h1>
    </div>
    <div class="right-panel">
        <h2>Login to Your Account</h2>
        <?php 
                    if (isset($_POST['login'])){
                        ?>
                        <?php 
                        include 'capaian.php';
                        $count=0;
                        $empID=$_POST['id'];
                        $password=$_POST['password'];
                        $SQLLogin="SELECT * from Employee where empID='$empID' AND password='$password';";
                        $run=mysqli_query($capaiDB,$SQLLogin);
                        $data=mysqli_fetch_array($run);
                        if(empty($data['empID'])){
                        ?>
                        <script type="text/javascript">
                            window.alert("ID or Password is Incorrect. Please Try again!");
                            window.location='index.php';
                        </script>   
                        <?php
                        }else{
                            session_start();
                            $_SESSION['empID']=$data['empID'];

                        ?>
                            <script type="text/javascript">
                                window.alert("Login Successful");
                                window.location='home.php';
                            </script>
                            <?php
                        }
                        ?>
                        <?php
                    }else{
                 ?>
        <form action="" method="POST">
            <input type="text" name = "id" placeholder="Admin ID" required>
            <input type="password" name="password" placeholder="Enter 8-digit PIN number" required>
            <input type="submit" name="login" value="Login">
        </form>
        <?php
            }
            ?>
    </div>
</body>
</html>
