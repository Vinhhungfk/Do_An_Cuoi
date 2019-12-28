<?php
	// Kiểm tra nếu người dùng đã ân nút đăng nhập thì mới xử lý
if (isset($_POST['DangNhap']))
    { 
    echo '<div class="xah" style="color:black">';
		// lấy thông tin từ form
		$username = $_POST["username"];
		$password = $_POST["password"];
		
	    if ($username == "" || $password =="") 
    	    {
    			echo "Xin vui lòng nhập!";
    		  }
		  else 
    		{
          $query = mysqli_query($ketnoi,"select * FROM users WHERE Username = '$username' and Password = '$password' ");
          $num_rows = mysqli_num_rows($query);
		    	if ($num_rows==null) 
        			{
              echo "tên đăng nhập hoặc mật khẩu không đúng!"; 
              }
          else
              {
              // đoạn này kiểm tra nick kích hoạt ch - lấy TinhTrang ra so sánh 0 ~ 1
              $result = mysqli_query($ketnoi,"select TinhTrang FROM users WHERE Username = '$username'"); 
              if ($result) 
                  {  
                      while ($row=mysqli_fetch_row($result)) 
                        {
                          $tinhtrang=$row[0];// lấy mã TinhTrang sql ra gán vô $tinhtrang
                        }
                        
                      if($tinhtrang==0)
                        {
                          echo'Xin lỗi nick này chưa được kích hoạt! vui lòng check mail lại!';
                        }
                      if($tinhtrang==1)
                        {
                          echo "Đăng nhập Thành công!";
        		   	          $sql1 = "select * FROM users WHERE Username = '$username' ";
    		           	      mysqli_query($ketnoi,$sql1);
                          $_SESSION['userindex'] = $username; // lưu tên vô sesion
                          $Emaill = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT Email FROM users where Username =N'$username' "));
                          $_SESSION['Email'] = $Emaill['Email']; // lưu email


                         // echo'<META http-equiv="refresh" content="1;URL=index.php">';
                        }
                    } 
                }
    		}
		echo '</div>';
}
?>