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
if(!$db) {
    echo $db->lastErrorMsg();
    exit();
}

    $sql = "INSERT INTO customers(first_name, last_name, phone, email,username, password)
            VALUES ('$first_name','$last_name','$phone','$email','$username', '$password')";
    $result = $db->query($sql);

    if($result){
        header("Location: login.php");
    }else{
        echo("error" . mysqli_error($conn));
    }
?>