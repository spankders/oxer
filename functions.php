<?php
/**
* @author Ardan Ardzz
* @link https://fb.com/4rdzz
* @package OXER
*/
$green  = "\e[1;92m";
$cyan   = "\e[1;36m";
$normal = "\e[0m";
$blue   = "\e[34m";
$green1 = "\e[0;92m";
$yellow = "\e[93m";
$red    = "\e[1;91m";
$version = "1.0";
function check_proxy($px){
    if (empty($px)) {
        echo "[!] Proxy is empty!\n";
    }else{
    /*
    Set URL
    */
    $url = "https://www.google.com";
    /*
    Other 
    ....
    */
    $green  = "\e[1;92m";
    $cyan   = "\e[1;36m";
    $normal = "\e[0m";
    $blue   = "\e[34m";
    $green1 = "\e[0;92m";
    $yellow = "\e[93m";
    $red    = "\e[1;91m";
    $timeout = 10;
    $a = 1;
    $pecah = explode(":", $px);
    $ipx = $pecah[0];
    $port = $pecah[1];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 0);
    curl_setopt($ch, CURLOPT_PROXY, $px);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout); 
    curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $data = curl_exec($ch);
    $header = substr($data, 0, curl_getinfo($ch, CURLINFO_HEADER_SIZE));
    $body = substr($data, curl_getinfo($ch, CURLINFO_HEADER_SIZE));
    $response = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $info = curl_getinfo($ch);
    curl_close($ch);
    if (empty($response)) {
        echo "[!] Proxy is ".$red."DIE!\n".$normal;
        echo "[*] Using proxy [$px]\n";
        // show curl error
        #curl_error($ch);
        //exit();
    }else{
        $json = json_decode(file_get_contents("https://api.zonkploit.com/ip-lookup/".$ipx),1);
        preg_match("'(.*?)\r\n'", $header, $match);
        echo "[+] Proxy is ".$green1."LIVE\n".$normal;
        echo "[?] Using proxy [$px]\n";
        echo "[*] Response Proxy : ".$match[1]."\n";
        echo "[*] Timeout        : ".round($info["total_time"])."s\n";
        echo "[+] Country        : ".$json["country_name"]."\n";
        echo "[+] ISP            : ".$json["organization"]."\n";
        echo "[+] Hostname       : ".$json["hostname"]."\n";
        //echo "[*] Speed Proxy    : ".$info["speed_download"]."\n";
    }
}
}
function save($name, $isi)
{
    $jud1 = fopen($name, "a");
    fwrite($jud1, $isi . "\n");
    fclose($jud1);
}function banner(){
$green  = "\e[1;92m";
$cyan   = "\e[1;36m";
$normal = "\e[0m";
$blue   = "\e[34m";
$green1 = "\e[0;92m";
$yellow = "\e[93m";
$red    = "\e[1;91m";
system("clear");
$banner = ":::::::::::::::::::::::::::::::::::::::::::::::::::::
:::'#####::::::'##::::'##::::'########::::'########::
::'##.. ##:::::. ##::'##::::: ##.....::::: ##.... ##:
:'##:::: ##:::::. ##'##:::::: ##:::::::::: ##:::: ##:
: ##:::: ##::::::. ###::::::: ######:::::: ########::
: ##:::: ##:::::: ## ##:::::: ##...::::::: ##.. ##:::
:. ##:: ##:::::: ##:. ##::::: ##:::::::::: ##::. ##::
::. #####:::::: ##:::. ##:::: ########:::: ##:::. ##:
:::.....:::::::..:::::..:::::........:::::..:::::..::
::::::::::::::::[ ".$green."PROXY CHECKER v1.0".$normal." ]:::::::::::::::
::::::::::::::::::::::::[ ".$yellow."BY".$normal." ]:::::::::::::::::::::::\n";
$banner1 = ":::::::::::::::::::::::::::::::::::::::::::::::::::::
:::'###::::'########::'########::'########:'########:
::'## ##::: ##.... ##: ##.... ##:..... ##::..... ##::
:'##:. ##:: ##:::: ##: ##:::: ##::::: ##::::::: ##:::
'##:::. ##: ########:: ##:::: ##:::: ##::::::: ##::::
 #########: ##.. ##::: ##:::: ##::: ##::::::: ##:::::
 ##.... ##: ##::. ##:: ##:::: ##:: ##::::::: ##::::::
 ##:::: ##: ##:::. ##: ########:: ########: ########:
..:::::..::..:::::..::........:::........::........::
:::::::::::::::::::::::::::::::::::::::::::::::::::::\n";
return str_replace("#", $cyan."=".$normal, $banner).str_replace("#", $green."X".$normal, $banner1);
}
function oxer_error(){
$green  = "\e[1;92m";
$cyan   = "\e[1;36m";
$normal = "\e[0m";
$blue   = "\e[34m";
$green1 = "\e[0;92m";
$yellow = "\e[93m";
$red    = "\e[1;91m";
system("clear");
$banner = "::::::::::::::::::::::::::::::::::::::::::::::::::::::
'########:'########::'########:::'#######::'########::
:##.....:: ##.... ##: ##.... ##:'##.... ##: ##.... ##:
:##::::::: ##:::: ##: ##:::: ##: ##:::: ##: ##:::: ##:
:######::: ########:: ########:: ##:::: ##: ########::
:##...:::: ##.. ##::: ##.. ##::: ##:::: ##: ##.. ##:::
:##::::::: ##::. ##:: ##::. ##:: ##:::: ##: ##::. ##::
:########: ##:::. ##: ##:::. ##:. #######:: ##:::. ##:
........::..:::::..::..:::::..:::.......:::..:::::..::\n";
return str_replace("#", $red."!".$normal, $banner);
}function is_root(){
if(posix_getuid()==0){
return true;
}
else{
return false;
exit();
}
}
?>
