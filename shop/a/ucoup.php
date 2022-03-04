<?php
include 'fun.php';
if (isset($_SESSION[$coupon_session])) {
    unset($_SESSION[$coupon_session]);
}?>
<td class="col-md-4">
    <sss class="form-inline float-right">
        <div class="form-group">
            <input type="text" placeholder="Enter discount code" class="form-control border-form-control form-control-sm" id="coupon">
        </div>
        &nbsp;
        <button class="btn btn-success float-left btn-sm" onclick="return coupon();">Apply</button>
    </sss>
</td>
