<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Insert title here</title>
<link rel="stylesheet" href="../css/message.css?ver=1">
</head>
<body>
  <form class="" action="./check_message.php" method="post">
    <div class="form_div">
      <div id="head">
        <h1 id="title_h1">Send a Private Message</h1>
      </div>
      <div class="email_div">
       <input type="text" id="write_id" value="" name="receive_id" placeholder="Name">
      </div>
      <div class="message_div">
        <textarea rows="8" cols="60" id="write_message"  name="message" placeholder="Message"></textarea>
      </div>
      <button type="submit" name="button" id="send_button"><span> Send Message </span></button>
    </div>
  </form>
</body>
</html>
