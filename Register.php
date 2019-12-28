<?php include("header.php"); ?>
 
<style>
.main1{ 
  width: 1000px; 
  margin: auto;}  

.trai1{ 
  float: left;
  width: 280px;
  margin:1px}  
    
.phai1{ 
  float: right; 
  width: 700px; 
  margin:1px}









    </style>



<div class="main1">

<div class="trai1">
<div class="list21">
<div class="list1">





<form style="" method="POST" action=""><br>
    <b> Mã Kích Hoạt</b><br>
    <input type="text" style="width:230px" name="code" placeholder="code" > <br><br>
    <input type="submit" style="width:242px" name="Kichhoat" value="Kích Hoạt"><p></p>
    </form>



    





    
 <?php   
  
  if (isset($_POST["Kichhoat"]))
    {
        echo'<div class="xah">';
        $code = $_POST["code"];

        $c=mysqli_query($ketnoi,"SELECT Tinhtrang FROM users WHERE Code='$code'");
 
         if(mysqli_num_rows($c) > 0)
            {
                $count=mysqli_query($ketnoi,"SELECT Tinhtrang FROM users WHERE Code='$code' and Tinhtrang='0'");
    
                if(mysqli_num_rows($count) == 1)
                {
                    mysqli_query($ketnoi,"UPDATE users SET Tinhtrang='1' WHERE Code='$code'");
                    echo"kích hoạt tài khoản thành công!";
                }
                else
                {
                    echo"tài khoản đã được kích hoạt rồi! không cần kích hoạt lại!";
                }
            }
         else
            {
                echo"Mã Kích Hoạt Tào Lao. xem lại nhé!.";
            }
            echo'</div>';
}
?>




</div></div></div>








<div class="phai1">

<div class="list21">
<div class="list1" style="padding-left:10px">


      
          <center><b>Đăg ký tài khoản</b></center>
          <hr>
          <form method="POST" action=""><br>
          
          <b><font color="#f00">* </font>Tên Tài Khoản</b><br> 
          <input type="text"  style="border-left: 1px solid #f00;width:280px"name="username" ><br>

          <b><font color="#f00">* </font>Mật Khẩu</b><br>
          
          <input type="password" style="border-left: 1px solid #f00;width:280px" name="password" ><br>

          <b><font color="#f00">* </font>Email</b><br> 
          
          <input type="text" style="border-left: 1px solid #f00;width:280px" name="email" ><br>
          
          <input type="submit" name="dangky" value="Đăng ký">   không được để trống *  <br><p></p>
         
        <br><br>

    

            
<?php
if (isset($_POST["dangky"])) 
{ 
    echo'<div class="xah">';
    
      $username = $_POST["username"];
      $password = $_POST["password"];
      $email = $_POST["email"];
      // check định dạng mail
      $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/';
      
      // Mã khóa mật khẩu
      // $password = md5($password);
      
      if ($username == "" || $password == "" || $email == "" )
          {
              echo '* Nhập thiếu thông tin!<br>';
          }
      else
          {
              if(!preg_match($regex, $email))
                {
                    echo '* Định dạng email này có gì đó sai sai!<br>';
                }
              else
                {
                    // check tên
                    $kt_ten=mysqli_query($ketnoi, "select * FROM users WHERE Username='$username'");
                    if(mysqli_num_rows($kt_ten)  > 0 )
                      {
                          echo '* Tên Tài khoản này tồn tại rồi!<br>';
                      }
                    else
                      {
                          // check email
                          $kt_email=mysqli_query($ketnoi,"select * FROM users WHERE Email='$email'");
                          if( mysqli_num_rows($kt_email)  > 0 )
                            {
                              echo '* Email này đã tồn tại<br>';
                            }
                          else
                            {
                                $randum = rand(100, 900); //tạo code accti cho nick
                                mysqli_query($ketnoi,"INSERT INTO users(Username,Password,Email,Code,TinhTrang) 
                                            VALUES ('$username','$password','$email','$randum',0)");
                                function Send_Mail($email,$username,$randum)
                                  {
                                    ini_set( 'display_errors', 1 );   
                                    error_reporting( E_ALL );
                                    $from = "kichhoat@gmail.com";
                                    $to = "$email";
                                    $subject = "Chúc mừng $username đã chốt kèo tại web hồi nãy";
                                    $message ='Xin chúc mừng '.$username.' đã đăng ký tài khoản thành công tại WEb Hưng Vĩnh! Mã kích Hoạt Của Bạn là: '.$randum.' ';
                                    $headers = "From:" . $from;
                                    mail($to,$subject,$message, $headers);
                                    echo 'Đăng ký tk thành công! đã gửi mail tới '.$email.' vui lòng kiểm tra hộp thư đến để kích hoạt tài khoản này nhé!';
                                  }
                                Send_Mail($email,$username,$randum);
                            }     
                                    
                      }
               }    
            }
echo'</div>';
}
?>

  

</div> </div> </div>


<?php include('footer.php'); ?>