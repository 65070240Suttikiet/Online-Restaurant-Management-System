<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    class MyDB extends SQLite3
    {
        function __construct()
        {
            $this->open('db/omakase.db');
        }
    }
    $db = new MyDB();
    if (isset($_GET['order_id'])) {

        $order_id = $_GET['order_id'];
        $update_query = "UPDATE orders SET order_status = 'cooking' WHERE order_id = $order_id";
        if ($db->exec($update_query)) {
            header("Location: cheffood.php");
        } else {
            echo "เกิดข้อผิดพลาดในการอัปเดตสถานะของคำสั่ง: " . $db->lastErrorMsg();
        }
    } else {
        echo "ไม่มีการส่งค่า order_id";
    }

    $db->close();
    ?>

</body>

</html>
