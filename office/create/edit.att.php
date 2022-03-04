<?php
include '../heart/a.php';
$att_id = '';
secure('add_new_stock');
if (!there('s')) {
    error("Bad practice has been detected.");
}else {
    $att_id = clean(hide('d', $_POST['s']));
    $rf = r("SELECT `id` FROM `att` WHERE `id` = '$att_id'");
    if (mysqli_num_rows($rf) == 1) {
        $bhj = 20;
        $a = get($rf);
    }else {
        error("Bad practice has been detected.");
    }
}
?>
<?php if (isset($bhj)): ?>
    <script>
    $('#edit_attribute_modal').modal('toggle');
    function ed_att(s){
        $('#edit_att').children('.ibox-content').toggleClass('sk-loading');
        var att_name = document.getElementById('att_names').value;
        var attribute = document.getElementById('attributes').value;
        $.ajax({
            url: 'ed.att.php',
            method: 'post',
            data:{s:s, att_name:att_name, attribute:attribute},
            success:function(response){
                $('#edit_att').children('.ibox-content').toggleClass('sk-loading');
                $('#success').html(response);
            }
        });
    };
    </script>
    <?php $a = get(r("SELECT * FROM `att` WHERE `id` = '$att_id'")); ?>
    <div class="col-lg-8">
        <div class="modal inmodal" id="edit_attribute_modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="ibox" id="edit_att">
                            <div class="ibox-content">
                                <div class="sk-spinner sk-spinner-wave">
                                    <div class="sk-rect1"></div>
                                    <div class="sk-rect2"></div>
                                    <div class="sk-rect3"></div>
                                    <div class="sk-rect4"></div>
                                    <div class="sk-rect5"></div>
                                </div>
                                <form role="form" id="nijh" method="post" onsubmit="return ed_att('<?php echo hide('e', $a['id']); ?>');">
                                    <div class="form-group">
                                        <input type="text" name="att_name" id="att_names" value="<?php echo $a['att_name']; ?>" class="form-control" placeholder="Attribute name">
                                    </div>
                                    <div class="form-group">
                                        <textarea type="text" name="attribute" id="attributes" class="form-control" placeholder="Description"><?php echo $a['att_text']; ?></textarea>
                                    </div>
                                    <span class="ladda-button ladda-button-demo btn btn-primary" onclick="return ed_att('<?php echo hide('e', $a['id']); ?>');"  data-style="expand-right">Submit</span>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
