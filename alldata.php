<?php
include "config.php";
$sql = "SELECT * FROM StudentData";
$result = $connect->query($sql);
$srnoorder = "asc";
$nameorder = "asc";
$emailorder = "asc";
$passwordorder = "asc";
$subjectorder = "asc";
$genderorder = "asc";
$messageorder = "asc";
if (isset($_GET["sort"])) {
    $id = $_GET["sort"];
    $ordersorting = $_GET["orderby"];
    $sql = "SELECT * from StudentData ORDER BY " . $id . " " . $ordersorting;
    // $sql = "SELECT * FROM `StudentData` ORDER BY $id ASC";
    $result = $connect->query($sql);
    if ($id == "srno" and $ordersorting == "asc") {
        $srnoorder = "desc";
    } else if ($id == "name" and $ordersorting == "asc") {
        $nameorder = "desc";
    } else if ($id == "email" and $ordersorting == "asc") {
        $emailorder = "desc";
    } else if ($id == "password" and $ordersorting == "asc") {
        $passwordorder = "desc";
    } else if ($id == "subject" and $ordersorting == "asc") {
        $subjectorder = "desc";
    } else if ($id == "gender" and $ordersorting == "asc") {
        $genderorder = "desc";
    } else if ($id == "message" and $ordersorting == "asc") {
        $messageorder = "desc";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <style>
        a {
            margin-left: -5px;
        }
    </style>
</head>

<body>
    <div class="head-btn">
        <a href="display.php"> Display page</a>
        <a href="user.php"> Add User</a>
        <a href="alldata.php"> Show All Data</a>
    </div>
    <table class="styled-table">
        <tr>
            <th><a href="alldata.php?sort=srno&orderby=<?php echo $srnoorder; ?>"> Srno<span
                        style='font-size:20px;'>&#8593;</span>
                    <span style='font-size:20px;'>&#8595;</span> </a></th>
            <th><a href="alldata.php?sort=name&orderby=<?php echo $nameorder; ?>"> Name<span
                        style='font-size:20px;'>&#8593;</span>
                    <span style='font-size:20px;'>&#8595;</span> </a></th>
            <th><a href="alldata.php?sort=email&orderby=<?php echo $emailorder; ?>"> Email<span
                        style='font-size:20px;'>&#8593;</span>
                    <span style='font-size:20px;'>&#8595;</span> </a></th>
            <th><a href="alldata.php?sort=password&orderby=<?php echo $passwordorder; ?>">Password<span
                        style='font-size:20px;'>&#8593;</span>
                    <span style='font-size:20px;'>&#8595;</span> </a></th>
            <th><a href="alldata.php?sort=subject&orderby=<?php echo $subjectorder; ?>">Subject<span
                        style='font-size:20px;'>&#8593;</span>
                    <span style='font-size:20px;'>&#8595;</span> </a></th>
            <th><a href="alldata.php?sort=gender&orderby=<?php echo $genderorder; ?>">Gender<span
                        style='font-size:20px;'>&#8593;</span>
                    <span style='font-size:20px;'>&#8595;</span> </a></th>
            <th><a href="alldata.php?sort=message&orderby=<?php echo $messageorder; ?>">Message<span
                        style='font-size:20px;'>&#8593;</span>
                    <span style='font-size:20px;'>&#8595;</span> </a></th>
        </tr>
        <?php
        $rowCount = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $srno = $row["srno"];
            $name = $row["name"];
            $email = $row["email"];
            $password = $row["password"];
            $subject = $row["subject"];
            $gender = $row["gender"];
            $message = $row["message"];
            // $rowCount++;
            echo '<tr>
            <td>' . $srno . '</td>
            <td>' . $name . '</td>
            <td>' . $email . '</td>
            <td>' . $password . '</td>
            <td>' . $subject . '</td>
            <td>' . $gender . '</td>
            <td>' . $message . '</td>
            ';
        }
        ?>
    </table>

</body>

</html>