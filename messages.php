<?php include('header.php'); ?>

	
<?php

if(!isset($_SESSION['userindex'])){

	//header("location: index.php");
	

}
else

{ ?>
<html>
<head>
	<title>Message</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<style>
#scroll_messages{
	max-height: 500px;
	overflow: scroll;
}
#btn-msg{
	width: 20%;
	height: 28px;
	border-radius: 5px;
	margin: 5px;
	border: none;
	color: #fff;
	float: right;
	background-color: #2ecc71;
}
#select_user{
	max-height: 500px;
	overflow:scroll;
}
#green{
	background-color: #2ecc71;
	border-color: #27ae60;
	width:45%;
	padding:2.5px;
	font-size:16px;
	border-radius:3px;
	float: left;
	margin-bottom: 5px;
}
#blue{
	background-color: #3498db;
	border-color: #2980b9;
	width:45%;
	padding:2.5px;
	font-size:16px;
	border-radius:3px;
	float: right;
	margin-bottom: 5px;
}
</style>
<body>
<div class="row">
<?php
		//getting user to id and user from id for messages
			if(isset($_GET['u_id']))
			{

			global $ketnoi;

			$get_id = $_GET['u_id'];

			$get_user = "select * from users where ID='$get_id'";

			$run_user = mysqli_query($ketnoi,$get_user);

			$row_user=mysqli_fetch_array($run_user);

			$user_to_msg = $row_user['ID'];
			$user_to_name = $row_user['Username'];
			}

			$user = $_SESSION['Email'];
			$get_user = "select * from users where Email='$user'";
			$run_user = mysqli_query($ketnoi,$get_user);
			$row=mysqli_fetch_array($run_user);
			$user_from_msg = $row['ID'];
			$user_from_name = $row['Username'];
		?>
	<div class="col-sm-3" id='select_user'>

		<?php

			$user = "select * from users";
			$run_user = mysqli_query($ketnoi,$user);
			while ($row_user=mysqli_fetch_array($run_user)){
			$user_id = $row_user['ID'];
			$user_name = $row_user['Username'];
			echo'<div class="container-flui">
			<img id="zoom" src="data:image/jpeg;base64,'.base64_encode( $row_user['ImgData'] ).'" width="30px" height="30px" style="border-radius:100px;boder:1px solid #ddd;"/>
			<a href="messages.php?u_id='.$user_id.'"><strong> '.$user_name.'</strong><br><br></a>
			</div>';
			}
		?>
	</div>
	<div class="col-sm-6">
		<div class="load_msg" id="scroll_messages">
			<?php

				$sel_msg = "select * from user_messages where (user_to='$user_to_msg' AND user_from='$user_from_msg') OR (user_from='$user_to_msg' AND user_to='$user_from_msg') ORDER by 1 ASC";
				$run_msg = mysqli_query($ketnoi,$sel_msg);

				while($row_msg=mysqli_fetch_array($run_msg)){

				$user_to = $row_msg['user_to'];
				$user_from = $row_msg['user_from'];
				$msg_body = $row_msg['msg_body'];
				$msg_date = $row_msg['date'];
				?>

				<div id="loaded_msg">
					<p><?php if($user_to == $user_to_msg AND $user_from == $user_from_msg){echo "<div class='message' id='blue' data-toggle='tooltip' title='$msg_date'>$msg_body</div><br><br><br>";} else if($user_from == $user_to_msg AND $user_to==$user_from_msg){echo "<div class='message' id='green' data-toggle='tooltip' title='$msg_date'>$msg_body</div><br><br><br>";}?></p>
				</div>

				<?php
				}


			?>
		</div>
		<?php
			if(isset($_GET['u_id'])){
				$u_id = $_GET['u_id'];
				if($u_id == "new"){
				echo '

				<form>
					<center><h3>Select Someone to start conversation with</h3></center>
					<textarea disabled class="form-control" placeholder="Enter Your Message now" id="message_textarea"></textarea>
					<input class="btn btn-default" disabled type="submit" name="send_msg" id="btn-msg" value="Send">
				</form><br><br>

				';
				}
				else{
				echo'
				<form action="" method="POST">
					<textarea class="form-control" placeholder="Enter Your Message ngay" name="msg_box" id="message_textarea"></textarea>
					<input type="submit" name="send_msg" id="btn-msg" value="Send">
				</form><br><br>
				';
				}
			}
		?>
		<?php
			if(isset($_POST['send_msg'])){
				$msg = htmlentities($_POST['msg_box']);

				if($msg == ""){
					echo"<h4 style='color:red;text-align:center;'>Message was unable to send!</h4>";
				}else if(strlen($msg) > 37){
					echo"<h4 style='color:red;text-align:center;'>Message is Too long! Use only 37 characters</h4>";
				}
				else{
				$insert = "insert into user_messages(user_to,user_from,msg_body,date,msg_seen) values ('$user_to_msg','$user_from_msg','$msg',NOW(),'no')";

				$run_insert = mysqli_query($ketnoi,$insert);

				}
			}
		?>
	</div>
	<div class="col-sm-3">
		
		
		<?php
			if(isset($_GET['u_id']))
			{

			global $ketnoi;

			$get_id = $_GET['u_id'];

			$get_user = "select * from users where ID='$get_id'";
			$run_user = mysqli_query($ketnoi,$get_user);

			$row=mysqli_fetch_array($run_user);

			$user_id = $row['ID'];
			$user_name = $row['Username'];
			

			$user_Email = $row['Email'];
			$user_NgaySinh = $row['NgaySinh'];
			$user_GioiTinh = $row['GioiTinh'];
			
			}

			if($get_id == "new")
			{

			}
			else

			{

			echo '
			<div class="row">
					<div class="col-sm-2">
					</div>
					<center>
					<div style="background-color: #e6e6e6;" class="col-sm-9">
					<h2>Thông tin cá nhân </h2>
					<img id="zoom" src="data:image/jpeg;base64,'.base64_encode( $row['ImgData'] ).'"width="150" height="150"/>
					<br><br>
					<ul class="list-group">
					  <li class="list-group-item" title="Username"><strong>'.$user_name.'</strong></li>
					  <li class="list-group-item" title="User Status"><strong style="color:grey;">'.$user_Email.'</strong></li>
					  <li class="list-group-item" title="Gender">'.$user_NgaySinh.'</li>
					  <li class="list-group-item" title="Country">'.$user_GioiTinh.'</li>
					</ul>
					</div>
					<div class="col-sm-1">
					</div>
				</div>
				';
			}
		?>
	</div>
</div>




<script>
	var div = document.getElementById("scroll_messages");
	div.scrollTop = div.scrollHeight;
</script>
</body>
</html>
<?php } ?>

<!-- <span class='badge badge-secondary'> $count_msg</span> -->
