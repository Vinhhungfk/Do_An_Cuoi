<?php include('header.php'); ?>

<div id="main">
<div id="phai">

<div class="list21">
<div class="list1">

<?php
if (isset($_GET["tim"]))
{
    echo'<h3>Kết Quả:</h3>'; 
  

    $Ten=$_GET["tim"]; 
    $result = mysqli_query($ketnoi, "SELECT * FROM users  where Username =N'$Ten' ");        
    if ($result)    
        {

         // $num_rows = mysqli_num_rows($result);       
                  $row=mysqli_fetch_row($result);
                  if ($row==null) // tìm k ra
                  {
                    $check_tim=1; 
                    echo'<div class="xah">Tài Khoản ko tồn tại</div>';
                  }
                    else
                    {
                    echo'   <br><br><br><br><br><br> 
                    <table style="margin:-90px 0px 0px 30px"><td>';
                    if($row[9] != null)// nếu user có ảnh thì xuất ảnh ra
                    {
                      $resultAVT = mysqli_query($ketnoi, "SELECT ImgData FROM users where Username =N'$Ten' ");
                      $AVT = mysqli_fetch_array($resultAVT);
                      echo ' <img id="zoom" src="data:image/jpeg;base64,'.base64_encode( $AVT['ImgData'] ).'"  style="border-radius:100px" height="50px" width="50px"/>';
                    }
                    else// ko có ảnh thì no images
                    {
                      echo ' <img id="zoom" src="https://ataxavi.vn/theme/admin/images/noimage.png" style="border-radius:100px" height="120px" width="120px" />';
                    }                 


                      echo'</td><td>
                  <a style="color:green;font-weight:bold;font-size:20px;margin-left:10px" href="Profile.php?user='.$Ten.'">'.$row[1].'</a>
                  <a class="hong" style="padding:3px; border-radius:4px" href="XuLy.php?get_id_ket_ban='.$row[0].'">Gửi Lời Kết bạn</a>
                  </td></table> ';

                      echo'<div class="#list1" style=""><table><td>• Tên tài khoản: <a href="Profile.php?user='.$Ten.'">'.$row[1].'</a><br><br>
                      • Email: '.$row[3].'<br><br>
                      • Ngày Sinh: '.$row[6].'<br></td><td>
                      • Giới Tính: '.$row[7].'<br><br>
                      • Số Điện Thoại: '.$row[8].'<br><br>
                      • Thành Viên Thứ: #'.$row[0].'   </td></table>';
                  }
        }
            
 
    mysqli_free_result($result); 
            
}

?>




</div></div></div></div>
<p><p>









<?php
include('footer.php');
?>