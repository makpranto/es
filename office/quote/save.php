<?php
include '../heart/heart.php';
include '../heart/func.php';
include '../heart/dsfhiusdfhui.php';
 ?>
 <?php if (access($user_id, 'quotation')): ?>
     <script type="text/javascript">
        setTimeout(function() {
            toastr.options = {
                "closeButton": true,
                "debug": true,
                "progressBar": true,
                "preventDuplicates": false,
                "positionClass": "toast-top-center",
                "onclick": null,
                "showDuration": "4000",
                "hideDuration": "1000",
                "timeOut": "12000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };
            <?php
                if (!isset($_POST['client_name']) || !isset($_POST['physical_address']) || !isset($_POST['phone']) || !isset($_POST['email_address']) || !isset($_POST['agent_name'])) {
                   echo "toastr.error('Bad practice detected.');";
                   $filo = 20;
               }elseif (mysqli_num_rows($db->query("SELECT `id` FROM `basket` WHERE `user_id` = '$user_id' AND `type` = 'quote'")) == 0) {
                   echo "toastr.error('Dear $user_name, you curremtly have an empty basket.');";
                   $filo = 20;
                }else {
                   $client_name = clean($_POST['client_name']);
                   $physical_address = clean($_POST['physical_address']);
                   $phone = clean($_POST['phone']);
                   $phone = str_replace(' ', '', $phone);
                   $email_address = clean($_POST['email_address']);
                   $agent_name = clean($_POST['agent_name']);
                   if (mysqli_num_rows($db->query("SELECT `id` FROM `customers` WHERE `customer_name` = '$client_name' AND `company_id` = '$company_id'"))> 0) {
                       $dcx = $db->query("SELECT `id` FROM `customers` WHERE `customer_name` = '$client_name' AND `company_id` = '$company_id'");
                       $dtr = mysqli_fetch_array($dcx);
                       $_SESSION['tysla_retail customer SESSIONS name'] = $dtr['id'];
                       $fg = $_SESSION['tysla_retail customer SESSIONS name'];
                       $dpo = 20;
                   }elseif (strlen($client_name)< 3) {
                       echo "toastr.error('Please submit a valid customer\'s name.');";
                   }elseif (empty($physical_address) || strlen($physical_address)<3) {
                       echo "toastr.error('Please submit $client_name\'s physical address.');";
                   }elseif (!preg_match("/^[\+]?[0-9]{5,13}$/", $phone)) {
                       echo "toastr.error('Please submit a valid phone number.');";
                   }elseif (!empty($email_address) && !valid_email($email_address)) {
                       echo "toastr.error('Please submit a valid email address.');";
                   }elseif (!empty($agent_name) AND mysqli_num_rows($db->query("SELECT `id` FROM `agents` WHERE (`agent_name`= '$agent_name' OR `agent_surname`= '$agent_name' || `agent_username`= '$agent_name') AND `company_id` = '$company_id'")) == 0) {
                       echo "toastr.error('$agent_name was not found.');";
                   }elseif (!empty($agent_name) AND mysqli_num_rows($db->query("SELECT `id` FROM `agents` WHERE (`agent_name`= '$agent_name' OR `agent_surname`= '$agent_name' || `agent_username`= '$agent_name') AND `company_id` = '$company_id'")) > 1) {
                       echo "toastr.error('There are more than one agents named $agent_name.');";
                   }elseif (!empty($agent_name) AND mysqli_num_rows($db->query("SELECT `id` FROM `agents` WHERE (`agent_name`= '$agent_name' OR `agent_surname`= '$agent_name' || `agent_username`= '$agent_name') AND `company_id` = '$company_id'")) == 1 &&
                                                   mysqli_num_rows($db->query("SELECT `id` FROM `agents` WHERE (`agent_name`= '$agent_name' OR `agent_surname`= '$agent_name' || `agent_username`= '$agent_name') AND `status`=0 AND `company_id` = '$company_id'")) == 1
                           ) {
                       echo "toastr.error('$agent_name is not activated.');";
                   } else {
           $rgh = date('Y-m-d H:i:s');
           $d = $db->query("SELECT `id` FROM `agents` WHERE `agent_name`= '$agent_name' OR `agent_surname`= '$agent_name' || `agent_username`= '$agent_name' AND `status`= 1 AND `company_id` = '$company_id' ORDER BY `id` DESC LIMIT 1");
           $dml = mysqli_fetch_array($d);
           $agent_ = $dml['id'];
           $db->query("INSERT INTO `customers`(`kind`,`agent`,`company_id`,`customer_name`, `physical_address`, `phone`, `email_address`, `last_active_on`, `added_by`, `added_on`, `sub`)
                       VALUES ('quote','$agent_','$company_id','$client_name','$physical_address','$phone','$email_address','$rgh', '$user_id', '$rgh', 1)");
           $dcx = $db->query("SELECT `id` FROM `customers` WHERE `added_by`= '$user_id' ORDER BY `id` DESC LIMIT 1");
           $dtr = mysqli_fetch_array($dcx);
           $_SESSION['tysla_retail customer SESSIONS name'] = $dtr['id'];
           $fg = $_SESSION['tysla_retail customer SESSIONS name'];
           $dpo = 20;
       }
   }
   ?>
   }, 0);
   </script>
    <?php else: ?>
        <div class="text-center">
            <a class="btn btn-primary" onclick="return invoice();">Print Quotation</a>
        </div>



<?php endif; ?>
<?php if (isset($dpo) && $dpo == 20): ?>
    <div class="text-center">
        <a  class="btn btn-primary" onclick="return invoice();">Print Quotation</a>
    </div>
<?php endif; ?>
