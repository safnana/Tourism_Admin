<?php
$conn = mysqli_connect('localhost', 'root', '') ;
if(!$conn)
{
die('gagal konek'.mysqli_error($con));
}
mysqli_select_db($conn, 'database_jj');
?>