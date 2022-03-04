

<?php if (count($errors)>0): ?>
    <?php foreach ($errors as $error): ?>
        <script type="text/javascript">


       $(document).ready(function() {



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
            toastr.error(<?php echo "'$error'"; ?>);

        }, 1300);
       });
        </script>
    <?php endforeach; ?>
<?php endif; ?>



<?php if (count($success)>0): ?>
    <?php foreach ($success as $succ): ?>
        <script type="text/javascript">


       $(document).ready(function() {



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
            toastr.success(<?php echo "'$succ'"; ?>);

        }, 1300);
       });
        </script>
    <?php endforeach; ?>
<?php endif; ?>
