<?php
$errors = array();
session_start();
$err = '';
require("db.php");

if (isset($_POST['adminLogin'])) {
    $adminUsername = mysqli_real_escape_string($db, $_POST['adminUsername']);
    $adminPassword = mysqli_real_escape_string($db, $_POST['adminPassword']);

    $res = mysqli_query($db, "select * from admin where username='$adminUsername'");
    $check = mysqli_num_rows($res);
    if ($check > 0) {
        $row = mysqli_fetch_assoc($res);
        $dbpassword = $row['password'];

        if ($adminPassword === $dbpassword) {
            $box = $_SESSION['username'] = $adminUsername;
            setcookie('uname', $box, time() + (48 * 60 * 60));
            header("location: ./allot.php");
            $arr = array('Status' => 'Login Success', 'Success Message' => 'Login Successfuly, Please Wait to Redirect....');
        } else {
            $arr = array('Status' => 'Login Failed', 'Error Message' => 'Please enter correct password');
        }
    } else {
        $arr = array('Status' => 'Login Failed', 'Error Message' => 'Please enter correct Roll no');
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Housekeeper Admin Login</title>

    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800" rel="stylesheet">

    <!-- Custom Style -->
    <style>
    body {
        background-image: url('assets/imgs/p.jpg');
        /* Replace 'your-background-image.jpg' with the URL of your image */
        background-repeat: no-repeat;
        background-size: cover;
        /* Adjust as needed */
        background-position: center;
        /* Adjust as needed */
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        font-family: 'Montserrat', sans-serif;
        height: 100vh;
        margin: -20px 0 50px;
    }

    /* Additional CSS for better UI */
    header {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }

    .card {
        width: 400px;
        padding: 20px;
        margin-top: 50px;
        border-radius: 10px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        background-color: #18d120;
        /* Green color */
        color: #333;
        /* Text color */
    }

    .form-align {
        text-align: center;
    }

    .link {
        color: #333;
        font-size: 14px;
        text-decoration: none;
        margin-top: 10px;
        display: block;
        text-align: center;
        /* Center align the text */
    }

    .input-field {
        position: relative;
        margin-bottom: 1rem;
    }

    .input-field input[type="text"],
    .input-field input[type="password"] {
        width: calc(100% - 20px);
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 5px;
        outline: none;
        background-color: white;
        /* Set background color to white */
    }

    .input-field input[type="text"]:focus,
    .input-field input[type="password"]:focus {
        border-color: #007bff;
    }

    .input-field label {
        position: absolute;
        top: 0;
        left: 0;
        padding: 10px;
        transition: all 0.3s ease;
        pointer-events: none;
    }

    .input-field input[type="text"]:focus+label,
    .input-field input[type="password"]:focus+label,
    .input-field input[type="text"]:valid+label,
    .input-field input[type="password"]:valid+label {
        top: -18px;
        left: 0;
        background: #fff;
        padding: 5px;
        font-size: 12px;
        color: #007bff;
    }

    .input-field input[type="text"]:focus+label,
    .input-field input[type="password"]:focus+label {
        color: #007bff;
    }

    .button-container {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }

    h4 {
        font-weight: bold;
        /* Make the text bold */
        text-align: center;
        /* Center align the text */
    }
    </style>
</head>

<body>
    <header>
        <div class="card">
            <h4>Admin Sign In</h4>
            <p>Allot Housekeepers.</p>
            <form action="" method="POST" autocomplete="off">
                <?php include("errors.php") ?>
                <div class="input-field">
                    <input type="text" name="adminUsername" id="rollnumber" class="validate" required>
                    <label for="rollnumber">Username</label>
                </div>
                <div class="input-field">
                    <input type="password" name="adminPassword" id="password" class="validate" required>
                    <label for="password">Password</label>
                </div>
                <div class="button-container">
                    <button type="submit" name="adminLogin" class="waves-effect waves-light btn">Continue</button>
                </div>
            </form>
            <a class="link" href="login.php"><b>Student login</b></a>
            <!-- Center align the link -->
        </div>
    </header>

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>

</html>