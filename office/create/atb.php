<table class="table table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Data</th>
            <th>Status</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $count = 0;
        $pro_id = hide('d', $pro_id);
        $basket = r("SELECT * FROM `att` WHERE `pro_id` = '$pro_id'");
        while ($ba = get($basket)) {
            $count++;
            $pid = $ba['id'];
            echo "<tr> \n";
            echo "<td> $count</td> \n";
            echo "<td><b>".$ba['att_name']."</b></td> \n";
            echo "<td>".$ba['att_text']."</td> \n";
            echo "<td>".$ba['status']." </td> \n";
            $line_id = $ba['id'];
            $lmn = hide('e', $line_id);
            echo "<td><a onclick=\"return edit('$lmn')\">Edit <i class='fa fa-edit'></i></a></td> \n";
            echo "<td><a class='text-danger' onclick=\"return del('$lmn')\">Delete <i class='fa fa-trash'></i></a></td></tr> \n";
        }
        ?>
    </tbody>
</table>
