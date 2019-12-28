<?php include('header.php'); ?>


<?php
if (!isset($_SESSION['userindex'])) 
    {
      echo'<h3>bạn chưa đăng nhập! không thể sử dụng các chức năng</h3><br> xẽ tự động chuyển về trang chủ sau 3s
      <meta http-equiv="refresh" content="3;url= index.php">';
    }


// xử lý Kết bạn
if (isset($_GET["get_id_kb"]) && isset($_SESSION['userindex'])) 
    {
      $Ten = $_SESSION['userindex'];
      $get_id_xoa = $_GET["get_id_xoa"];
      mysqli_query($ketnoi, "DELETE FROM tinmoi where ID='$get_id_xoa' and Username=N'$Ten' ");
      echo'<meta http-equiv="refresh" content="0;url= Profile.php?user='.$Ten.'">';
    }



// xử lý xóa bài
if (isset($_GET["get_id_xoa"]) && isset($_SESSION['userindex'])) 
    {
      $Ten = $_SESSION['userindex'];
      $get_id_xoa = $_GET["get_id_xoa"];
      mysqli_query($ketnoi, "DELETE FROM tinmoi where ID='$get_id_xoa' and Username=N'$Ten' ");
      echo'<meta http-equiv="refresh" content="0;url= Profile.php?user='.$Ten.'">';
    }







// xử lý like
// xử lý like bài cuả id nào đó 
if (isset($_GET["get_id"]) && isset($_SESSION['userindex'])) 
    {
            $result = mysqli_query($ketnoi, "SELECT * FROM tinmoi ORDER BY ID DESC");
            if ($result) 
                {
                while ($row=mysqli_fetch_row($result)) 
                    {
                        $get_id=($_GET['get_id']);
                        if($row[0]==$get_id) // nếu dòng ID nầy trùng vs id get thì thực thi lệnh với id này
                        { 
                            $TinhtrangLike = mysqli_query($ketnoi, "SELECT * FROM tinmoi where ID ='$get_id' ");
                            $Tinhtrang = mysqli_fetch_array($TinhtrangLike);

                            if($Tinhtrang['TinhTrangLike'] == NULL)  // stt mới đăng là 100% được like
                            {
                                $like_up = $row[5] + 1;
                                mysqli_query($ketnoi, " UPDATE tinmoi SET LuotThich='$like_up' where ID ='$get_id'");
                                mysqli_query($ketnoi, " UPDATE tinmoi SET TinhTrangLike='1' where ID ='$get_id'");
                                $_SESSION['Check_Like'] ='ok'; // đã like
                            }
                            
                            if($Tinhtrang['TinhTrangLike']=='1')// nếu đã tồn tại tình trạng thì chạy kiểm tra vô trong
                            {
                                if(isset($_SESSION['Check_Like']))// tồn tại tình trạng và tồn tại check_like rồi thì trừ like
                                {
                                    if($row[5]==0)
                                    {
                                        // nếu dòng row ID đang chạy trùng với id get thì giảm 1 like
                                        $like_up = 0;
                                        mysqli_query($ketnoi, " UPDATE tinmoi SET LuotThich='$like_up' where ID ='$get_id'");
                                        mysqli_query($ketnoi, " UPDATE tinmoi SET TinhTrangLike='0' where ID ='$get_id'");
                                        unset($_SESSION['Check_Like']); // đã bỏ like
                                    }
                                    else
                                    {
                                        // nếu dòng row ID đang chạy trùng với id get thì giảm 1 like
                                        $like_up = $row[5] - 1;
                                        mysqli_query($ketnoi, " UPDATE tinmoi SET LuotThich='$like_up' where ID ='$get_id'");
                                        mysqli_query($ketnoi, " UPDATE tinmoi SET TinhTrangLike='0' where ID ='$get_id'");
                                        unset($_SESSION['Check_Like']); // đã bỏ like
                                    }
                                }
                                else
                                {
                                    // nếu dòng row ID đang chạy trùng với id get thì tăng 1 like
                                    $like_up = $row[5] + 1;
                                    mysqli_query($ketnoi, " UPDATE tinmoi SET LuotThich='$like_up' where ID ='$get_id'");
                                    mysqli_query($ketnoi, " UPDATE tinmoi SET TinhTrangLike='1' where ID ='$get_id'");
                                    $_SESSION['Check_Like'] ='ok'; // đã like 
                                }
                            }

                            else if($Tinhtrang['TinhTrangLike'] =='0')  // nếu CHƯA tồn tại tình trạng thì chạy kiểm tra vô trong
                            {
                                if(isset($_SESSION['Check_Like'])) // nếu CHƯA có tình trạng mà có like rồi thì cũng ko like dc n
                                {

                                    if($row[5]==0)
                                    {
                                        // nếu dòng row ID đang chạy trùng với id get thì giảm 1 like
                                        $like_up = 0;
                                        mysqli_query($ketnoi, " UPDATE tinmoi SET LuotThich='$like_up' where ID ='$get_id'");
                                        mysqli_query($ketnoi, " UPDATE tinmoi SET TinhTrangLike='0' where ID ='$get_id'");
                                        unset($_SESSION['Check_Like']); // đã bỏ like
                                    }
                                    else
                                    {
                                        // nếu dòng row ID đang chạy trùng với id get thì giảm 1 like
                                        $like_up = $row[5] - 1;
                                        mysqli_query($ketnoi, " UPDATE tinmoi SET LuotThich='$like_up' where ID ='$get_id'");
                                        mysqli_query($ketnoi, " UPDATE tinmoi SET TinhTrangLike='0' where ID ='$get_id'");
                                        unset($_SESSION['Check_Like']); // đã bỏ like
                                    }
                                }
                                else
                                {
                                    // nếu dòng row ID đang chạy trùng với id get thì tăng 1 like
                                    $like_up = $row[5] + 1;
                                    mysqli_query($ketnoi, " UPDATE tinmoi SET LuotThich='$like_up' where ID ='$get_id'");
                                    mysqli_query($ketnoi, " UPDATE tinmoi SET TinhTrangLike='1' where ID ='$get_id'");
                                    $_SESSION['Check_Like'] ='ok'; // đã like 
                                }
                            }
                        }
                        echo'<meta http-equiv="refresh" content="0;url= index.php">';
                    }
             }
    }
?>