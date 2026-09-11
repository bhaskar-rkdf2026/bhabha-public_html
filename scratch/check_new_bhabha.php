<?php
$conn = new mysqli("localhost", "root", "", "new-bhabha");
if ($conn->connect_error) {
    echo "Cannot connect to new-bhabha: " . $conn->connect_error . "\n";
    exit;
}
echo "Connected to new-bhabha successfully!\n";
$res = $conn->query("SHOW COLUMNS FROM course");
if ($res) {
    echo "Columns in new-bhabha 'course':\n";
    while ($row = $res->fetch_assoc()) {
        echo " - " . $row['Field'] . "\n";
    }
}
$res = $conn->query("SELECT COUNT(*) as c FROM settings");
if ($res) {
    $r = $res->fetch_assoc();
    echo "Settings rows in new-bhabha: " . $r['c'] . "\n";
}
