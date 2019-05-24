<?php
// session_start();
// $id = $_SESSION['id'];
// $name = $_SESSION['name'];

include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/session_call.php";
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/db_connector.php";
include $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/create_table.php";

$rece_no = $_GET['rece_no'];
// 고유 num 있으면 해당 넘을 가지고 yn 결정하고 삭제하고 할수 있으야?
$sql = "select * from message where rece_no = '$rece_no'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

$send_no=$row["send_no"];
$date=$row["regist_day"];

$message=$row["msg"];



$sql = "update message SET rece_status = 'Y' where rece_no = '$rece_no'";
mysqli_query($conn, $sql);

?>


<link rel="stylesheet" href="../css/message.css?ver=1">
<link rel="stylesheet" href="../css/common.css?ver=1">
<link rel="stylesheet" href="../css/footer.css">
<link rel="stylesheet" href="../css/footer_2.css">
<link rel="stylesheet" href="../css/admin.css">

<style media="screen">



</style>


<body>
	<?php
  include "../lib/header.php";
	 ?>
	<div class="view_boder">

  <div id="head">

    <h1 id="msg_h1">Messages</h1>

    <a href="./message.php">←All message  </a>
  </div>

  <div id="write_form">
		<span id="subject_span"><?=$message?></span>

  <div class="write_form_2">
    <div class="write_form_3">
			<a href="#" style="text-decoration:none"><span id="send_span"><?=$send_no?></span></a>
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


<div id="ripple">
	<div id="ripple2">
		<?php
			$sql="select * from `ripple` where parent='$rece_no'";
			$ripple_result = mysqli_query($conn,$sql);
			while($ripple_row=mysqli_fetch_array($ripple_result)){
				$ripple_num=$ripple_row['num'];
				$ripple_date=$ripple_row['regist_day'];
				$ripple_content=$ripple_row['content'];
				$ripple_content=str_replace("\n", "<br>", $ripple_content);
				$ripple_content=str_replace(" ", "&nbsp;", $ripple_content);
		?>
			<div id="ripple_title">
				<ul>
					<li><?=$ripple_nick."&nbsp;&nbsp;".$ripple_date?></li>
					<li id="mdi_del">
					<?php
					$message = free_ripple_delete($ripple_id,$ripple_num,'dml_board.php',$page,$hit,$q_num);
					echo $message;
					?>
					</li>
				</ul>
			</div>
			<div id="ripple_content">
				<?=$ripple_content?>
			</div>
		<?php
			}//end of while
				mysqli_close($conn);
		?>

		<form name="ripple_form" action="dml_board.php?mode=insert_ripple" method="post">
			<input type="hidden" name="parent" value="<?=$q_num?>">
			<input type="hidden" name="hit" value="<?=$hit?>">
			<input type="hidden" name="page" value="<?=$page?>">
			<div id="ripple_insert">
			<div id="ripple_textarea"><textarea name="ripple_content" rows="3" cols="80"></textarea></div>
			<div id="ripple_button"> <button type="submit" name="button"> <span id="re_button">reply</span></button> </div>
			</div><!--end of ripple_insert  -->
		</form>
	</div><!--end of ripple2-->
</div><!--end of ripple-->


</body>
<?php
  include "../lib/footer.php";

 ?>
