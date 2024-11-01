<?php
/**
 * Created by Touqeer Shafi.
 * Email: touqeer.shafi@gmail.com
 * Date: 5/28/13
 * Time: 6:17 PM
 * File: settings.php
 */
function lead_check()
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://touqeershafi.com/curl.php");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query(array('user_email' => $_POST['user_email'],'user_name' => $_POST['user_name'])));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec ($ch);
    curl_close ($ch);
    $result = json_decode($result,1);
    if($result['status'] == 'success'){
        update_option('leads_activated','true');
        $leads_activated = true;
    }else{
        $leads_activated = false;
    }

    return $leads_activated;
}

 /*
  * End file settings.php
 */
