<table class="table table-striped table-bordered table-hover dataTables-example" >
    <thead>
        <tr>
            <th>#</th>
            <th>Picture</th>
            <th>Name</th>
            <th>Main Category</th>
            <th>Products</th>
            <th>Status</th>
            <th>Edit</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $count = 0;
        $get = r("SELECT * FROM `sub_categories`");
        while ($a = mysqli_fetch_array($get)) {
            $count++;
            $jin = hide('e', $a['id']);
            $main_cat = $a['main_cat'];
            $sub_cat = $a['id'];
            echo "<tr id='$jin'>\n";
            echo "<td>$count</td> \n";
            echo "<td class='makpranto' style=\"background-image: url('$main".'img/subc/'.$a['image']."');\"></td> \n";
            echo "<td>".$a['name']."</td> \n";
            echo "<td>".pull('name', 'categories', "`id` = '$main_cat'")."</td> \n";
            $z = get(r("SELECT COUNT(`id`) AS `sa` FROM `zvinhu` WHERE `sub_cat` = '$sub_cat'"));
            echo "<td>".$z['sa']."</td> \n";
            if ($a['status'] == '1') {
                echo "<td>Active</td> \n";
            }else {
                echo "<td>Deactivated</td> \n";
            }
            echo "<td><a data-role='view-category' data-id='$jin'>Edit</a></td> \n";
            echo "</tr>";
        }
        ?>
    </tbody>
    <tfoot>
        <tr>
            <th>#</th>
            <th>Picture</th>
            <th>Name</th>
            <th>Main Category</th>
            <th>Products</th>
            <th>Status</th>
            <th>Edit</th>
        </tr>
    </tfoot>
</table>
