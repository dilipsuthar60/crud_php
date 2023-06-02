<?php
include "config.php";
session_start();
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

        .forget-heading{
            color: rgba(58, 53, 65, 0.87);
            font-weight: 500;

        }
    </style>
</head>

<body>
    <form class="contanier" method="POST">
        <div class="login-container">
            <?php
            if ($notmatch)
                echo '<div class="error">Invalid  Useremail and Password</div>';
            ?>
            <h1>Reset Password</h1>
            <div class="forget-heading">
                <p>Please Enter valid Email Where Received Code</p>
            </div>
            <div class="section">
                <div class="login">
                    <input placeholder="Email" type="email" id="email" name="email"
                        value="<?php echo $loginemail; ?>" />
                </div>
            </div>
            <button class="login-btn" type="login" name="login">SUBMIT</button>
        </div>
    </form>
</body>

</html>