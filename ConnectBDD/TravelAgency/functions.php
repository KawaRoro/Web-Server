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

function generateToken() {
    
    $token = md5(uniqid(microtime(), true));  

    return $token;
}

function registrationEmailWithToken($to , $name, $token) {
    ini_set('SMTP', "smtp.gmail.com");
    ini_set('smtp_port', "25");
    ini_set('sendmail_from', "webmaster.benjamin@gmail.com");

    $send_by = 'webmaster.benjamin@gmail.com';

    $message = include('registration_mail.php?name='.$name.'&email='.$to);
    
    $subject = 'Votre inscription à été prise en compte';
    
    $headers = "From: " . $send_by . "\r\n";
    $headers .= "Reply-To: robot@travelagency.com\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    if (mail($to, $subject, $message, $headers)) {
        return true;
    } else {
        return false;
    }
}
?>