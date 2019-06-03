<?php
// session_start();
// $name = $_SESSION['name'];

include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/session_call.php";
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/db_connector.php";
include $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/create_table.php";

$email = $_SESSION['email'];
$num = $_GET['num'];
create_table($conn, "message_ripple");

$sql = "select * from message where num = '$num'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

$send_email=$row["send_email"];
$date=$row["regist_day"];
$num=$row["num"];
$message=$row["msg"];


$sql = "update message SET rece_status = 'Y' where num = '$num'";
mysqli_query($conn, $sql);



$sql="select * from member where email='$send_email' and pro_img_copied";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$pro_img_copied=$row["pro_img_copied"];

if($pro_img_copied!=null){
	$pro_img_copied= $row["pro_img_copied"];
}else{
	$pro_img_copied= 'no_profile.png';
}
?>

<!DOCTYPE html>
<html lang="ko" dir="ltr">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="../css/message.css?ver=1">
		<link rel="stylesheet" href="../css/common.css?ver=1">
		<link rel="stylesheet" href="../css/footer.css">
		<link rel="stylesheet" href="../css/footer_2.css">
		<link rel="stylesheet" href="../css/admin.css">
		<title></title>
	</head>
	<body>
		<?php
			include "../lib/header_in_folder.php";
		?>
		<div class="view_boder">
			<div id="head">
				<h1 id="msg_h1">Messages</h1>
				<a href="./message.php">←All message </a>
			</div>
			<div id="write_form">
				<span id="subject_span"><?=$message?></span>
				<div class="write_form_img">
					<a href="../member_profile/profile_view.php?mode=shop&email=<?=$send_email?>"><img src="../data/img/<?=$pro_img_copied?>" class="message_pro"></a>
					<div class="write_form_2">
						<div class="write_form_3">
							<a href="../member_profile/profile_view.php?mode=shop&email=<?=$send_email?>" style="text-decoration:none"><span id="send_span"><?=$send_email?></span></a>
						</div>
						<div class="write_form_4">
							<span id="message_span"><?=$message?></span>
						</div>
						<div class="write_form_5">
							<span id="date_span"><?=$date?></span>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="ripple">
			<div id="ripple2">
				<?php
						$sql="select * from `message_ripple` where parent='$num'";
						$ripple_result = mysqli_query($conn,$sql);
						while($ripple_row=mysqli_fetch_array($ripple_result)){
							$ripple_num=$ripple_row['num'];
							$ripple_email=$ripple_row['email'];
							$ripple_date=$ripple_row['regist_day'];
							$ripple_content=$ripple_row['ripple_content'];
							$ripple_content=str_replace("\n", "<br>", $ripple_content);
							$ripple_content=str_replace(" ", "&nbsp;", $ripple_content);

							$sql="select * from member where email='$ripple_email' and pro_img_copied";
							$result = mysqli_query($conn, $sql);
							$row = mysqli_fetch_array($result);
							$pro_img_copied=$row["pro_img_copied"];

							if($pro_img_copied!=null){
								$pro_img_copied= $row["pro_img_copied"];
							}else{
								$pro_img_copied= 'no_profile.png';
							}
					?>
					<div id="ripple_title">
						<div id="write_form">
							<div class="write_form_img">
								<a href="#"><img src="../data/img/<?=$pro_img_copied?>" class="message_pro"></a>
								<div class="write_form_2">
									<div class="write_form_3">
										<a href="../member_profile/profile_view.php?mode=shop&email=<?=$ripple_email?>" style="text-decoration:none"><span id="send_span"><?=$ripple_email?></span></a>
									</div>
									<div class="write_form_4">
										<span id="message_span"><?=$ripple_content?></span>
									</div>
									<div class="write_form_5">
										<span id="date_span"><?=$ripple_date?></span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php
						}//end of while
					?>
				<form name="ripple_form" action="dml_ripple.php?mode=insert_ripple" method="post" id="ripple_save_form">
					<input type="hidden" name="parent" value="<?=$num?>">
					<div id="ripple_insert">
						<?php
								$sql10="select * from member where email='$member_email'";
								$result10 = mysqli_query($conn, $sql10);
								$row10 = mysqli_fetch_array($result10);
								$pro_img_copied10=$row10['pro_img_copied'];
						 ?>
						<a href="#"><img src="../data/img/<?=$pro_img_copied10?>" class="message_pro"></a>
						<div id="ripple_textarea"><textarea name="ripple_content" rows="3" cols="50"></textarea></div>
						<div class="ripple_button" style="margin-left:315px;"> <button type="submit" name="button" class="ripple_button"> <span id="re_button">reply</span></button> </div>
					</div><!--end of ripple_insert  -->
				</form>
			</div><!--end of ripple2-->
		</div><!--end of ripple-->
	</body>
	<?php include "../lib/footer_in_folder.php"; ?>
</html>
