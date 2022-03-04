<table class="table table-striped table-bordered table-hover dataTables-example" >
    <thead>
        <tr>
            <th>#</th>
            <th>Product Image</th>
            <th>Product Name</th>
            <th>On Hand</th>
            <th>Buying Price</th>
            <th>Selling Price</th>
            <th>Category</th>
            <?php if (access($user_id, 'adjust_static')): ?>
            <th>Action</th>
            <?php endif; ?>
        </tr>
    </thead>
    <tbody>
        <?php
        $count = 0;
        $get = r("SELECT * FROM `zvinhu`");
        while ($a = mysqli_fetch_array($get)) {
            $cat = $a['main_cat'];
            $count++;
            $jin = hide('e', $a['id']);
            echo "<tr id='$jin'>\n";
            echo "<td>$count</td> \n";
            echo "<td class='makpranto' style=\"background-image: url('$main".'i/p/'.$a['image']."');\"></td> \n";
            echo "<td data-target='product_name'>".$a['product_name']."</td> \n";
            echo "<td data-target='on_hand'><center>".$a['on_hand']."</center></td> \n";
            echo "<td data-target='buying_price'><center>$".amount($a['buying_price'])."</center></td> \n";
            echo "<td data-target='selling_price'><center>$".$a['selling_price']."</center></td> \n";
            echo "<td data-target='p_category'><center>".(pull('name', 'categories', "`id` = '$cat'"))."</center></td> \n";
            echo "<td><center><a href='?edit=$jin' target='_blank'>Edit</a></center></td> \n";
            echo " </tr>";
            }
        ?>
    </tbody>
    <tfoot>
        <tr>
            <th>#</th>
            <th>Product Code</th>
            <th>Product Name</th>
            <th>On Hand</th>
            <th>Buying Price</th>
            <th>Selling Price</th>
            <th>Category</th>
            <?php if (access($user_id, 'adjust_static')): ?>
            <th>Action</th>
            <?php endif; ?>
        </tr>
    </tfoot>
</table>
<style media="screen">

</style>
