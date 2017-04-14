<?php
session_start();
require("./inc/common.php");

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

function getRecordNum(){
    global $conn;
    //操作数据库
    $sql = "select count(*) num from tk_blog";
    $result = mysql_query($sql ,$conn);
    $row= mysql_fetch_array($result);
    return intval($row['num']);
}

function initPage($pageSize){
    $_GET['pageSize'] = $pageSize;

    $_GET['allPostNum'] = getRecordNum();
    $allPageNum = intval(($_GET['allPostNum'] + $pageSize - 1) / $pageSize);
    $_GET['allPageNum'] = $allPageNum;

    $nowPage = 1;
    if(isset($_GET['nowPage'])){
        $nowPage = intval($_GET['nowPage']);
    }
    if($nowPage <= 0){
        $nowPage = 1;
    }else if($nowPage > $allPageNum){
        $nowPage = $allPageNum;
    }
    $_GET['nowPage'] = $nowPage;
    $_GET['offset'] = ($nowPage - 1) * $pageSize;
    
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
    $sql = "select tk_blog_key id,UNIX_TIMESTAMP(tk_blog_datetime) time,tk_blog_title title from `tk_blog` ORDER BY tk_blog_datetime DESC LIMIT $offset , $pageSize";
    $result = mysql_query($sql ,$conn);
    if(!$result){
        return output(OUTPUT_ERROR, "非法操作");
    }
    
    
    
    $data["list"] = array();
    $list = &$data["list"];

    while($row=mysql_fetch_array($result)){
        $item = array();
        $item["id"] = $row['id'];
        $item["time"] = intval($row['time']);
        $item["title"] = $row['title'];
        
        $list[] = $item;
    }
    
    $retutnJson["code"] = 0;
    $retutnJson["message"] = "suc";
    return $retutnJson;
}

function getPostData(){
    global $conn;
    
    if(!isset($_GET["id"])){
        return output(OUTPUT_ERROR, "非法操作");
    }
    
    $retutnJson = array();
    $retutnJson["data"] = array();
    $data = &$retutnJson["data"];
    
    $id =  mysql_real_escape_string( $_GET ["id"] );
    $sql = "select tk_blog_key id,UNIX_TIMESTAMP(tk_blog_datetime) time,tk_blog_title title,tk_blog_content content from `tk_blog` where `tk_blog_key` = '$id' limit 1";
    $result = mysql_query ( $sql, $conn );
     
    if ($result && $row = mysql_fetch_array ( $result )) {
        $data["id"] = $row['id'];
        $data["title"] = $row['title'];
        $data["time"] = intval($row['time']);
        $data["content"] = $row['content'];
        $data["tags"] = array();
        
        $time = $data["time"];
    } else {
        return output(OUTPUT_ERROR, "非法操作");
    }

    
    $data["pre"] = array();
    $pre = &$data["pre"];

    $sql = "select tk_blog_key id,tk_blog_datetime time,tk_blog_title title from `tk_blog`  where `tk_blog_datetime` > FROM_UNIXTIME('$time') ORDER BY  `tk_blog_datetime` ASC  limit 0,1";
    $result = mysql_query ( $sql, $conn );
    if ($result && $row = mysql_fetch_array ( $result )) {
        $pre["id"] = $row ['id'];
        $pre["title"] = $row ['title'];
    }
    

    $data["next"] = array();
    $next = &$data["next"];
    
    $sql = "select tk_blog_key id,tk_blog_datetime time,tk_blog_title title from `tk_blog` where `tk_blog_datetime` < FROM_UNIXTIME('$time') ORDER BY  `tk_blog_datetime` DESC limit 0,1";
    $result = mysql_query ( $sql, $conn );
    if ($result && $row = mysql_fetch_array ( $result )) {
        $next["id"] = $row ['id'];
        $next["title"] = $row ['title'];
    }
    
    $retutnJson["code"] = 0;
    $retutnJson["message"] = "suc";
    return $retutnJson;
}
