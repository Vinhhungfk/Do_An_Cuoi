<?php include("header.php"); ?>

<div id="main">
<div id="phai">

<div class="list21">
<div class="list1">
<?php
	// Kiểm tra nếu người dùng đã ân nút đăng nhập thì mới xử lý
	if (isset($_POST["quenmk"])) 
	{  
	    echo '<div class="xah">';
	    // lấy thông tin người dùng
		$username = $_POST["username"];
		$email = $_POST["email"];
		if ($username == "" || $email =="") 
    	    {
    			echo "bạn không được để trống cái nào hết!";
    		}
		else 
    		{
    			$query = mysqli_query($ketnoi,"select * FROM users WHERE Username = '$username' and Email = '$email' ");
    			$num_rows = mysqli_num_rows($query);
    			if ($num_rows==null) 
        			{
    				echo "tên đăng nhập hoặc email không Tồn tại!";
    			    }
    		   	else
        		   	{
        		   	    // đoạn này select ra cái pass word gán vô biến để send vè mail
            			$accc= "select password FROM users WHERE Username = '$username'";
            			$result = mysqli_query($ketnoi,$accc); 
                        if ($result) 
                            {  
                                 while ($row=mysqli_fetch_row($result)) 
                                    {
                                        $pass=$row[0];// lấy pass ra gán vô $pass
                                    }
                            }
        		   	    // truyền 3 cái $email,$username,$pass vô function
        		   	    function Send_Mail($email,$username,$pass)
        		   	    {
                                ini_set( 'display_errors', 1 );
                                error_reporting( E_ALL );
                                $from = "kichhoat@gmail.com";
                                $to = "$email";
                                $subject = "Quên mật khẩu";
                                $message ='mật khẩu của bạn là '.$pass.', lấy tờ giấy ra ghi lại cho đỡ quên nhé =))';
                                $headers = "From:" . $from;
                                mail($to,$subject,$message, $headers);
                                echo 'đã gửi mật khẩu tới '.$email.' vui lòng kiểm tra hộp thư đến để lấy lại mk nhé!';
       				   	 }
       				// thực thi cái function này
                    Send_Mail($email,$username,$pass);
        		   	}
    		}
	echo '</div>';
}
?>



	
<br><b>bạn vui lòng nhập tên và email của tài khoản bị quên mk:</b><br>

<form method="POST" action="resetmk.php"><br>
Tên:<br> <input type="text" name="username" ><br>
email:<br> <input type="text" name="email" > <br><input type="submit" name="quenmk" value="gửi email">
<p></p> </form> 
</div></div></div></div>

<?php include("footer.php"); ?>

