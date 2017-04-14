<?php
session_start();
require("./inc/common.php");
require("./inc/function.php");

$json = new Services_JSON();
if((!$conn || !$result) && $ret){
    echo $json->encode($ret);
}else if(!checkReferer()){
    echo $json->encode(output(OUTPUT_ERROR,"非法操作"));
}else if(!isset($_GET["state"])){
    echo $json->encode(output(OUTPUT_ERROR,"非法操作"));
}else{
    $code = $_GET["state"];
    switch($code){
        case "list" :echo $json->encode(getPostList());break;
        case "post" :echo $json->encode(getPostData());break;
        default: 
            echo $json->encode(output(OUTPUT_ERROR,"非法操作"));
            break;
    }
}

function checkReferer(){
    if(!isset($_SERVER['HTTP_REFERER'])){
        return false;
    }
    
    $url = $_SERVER['HTTP_REFERER'];
    $result = parse_url($url);
    if(!$result){
        return false;
    }
    
    
    if(!isset($result["host"])){
        return false;
    }
    $host = $result["host"];
    if($host != "github.tiankonguse.com"){
        return false;
    }
    
    header('Access-Control-Allow-Origin: http://github.tiankonguse.com');
    header('Access-Control-Allow-Credentials: true');
    return true;
}

function getPostList(){
    global $conn;
    initPage(10);
    
    $retutnJson = array();
    $retutnJson["data"] = array();
    $data = &$retutnJson["data"];
    
    $data["pageSize"] = $_GET['pageSize'];
    $data["allPostNum"] = $_GET['allPostNum'];
    $data["allPageNum"] = $_GET['allPageNum'];
    $data["offset"] = $_GET['offset'];
 
    $pageSize = $data['pageSize'];
    $offset = $data['offset'];
    $sql = "select id,time,last_time,title from `record_record` where `invalid` = '1' ORDER BY `last_time` DESC LIMIT $offset , $pageSize";
    $result = mysql_query($sql ,$conn);
    if(!$result){
        return output(OUTPUT_ERROR, "非法操作");
    }
    
    $data["list"] = array();
    $list = &$data["list"];

    while($row=mysql_fetch_array($result)){
        $item = array();
        $item["id"] = $row['id'];
        $item["time"] = $row['time'];
        $item["last_time"] = $row['last_time'];
        $item["title"] = $row['title'];
        
        $list[] = $item;
    }
    
    $retutnJson["code"] = 0;
    $retutnJson["message"] = "suc";
    return $retutnJson;
}

function getPostData(){
    global $conn;
    
    $retutnJson = array();
    $retutnJson["data"] = array();
    $data = &$retutnJson["data"];
    
    $id = intval ( $_GET ["id"] );
    $sql = "select id,time,last_time,title,content from `record_record` where `id` = '$id' limit 1";
    $result = mysql_query ( $sql, $conn );
     
    if ($result && $row = mysql_fetch_array ( $result )) {
        $data["id"] = $row['id'];
        $data["title"] = $row['title'];
        $data["time"] = $row['time'];
        $data["last_time"] = $row['last_time'];
        $data["content"] = $row['content'];
        $data["tags"] = getTags ($row['id']);
        
        $time = $data["time"];
    } else {
        return output(OUTPUT_ERROR, "非法操作");
    }

    
    $data["pre"] = array();
    $pre = &$data["pre"];

    $sql = "select id,time,last_time,title from `record_record`  where `time` > '$time' ORDER BY  `time` ASC  limit 0,1";
    $result = mysql_query ( $sql, $conn );
    if ($result && $row = mysql_fetch_array ( $result )) {
        $pre["id"] = $row ['id'];
        $pre["title"] = $row ['title'];
    }
    

    $data["next"] = array();
    $next = &$data["next"];
    
    $sql = "select id,time,last_time,title from `record_record` where `time` < '$time' ORDER BY  `time` DESC limit 0,1";
    $result = mysql_query ( $sql, $conn );
    if ($result && $row = mysql_fetch_array ( $result )) {
        $next["id"] = $row ['id'];
        $next["title"] = $row ['title'];
    }
    
    $retutnJson["code"] = 0;
    $retutnJson["message"] = "suc";
    return $retutnJson;
}
