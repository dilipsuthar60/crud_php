<?php
include "config.php";
$notmatch = NULL;
if (isset($_POST["login"])) {
    $username = $_POST["name"];
    $password = $_POST["password"];
    $sql = "SELECT * FROM `StudentData` WHERE `name` = '" . $username . "' AND  `password` = '" . $password . "'";
    $result = $connect->query($sql);
    if (mysqli_num_rows($result) > 0) {
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
</head>

<body>
    <form class="contanier" method="POST">
        <div class="login-container">
            <?php
            if ($notmatch)
                echo '<div class="error">Invalid Username and Password</div>';
            ?>
            <h1>Student</h1>
            <h2>Welcome to Student daitails!</h2>
            <p class="login-p">Please sign-in to your account and start the adventure</p>
            <div>

                <input placeholder="enter a name" type="text" id="name" name="name" />
            </div>
            <div>
                <input placeholder="enter a password" type="password" id="password" name="password" />
            </div>
            <button class="login-btn" type="login" name="login">LOGIN</button>
        </div>
    </form>
</body>

</html>