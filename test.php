<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
class MyDB extends SQLite3
{
    function __construct()
    {
        $this->open('db/omakase.db');
    }
}
$db = new MyDB();

$seat = "av";
// $seatresult = $db->query($seatsql);
$seat_uv = "SELECT * FROM seat_booking WHERE seat_id = 1 and booking_date = '2024-03-09'";
$seat_booking_result = $db->query($seat_uv);
if ($seat_booking_result) {
    $seat_booking_row = $seat_booking_result->fetchArray(SQLITE3_ASSOC);
    $seat_status = $seat_booking_row["seat_status"];
    echo $seat_status;
    // if ($seat_status == 'uv') {
    //     $seat = "uv"; // ถ้ามีการจองแล้ว
    //     echo $seat;
    // }
}
