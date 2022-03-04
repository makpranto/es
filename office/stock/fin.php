<?php
include '../heart/a.php';
secure('stock');
$to  = 0;
if (mysqli_num_rows(r("SELECT `id` FROM `zvinhu`")) != mysqli_num_rows(r("SELECT `id` FROM `stock_taking` WHERE `status` = 'in_cart'"))) {
    error("Something went wrongs.");
    $er = 20;
}else {
    $to = 2000;
}
?>
<?php if ($to>0):?>
    <script type="text/javascript">
    $('#myModal2').modal('toggle');
    </script>
    <div class="col-lg-8">
        <div class="ibox ">
            <div class="anser">

            </div>
            <div class="modal inmodal" id="myModal2" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content animated flipInY">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title">Confirm Stock Taking</h4>

                        </div>
                        <div class="modal-body">
                            <div class="form-group"> <input type="text" autocomplete='off' placeholder="Name" name="name" class="form-control" /></div>
                            <div class="form-group"> <input type="password" placeholder="Password" name="pas" class="form-control" /></div>
                            <div class="form-group"><button type="button" class="btn btn-sm btn-primary m-t-n-xs" onclick="return withdraw();"><strong>Finish</strong></button></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
endif; ?>
<script>
function withdraw() {
    $('#ibox1').children('.ibox-content').toggleClass('sk-loading');
    $.ajax({
        type: 'POST',
        url: 'done.php',
        data: $('#akunda').serialize(),
        success: function(response) {
            $('#ibox1').children('.ibox-content').toggleClass('sk-loading');
            $('.anser').html(response);
        }
    });
}
</script>
