<!-- Scripts -->



<script type="text/javascript" src="/admin/assets/vendors/jquery/jquery-3.2.1.min.js"></script>

<script type="text/javascript" src="/admin/assets/vendors/js/vendor.bundle.base.js"></script>

<script type="text/javascript" src="/admin/assets/js/shared/off-canvas.js"></script>

<script type="text/javascript" src="/admin/assets/js/shared/misc.js"></script>

<script type="text/javascript" src="/admin/assets/js/main-custom.js"></script>

<!-- Sweet Alert -->
<script src="../plugins/SweetAlert/sweetalert2.all.js"></script>
<script src="../js/ip_address_control.js"></script>
<script>
$(document).ready(function (){
    setInterval(function() {
        check_Ip_Address("../sameparts/ip_address_control.php");
    }, 300000);
});
</script>
<!-- end Sweet Alert -->

