<footer>
  <div class="container">
    <p>Dobble Copyright &copy; 2015, All Rights Reserved</p>
  </div>
</footer>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.10/angular.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="<?= base_url();?>assets/client/js/bootstrap.js"></script>

<script type="text/javascript">
      var html="";
      // Ajax post
      // $(document).ready(function() {

      getRealtimechat();

      function startChat(){

          setInterval( function() { getRealtimechat(); }, 2000);



      }


      function clearInput(){

             $("#mychat").val("");
      }

      function getRealtimechat(){
      html="";
      jQuery.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>" + "index.php/feed/get_show_all_chat/",
      dataType: 'json',
      // data: {chatboard: userchat},
      success: function(res) {



            console.log("relen"+ res.length);
            console.log(res.pc_id);
            html='';
            for(i=0;i<res.length;i++){
                  console.log(res[i].pc_text_chat);

                //  $("#namechatter").html(res[i].pc_text_chat);
                  $("#idbuble").html("");

                  html+='<div class="pointer">'

                      + '<p  class"badge">'

                      + res[i].users_email

                      + '</p>'

                      + '</div>'

                      + '<div class="btn btn-primary">'

                      + res[i].pc_text_chat

                      + '</div>';


                  // var node = document.createElement("LI");
                  // var textnode = document.createTextNode(res[i].pc_text_chat);
                  // node.appendChild(textnode);
                  // document.getElementById("myList").appendChild(node);


            }


            $("#idbuble").append(html);
      }
     });

        }




        $("#sbt").click(function(event) {
          event.preventDefault();
              var userchat = $("#mychat").val();
              // var password = $("input#pwd").val();
              // alert(userchat);
              jQuery.ajax({
              type: "POST",
              url: "<?php echo base_url(); ?>" + "index.php/feed/post_chat_api/",
              dataType: 'json',
              data: {chatboard: userchat},
              success: function(res) {
              if (res.message==="Chat Terkirim")
              {
                clearInput();
                getRealtimechat();
                //startChat();
                toastr.success('Notification!', res.message);


              }
              else if(userchat===""){

                toastr.error('Notification!', res.message);

              }
          }
          });
        });


      // });





</script>


</body>
</html>
