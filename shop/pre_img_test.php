<html lang="ko" dir="ltr">


<head>
  <meta charset="utf-8">
  <title></title>
  <script src="jquery-3.4.0.min.js"></script>
</head>
<body>


  <script>
  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function (e) {
        $('#blah').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]);
    }
  }

  $("#imgInp").change(function(){
    readURL(this);
  });
  </script>
  <form id="form1" runat="server">
        <input type='file' id="imgInp" />
        <img id="blah" src="#" alt="your image" />
    </form>
</body>
</html>
