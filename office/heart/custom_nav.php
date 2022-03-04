<?php if ("$project_root_folder/" == url()):?>  <li class="active"><a href="<?php echo "$project_root_folder"; ?>"><i class="fa fa-home"></i> <span class="nav-label">Home</span> </a></li>
<?php else: ?>
<li><a href="<?php echo "$project_root_folder"; ?>"><i class="fa fa-home"></i> <span class="nav-label">Home</span> </a></li>
<?php endif; ?>
<?php
$user_db_access = [
    ['display' => 'Point of Sale', 'folder' => 'pos', 'access' => 'sell', 'icon' => 'fa fa-shopping-cart' ],
    ['display' => 'Create Order', 'folder' => 'order', 'access' => 'start_order', 'icon' => 'fa fa-plus' ],
    ['display' => 'Quotations', 'folder' => 'quotations', 'access' => 'verify_quotations', 'icon' => 'fa fa-file-o' ],
    ['display' => 'Approved Quotations', 'folder' => 'approved', 'access' => 'start_order', 'icon' => 'fa fa-check-circle' ],
    ['display' => 'Purchase Order', 'folder' => 'po', 'access' => 'start_purchase_order', 'icon' => 'fa fa-level-down' ],
    ['display' => 'Grocery Orders', 'folder' => 'orders', 'access' => 'orders', 'icon' => 'fa fa-shopping-cart' ],
    ['display' => 'Restock', 'folder' => 'restock', 'access' => 'receive', 'icon' => 'fa fa-refresh' ],
    ['display' => 'Create Products', 'folder' => 'create', 'access' => 'add_new_stock', 'icon' => 'fa fa-plus' ],
    ['display' => 'Stocklist', 'folder' => 'stocklist', 'access' => 'stock', 'icon' => 'fa fa-list' ],
    ['display' => 'Coupons', 'folder' => 'coupons', 'access' => 'coupons', 'icon' => 'fa fa-money' ],
    ['display' => 'Customers', 'folder' => 'customers', 'access' => 'orders', 'icon' => 'fa fa-users' ],
    ['display' => 'Categories', 'folder' => 'categories', 'access' => 'manage_categories', 'icon' => 'fa fa-edit' ],
    ['display' => 'Brands', 'folder' => 'brands', 'access' => 'brands', 'icon' => 'fa fa-shield'],
    ['display' => 'Stock Take', 'folder' => 'stock', 'access' => 'stock', 'icon' => 'fa fa-check-circle' ],
];
// $menu_display = ['Add Groceries','Orders', 'Stock List', 'Stock List', 'Debtors', 'Categories','Quotations' , 'Stock Taking','Rates', 'Reports'];
// $menu_href = ['add-stock','orders','stocklist','lay-by', 'debtors', 'cat', 'quote', 'Tjhhsd','mops', 'GsbTr'];
// $icons = ['fa fa-plus','fa fa-shopping-cart', 'fa fa-list', 'fa fa-users', 'fa fa-list', 'fa fa-list-ol', 'fa fa-cube', 'fa fa-file-pdf-o', 'fa fa-check', 'fa fa-money', 'fa fa-bar-chart-o'];

foreach ($user_db_access as $key) {
    $check = $key['access'];
    $folder = $key['folder'];
    $icon = $key['icon'];
    $display = $key['display'];
    if (pull($check, 'access_level', "`user_id` = '$user_id'") == 1) {
        if ("$project_root_folder/$folder/" == url()) {
echo "                      <li class='active'><a href='$project_root_folder/$folder/'><i class='$icon'></i> <span class='nav-label'>$display</span></a></li>\n";
        }else {
echo "                      <li><a href='$project_root_folder/$folder/'><i class='$icon'></i> <span class='nav-label'>$display</span></a></li>\n";
        }
    }
}
?>
