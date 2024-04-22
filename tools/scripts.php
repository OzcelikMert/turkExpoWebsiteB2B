<!-- Scripts -->





<script src="js/jquery-3.2.1.min.js?v=1"></script>
<script src="styles/bootstrap-4.1.2/popper.js?v=1"></script>
<script src="styles/bootstrap-4.1.2/bootstrap.min.js?v=1"></script>
<!--script src="plugins/easing/easing.js"></script-->
<script src="plugins/parallax-js-master/parallax.min.js?v=1"></script>
<script src="js/custom.js?v=1"></script>
<script src="js/searchbox.js?v=1"></script>
<script>


function SignOut(){

  var message = confirm("<?php echo _exit_confirm;?>");

  if(message == true){

    window.location.href = "?exit=true";
  }
}

</script>
<!-- Sweet Alert -->
<script src="./plugins/SweetAlert/sweetalert2.all.js?v=1"></script>
<script src="./js/ip_address_control.js?v=1"></script>
<script>
$(document).ready(function (){
    setInterval(function() {
        check_Ip_Address("./sameparts/ip_address_control.php");
    }, 300000);
});
</script>
<!-- end Sweet Alert -->
