<script>
    var jill = $('#<?php echo cleaned($_POST['quantity']); ?>');
    <?php $key = str_shuffle("HOsodfnbnxcuiIUY89ehuiasvUSUasdjhASLJDSBDuhiwqduyVAKSHDUSKHSADVUSVADGUIUsdvkSADIHKHSADVKHVHSUADVHKASDBVKHSVDK").time();
    $kids = str_replace('=', '', hide('e', $key.$key)); ?>
    jill.attr('id', '<?php echo $kids; ?>');
    $('#<?php echo hide('d', cleaned($_POST['quantity'])); ?>').attr('onclick', "return add_to_basket('<?php echo $_POST['product']; ?>', '<?php echo $kids; ?>');");
    $('#<?php echo hide('d', cleaned($_POST['quantity'])); ?>').attr('id', '<?php echo $key.$key; ?>');
</script>
