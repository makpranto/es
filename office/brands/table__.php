<table class="table table-striped table-bordered table-hover dataTables-example" >
    <thead>
        <tr>
            <th>#</th>
            <th>Picture</th>
            <th>Name</th>
            <th>Products</th>
            <th>Status</th>
            <th>Edit</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $count = 0;
        $get = r("SELECT * FROM `brands`");
        while ($a = mysqli_fetch_array($get)) {
            $count++;
            $jin = hide('e', $a['id']);
            $brand = $a['id'];
            echo "<tr id='$jin'>\n";
            echo "<td>$count</td> \n";
            echo "<td class='makpranto' style=\"background-image: url('$main".'img/brands/'.$a['image']."');\"></td> \n";
            echo "<td>".$a['name']."</td> \n";
            $z = get(r("SELECT COUNT(`id`) AS `sa` FROM `zvinhu` WHERE `brand` = '$brand'"));
            echo "<td>".$z['sa']."</td> \n";
            if ($a['status'] == 'ACTIVE') {
                echo "<td>Active</td> \n";
            }else {
                echo "<td>Deactivated</td> \n";
            }
            echo "<td><a data-role='view-brand' data-id='$jin'>Edit</a></td> \n";
            echo "</tr>";
        }
        ?>
    </tbody>
    <tfoot>
        <tr>
            <th>#</th>
            <th>Picture</th>
            <th>Name</th>
            <th>Products</th>
            <th>Status</th>
            <th>Edit</th>
        </tr>
    </tfoot>
</table>
