<?php
include "config.php";
if (isset($_GET['editid'])) {
    $id = $_GET['editid'];
    $current_page = $_GET["page"];
    $sql = "select * from StudentData where srno='$id'";
    $result = $connect->query($sql);
    $row = mysqli_fetch_assoc($result);
    $srno = $row["srno"];
    $name = $row["name"];
    $email = $row["email"];
    $password = $row["password"];
    $subject = $row["subject"];
    $gender = $row["gender"];
    $message = $row["message"];
    $errorEdit = NULL;
    $nameerror = "";
    $emailerror = "";
    $passworderror = "";
    $subjecterror = "";
    $gendererror = "";
    $messageerror = "";
    // $sql = "delete from StudentData where srno=$id";
    // $result = $connect->query($sql);
    if (isset($_POST['submit'])) {
        echo $_POST['srno'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $subject = $_POST['subject'];
        $gender = $_POST['gender'];
        $message = $_POST['message'];
        // $sql = "delete from StudentData where srno=$id";
        if (empty($name)) {
            $nameerror = "name is required";
            $errorEdit = 1;
        } else if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
            $nameerror = "name should be letter";
            $errorEdit = 1;
        }
        if (empty($email)) {
            $errorEdit = 1;
            $emailerror = "email is required";
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailerror = "invalid email";
            $errorEdit = 1;
        }
        if (empty($password)) {
            $passworderror = "password is required";
            $errorEdit = 1;
        }
        if (empty($gender)) {
            $gendererror = "gender is required";
            $errorEdit = 1;
        }
        if (empty($subject)) {
            $subjecterror = "subject is required";
            $errorEdit = 1;
        }
        if (empty($message)) {
            $messageerror = "message is required";
            $errorEdit = 1;
        }
        if ($errorEdit == NULL) {
            // echo '<script> alert("are you want to edit data")</script>';
            $sql = "UPDATE StudentData SET  `name` = '$name', `email` = '$email', `password` = '$password', `subject` = '$subject', `gender` = '$gender', `message` = '$message' WHERE `srno` = $id;";
            $result = $connect->query($sql);
            if ($result) {
                // echo '<script>window.location.href = "display.php?submit"</script>';
                // echo '<script>window.location.href = "display.php?edit"</script>';
                header("location:display.php?page=" . $current_page . "&edit");
            }
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
</head>

<body>
    <form method="post">
        <?php if (isset($errorEdit)) {
            if ($errorEdit == 1) {
                echo '<div style="text-align:center; color:#c0392b">Something Went Wrong Please Check</div>';
            }
        }
        ?>
        <h1 class="heading">Student From</h1>
        <div>
            <label for="name">Name:</label>
            <input placeholder="enter a name" type="text" id="name" name="name" value="<?php echo $name; ?>" />
            <span class="error" style="display:block">
                <?php echo $nameerror; ?>
            </span>
        </div>
        <div>
            <label for="email">Email:</label>
            <input placeholder="enter a email" type="email" id="email" name="email" value="<?php echo $email; ?>" />
            <span class="error" style="display:block">
                <?php echo $emailerror; ?>
            </span>
        </div>
        <div>
            <label for="password">Password:</label>
            <input placeholder="enter a password" type="password" id="password" name="password"
                value="<?php echo $password; ?>" />
            <span class="error" style="display:block">
                <?php echo $passworderror; ?>
            </span>
        </div>
        <div>
            <label for="subject">Subject:</label>
            <select id="subject" name="subject">
                <option value="math" <?php if ($subject == "math") {
                    echo "selected";
                } ?>>math</option>
                <option value="science" <?php if ($subject == "science") {
                    echo "selected";
                } ?>>science</option>
                <option value="hindi" <?php if ($subject == "hindi") {
                    echo "selected";
                } ?>>hindi</option>
                <option value="algorithm" <?php if ($subject == "algorithm") {
                    echo "selected";
                } ?>>algorithm</option>
            </select>
            <span class="error" style="display:block">
                <?php echo $subjecterror; ?>
            </span>
        </div>
        <div>
            <label for="gender">Gender:</label>
            <input type="radio" type="gender" id="gender" name="gender" value="Male" <?php if ($gender == "Male") {
                echo "checked";
            } ?> />
            <label for="gender">Male</label>
            <input type="radio" type="gender" id="gender" name="gender" value="Female" <?php if ($gender == "Female") {
                echo "checked";
            } ?> />
            <label for="gender">Female</label>
            <span class="error" style="display:block">
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
        <input type="submit" name="submit" value="Update" class="btn">
    </form>

</body>

</html>