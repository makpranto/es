<?php
global $project_root_folder;
$home = $project_root_folder;
$project_name = "Tysla Retail";
$retail_version = mb_strtolower("$project_name v0.1.4");
$project_main_session_name = "7w89WE^&8hbds fbcasydygds7tudhg;oiujdofgiunihuhd&&&I%shdrtufyytfytf dieyjdfkutsd76tyg7887()Sd8t87egryuvhbvtYT7uysdfdgdfkus6r7w7654wefRtyshfduyd9f87&^A%S&^sfdhgdsf67367265165wjgfaJASF7I6RADS76";
$icon = $project_root_folder."/img/enfield-icon.png";
$logo = $project_root_folder."/img/enfield-logo.png";
$ikon = "enfield-logo.png";
$errors = [];
$success = [];
$greeting = 'morning';
if (date('H')>= 12 && date('H')<18) {
    $greeting = 'afternoon';
}elseif (date('H')>18) {
    $greeting = 'evening';
}

$c_name_length = 150;
?>
