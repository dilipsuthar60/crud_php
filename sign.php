<?php
include "config.php";
$signerror = NULL;
$nameerror = "";
$emailerror = "";
$passworderror = "";
if (isset($_POST["sign"])) {
    $signname = $_POST["name"];
    $signpassword = $_POST["password"];
    $signemail = $_POST["email"];
    if (empty($signname)) {
        $nameerror = "name is required";
        $signerror = 1;
    } else if (!preg_match("/^[a-zA-Z ]*$/", $signname)) {
        $nameerror = "name should be letter";
        $signerror = 1;
    }
    if (empty($signemail)) {
        $signerror = 1;
        $emailerror = "email is required";
    } else if (!filter_var($signemail, FILTER_VALIDATE_EMAIL)) {
        $emailerror = "invalid email";
        $signerror = 1;
    } else {
        $sql = "SELECT * FROM `account` WHERE `email` = '" . $signemail . "'";
        $result = $connect->query($sql);
        $present_row_count_in_db = mysqli_num_rows($result);
        if ($present_row_count_in_db > 0) {
            $emailerror = "email is already exist";
            $signerror = 1;
        }
    }
    if (empty($signpassword)) {
        $passworderror = "password is required";
        $signerror = 1;
    }
    if ($signerror == NULL) {
        $sql = "INSERT INTO account VALUES ('$signname', '$signemail', '$signpassword')";
        $result = $connect->query($sql);
        if ($result) {
            header('location:login.php');
        }
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

        .span {
            border: 1px solid red;
            margin: 0;
        }

        .section {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            width: 100%;
        }
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
            <div class="section">
                <div class="login">
                    <input placeholder="Name" type="text" id="name" name="name" value="<?php echo $signname ?>" />
                </div>
                <div class="error" style="display:block">
                    <?php echo $nameerror; ?>
                </div>
            </div>
            <div class="section">
                <div class="login">
                    <input placeholder="Email" type="email" id="email" name="email" value="<?php echo $signemail ?>" />
                </div>
                <div class="error" style="display:block">
                    <?php echo $emailerror; ?>
                </div>
            </div>
            <div class="section">
                <div class="login">
                    <input placeholder="Password" type="password" id="password" name="password"
                        value="<?php echo $signpassword ?>" />
                </div>
                <div class="error" style="display:block">
                    <?php echo $passworderror; ?>
                </div>
            </div>
            <button class="login-btn" type="=sign" name="sign">SIGN UP</button>
            <div class="create-heading">If you have a Account? <span><a href="login.php">Login an account</a></span>
            </div>
        </div>
    </form>
</body>

</html>