  

   <script>

   // Get the modal
   var modal1 = document.getElementById("write_discussion_modal");

   // Get the button that opens the modal
   var btn1 = document.getElementById("write_button");

   // Get the <span> element that closes the modal
   var span1 = document.getElementsByClassName("write_discussion_close")[0];

   // When the user clicks the button, open the modal
   function open_modal(){
     modal1.style.display = "block";
   }

   // When the user clicks on <span> (x), close the modal
   span1.onclick = function() {
     modal1.style.display = "none";
   }

   </script>
