<?php
class MyDB extends SQLite3
{
    function __construct()
    {
        $this->open('../db/omakase.db');
    }
}
$db = new MyDB();
if (!$db) {
    echo $db->lastErrorMsg();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    if (isset($_GET['course_id'])) {
        $course_id = $_GET["course_id"];
        $menu_name = $_GET["menu_name"];
        $menu_detail = $_GET["menu_detail"];
        $menu_img = $_GET["menu_img"];
        $add_menu = "INSERT INTO menu(menu_name, menu_detail, menu_img) 
                    VALUES ('$menu_name', '$menu_detail', '$menu_img')";
        $detail_menu = "INSERT INTO detail_course_menu(course_id, menu_name)
                    VALUES ('$course_id', '$menu_name')";
        if (($db->query($add_menu) == true) and ($db->query($detail_menu) == true)) {
            echo "<script>alert('การเพิ่มเมนูสำเร็จ');</script>";
            echo "<script>window.location.href = 'home-menu.php';</script>";
        } else {
            echo "<script>alert('การเพิ่มเมนูไม่สำเร็จ');</script>";
            echo "<script>window.location.href = 'menu-add.php';</script>";
        }
    } else {
        echo "<script>alert('เกิดข้อผิดพลาด');</script>";
        echo "<script>window.location.href = 'menu-add.php';</script>";
    }
    ?>

</body>

</html>