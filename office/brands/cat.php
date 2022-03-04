<?php
include '../heart/a.php';
secure('brands');
if (!there('id')) {
    error("You cannot be doing that.");
}else {
    $uid = clean(hide('d', $_POST['id']));
    if (empty($uid)) {
        error("You cannot be doing that.");
    }else {
        $as = r("SELECT * FROM `brands` WHERE `id` = '$uid'");
        if (mysqli_num_rows($as)<1) {
            error("Error.");
        }else {
            $a = get($as);
            $ddd = '';
        }
    }
}
if (isset($ddd)): ?>
<div class="modal-dialog">
    <div class="modal-content">
        <div class="ibox" id="ibox2">
            <div class="ibox-content">
                <div class="sk-spinner sk-spinner-wave">
                    <div class="sk-rect1"></div>
                    <div class="sk-rect2"></div>
                    <div class="sk-rect3"></div>
                    <div class="sk-rect4"></div>
                    <div class="sk-rect5"></div>
                </div>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit <span class="text-navy"><?php echo word($a['name']); ?></span> </h4>
                </div>
                <form role="form" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="file" class="form-control" name="file" accept=".jpg, .png, .jpeg"/>
                        </div>
                        <div class="form-group"><input type="text" required placeholder="Sub-category's name" autocomplete='off' value="<?php echo  word($a['name']); ?>" name="brand" class="form-control" /></div>
                    </div>
                    <input type="hidden" name="brand_id" value="<?php echo hide('e', $a['id']); ?>">
                    <div class="modal-footer">
                        <button class="btn btn-sm btn-primary m-t-n-xs" name='edit_brand' type="submit"><strong>Save changes</strong></button>
                        <button class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$('#brander').modal('toggle');
</script>
<?php endif; ?>
