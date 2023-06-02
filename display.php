<?php
include "config.php";
session_start();
if (!isset($_SESSION["email"]) or !isset($_SESSION["password"]) or !isset($_SESSION["name"])) {
    header('location:login.php');
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
</head>

<body>
    <?php
    $srnoorder = "asc";
    $nameorder = "asc";
    $emailorder = "asc";
    $passwordorder = "asc";
    $subjectorder = "asc";
    $genderorder = "asc";
    $messageorder = "asc";
    $searchvalue = "";
    $sql = "SELECT * FROM StudentData";
    $result = $connect->query($sql);
    $total_row = mysqli_num_rows($result);
    $per_page_number = 3;
    if (isset($_GET['page'])) {
        $page_number = $_GET['page'];
    } else {
        $page_number = 1;
    }
    echo '<h1 class="welcome-heading">Welcome to ' . $_SESSION["password"] . '</h1>';
    if (isset($_GET["submit"])) {
        echo '<div  class="insert-message">Record Insert Succesfully</div>';
        echo '<script>
        function deleteclass(){
            let insertmessage=document.querySelector(".insert-message");
            insertmessage.style.display="none";
        }
        setTimeout(deleteclass, 2000);
       </script>';
    }
    if (isset($_GET["edit"])) {
        echo '<div  class="insert-message">Record Edit Succesfully</div>';
        echo '<script>
        function deleteclass(){
            let insertmessage=document.querySelector(".insert-message");
            insertmessage.style.display="none";
        }
        setTimeout(deleteclass, 2000);
       </script>';
    }
    if (isset($_GET["delete"])) {
        echo '<div  class="insert-message" style="color:#EA2027">Record Delete Succesfully</div>';
        echo '<script>
        function deleteclass(){
            let insertmessage=document.querySelector(".insert-message");
            insertmessage.style.display="none";
        }
        setTimeout(deleteclass, 2000);
       </script>';
    }
    $start_page = ($page_number - 1) * $per_page_number;
    $sql = "SELECT * FROM `StudentData` order by  `srno` DESC limit $start_page,$per_page_number ";
    $result = $connect->query($sql);
    if (isset($_GET["sort"])) {
        $id = $_GET["sort"];
        $ordersorting = $_GET["orderby"];
        $sql = "SELECT * from StudentData ORDER BY " . $id . " " . $ordersorting . " limit $start_page,$per_page_number ";
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
    $character = "";
    if (isset($_GET['search'])) {
        $name = trim($_GET['search']);
        if (strlen($name) > 2) {
            $sql = "SELECT * FROM `StudentData` WHERE (`name` LIKE '%" . $name . "%' or `email` LIKE '%" . $name . "%' or `gender` LIKE '%" . $name . "%' or `subject` LIKE '%" . $name . "%')";
            $result = $connect->query($sql);
            $total_row = mysqli_num_rows($result);
            $character = "";

        } else {
            $character = "at least 3 character";
        }
    }
    ?>
    <div class="head-btn">
        <a href="user.php"> Add Student</a>
        <form method="GET">
            <input class="search-input" value="" placeholder="enter a name" type="text" id="search" name="search" />
            <button type="search" class="btn btn-search">Search</button>
        </form>
        <a href="logout.php">Logout</a>
    </div>
    <?php
    echo '<div class="error searcherror"> ' . $character . '</div>'; ?>
    <div class="table-container">
        <table class="styled-table">
            <tr>
                <th><a href="display.php?page=<?php echo $page_number; ?>&sort=srno&orderby=<?php echo $srnoorder; ?>">
                        Srno<span style='font-size:20px;'>&#8593;</span>
                        <span style='font-size:20px;'>&#8595;</span> </a></th>
                <th><a href="display.php?page=<?php echo $page_number; ?>&sort=name&orderby=<?php echo $nameorder; ?>">
                        Name<span style='font-size:20px;'>&#8593;</span>
                        <span style='font-size:20px;'>&#8595;</span> </a></th>
                <th><a
                        href="display.php?page=<?php echo $page_number; ?>&sort=email&orderby=<?php echo $emailorder; ?>">
                        Email<span style='font-size:20px;'>&#8593;</span>
                        <span style='font-size:20px;'>&#8595;</span> </a></th>
                <th><a
                        href="display.php?page=<?php echo $page_number; ?>&sort=subject&orderby=<?php echo $subjectorder; ?>">Subject<span
                            style='font-size:20px;'>&#8593;</span>
                        <span style='font-size:20px;'>&#8595;</span> </a></th>
                <th><a
                        href="display.php?page=<?php echo $page_number; ?>&sort=gender&orderby=<?php echo $genderorder; ?>">Gender<span
                            style='font-size:20px;'>&#8593;</span>
                        <span style='font-size:20px;'>&#8595;</span> </a></th>
                <th><a
                        href="display.php?page=<?php echo $page_number; ?>&sort=message&orderby=<?php echo $messageorder; ?>">Message<span
                            style='font-size:20px;'>&#8593;</span>
                        <span style='font-size:20px;'>&#8595;</span> </a></th>
                <th><a>Action</a></th>
            </tr>
            <?php
            $current_page_count = mysqli_num_rows($result);
            $rowCount = 0;
            if ($srnoorder == "desc") {
                $rowCount = $total_row;
            }
            while ($row = mysqli_fetch_assoc($result)) {
                $srno = $row["srno"];
                $name = $row["name"];
                $email = $row["email"];
                $password = $row["password"];
                $subject = $row["subject"];
                $gender = $row["gender"];
                $message = $row["message"];
                if ($srnoorder == "desc") {
                    $rowCount--;
                } else {
                    $rowCount++;
                }
                echo '<tr>
            <td>' . $rowCount + ($page_number - 1) * $per_page_number . '</td>
            <td>' . $name . '</td>
            <td>' . $email . '</td>
            <td>' . $subject . '</td>
            <td>' . $gender . '</td>
            <td>' . $message . '</td>
            <td><a href="edit.php?page=' . $page_number . '&editid=' . $srno . '" style="padding:0.3rem; color:white;background-color:green;border-radius:5px;">Edit</a>&nbsp;<a href="delete.php?page=' . $page_number . '&deleteid=' . $srno . '" style="padding:0.3rem; color:white;background-color:red;border-radius:5px;" >Delete</a></td>';
            }
            ?>
        </table>
    </div>
    <?php
    if ($total_row == 0) {
        echo "student is not found";
    } ?>
    <div class="pagination_section">
        <?php
        // $sql = "SELECT * FROM StudentData";
        // $result = $connect->query($sql);
        $total_number_of_rows = $total_row;
        $page_needed = ceil(($total_number_of_rows) / ($per_page_number));
        if ($page_number > 1) {
            echo '<a href="display.php?page=' . ($page_number - 1) . '">Prev</a>';
        }
        for ($i = 1; $i <= $page_needed; $i++) {
            if ($page_number == $i) {
                $active = "active";
            } else {
                $active = "";
            }
            echo '<a class="' . $active . '"  href="display.php?page=' . $i . '" >' . $i . '</a>';
        }
        if ($i - 1 > $page_number) {
            echo '<a href="display.php?page=' . ($page_number + 1) . '">Next</a>';
        }
        ?>
    </div>

</body>

</html>