<!DOCTYPE html>
<html>
<body>

<?php
require_once "config.php"; 
$sql = "SELECT upload_status FROM products WHERE product_id='21RJGM1081'";
$result = mysqli_query($link, $sql);
if ($result !== false) {
$row = mysqli_fetch_row($result);
echo $row[0];
}
?>

</body>
</html>