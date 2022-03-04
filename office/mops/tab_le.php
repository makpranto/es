<table class="table table-striped table-bordered table-hover dataTables-example" >
    <thead>
        <tr>
            <th>#</th>
            <th>Method Name</th>
            <th>Rate</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $count = 0;
        $get = $db->query("SELECT * FROM `company_mop` WHERE `company_id` = '$company_id'");
        while ($a = mysqli_fetch_array($get)) {
            $count++;
            if ($a['status'] == 1) {
                $st = 'YES';
            }else {
                $st = 'NO';
            }
            $jin = hide('e', $a['id']);
            echo "<tr id='$jin'>\n";
            echo "<td>$count</td> \n";
            echo "<td data-target='name'>".$a['name']."</td> \n";
            echo "<td data-target='rate'>".$a['exchange_rate_to_us']."</td> \n";
            echo "<td data-target='status'>".$st."</td> \n";
            echo "<td><a data-role='update' data-id='$jin'>Edit</a></td> \n";
            echo " </tr>";
        }
        ?>
    </tbody>
    <tfoot>
        <tr>
            <th>#</th>
            <th>Method Name</th>
            <th>Rate</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </tfoot>
</table>
<script>
$(document).ready(function(){
    $('.dataTables-example').DataTable({
        pageLength: 25,
        responsive: true,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [
            { extend: 'copy'},
            {extend: 'csv', title: '<?php echo "$company_name All Methods of Payment as at ". date("d F, Y"); ?>'},
            {extend: 'excel', title: '<?php echo "$company_name All Methods of Payment as at ". date("d F, Y"); ?>'},
            {extend: 'pdf', title: '<?php echo "$company_name All Methods of Payment as at ". date("d F, Y"); ?>'},
            {extend: 'print',
            customize: function (win){
                $(win.document.body).addClass('white-bg');
                $(win.document.body).css('font-size', '10px');
                $(win.document.body).find('table').addClass('compact').css('font-size', 'inherit');
            }
        }
    ]
    });
});
</script>
