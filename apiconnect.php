<?php

//Sending HTTP POST Request to SELCOM API
function sendHTTPRequest($url, $isPost, $json, $authorization, $digest, $signed_fields, $timestamp) {
    $headers = array(
      "Content-type: application/json;charset=\"utf-8\"", "Accept: application/json", "Cache-Control: no-cache",
      "Authorization: SELCOM $authorization",
      "Digest-Method: HS256",
      "Digest: $digest",
      "Timestamp: $timestamp",
      "Signed-Fields: $signed_fields",
    );
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    if($isPost){
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
    }
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch,CURLOPT_TIMEOUT,90);
    $result = curl_exec($ch);
    curl_close($ch);
    return json_decode($result);
}

add_filter('plugin_row_meta',  'Register_Plugins_Links', 10, 2);
function Register_Plugins_Links ($links, $file) {
   $base = plugin_basename(__FILE__);
   if ($file == $base) {
       $links[] = '<a href="https://github.com/wallace-stev/epush-selcom-wp">' . __('📦 View on Github') . '</a>';
      $links[] = '<a href="https://github.com/wallace-stev/epush-selcom-wp/issues">' . __('📝 Report an Issue') . '</a>';
       }
   return $links;
}

?>
