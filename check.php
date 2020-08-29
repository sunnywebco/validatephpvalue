<?php
function protect($string) {
    //sql injection and xss -- all string check . easy check and pro check
    $protection = htmlspecialchars(trim($string), ENT_QUOTES);
    return $protection;
}

//$domains = array("abc.com","gmail.com");
function validateEmailDomain($email, $domains) {
    // valid email and use whitelist domain service
    foreach ($domains as $domain) {
        if(empty($email)){return false;}else{
        $pos = strpos($email, $domain, strlen($email) - strlen($domain));
        if ($pos === false)
            continue;
        if ($pos == 0 || $email[(int) $pos - 1] == "@" || $email[(int) $pos - 1] == ".")
            return true;
        }
    }
    return false;
}

function validatepassword($password,$min = 8) {
    // password valid
    if(empty($password)){return false;}else {
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number = preg_match('@[0-9]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);
        if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < $min) {
            return false;
        } else {
            return true;
        }
    }
}


function validateuserpersian($string) {
    // persian
    if(empty($string)){return false;}else {
        if (preg_match('/^[^\x{600}-\x{6FF}]+$/u', str_replace("\\\\","",$string))){
            return false;
        } else {
            return true;
        }
    }
}

function validatestrlen($string,$max = 20) {
    // max check
    if(empty($string)){return false;}else{
        if (strlen($string) > $max ){
            return false;
        } else {
            return true;
        }
    }
}

function validatetimestamp($timestamp) {
    if(empty($timestamp)){return false;}else{
        if((string) (int) $timestamp === $timestamp && ($timestamp <= PHP_INT_MAX) && ($timestamp >= ~PHP_INT_MAX)){
            return true;
        } else {
            return false;
        }
    }
}

function birth($birth,$age = 17) {
    // birth user check +18
    if(empty($birth)){return false;}else{
        if(date("Y",$birth) >= date('Y')-$age){
            return true;
        } else {
            return false;
        }
    }
}

function validatemelicode($input) {
    if (preg_match("/^\d{10}$/", $input)) {
        $blacklist = array("0000000000","1111111111","2222222222","3333333333","4444444444","5555555555","6666666666","7777777777","8888888888","9999999999");
        if ((array_search($input,$blacklist)) !== FALSE) {
            return false;
        } else {
             $check = (int)$input[9];
            $sum = array_sum(array_map(function ($x) use ($input) {
                    return ((int)$input[$x]) * (10 - $x);
                }, range(0, 8))) % 11;
            if (($sum < 2 && $check == $sum) || ($sum >= 2 && $check + $sum == 11)) {
                return true;
            } else {
                return false;
            }
        }
    } else {
        return false;
    }
}

function validasexnumber($sex){
    // 1 = men
    // 2 = woman
    // 3 = other
    if(($sex === '1') OR ($sex === '2') OR ($sex === '3')){
        return true;
    }else{
        return false;
    }
}

function validatetel($init,$min = 8,$max = 12){
    //min = number min
    //max = number max ' iran all city 8 - 12
    $filtered_phone_number = filter_var($init, FILTER_SANITIZE_NUMBER_INT);
    if (strlen($filtered_phone_number) < $min || strlen($filtered_phone_number) > $max) {
        return false;
    } else {
        return true;
    }
}

function validatemobile($mobile){
    // valid mobile number easy
    if(preg_match("/^09[0-9]{9}$/", $mobile)) {
        return true;
    }else{
        return false;
    }
}
