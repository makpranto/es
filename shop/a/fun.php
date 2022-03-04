<?php
include 'meta.php';
class Database{
    private static $instance;
    public static function getInstance(){
        global $dbuser, $dbpass, $dbname;
        if (self::$instance == null) {
            self::$instance = mysqli_connect('localhost', $dbuser, $dbpass, $dbname);
        }
        return self::$instance;
    }
}
$db = Database::getInstance();
session_start();
function total_cart(){
    global $user_id, $items;
    $total_cart = 0;
    $ge = r("SELECT * FROM `basket` WHERE `user_id` = '$user_id' AND `status` = 'order'");
    if (mysqli_num_rows($ge)> 0) {
        while ($z = get($ge)) {
            $p = $z['product_id'];
            $items = $items + $z['qty'];
            $total_cart = $total_cart + amount(pull('selling_price', 'zvinhu', "`id` = '$p'")*($z['qty']));
        }
    }
    return amount($total_cart);
}
function featured_cat(){
    include 'feat.php.php';
}
global $_COOKIE, $user_id;
if (!isset($_COOKIE[$kook])) {
    $name = hide('e', getToken(25).time());
    $surname = hide('e', getToken(25).time());
    r("INSERT INTO `customers`( `name`, `surname`) VALUES ('$name','$surname' )");
    $user_id = pull('id', 'customers', "`name` = '$name' AND `surname` = '$surname'");
    setcookie($kook, hide('e', hide('e', hide('e', hide('e', $user_id)))), time()+60*24*60*60, '/');
    $_COOKIE[$kook] = hide('e', hide('e', hide('e', hide('e', $user_id))));
    $d = url();
}else{
    $user_id = hide('d', hide('d', hide('d', hide('d', $_COOKIE[$kook]))));
    // echo "$user_id";
    $d = get(r("SELECT * FROM `customers` WHERE `id` = '$user_id'"));
    if (mysqli_num_rows(r("SELECT * FROM `customers` WHERE `id` = '$user_id'")) == 1) {
        $user_name = hide('d', $d['name']);
        $user_surname = hide('d', $d['surname']);
        $email = hide('d', $d['email_address']);
        $phone = hide('d', $d['phone']);
        if (empty($phone)) {
            $user_name = substr($user_name, 0, 10);
            $user_surname = substr($user_surname, 0, 10);
        }
    }else {
        $name = hide('e', getToken(25).time());
        $surname = hide('e', getToken(25).time());
        r("INSERT INTO `customers`( `name`, `surname`) VALUES ('$name','$surname' )");
        $user_id = pull('id', 'customers', "`name` = '$name' AND `surname` = '$surname'");
        setcookie($kook, hide('e', hide('e', hide('e', hide('e', $user_id)))), time()+60*24*60*60, '/');
        $_COOKIE[$kook] = hide('e', hide('e', hide('e', hide('e', $user_id))));
    	$d = url();
    }
}

function cleaned($string){
    global $db;
    $name = trim($string);
    $name = $db->real_escape_string(htmlentities($string));
    $name = trim($name);
    return $name;
}
function pname($str){
    $str = word($str);
    $ac = [
        'gb'
    ];
    foreach ($ac as $a) {
        $str = str_replace($a, mb_strtoupper($a), $str);
    }
    $rf = [
        ['one' => '1l', 'two' => '1L'],
        ['one' => '2l', 'two' => '2L'],
        ['one' => '5l', 'two' => '5L'],
        ['one' => ' N ', 'two' => " 'n' "],
        ['one' => 'Iphone', 'two' => "iPhone"],
        ['one' => 'Itel', 'two' => "iTel"],
        ['one' => 'Xr', 'two' => "XR"],
        ['one' => 'Jbl', 'two' => "JBL"],
        ['one' => ' 5g ', 'two' => " 5G "],
    ];
    foreach ($rf as $a) {
        $str = str_replace($a['one'], ($a['two']), $str);
    }
    return $str;
}

function insertPaginations($url, $cur_page, $number_of_pages, $prev_next=false) {
   $ends_count = 1;
   $middle_count = 2;
   $dots = false;
   ?>
   <nav aria-label="Page navigation example">
       <ul class="pagination pagination-circle pg-amber justify-content-center">
   <?php
   if (!$prev_next && $cur_page && 1 < $cur_page) {  //print previous button?
		?><li class="page-item" href='<?php echo "$url"; ?>&page=<?php echo $cur_page-1; ?>'>
		<a class="page-link" aria-label="Next">
		<span aria-hidden="true">&laquo;</span>
		<span class="sr-only">Previous</span>
		</a>
		</li>
		<?php
   }
   for ($i = 1; $i <= $number_of_pages; $i++) {
		if ($i == $cur_page) {
			 ?><li class="page-item active"><a class="page-link" href='<?php echo "$url"; ?>&page=<?php echo $cur_page; ?>'><?php echo $cur_page; ?></a></li><?php
			 $dots = true;
		} else {
			 if ($i <= $ends_count || ($cur_page && $i >= $cur_page - $middle_count && $i <= $cur_page + $middle_count) || $i > $number_of_pages - $ends_count) {
				  ?>
				  <li class="page-item"><a class="page-link" href='<?php echo "$url"; ?>&page=<?php echo $i; ?>'><?php echo "$i"; ?></a></li>
				  <?php
				  $dots = true;
			 } elseif ($dots) {
				  ?><li><a>…</a></li><?php
				  $dots = false;
			 }
		}
   }
   if (!$prev_next && $cur_page && ($cur_page < $number_of_pages || -1 == $number_of_pages)) {
		?>
		<li class="page-item" href='<?php echo "$url"; ?>&page=<?php echo $cur_page+1; ?>'>
		<a class="page-link" aria-label="Next">
		<span aria-hidden="true">&raquo;</span>
		<span class="sr-only">Next</span>
		</a>
		</li>
		<?php
   }
   ?>
   	</ul>
</nav>
   <?php
}

function show_grocery_item($id){
    global $home;
    $key = str_shuffle("HOsodfnbnxcuiIUY89ehuiasvUSUasdjhASLJDSBDuhiwqduyVAKSHDUSKHSADVUSVADGUIUsdvkSADIHKHSADVKHVHSUADVHKASDBVKHSVDK").time();
    $kids = hide('e', $key.$key);
    $product_name = pname(pull('product_name', 'zvinhu', "`id` = '$id'"));
    $df =  "<div class='item' title='$product_name'>
    <div class='product'>
    <div class='product-header'>";
    if (new_product($id)){
        $df .= "<span class='badge badge-success'>New</span>";
    }
    $img = $home.'i/p/'.pull('image', 'zvinhu', "`id` = '$id'");
    $price = mari(pull('selling_price', 'zvinhu', "`id` = '$id'"));
    $link = $home.'product/'.linker('o', $product_name);
    $df .= "<a class='pointer' onclick=\"window.location.href='$link/'\"> <img class='img-fluid' src='$img' alt='$product_name image'></a>";
    $df .= "</div>
    <div class='product-body'>
        <h5><a class='pointer' onclick=\"window.location.href='$link/'\">$product_name</a></h5>
        <h6><strong><span class='mdi mdi-tag-outline'></span>$$price</strong></h6>
    </div>
    <div class='product-footer'>

    <div class='input-group'>
    <div class='quantity'>
    <button class='minus-btn btns' value='-' type='button' name='button'>-
    </button>
        <input type='text' id='".str_replace('=', '', hide('e', $key))."'  min='1' value='1'  name='quantity'>
        <button class='plus-btn btns' value='-' type='button' name='button'>
        +
        </button>
        </div>
        <button type='button' title='Add to your Cart' id='$key' class='btns btn-secondary btn-sm' onclick='return add_to_basket(\"".hide('e',hide('e',  $id))."\", \"".str_replace('=', '', hide('e', $key))."\")'><i class='mdi mdi-cart-outline'></i>Add To Cart</button>
    </div>
</div>
</div>
</div>";
echo "$df";
}

function grocery_item($id){
    global $home;
    $key = str_shuffle("HOsodfnbnxcuiIUY89ehuiasvUSUasdjhASLJDSBDuhiwqduyVAKSHDUSKHSADVUSVADGUIUsdvkSADIHKHSADVKHVHSUADVHKASDBVKHSVDK").time();
    $kids = hide('e', $key.$key);
    $df =  "<div class='item'>
    <div class='product'>
    <div class='product-header'>";
    if (new_product($id)){
        $df .= "<span class='badge badge-success'>New</span>";
    }
    $img = $home.'i/p/'.pull('image', 'zvinhu', "`id` = '$id'");
    $product_name = word(pull('product_name', 'zvinhu', "`id` = '$id'"));
    $price = mari(pull('selling_price', 'zvinhu', "`id` = '$id'"));
    $link = $home.'product/'.linker('o', $product_name);
    $product_name = pname($product_name);
    $df .= "<a class='pointer' onclick=\"window.location.href='$link/'\"> <img class='img-fluid' src='$img' alt='$product_name image'></a>";
    $df .= "</div>
    <div class='product-body'>
        <h5><a class='pointer' onclick=\"window.location.href='$link/'\">$product_name</a></h5>
        <h6><strong><span class='mdi mdi-tag-outline'></span>$$price</strong></h6>
    </div>
    <div class='product-footer'>
    <div class='input-group'>
    <div class='quantity'>
    <button class='minus-btn btns' value='-' type='button' name='button'>-
    </button>
        <input type='text' id='".str_replace('=', '', hide('e', $key))."'  min='1' value='1'  name='quantity'>
        <button class='plus-btn btns' value='-' type='button' name='button'>
        +
        </button>
        </div>
        <button type='button' title='Add to your Cart' id='$key' class='btns btn-secondary btn-sm' onclick='return add_to_basket(\"".hide('e',hide('e',  $id))."\", \"".str_replace('=', '', hide('e', $key))."\")'><i class='mdi mdi-cart-outline'></i>Add To Cart</button>

    </div>
</div>
</div>
</div>";
return "$df";
}
function linker($s, $t){
    if ($s == 'l') {
        $rf = array(
            '!' => '%21',    '"' => '%22',
            '#' => '%23',    '$' => '%24',    '%' => '%25',
            '&' => '%26',    '\'' => '%27',   '(' => '%28',
            ')' => '%29',    '*' => '%2A',    '+' => '%2B',
            ',' => '%2C',    '-' => '%2D',    '.' => '%2E',
            '/' => '%2F',    ':' => '%3A',    ';' => '%3B',
            '<' => '%3C',    '=' => '%3D',    '>' => '%3E',
            '?' => '%3F',    '@' => '%40',    '[' => '%5B',
            '\\' => '%5C',   ']' => '%5D',    '^' => '%5E',
            '_' => '%5F',    '`' => '%60',    '{' => '%7B',
            '|' => '%7C',    '}' => '%7D',    '~' => '%7E',
            ',' => '%E2%80%9A'
        );
        foreach ($rf as $k => $v) {
            $t = str_replace($v, $k, $t);
        }
        return mb_strtolower($t);
    }

    $rf = array(
        '!' => '%21',    '"' => '%22',
        '#' => '%23',    '$' => '%24',    '%' => '%25',
        '&' => '%26',    '\'' => '%27',   '(' => '%28',
        ')' => '%29',    '*' => '%2A',    '+' => '%2B',
        ',' => '%2C',    '-' => '%2D',    '.' => '%2E',
        '/' => '%2F',    ':' => '%3A',    ';' => '%3B',
        '<' => '%3C',    '=' => '%3D',    '>' => '%3E',
        '?' => '%3F',    '@' => '%40',    '[' => '%5B',
        '\\' => '%5C',   ']' => '%5D',    '^' => '%5E',
        '_' => '%5F',    '`' => '%60',    '{' => '%7B',
        '|' => '%7C',    '}' => '%7D',    '~' => '%7E',
        ',' => '%E2%80%9A',  ' ' => '-'
    );

    foreach ($rf as $k => $v) {
        if ($s == 'o') {
            $t = str_replace($k, $v, $t);
        }else {
            $t = str_replace($v, $k, $t);
        }
    }
    return mb_strtolower($t);
}
function crs($min, $max){
    $range = $max - $min;
    if ($range < 1) return $min;
    $log = ceil(log($range, 2));
    $bytes = (int) ($log / 8) + 1;
    $bits = (int) $log + 1;
    $filter = (int) (1 << $bits) - 1;
    do {
        $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
        $rnd = $rnd & $filter;
    } while ($rnd > $range);
    return $min + $rnd;
}

function getToken($length){
    $token = "";
    $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
    $codeAlphabet.= "0123456789";
    $max = strlen($codeAlphabet);
    for ($i=0; $i < $length; $i++) {
        $token .= $codeAlphabet[crs(0, $max-1)];
    }
    return $token;
}
$last_week = date('Y-m-d 00:00:00', strtotime('-7 days'));

function zim($p){
    if ($p[0] != 7 || $p[2] == 0 || strlen($p) != 9 || ($p[1] != 1 && $p[1] != 3 && $p[1] != 7 && $p[1] != 8)) {
        return false;
    }else {
        return true;
    }
}


function isolate($string, $start, $end){
    $string = ' '. $string;
    $ini =strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    $den =substr($string, $ini, $len);
    return substr($den, 0, $len);
}
function nav(){
    global $home, $logo;
    include 'menu.php';

}
function strong($pass){
    if(!preg_match("^(?=.*?[A-Z])(?=.*?[0-9])(?=.*?[a-z]).{6,}^", $pass)){
        return false;
    }else {
        return true;
    }
}

function cleared($company_id, $page){
    global $db;
    $get_access_levels = r("SELECT `$page` FROM `company_access` WHERE `company_id` = '$company_id' and `$page` = 1");
    if (mysqli_num_rows($get_access_levels)==1) {
        return true;
    }else {
        return false;
    }
}

function ls($amo){
    if (preg_match('/^[a-zA-Z\s]+$/', $amo)) {
        return true;
    }else {
        return false;
    }
}
function now(){
    return date("Y-m-d H:i:s");
}


function similar_products($id){
    global $pid, $home, $sid;
    $as = r("SELECT * FROM `zvinhu` WHERE `status` = '1' AND `main_cat` = '$pid' AND `id` != '$sid' ORDER BY RAND() LIMIT 10");
    include 'simila.php';
}
function amount($s){
    if (empty($s)) {
        return '0.00';
    }
    return str_replace(',', '', number_format($s, 2));
}
function mari($s){
    if (empty($s)) {
        return '0.00';
    }
    return number_format($s, 2);
}
function quant($string){
    if (preg_match("/^[0-9]*$/", $string)) {
        if ($string < 1) {
            return false;
        }else {
            return true;
        }
    }else {
        return false;
    }
}
function number($p){
    $p = preg_replace('/\D/', '', $p);
    return $p;
}
function cry($s){
    if ($s == 1) {
        error("Bad practice has been detected.");
        exit;
    }
}
function there($s){
    if (!isset($_POST[$s])) {
        return false;
    }else {
        return true;
    }
}
function hide($action, $string) {
    $output = false;
    $encrypt_method = "AES-128-CTR";
    $secret_key = 'this is now APISE shop anskdjfhIUHbduifsdh98u987dguhjgwe78ds8f77ds';
    $secret_iv = 'dsfhihOISHD90hds8Sd09usgdjghjsd32jhgjhsgdhj8(yghjjh))';
    $key = hash('sha256', $secret_key);
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    if ( $action == 'e' ) {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    } else if( $action == 'd' ) {
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }
    return $output;
}
function url(){
    if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on'){
        $main = "https://";
    }else{
        $main = "http://";
    }
    $main.= $_SERVER['HTTP_HOST']. $_SERVER['REQUEST_URI'];
    return $main;
}
function style(){
    include 'meta.php';
    include 'styles.php';
}
function recent(){
    include 'meta.php';
    include 'recen.php';
}
function random($num, $h = 'Featured products'){
    global $home;
    include 'rando.php';
}
function word($word){
    return ucwords(mb_strtolower($word));
}
function pull($column, $table, $query ){
    global $db;
    $g = get(r("SELECT `$column` FROM `$table` WHERE $query"));
    $var =  isset($g[$column]) ? $g[$column] : '';
    return $var;
}
function cat_mod(){
    include 'meta.php';
    include 'cat_mod.php';
}

function most_random(){
    include 'meta.php';
    include 'most_random.php';
}
function modals(){
    include 'meta.php';
    include 'modals.php';
}
function feature(){
    include 'meta.php';
    include 'f_products.php';
}
function script(){
    include 'script_.php';
}
function show_cart(){
    global $user_id;
    include 'meta.php';
    include 'the_cart.php';
}
function new_product($id){
    global $last_week;
    if (mysqli_num_rows(r("SELECT `id` FROM `zvinhu` WHERE `date_added`> '$last_week' AND `id` = '$id'")) == 1) {
        return true;
    }
}
function recently_added($i){
    global $last_week;
    if (mysqli_num_rows(r("SELECT `id` FROM `zvinhu` WHERE `date_added`> '$last_week'")) >= $i) {
        return true;
    }else {
        return false;
    }
}
function head(){
    include 'meta.php';
    include 'header_._.php';
}
function foot(){
    include 'meta.php';
    global $total_cart;
    include 'fo.php';
}
function cats(){
    include 'meta.php';
    include 'cats.php';
}
function show_category(){
    include 'meta.php';
    include 'nav_top.php';
}
function pass($pass){
    global $db;
    $pass = sha1(md5($db->real_escape_string(htmlentities($pass))));
    $return = crypt($pass, "hosssana forever by kirk franklin is the best track to listen to at this time7U^*&^G#RUYR&*#^%&^WEFgsdgftr54@#$@gdhfmgsdy7(**SDF8053273235dsiufy76d78sf62495865");
    $pass = sha1(md5(htmlentities($return)));
    $pass = sha1(md5(md5(sha1(sha1(md5(sha1($pass."hdskfjh&Y*&^*Dbjhgsd78ssasddsefhjkgayustUYJHTYUdfsnjhyUI&*909-000-ejhsdkjf6h")))))));
    $pass = password_hash($pass, PASSWORD_ARGON2I);
    $pass = password_hash($pass, PASSWORD_ARGON2I);
    return $pass;
}
function clean($string){
    global $db;
    $name = trim($string);
    $name = $db->real_escape_string(htmlentities($string));
    $name = trim($name);
    return ucwords($name);
}
function valid_email($email){
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    }else {
        return false;
    }
}
function r($dv){
    global $db;
    return $db->query($dv);
}


function get($fg){
    return mysqli_fetch_array($fg);
}
function error($string){
    echo "<script type='text/javascript'>
    setTimeout(function() {
        toastr.options = {
            'closeButton': true,
            'debug': true,
            'progressBar': true,
            'preventDuplicates': false,
            'positionClass': 'toast-top-center',
            'onclick': null,
            'showDuration': '4000',
            'hideDuration': '1000',
            'timeOut': '12000',
            'extendedTimeOut': '1000',
            'showEasing': 'swing',
            'hideEasing': 'linear',
            'showMethod': 'fadeIn',
            'hideMethod': 'fadeOut'
        };
        toastr.error('$string');
    }, 0);
    </script>";
}

function warn($string){
    echo "<script type='text/javascript'>
    setTimeout(function() {
        toastr.options = {
            'closeButton': true,
            'debug': true,
            'progressBar': true,
            'preventDuplicates': false,
            'positionClass': 'toast-top-center',
            'onclick': null,
            'showDuration': '4000',
            'hideDuration': '1000',
            'timeOut': '12000',
            'extendedTimeOut': '1000',
            'showEasing': 'swing',
            'hideEasing': 'linear',
            'showMethod': 'fadeIn',
            'hideMethod': 'fadeOut'
        };
        toastr.warning('$string');
    }, 0);
    </script>";
}
function r_warn($str, $l, $t){
    echo "<script type='text/javascript'>
    setTimeout(function() {
        toastr.options = {
            'closeButton': true,
            'debug': true,
            'progressBar': true,
            'preventDuplicates': false,
            'positionClass': 'toast-top-center',
            'onclick': null,
            'showDuration': '3000',
            'hideDuration': '1000',
            'timeOut': '4000',
            'extendedTimeOut': '1000',
            'showEasing': 'swing',
            'hideEasing': 'linear',
            'showMethod': 'fadeIn',
            'hideMethod': 'fadeOut'
        };
        toastr.warning('$str');
        window.setTimeout(function(){
            window.location.href = '$l';
        }, $t);
    }, 0);
    </script>";
}
function success($string){
    echo "<script type='text/javascript'>
    setTimeout(function() {
        toastr.options = {
            'closeButton': true,
            'debug': true,
            'progressBar': true,
            'preventDuplicates': false,
            'positionClass': 'toast-top-center',
            'onclick': null,
            'showDuration': '4000',
            'hideDuration': '1000',
            'timeOut': '12000',
            'extendedTimeOut': '1000',
            'showEasing': 'swing',
            'hideEasing': 'linear',
            'showMethod': 'fadeIn',
            'hideMethod': 'fadeOut'
        };
        toastr.success('$string');
    }, 0);
    </script>";
}
$families = mysqli_num_rows(r("SELECT DISTINCT(`uid`) AS `fam` FROM `basket` WHERE `uid` != '' GROUP BY `uid`"));
$lls = get(r("SELECT COUNT(`id`) AS `it` FROM `zvinhu`"));
$all_products = $lls['it'];
$items = 0;
$total_cart = total_cart();
$payable = $total_cart;
if (isset($_SESSION[$coupon_session])) {
    $cpid = $_SESSION[$coupon_session];
    $camount = amount(pull('amount', 'coupons', "`id` = '$cpid'"));
    if(($total_cart*(1+$delivery_rate)) - $camount<0){
        $payable = "0.00";
    }else{
        $payable = ($total_cart*(1+$delivery_rate)) - $camount;
    }
}else {
    $payable = ($total_cart*(1+$delivery_rate));
}
$payable = amount($payable);
