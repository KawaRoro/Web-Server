<?php
// Function to get the user IP address
function getUserIP() {
    $ip_address = '';
    $ip_type = '';
    if (isset($_SERVER['HTTP_CLIENT_IP'])){
        $ip_address = $_SERVER['HTTP_CLIENT_IP'];
        $ip_type = 'HTTP_CLIENT_IP';
    }else if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
        $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
        $ip_type = 'HTTP_X_FORWARDED_FOR';
    }else if(isset($_SERVER['HTTP_X_FORWARDED'])){
        $ip_address = $_SERVER['HTTP_X_FORWARDED'];
        $ip_type = 'HTTP_X_FORWARDED';
    }else if(isset($_SERVER['HTTP_X_CLUSTER_CLIENT_IP'])){
        $ip_address = $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
        $ip_type = 'HTTP_X_CLUSTER_CLIENT_IP';
    }else if(isset($_SERVER['HTTP_FORWARDED_FOR'])){
        $ip_address = $_SERVER['HTTP_FORWARDED_FOR'];
        $ip_type = 'HTTP_FORWARDED_FOR';
    }else if(isset($_SERVER['HTTP_FORWARDED'])){
        $ip_address = $_SERVER['HTTP_FORWARDED'];
        $ip_type = 'HTTP_FORWARDED';
    }else if(isset($_SERVER['REMOTE_ADDR'])){
        $ip_address = $_SERVER['REMOTE_ADDR'];
        $ip_type = 'REMOTE_ADDR';
    }else{
        $ip_address = 'UNKNOWN';
        $ip_type = 'UNKNOWN';
    }
    //return $ipaddress;
    return array($ip_address, $ip_type);
}
?>