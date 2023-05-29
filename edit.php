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

    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $subject = $_POST['subject'];
        $gender = $_POST['gender'];
        $message = $_POST['message'];
        echo '<script> alert("are you want to edit data")</script>';
        $sql = "UPDATE StudentData SET  `name` = '$name', `email` = '$email', `password` = '$password', `subject` = '$subject', `gender` = '$gender', `message` = '$message' WHERE `srno` = $id;";
        $result = $connect->query($sql);
        if ($result) {
            // echo '<script>window.location.href = "display.php?submit"</script>';
            echo '<script>window.location.href = "display.php?edit"</script>';
            // header("location:display.php?page=" . $current_page . "&edit");
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
        <?php if (isset($error)) {
            if ($error == 1) {
                echo '<div style="text-align:center; color:#c0392b">Something Went Wrong Please Check</div>';
            }
            if ($error == 0) {
                echo '<div style="text-align:center; color:#27ae60">Form Succes Fully Submited<br>record insert successfully
        </div>';
            }
        }
        ?>
        <h1 class="heading">Student From</h1>
        <div>
            <label for="name">Name:</label>
            <input placeholder="enter a name" type="text" id="name" name="name" value=<?php echo $name; ?> />
        </div>
        <div>
            <label for="email">Email:</label>
            <input placeholder="enter a email" type="email" id="email" name="email" value=<?php echo $email; ?> />
        </div>
        <div>
            <label for="password">Password:</label>
            <input placeholder="enter a password" type="password" id="password" name="password" value=<?php echo $password; ?> />
        </div>
        <div>
            <label for="subject">Subject:</label>
            <select id="subject" name="subject">
                <option value="math">math</option>
                <option value="science">science</option>
                <option value="hindi" selected>hindi</option>
                <option value="algorithm">algorithm</option>
            </select>
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

        </div>
        <div class="message-section">
            <span>Massage:</span>
            <input name="message" type="text" value=<?php echo $message; ?>></input>
        </div>
        <input type="submit" name="submit" value="Update" class="btn">
    </form>

</body>

</html>