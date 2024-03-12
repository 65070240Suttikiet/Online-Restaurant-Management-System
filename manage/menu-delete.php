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
    <meta name="viewport" content="width=ds, initial-scale=1.0">
    <title>Document</title>
  </head>

  <body>
    <?php
    $menu_name = $_GET['menu_name'];
    $sql = "DELETE FROM menu WHERE menu_name = '$menu_name'";
    $sql1 = "DELETE FROM detail_course_menu WHERE menu_name = '$menu_name'";
    if ($db->query($sql) == TRUE & $db->query($sql1) == TRUE) {
      echo "<script>alert('การลบเมนูสำเร็จ');</script>";
      echo "<script>window.location.href = 'home-menu.php';</script>";

    }else {
      echo "<script>alert('การลบเมนูอาหารไม่สำเร็จ');</script>";
      echo "<script>window.location.href = 'home-menu.php';</script>";
    }
    ?>
  </body>
</html>