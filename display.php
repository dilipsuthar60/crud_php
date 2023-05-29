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
    include "config.php";
    $per_page_number = 3;
    if (isset($_GET['page'])) {
        $page_number = $_GET['page'];
    } else {
        $page_number = 1;
    }
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
    ?>
    <div class="head-btn"><a href="user.php"> Add User</a>
        <a href="alldata.php"> Show All Data</a>
    </div>
    <table class="styled-table">
        <tr>
            <th>Srno</th>
            <th>Name</th>
            <th>Email</th>
            <th>Password</th>
            <th>Subject</th>
            <th>Gender</th>
            <th>Message</th>
            <th>Action</th>
        </tr>
        <?php
        $current_page_count = mysqli_num_rows($result);
        $rowCount = 0;
        if ($current_page_count == 0) {
            $page_number--;
        }
        while ($row = mysqli_fetch_assoc($result)) {
            $srno = $row["srno"];
            $name = $row["name"];
            $email = $row["email"];
            $password = $row["password"];
            $subject = $row["subject"];
            $gender = $row["gender"];
            $message = $row["message"];
            $rowCount++;
            echo '<tr>
            <td>' . $rowCount + ($page_number - 1) * $per_page_number . '</td>
            <td>' . $name . '</td>
            <td>' . $email . '</td>
            <td>' . $password . '</td>
            <td>' . $subject . '</td>
            <td>' . $gender . '</td>
            <td>' . $message . '</td>
            <td><a href="edit.php?page=' . $page_number . '&editid=' . $srno . '" style="padding:0.3rem; color:white;background-color:green;border-radius:5px;">Edit</a>&nbsp;<a href="delete.php?page=' . $page_number . '&deleteid=' . $srno . '" style="padding:0.3rem; color:white;background-color:red;border-radius:5px;" >Delete</a></td>';
        }
        ?>
    </table>
    <div class="pagination_section">
        <?php
        $sql = "SELECT * FROM StudentData";
        $result = $connect->query($sql);
        $total_number_of_rows = mysqli_num_rows($result);
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