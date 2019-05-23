<link rel="stylesheet" href="../css/common.css?ver=1">
<link rel="stylesheet" href="../css/footer.css">
<link rel="stylesheet" href="../css/footer_2.css">
<link rel="stylesheet" href="../css/admin.css">
<link rel="stylesheet" href="../css/admin_freegoods.css">

<div class="gesipan_div">
<?php
for($i=0;$i<3;$i++){
  echo "<div class='img_div'>
    <figure class='snip1368'>
      <a href='#'>
        <img id='main_img' src='../img/openmarket.png' alt='sample30' />
      </a>
      <div class='hover_img'>
        <img src='../img/logo.png' alt='' style='width:25px; height:25px;'><!--가져다 댔을때-->
      </div>
      <div class='list_title_div'>
        <div class=''>
          <a href='#' class=''>
            <span class='list_title_div_span_bold'>게시물번호(순서)</span>
            <span class='list_title_div_span_bold'>게시물이름</span>
          </a>
          <a href='#' class='list_title_div_a_float_right'>
            M&nbsp; 5,000(가격)
          </a>
        </div>
        <div class=''>
            by&nbsp;<a href='#' class=''>shwanycom@gmail.com</a>
            in&nbsp;<a href='#' class=''>게시물 대분류</a>
        </div>
      </div>
      <figcaption>
        <div class='icons'>
          <a href='#'><img src='../img/logo.png' alt='' style='width:50px; height:20px;' class='checkimg'></a><span>Like</span> <br>
          <a href='#'><img src='../img/logo.png' alt='' style='width:50px; height:20px;' class='checkimg'></a><span>Save</span>
        </div>
      </figcaption>
    </figure>
  </div>";
}

?>
</div>
