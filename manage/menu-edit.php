<?php
class MyDB extends SQLite3
{
  function __construct()
  {
    $this->open('../db/omakase.db');
  }
}

// 2. Open Database 
$db = new MyDB();
if (!$db) {
  echo $db->lastErrorMsg();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=ds, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $menu_name = $_GET['menu_name'];
    $menu_detail = $_GET['menu_detail'];
    $menu_img = $_GET['menu_img'];


    $sql = "UPDATE menu SET menu_name='$menu_name', menu_detail='$menu_detail' , menu_img='$menu_img' WHERE menu_name='$menu_name';";
    if ($db->query($sql) == TRUE) {
        echo "<script>alert('การอัพเดทเมนูสำเร็จ');</script>";
        echo "<script>window.location.href = 'home-menu.php';</script>";
    }else {
        echo "Error updating record";
    }
    ?>
</body>

</html>
