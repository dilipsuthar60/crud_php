<?php
include "config.php";
session_start();
$notmatch = NULL;
$loginname = "";
$loginemail = "";
if (isset($_POST["login"])) {
    $password = $_POST["password"];
    $useremail = $_POST["email"];
    $loginname = $username;
    $loginemail = $useremail;
    $sql = "SELECT * FROM `account` WHERE `email` = '" . $useremail . "' AND  `password` = '" . $password . "'";
    $result = $connect->query($sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION["name"] = $row["name"];
        $_SESSION["password"] = $row["password"];
        $_SESSION["email"] = $row["email"];
        header('location:display.php');
    } else {
        $notmatch = 1;
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
            <?php
            if ($notmatch)
                echo '<div class="error">Invalid  Useremail and Password</div>';
            ?>
            <h1>Login </h1>
            <div class="sub-heading">
                <h2>Welcome to Student daitails!</h2>
                <p>Please login-in to your account and start the adventure</p>
            </div>
            <div class="section">
                <div class="login">
                    <input placeholder="Email" type="email" id="email" name="email"
                        value="<?php echo $loginemail; ?>" />
                </div>
            </div>
            <div class="section">
                <div class="login">
                    <input placeholder="Password" type="password" id="password" name="password"
                        value="<?php echo $signpassword ?>" />
                </div>
                <div class="forget"><span><a href="forget-password.php">Forgot Password?</a></span></div>
            </div>
            <button class="login-btn" type="login" name="login">LOGIN</button>
            <div class="create-heading">New on our platform? <span><a href="sign.php">Create an account</a></span></div>
        </div>
    </form>
</body>

</html>