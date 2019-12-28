<?php session_start(); ?>
<?php 
  include('ketnoi.php');
  //https://www.falconenergy.co.uk/wp-content/uploads/2016/05/sound-insulation-testing-banner.jpg

  date_default_timezone_set('Asia/Ho_Chi_Minh');// cài đặt múi giờ hcm
  $Time = date('d.m.Y / H:i'); // time đăng bài 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><!--doc ki tu dac biet-->
  <title>Quachdaik</title>

<link rel="stylesheet" href="style1.css" type="text/css" />

</head>
<body>
<div class="white">





<table width="100%" class="head"><tr><td style="margin-left:50px" width="50%"><a href="index.php"><img src="img/logo.png" width="120px" /></a><p></p></td>
<td width="40%" ><span align="right"><form action="TimKiem.php" method="get"><input  type="text" name="tim" />
<input type="submit" value="Tìm kiếm Tài Khoản" /></form></div></span></td></tr></table>






<div id="cssmenu">
  <ul>
  <li class='actived'><a href='index.php'>Home</a></li>

  <?php
  if (isset($_SESSION['userindex']))  // nếu mà đã đăng nhập thì vô đây
      {
        $Ten=$_SESSION['userindex'];
        echo' <li><a style="" href="Profile.php?user='.$Ten.'">Trang Cá nhân</a></li> ';
      }
  ?>
 
  <li><a href='messages.php?u_id=new'>Chat</a></li>

  <?php
  if (isset($_SESSION['userindex']))  // nếu mà đã đăng nhập thì vô đây
      {
        $Ten=$_SESSION['userindex'];
        echo' <li><a href="Logout.php">Logout</a></li> ';
      }
  ?>
  

</ul></div>
<script type="text/javascript"src="http://dat007.xtgem.com/Js/trochuot2.js"></script>
<!--End#menu-qh-->   

<div class="list1">
  

<img src="http://dongduong.edu.vn/old_website/wp-content/uploads/2016/12/mang-xa-hoi-tao-mang-ket-noi-rong.png" width="985px" height="100px"/>







</div>

