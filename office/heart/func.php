<?php
include $_SERVER['DOCUMENT_ROOT'].'/e/shop/a/bb.php';
$project_root_folder = $office;
include 'heart.php';


define('KB', 1024);
define('MB', 1048576);
setlocale(LC_CTYPE, "en_US.UTF-8");
date_default_timezone_set('Africa/Harare');
class Database{
    private static $instance;
    public static function getInstance(){
        global  $dbuser, $dbpass, $dbname;
        if (self::$instance == null) {
            self::$instance = mysqli_connect('localhost', $dbuser, $dbpass, $dbname);
        }
        return self::$instance;
    }
}
session_start();
function url(){
    $url  = isset($_SERVER['HTTPS']) ? 'https://' : 'http://';
    $url .= $_SERVER['SERVER_NAME'];
    $url .= $_SERVER['REQUEST_URI'];
    return $url;
}
$db = Database::getInstance();
function space($word){
    return preg_replace('!\s+!', ' ', $word);
}

function pname($product_name){
    if(!preg_match("/^[a-zA-Z 0-9,.%&-]+$/", $product_name) == 1) {
        return false;
    }
    return true;
}
function mari($s){
    if($s == ''){
         return '0.00';
    }
    return number_format($s, 2);
}
function main_cat_dd($id = '0'){
    $as = r("SELECT `name`, `id` FROM `categories` ORDER BY `name`");
    while ($a = get($as)) {
        if ($id == $a['id']) {
            echo "<option value='". hide('e', $a['id'])."' selected>". $a['name']. '</option>';
        }else {
            echo "<option value='". hide('e', $a['id'])."'>". $a['name']. '</option>';
        }
    }
}
function now(){
    return date("Y-m-d H:i:s");
}
function sub_cat_dd($id = '0'){
    $as = r("SELECT `name`, `id` FROM `sub_categories` ORDER BY `name`");
    while ($a = get($as)) {
        if ($id == $a['id']) {
            echo "<option value='". hide('e', $a['id'])."' selected>". $a['name']. '</option>';
        }else {
            echo "<option value='". hide('e', $a['id'])."'>". $a['name']. '</option>';
        }
    }
}
function style(){
    global $project_root_folder, $icon;
    include 'styles.php';
}

function r_success($str, $l, $t){
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
        toastr.success('$str');
        window.setTimeout(function(){
            window.location.href = '$l';
        }, $t);
    }, 0);
    </script>";
}

function generate_coupon($length = 9 ){
    $pool = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $crypto_rand_secure = function ( $min, $max ) {
        $range = $max - $min;
        if ( $range < 0 ) return $min;
        $log    = log( $range, 2 );
        $bytes  = (int) ( $log / 8 ) + 1;
        $bits   = (int) $log + 1;
        $filter = (int) ( 1 << $bits ) - 1;
        do {
            $rnd = hexdec( bin2hex( openssl_random_pseudo_bytes( $bytes ) ) );
            $rnd = $rnd & $filter;
        } while ( $rnd >= $range );
        return $min + $rnd;
    };
    $token = "";
    $max   = strlen( $pool );
    for ( $i = 0; $i < $length; $i++ ) {
        $token .= $pool[$crypto_rand_secure( 0, $max )];
    }
    $tokens = mb_strtoupper($token);
    while (mysqli_num_rows(r("SELECT `id` FROM `coupons` WHERE `coupon` = '$tokens'")) != 0) {
        $max   = strlen( $pool );
        for ( $i = 0; $i < $length; $i++ ) {
            $token .= $pool[$crypto_rand_secure( 0, $max )];
        }
    }
    return $token;
}
function stand_alone($id){
    if (mysqli_num_rows(r("SELECT `id` FROM `categories` WHERE `id` = '$id'  AND `stand_alone` = '1'")) == 1) {
        return true;
    }
    return false;
}
function ago($time){
    $seconds_ago = (time() - strtotime($time));
    if ($seconds_ago >= 31536000) {
        $rf =  intval($seconds_ago / 31536000);
        if ($rf == 1) {
            $rf .= " year ago";
        }else {
            $rf .= " years ago";
        }
    } elseif ($seconds_ago >= 2419200) {
        $rf =  intval($seconds_ago / 2419200);
        if ($rf == 1) {
            $rf .= " month ago";
        }else {
            $rf .= " months ago";
        }
    } elseif ($seconds_ago >= 86400) {
        $rf =  intval($seconds_ago / 86400);
        if ($rf == 1) {
            $rf .= " day ago";
        }else {
            $rf .= " days ago";
        }
    } elseif ($seconds_ago >= 3600) {
        $rf =  intval($seconds_ago / 3600);
        if ($rf == 1) {
            $rf .= " hour ago";
        }else {
            $rf .= " hours ago";
        }
    } elseif ($seconds_ago >= 60) {
        $rf =  intval($seconds_ago / 60);
        if ($rf == 1) {
            $rf .= " minute ago";
        }else {
            $rf .= " minutes ago";
        }
    } else {
        $rf =  "Less than a minute ago";
    }
    return $rf;
}

function there($t){
    if (!isset($_POST[$t])) {
        return false;
    }else {
        return true;

    }
}
function format_punc($string){
    $punctuation = ';:';
    $spaced_punc = array(' ?', ' .', ' ,');
    $un_spaced_punc = array('?', '.', ',');
    $string = preg_replace("/([.,!?;:])+/iS","$1",$string);
    $string = preg_replace('/[[:space:]]+/', ' ', $string);
    $string = str_replace($spaced_punc, $un_spaced_punc, $string);
    $string = preg_replace('/(['.$punctuation.'])[\s]*/', '\1 ', $string);
    $string = preg_replace('/(?<!\d),|,(?!\d{3})/', ', ', $string);
    $string = preg_replace('/(\.)([[:alpha:]]{2,})/', '$1 $2', $string);
    $string = trim($string);

    if($string[strlen($string)-1]==','){
        $string = substr($string, 0, -1).'.';
    }
    // $string = preg_replace_callback("/([.!?]\s*\w)/e", "strtoupper('$1')", $string);
    $letters = array(
'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n',
 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'
);
foreach ($letters as $letter) {
    $string = str_replace('. ' . $letter, '. ' . ucwords($letter), $string);
    $string = str_replace('? ' . $letter, '? ' . ucwords($letter), $string);
    $string = str_replace('! ' . $letter, '! ' . ucwords($letter), $string);
}
    // preg_match_all("/\.\s*\w/", $string, $matches);
    // foreach($matches[0] as $match){
    //     $string = str_replace($match, strtoupper($match), $string);
    // }
    // $string = str_replace()
    return ucfirst($string);
}
function ls($amo){
    if (preg_match('/^[a-zA-Z\s]+$/', $amo)) {
        return true;
    }else {
        return false;
    }
}
function pull($column, $table, $query ){
    global $db;
    $g = get(r("SELECT `$column` FROM `$table` WHERE $query"));
    $var =  isset($g[$column]) ? $g[$column] : '';
    return $var;
}
function block($id){
    include('heart.php');
    global $db;
    $get_access_levels = r("UPDATE `chikwata` SET `status` = 'BLOCKED', `status_message` = 'Your account was blocked because of bad practice. Contact Tysla Solutions for assistance.' WHERE `id` = '$id'");
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
        toastr.error('Your account has been deactivated.');
        window.setTimeout(function(){
            window.location.href = '$project_root_folder/IjXeyPj4';
        }, 3000);
    }, 0);
    </script>";
}
function full_name($id){
    include('heart.php');
    $get_access_levels = r("SELECT `full_name` FROM `chikwata` WHERE `id` = '$id'");
    $s = get($get_access_levels);
    return $s['full_name'];
}
function agent_name($id){
    include('heart.php');
    global $db;
    $get_access_levels = r("SELECT `agent_username` FROM `agents` WHERE `id` = '$id'");
    $s = get($get_access_levels);
    return $s['agent_username'];
}
function word($word){
    return ucwords(mb_strtolower($word));
}
function r($dv){
    include('heart.php');
    global $db;
    return $db->query($dv);
}

function get($fg){
    return mysqli_fetch_array($fg);
}

function pn($id){
    include('heart.php');
    global $db;
    $get_access_levels = r("SELECT `product_name` FROM `zvinhu` WHERE `id` = '$id'");
    $s = get($get_access_levels);
    return isset($s['product_name']) ? $s['product_name'] : '';
}

function int_compare($then, $now){
    if ($then>$now){
        echo "<h2 class='text-danger'>
        <i class='fa fa-play fa-rotate-90'></i>$now
        </h2>";
    }elseif ($now>$then) {
        echo "<h2 class='text-navy'>
        <i class='fa fa-play fa-rotate-270'></i>$now
        </h2>";
    }else {
        echo "<h2 class='text-danger'>
        <i class='fa fa-play fa-rotate-90'></i>$now
        </h2>";
    }
}

function amt_compare($then, $now){
    if ($then>$now){
        echo "<h2 class='text-danger'>
        <i class='fa fa-play fa-rotate-90'></i>$$now
        </h2>";
    }elseif ($now>$then) {
        echo "<h2 class='text-navy'>
        <i class='fa fa-play fa-rotate-270'></i>$$now
        </h2>";
    }else {
        echo "<h2 class='text-danger'>
        <i class='fa fa-play fa-rotate-90'></i>$$now
        </h2>";
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


function cleared($company_id, $page){
    include('heart.php');
    global $db;
    $get_access_levels = $db->query("SELECT `$page` FROM `company_access` WHERE `company_id` = '$company_id' and `$page` = 1");
    if (mysqli_num_rows($get_access_levels)==1) {
        return true;
    }else {
        return false;
    }
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
function figure($amo){
    if (strlen($amo) == 0) {
        return false;
    }else {
        if (!preg_match('/^[0-9]?$/', $amo[0])) {
            return false;
        }else {
            if (preg_match('/^[0-9]*(\.[0-9]{0,2})?$/', $amo)) {
                return true;
            }else {
                return false;
            }
        }
    }
}

function amount($s){
    if ($s == '') {
        return '0.00';
    }else {
        return str_replace(',', '', number_format($s, 2));
    }
}

function number($string, $c){
    if (preg_match("/^[0-9]{1,$c}$/", $string)) {
        return true;
    }else {
        return false;
    }
}
function prt($n){
    if (!preg_match("/^(?:100|\d{1,3})(?:\.\d{1,2})?$/", $n)) {
        return false;
    }else {
        return true;
    }
}
function percentage($n){
    $n = str_replace('%', '', $n);
    return $n;
}
function check_access($user_id, $page){
    include('heart.php');
    global $db;
    $get_access_levels = r("SELECT `$page` FROM `access_level` WHERE `user_id` = '$user_id' and `$page` = 1");
    if (mysqli_num_rows($get_access_levels)==1) {
    }else {

        header("location: $project_root_folder");
    }
}
function secure($page){
    $user_id = 'tyslasolutions';
    include('heart.php');
    include 'dsfhiusdfhui.php';
    $get_access_levels = r("SELECT `$page` FROM `access_level` WHERE `user_id` = '$user_id' and `$page` = 1");
    if (!isset($_SESSION[$project_main_session_name])) {
        $_SESSION['url'] = url();
        $_SESSION['error'] = "You need to login first.";
        $t = hide('e', hide('e', hide('e', time())));
        header("location: $project_root_folder?redirect=$t");
        exit;
    }elseif (mysqli_num_rows($get_access_levels)==1) {
    }else {
        header("location: $project_root_folder");
        exit;
    }
    if (strrev(substr(url(), -9)) == "php.xedni") {
        include '../404/rimwe.php';
        exit;
    }
}
function foot(){
    global $project_root_folder;
    include 'foot.php';
}
function scripts(){
    global $project_root_folder;
    include 'scripts.php';
}
function nav(){
    include 'heart.php';
    include 'dsfhiusdfhui.php';
    include 'nav.php';
}
function top_bar(){
    include 'heart.php';
    include 'dsfhiusdfhui.php';
    include 'top_bar.php';
}
function access($user_id, $page){
    include('heart.php');
    $get_access_levels = r("SELECT `$page` FROM `access_level` WHERE `user_id` = '$user_id' and `$page` = 1");
    if (mysqli_num_rows($get_access_levels)==1) {
        return true;
    }else {
        return false;
    }
}

function pass($pass){
    include('heart.php');
    global $db;
    $pass = sha1(md5($db->real_escape_string(htmlentities($pass))));
    $return = crypt($pass, "Warning! Iudlfliuhsdif7783468sdasdkjn7 Eguysadasdtgf7i6 == hjksadhjksasdsdsadadhkjbb8959***sadkhgsduyg1IoOwFqZfhjksadhjksadhkjbb8959***sOribUhXAWh5LN7q/QVOA. ");
    $pass = sha1(md5(htmlentities($return)));
    $pass = md5(md5(sha1(sha1(md5(sha1($pass."Warning! Iudlfliuhsdif7783468sdasdkjn7 Eguysadasdtgf7i6 == hjksadhjksasdsdsadadhkjbb8959***sadkhgsduyg1IoOwFqZfhjksadhjksadhkjbb8959***sOribUhXAWh5LN7q/QVOA. "))))));
    return $pass;
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
function clean($string){
    global $db;
    $name = trim($string);
    $name = $db->real_escape_string(htmlentities($string));
    $name = trim($name);
    $name = preg_replace('!\s+!', ' ', $name);
    return ucwords($name);
}
function cleaned($string){
    global $db;
    $name = trim($string);
    $name = $db->real_escape_string(htmlentities($string));
    $name = trim($name);
    return $name;
}

function valid_email($email){
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    }else {
        return false;
    }
}
