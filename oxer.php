#!/usr/bin/php
<?php
/**
* @author Ardan Ardzz
* @package 
*/
include 'functions.php';
if (empty($argv[1]) or $argv[1] == "-h") {
    echo "Usage : " . $argv[0] . " [Options...]\n";
    echo "-M, --mass-check     Mass Check\n";
    echo "-S, --single-check   Single Check\n";
    echo "-G, --grab-proxy     Grab Proxy\n";
    echo "-U, --update         Update\n";
    echo "-I, --install        Install OXER in system\n";
    echo "-UN, --uninstall     Uninstall OXER from system\n";
    echo "-A, --about          About This Tool\n";
}
elseif ($argv[1] == "--mass-check" | $argv[1] == "-M") {
    // $file = "proxy-list.txt";
    if (empty($argv[2])) {
        echo "Usage : " . $argv[0] . " [Options...] [Filename...]\n";
        echo "-M, --mass-check     Mass Check\n";
        echo "-F, --file-name      Filename\n";
        echo "Example : $argv[0] -M -F \"proxy-list.txt\"\n";
        exit();
    }
    $file = $argv[3];
    if(!file_exists($file)) {
        echo oxer_error();
        echo "::::::::::::::::[ ".$red."File is Not Found!".$normal." ]::::::::::::::::\n";
        echo "::::::::::::::::::::::::::::::::::::::::::::::::::::::\n";
        exit();
    }
    $proxy = explode("\n", file_get_contents($file));
    system("clear");
    echo "===================[ PROXY CHECKER ]====================\n";
    $a = 1;
    foreach($proxy as $px) {
        $j = count($proxy) - 1;
        echo $green1 . "[" . $a++ . "/" . $j . "] Checking Proxy\n" . $normal;
        check_proxy($px);
    }
    echo "===================[ PROXY CHECKER ]====================\n";
}
elseif ($argv[1] == "--single-check" | $argv[1] == "-S") {
    if (empty($argv[2])) {
        echo "Usage : " . $argv[0] . " [Options...] [Proxy...]\n";
        echo "-S, --single-check     Single Check\n";
        echo "-P, --proxy            Proxy\n";
        echo "Example : $argv[0] -S -P \"182.253.71.116:8080\"\n";
        exit();
    }
    elseif (empty($argv[3])) {
        echo oxer_error();
        echo ":::::::::::::::::[ ".$red."Proxy is Empty!".$normal." ]::::::::::::::::::\n";
        echo "::::::::::::::::::::::::::::::::::::::::::::::::::::::\n";
        exit();
    }
    else {
        echo "===================[ PROXY CHECKER ]====================\n";
        echo "[?] Checking Proxy\n" . $normal;
        check_proxy($argv[3]);
        echo "===================[ PROXY CHECKER ]====================\n";
    }
}
elseif ($argv[1] == "--grab-proxy" | $argv[1] == "-G") {
    if (empty($argv[2])) {
        echo "Usage : $argv[0] [Options...] [Save-as...]\n";
        echo "-SA, --save-as    Save As Proxy List\n";
        echo "Example : $argv[0] -G -SA \"proxy-list.txt\"\n";
    }
    elseif (empty($argv[3])) {
        echo "Usage : $argv[0] [Options...] [Save-as...]\n";
        echo "-SA, --save-as    Save As Proxy List\n";
        echo "Example : $argv[0] -G -SA \"proxy-list.txt\"\n";
    }
    else {
        $json = json_decode(file_get_contents("https://api.zonkploit.com/proxy-list") , true);
        foreach($json["result"] as $js) {
            echo $js["ip"] . ":" . $js["port"] . "\n";
            save($argv[3], $js["ip"] . ":" . $js["port"]);
        }
    }
}
elseif ($argv[1] == "--update" | $argv[1] == "-U") {
$json = json_decode(file_get_contents("https://api.zonkploit.com/oxer/check-update/".$version),1);
if ($json["update"] == "yes") {
    echo "[+] Update is Available\n";
    $o = readline("[?] Want to update now? [y/n] : ");
    if ($o == "y") {
    echo "[*] Downloading script\n";
    $url = "https://raw.githubusercontent.com/ardzz/oxer/master/oxer.php";
    shell_exec("wget -O $argv[0] $url 2>&1");
    echo "[+] Update successfully\n";
    }else{
        echo "[+] Update canceled\n";
    }
}else{
    echo "[?] Update is Unavailable\n";
}
}elseif ($argv[1] == "--uninstall" | $argv[1] == "-UN") {
if(is_root()){
if(file_exists("/usr/bin/oxer")){
    unlink("/usr/bin/oxer");
    echo "[!] OXER is successfully unstalled!\n";
}else{
    echo oxer_error();
    echo "[!] OXER is not installed\n";
}
}else{
    echo oxer_error();
    echo "::::::::::::::::[ ".$red."User is Not Root".$normal." ]::::::::::::::::::\n";
    echo "::::::::::::::::::::::::::::::::::::::::::::::::::::::\n";
}
}
elseif ($argv[1] == "--install" | $argv[1] == "-I") {
if(is_root()){
if(file_exists("/usr/bin/oxer")){
    echo oxer_error();
    echo "[!] OXER is already installed!\n";
}else{
    system("cp oxer /usr/bin/oxer && chmod +x oxer");
    echo "[+] OXER is successfully installed!\n";
    echo "[?] run OXER with command \"oxer [Options...]\"\n";
}
}else{
    echo oxer_error();
    echo "::::::::::::::::[ ".$red."User is Not Root".$normal." ]::::::::::::::::::\n";
    echo "::::::::::::::::::::::::::::::::::::::::::::::::::::::\n";
}
}
elseif ($argv[1] == "--about" | $argv[1] == "-A") {
echo banner();
}
elseif ($argv[1] == "-V" | $argv[1] == "--version") {
echo "Version 1.0 Beta\n";
}
else {
    echo "Usage : " . $argv[0] . " [Options...]\n";
    echo "-M, --mass-check     Mass Check\n";
    echo "-S, --single-check   Single Check\n";
    echo "-G, --grab-proxy     Grab Proxy\n";
    echo "-U, --update         Update\n";
    echo "-I, --install        Install OXER in system\n";
    echo "-UN, --uninstall     Uninstall OXER from system\n";
    echo "-A, --about          About This Tool\n";
}
?>