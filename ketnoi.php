<?php
//khai báo biến host
$hostName = 'localhost';
// khai báo biến username
$userName = 'root';
//khai báo biến password
$passWord = '';
// khai báo biến databaseName
$databaseName = 'data';


// khởi tạo kết nối
$ketnoi = mysqli_connect($hostName, $userName, $passWord, $databaseName);

$conn = mysqli_connect($hostName, $userName, $passWord, $databaseName);



/*
//Kiểm tra kết nối trường hợp k thành công = !
if (!$ketnoi) 
{
  exit('Kết nối không thành công!');
}
// thành công
else
{
  echo 'Kết nối thành công!';
  mysqli_query($ketnoi,"SET NAMES 'UTF8'");
}
*/

?>
