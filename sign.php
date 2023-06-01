<?php
include "config.php";

if (isset($_POST["sign"])) {
    $signname = $_POST["name"];
    $signpassword = $_POST["password"];
    $signemail = $_POST["email"];
    $sql = "INSERT INTO account VALUES ('$signname', '$signemail', '$signpassword')";
    $result = $connect->query($sql);
    if ($result) {
        header('location:login.php');
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
    <style>
        body {
            margin: 0;
        }

        input::placeholder {
            font-size: 16px;
            font-family: sans-serif;
        }

        a {}
    </style>
</head>

<body>
    <form class="contanier" method="POST">
        <div class="login-container">
            <h1>Sign-up</h1>
            <div class="sub-heading">
                <h2>Welcome to Student daitails!</h2>
                <p>Please sign-in to your account and start the adventure</p>
            </div>
            <div class="login">
                <input placeholder="Name" type="text" id="name" name="name" value="" />
            </div>
            <div class="login">
                <input placeholder="Email" type="email" id="email" name="email" value="" />
            </div>
            <div class="login">
                <input placeholder="Password" type="password" id="password" name="password" />
            </div>
            <button class="login-btn" type="=sign" name="sign">SIGN UP</button>
            <div class="create-heading">If you have a Account? <span><a href="login.php">Login an account</a></span>
            </div>
        </div>
    </form>
</body>

</html>