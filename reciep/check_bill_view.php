<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css" rel="stylesheet" />
    <title>Receptionist</title>
    <link rel="stylecut icon" type="x-icon" href="https://cdn0.iconfinder.com/data/icons/business-office-and-people-in-flat/256/Businessman-2-512.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="check_bill_view.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Lato:wght@400;700&family=Poppins:wght@400;500;600;700&display=swap");

        * {
            margin: 0;
            padding: 0;
            outline: none;
            border: none;
            box-sizing: border-box;
            font-family: "Lato", sans-serif;

        }

        body {
            background: #600081;
            width: 100%;
        }

        .icon i {

            color: rgb(103, 103, 103);
        }

        .icon i:hover {
            transform: scale(1.5);
            cursor: pointer;
            color: rgb(37, 37, 37);
        }
    </style>
</head>

<body>
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

    if (isset($_GET['booking_id'])) {
        $booking_id = $_GET['booking_id'];
    }
    $sql = "SELECT booking_id, course_name, seat_id, room_id, booking_date, total_price, booking_status, customers.cus_id, first_name, last_name, phone, email
           FROM booking 
           JOIN customers
           JOIN course
           ON booking.cus_id = customers.cus_id
           AND course.course_id = booking.course_id
           WHERE booking_id = '$booking_id';";

    $ret = $db->query($sql);
    $row = $ret->fetchArray(SQLITE3_ASSOC);

    ?>
    <div class="bg-white rounded-lg shadow-lg px-8 py-3 max-w-xl mx-auto" style="margin-top: 40px;">
        <div class="icon" style="display: flex; justify-content: center;">
            <a href="check_bill.php"><i class="fa-solid fa-xmark text-2xl"></i></a>
        </div>
        <div class="flex items-center justify-between mb-8">

            <div class="flex items-center">
                <img class="h-8 w-8 mr-2 mt-2" src="https://tailwindflex.com/public/images/logos/favicon-32x32.png" alt="Logo" />
                <div class="text-gray-700 font-semibold text-lg">Gangnam Omakase</div>
            </div>
            <div class="text-gray-700">
                <div class="font-bold text-xl mb-2">ใบเสร็จ</div>

                <div class="text-sm"><?php echo 'วันที่ : ' . $row['booking_date'] ?></div>
                <div class="text-sm"><?php echo 'Booking ID : ' . $row['booking_id'] ?></div>
                <div class="text-sm"><?php echo 'สถานะ : ' . $row['booking_status'] ?></div>

            </div>
        </div>
        <div class="border-b-2 border-gray-300 pb-8 mb-8">
            <h2 class="text-2xl font-bold mb-4">ใบเสร็จถึง:</h2>
            <div class="text-gray-700 mb-2"><?php echo $row['first_name'] . ' ' . $row['last_name'] ?></div>
            <div class="text-gray-700 mb-2"><?php echo $row['phone'] ?></div>
            <div class="text-gray-700"><?php echo $row['email'] ?></div>
        </div>
        <table class="w-full text-left mb-8">
            <thead>
                <tr>
                    <th class="text-gray-700 font-bold uppercase py-2">คอร์สอาหาร</th>
                    <th class="text-gray-700 font-bold uppercase py-2">จำนวน</th>
                    <th class="text-gray-700 font-bold uppercase py-2">ราคา</th>

                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="py-4 text-gray-700"><?php echo $row['course_name'] ?></td>
                    <td class="py-4 px-5 text-gray-700">1</td>
                    <td class="py-4 text-gray-700"><?php echo $row['total_price'] ?></td>

                </tr>

        </table>

        <div class="flex justify-end mb-8">
            <div class="text-gray-700 mr-2">ราคารวม :</div>
            <div class="text-gray-700 font-bold text-xl"><?php echo $row['total_price'] . ' บาท' ?></div>
        </div>
        <div class="border-t-2 border-gray-300 pt-8 mb-5" style="text-align: center;">
            ชำระเงินเสร็จสิ้นแล้ว
        </div>


</body>

</html>