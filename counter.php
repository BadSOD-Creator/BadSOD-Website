<?php
$file = "counter.txt";
$count = file_get_contents($file);
$count++;
file_put_contents($file, $count);
echo "People join this web: " . $count;
?>