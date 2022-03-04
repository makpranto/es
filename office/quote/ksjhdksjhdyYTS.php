<?php if (cleared($company_id, 'save_client_details') && access($user_id, 'save_client_details')): ?>
    <div class="form-group"><input type="text" placeholder="Client's Name" name="client_name"  class="customer form-control" class="form-control"></div>
    <div class="form-group"><input type="text" placeholder="Physical Address"  name="physical_address" class="form-control"></div>
    <div class="form-group"><input type="text" placeholder="Phone Number" name="phone" class="form-control"></div>
    <div class="form-group"><input type="email" placeholder="Email Address" name="email_address" class="form-control"></div>
<?php if (cleared($company_id, 'have_agents')): ?>
    <div class="form-group"><input type="text" placeholder="Agent Name" name="agent_name" class="form-control"></div>
    <div class="col-md-5">
        <a onclick="return save();" class="btn btn-primary">Save</a>
    </div>
    <div class="col-md-5">
        <span id="rel"></span>
    </div>
<?php endif; ?>
<?php else: ?>
    <div class="col-md-5">
        <a onclick="return save();" class="btn btn-primary">Save</a>
    </div>
    <div class="col-md-5">
        <span id="rel"></span>
    </div>
<?php endif; ?>

<script type="text/javascript">
function save(){
    $.ajax({
    type: 'POST',
    url: 'save.php',
    data: $('#frmBox').serialize(),
    success:function(response){
        $('#rel').html(response);
    }
});
return false;
}

</script>
