<div id="myModal_1" class="modal">
  <!-- Modal content -->
  <div class="modal-content_1">
    <span class="close_1">&times;</span>
    <form class="" action="../message/check_message.php" method="post">
      <div class="form_div">
        <div id="head">
          <h1 id="title_h1">Send a Private Message</h1>
        </div>
        <div class="email_div">
          <input type="text" id="write_id" value="" name="receive_id" placeholder="Name">
        </div>
        <div class="message_div">
          <textarea rows="8" cols="50" id="write_message" name="message" placeholder="Message"></textarea>
        </div>
        <button type="submit" name="button" id="send_button"><span> Send Message </span></button>
      </div>
    </form>
  </div>
</div>
<script>
  var modal1 = document.getElementById('myModal_1'); // 불러지는 모달 id,변수명
  var btn1 = document.getElementById("myBtn_1"); // 불르는 버튼 id, 변수명
  var span1 = document.getElementsByClassName("close_1")[0]; // 닫기버튼(x) 클래스, 변수명
  btn1.onclick = function() {
    modal1.style.display = "block";
  }

  span1.onclick = function() {
    modal1.style.display = "none";
  }

  window.onclick = function(event) {
    if (event.target == modal1) {
      modal1.style.display = "none";
    }
  }
</script>
