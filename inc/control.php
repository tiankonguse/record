<?php
session_start();
require("./common.php");

$json = new Services_JSON();
require("./function.php");

if((!$conn || !$result) && $ret){
    echo $json->encode($ret);
}else if(!isset($_GET["state"])){
    echo $json->encode(output(OUTPUT_ERROR,"非法操作"));
}else{
    $code = $_GET["state"];
    switch($code){
        case 1 :echo $json->encode(login());break;
        case 2 :echo $json->encode(write());break;
        case 3 :echo $json->encode(alter());break;
        case 4 :echo $json->encode(delete());break;
    }
}


