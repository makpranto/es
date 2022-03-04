<?php
if (isset($_SESSION[$project_main_session_name])) {
    $user_id = $_SESSION[$project_main_session_name];
    $get_user_details = $db->query("SELECT * from `chikwata` where `id` = '$user_id'");
    while ($till1 = mysqli_fetch_array($get_user_details)) {
        $user_name = $till1['name'];
        $company_id = $till1['company_id'];
        $user_surnane = $till1['surname'];
    }
    // $get_class = $db->query("SELECT * FROM `controller` WHERE `id`= $company_id");
    // while ($till2 = mysqli_fetch_array($get_class)) {
    //     $company_name = $till2['short_name'];
    // }

}else {
    header("location: $project_root_folder");
}


 ?>
