<?php 

function delCookie(String $cookie_name) {
    setcookie($cookie_name, '' , time() - 3600, null, null, false, true); // On antidate le cookie
}

?>