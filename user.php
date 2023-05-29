<?php
include "config.php";
$error = NULL;
$name = "";
$email = "";
$password = "";
$subject = "";
$gender = "";
$message = "";
$nameerror = "";
$emailerror = "";
$passworderror = "";
$subjecterror = "";
$gendererror = "";
$messageerror = "";
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $subject = $_POST['subject'];
    $gender = $_POST['gender'];
    $message = $_POST['message'];
    if (empty($name)) {
        $nameerror = "name is required";
        $error = 1;
    } else if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
        $nameerror = "name should be letter";
        $error = 1;
    } else {
        $sql = "SELECT * FROM `StudentData` WHERE `name` = '" . $name . "'";
        $result = $connect->query($sql);
        $present_row_count_in_db = mysqli_num_rows($result);
        if ($present_row_count_in_db > 0) {
            $nameerror = "name is already exist";
            $error = 1;
        }
    }
    if (empty($email)) {
        $error = 1;
        $emailerror = "email is required";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailerror = "invalid email";
        $error = 1;
    } else {
        $sql = "SELECT * FROM `StudentData` WHERE `email` = '" . $email . "'";
        $result = $connect->query($sql);
        $present_row_count_in_db = mysqli_num_rows($result);
        if ($present_row_count_in_db > 0) {
            $emailerror = "email is already exist";
            $error = 1;
        }
    }
    if (empty($password)) {
        $passworderror = "password is required";
        $error = 1;
    }
    if (empty($gender)) {
        $gendererror = "gender is required";
        $error = 1;
    }
    if (empty($subject)) {
        $subjecterror = "subject is required";
        $error = 1;
    }
    if (empty($message)) {
        $messageerror = "message is required";
        $error = 1;
    }
    // echo $error;
    if ($error == NULL) {
        echo '<script> alert("are you want to insert data")</script>';
        $error = null;
        $sql = "INSERT INTO StudentData VALUES (NULL,'$name', '$email', '$password', '$subject', '$gender', '$message')";
        $result = $connect->query($sql);
        if ($result) {
            // header('location:display.php?submit');
            echo '<script>window.location.href = "display.php?submit"</script>';
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
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .error {
            color: red;
            font-size: 12px;
            text-align: center;
            display: block;
        }
    </style>
</head>

<body>
    <form method="post">
        <?php if (isset($error)) {
            if ($error == 1) {
                echo '<div style="text-align:center; color:#c0392b">Something Went Wrong Please Check</div>';
            }
        }
        ?>
        <h1 class="heading">Student From</h1>
        <div>
            <label for="name">Name:</label>
            <input value="<?php echo $name; ?>" placeholder="enter a name" type="text" id="name" name="name" />
            <span class="error" style="display:block">
                <?php echo $nameerror; ?>
            </span>
        </div>
        <div>
            <label for="email">Email:</label>
            <input value="<?php echo $email; ?>" placeholder="enter a email" type="email" id="email" name="email" />
            <span class="error">
                <?php echo $emailerror; ?>
            </span>
        </div>
        <div>
            <label for="password">Password:</label>
            <input value="<?php echo $password; ?>" placeholder="enter a password" type="password" id="password"
                name="password" />
            <span class="error">
                <?php echo $passworderror; ?>
            </span>
        </div>
        <div>
            <label for="subject">Subject:</label>
            <select id="subject" name="subject">
                <option value="math">math</option>
                <option value="science">science</option>
                <option value="hindi" selected>hindi</option>
                <option value="algorithm">algorithm</option>
            </select>
            <span class="error">
                <?php echo $subjecterror; ?>
            </span>
        </div>
        <div>
            <label for="gender">Gender:</label>
            <label for="gender">Male</label>
            <input type="radio" type="gender" id="gender" name="gender" value="Male" <?php if ($gender == "Male") {
                echo "checked";
            } ?> />
            <label for="gender">Female</label>
            <input type="radio" type="gender" id="gender" name="gender" value="Female" <?php if ($gender == "Female") {
                echo "checked";
            } ?> />
            <span class="error">
                <?php echo $gendererror; ?>
            </span>
        </div>
        <div>
            <label for="message">Massage:</label>
            <input value="<?php echo $message; ?>" name="message" type="text"></input>
            <span class="error">
                <?php echo $messageerror; ?>
            </span>
        </div>
        <input type="submit" name="submit" value="submit" class="btn">
    </form>

</body>

</html>