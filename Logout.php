<?php include('header.php'); ?>


<p><p>
<div class="list1" >Bạn muốn đăng xuất?<br/>
<form method="post" action=""> <input type="submit" name="logout" onclick="confirmAction()" value="Đồng ý" /> </form> </div>
</p></p>

<SCRIPT LANGUAGE="JavaScript">
    function confirmAction() {
      return confirm("Xác nhận đăng Xuất?")
    }
</SCRIPT> 




<?php
if (!isset($_SESSION['userindex']))
{
    echo'<h2>có gì đâu mà đxuất</h2>';
}


if (isset($_SESSION['userindex']) && isset($_POST["logout"]))
{
    unset($_SESSION['userindex']); // xóa session login
    echo'<h2>Đăng xuất thành công!</h2>';
}


?>




<?php
include('footer.php');
?>