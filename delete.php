<?php
include "config.php";
if (isset($_GET['deleteid'])) {
    $id = $_GET['deleteid'];

    $current_page = $_GET["page"];
    // echo '<script> alert("are you want to delete data")</script>';
    $sql = "delete from StudentData where srno=$id";
    $result = $connect->query($sql);
    if ($result) {
        // echo '<script>window.location.href = display.php</script>';
        // echo '<script>window.location.href = "display.php?delete"</script>';
        header("location:display.php?page=" . $current_page . "&delete");
    }
}
?>