<?php
class MyDB extends SQLite3
{
    function __construct()
    {
        $this->open('omakase.db');
    }
}
$db = new MyDB();
if (!$db) {
    echo $db->lastErrorMsg();
} else {
    echo "Opened database successfully<br>";
}
$sql = "SELECT * FROM customers;";
$ret = $db->query($sql);

while ($row = $ret->fetchArray(SQLITE3_ASSOC)) {
    echo $row['cus_id'];
}
$db->close();
?>