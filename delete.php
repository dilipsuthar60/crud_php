<?php
include "config.php";
if (isset($_GET['deleteid'])) {
    $id = $_GET['deleteid'];

    $current_page = $_GET["page"];
    $sql = "delete from StudentData where srno=$id";
    $result = $connect->query($sql);
    if ($result) {
        header("location:display.php?page=" . $current_page . "&delete");
    }
}
?>