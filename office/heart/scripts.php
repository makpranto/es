
<script src="<?php echo "$project_root_folder"; ?>/js/jquery-3.1.1.min.js"></script>
<script src="<?php echo "$project_root_folder"; ?>/js/bootstrap.min.js"></script>
<script src="<?php echo "$project_root_folder"; ?>/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="<?php echo "$project_root_folder"; ?>/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?php echo "$project_root_folder"; ?>/js/plugins/flot/jquery.flot.js"></script>
<script src="<?php echo "$project_root_folder"; ?>/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
<script src="<?php echo "$project_root_folder"; ?>/js/plugins/flot/jquery.flot.spline.js"></script>
<script src="<?php echo "$project_root_folder"; ?>/js/plugins/flot/jquery.flot.resize.js"></script>
<script src="<?php echo "$project_root_folder"; ?>/js/plugins/flot/jquery.flot.pie.js"></script>
<script src="<?php echo "$project_root_folder"; ?>/js/plugins/peity/jquery.peity.min.js"></script>
<script src="<?php echo "$project_root_folder"; ?>/js/demo/peity-demo.js"></script>
<script src="<?php echo "$project_root_folder"; ?>/js/inspinia.js"></script>
<script src="<?php echo "$project_root_folder"; ?>/js/plugins/pace/pace.min.js"></script>
<script src="<?php echo "$project_root_folder"; ?>/js/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="<?php echo "$project_root_folder"; ?>/js/plugins/gritter/jquery.gritter.min.js"></script>
<script src="<?php echo "$project_root_folder"; ?>/js/plugins/sparkline/jquery.sparkline.min.js"></script>
<script src="<?php echo "$project_root_folder"; ?>/js/demo/sparkline-demo.js"></script>
<script src="<?php echo "$project_root_folder"; ?>/js/plugins/chartJs/Chart.min.js"></script>
<script src="<?php echo "$project_root_folder"; ?>/js/plugins/toastr/toastr.min.js"></script>
<script>
function change_currency(){
    $.ajax({
        type: 'POST',
        url: "<?php echo "$project_root_folder/".'free'; ?>",
        success: function(data) {
            $('#cc').html(data);
        }
    });
    return false;
}
</script>
<script>
// if ( window.history.replaceState ) {
//   window.history.replaceState( null, null, window.location.href );
// }
</script>
<?php
if (isset($_SESSION['error'])){
    error($_SESSION['error']);
    unset($_SESSION['error']);
}
if (isset($_SESSION['success'])){
    success($_SESSION['success']);
    unset($_SESSION['success']);
}
?>
