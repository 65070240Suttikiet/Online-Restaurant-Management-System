<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
class MyDB extends SQLite3
{
    function __construct()
    {
        $this->open('db/omakase.db');
    }
}
// Open Database 
$db = new MyDB();
$db->busyTimeout(5000);
if (!$db) {
    echo $db->lastErrorMsg();
    exit();
}
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$username = $_POST['username'];
$phone = $_POST['phone'];
$email = $_POST['mail'];
$password = $_POST['password'];
$confirmedPassword = $_POST["confirmed_pass"];
if ($password !== $confirmedPassword) {
    $mesg = "รหัสผ่านที่ยืนยันไม่ตรงกับรหัสผ่าน";
    echo "<script type='text/javascript'>alert('$mesg'); window.history.back();</script>";
    exit;
} else {
    $sql = "INSERT INTO customers(first_name, last_name, phone, email,username, password)
            VALUES ('$first_name','$last_name','$phone','$email','$username', '$password')";
    $result = $db->exec($sql);
    if ($result) {
        header("Location: index.php");
    } else {
        echo $db->lastErrorMsg();
    }
}
