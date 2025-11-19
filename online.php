<?php
session_start();
$filename = "online_users.txt";
$timeout = 300; // 5 minutes

// Get current time and user IP
$time = time();
$ip = $_SERVER['REMOTE_ADDR'];

// Read existing data
$data = file_exists($filename) ? file($filename) : [];
$new_data = [];

// Filter out expired sessions
foreach ($data as $line) {
    list($stored_ip, $stored_time) = explode("|", trim($line));
    if ($time - $stored_time < $timeout && $stored_ip != $ip) {
        $new_data[] = "$stored_ip|$stored_time";
    }
}

// Add current user
$new_data[] = "$ip|$time";

// Save updated data
file_put_contents($filename, implode("\n", $new_data));

// Show count
echo "Users online: " . count($new_data);
?>