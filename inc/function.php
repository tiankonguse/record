<?php

function getWriteInfo($username){
    global $conn;
    //操作数据库
    $username = mysql_real_escape_string($username);
    $sql = "select *  from `record_record` where lockauthor = '$username' order by  id ";
    $result = mysql_query($sql ,$conn);
    $row = mysql_fetch_array($result);
    if($row){
    }else{
        $time = time();
        $last_time = time();
        $sql = "insert into `record_record` (`title`,`time`,`content`, `last_time`, `author`, `lockauthor`) values('','$time','','$last_time', '$username', '$username')";
        mysql_query($sql ,$conn);

        $sql = "select *  from `record_record` where lockauthor = '$username' order by  id ";
        $result = mysql_query($sql ,$conn);

        $row = mysql_fetch_array($result);
    }
    $id = $row["id"];
    if(trim($row["content"]) == ""){
        $row["content"] = "<h2>
            声明
            </h2>
            <p>
            &nbsp; &nbsp;笔者最近意外的发现 笔者的个人网站<a href=\"http://tiankonguse.com/\" target=\"_blank\">&nbsp;http://tiankonguse.com/</a>&nbsp;的很多文章被其它网站转载，但是转载时未声明文章来源或参考自&nbsp;<a href=\"http://tiankonguse.com/\" target=\"_blank\">http://tiankonguse.com/</a> 网站，因此，笔者添加此条声明。
            </p>
            <p>
            &nbsp; &nbsp; 郑重声明：这篇记录《<a href=\"http://tiankonguse.com/record/record.php?id=$id\" target=\"_blank\">标题</a>》转载自&nbsp;<a href=\"http://tiankonguse.com/\" target=\"_blank\">http://tiankonguse.com/</a> 的这条记录：<a href=\"http://tiankonguse.com/record/record.php?id=$id\" target=\"_blank\">http://tiankonguse.com/record/record.php?id=$id</a>
            </p>
            <p>
            <br />
            </p>
            <h2>
            前言
            </h2>
            <p>
            <br />
            </p>
            <h2>
            正文
            </h2>
            <p>
            <br />
            </p>
            <h2>
            参考
            </h2>
            <p>
            <br />
            </p>
            ";
    } 

    return array(
        "id"=>$row["id"],
        "title"=>$row["title"],
        "content"=>$row["content"],
        "time"=>$row["time"]
    );
}

function getRecordNum(){
    global $conn;
    //操作数据库
    $sql = "select count(*) num from `record_record`";
    $result = mysql_query($sql ,$conn);
    $row= mysql_fetch_array($result);
    return $row['num'];
}
function getRecordNumByTagId($tagId){
    global $conn;
    $tagId = intval($tagId);
    //操作数据库
    $sql = "select count(*) num from `record_tag_map` where tag_id = '$tagId'";
    $result = mysql_query($sql ,$conn);
    $row= mysql_fetch_array($result);
    return $row['num'];
}

function getTagId($tag){
    global $conn;

    //操作数据库
    $tag = mysql_real_escape_string($_GET['tag']);
    $sql = "select id from `record_tag` where name = '$tag'";
    $result = mysql_query($sql ,$conn);
    $row= mysql_fetch_array($result);
    return $row['id'];
}

function initTagPage($tag, $pageSize){
    $_GET['pageSize'] = $pageSize;
    $tagId = getTagId($tag);
    $_GET['tagId'] = $tagId;

    $allPageNum = intval((getRecordNumByTagId($tagId) + $pageSize - 1) / $pageSize);
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

function checkLogin(){
    global $admin;
    global $username;
    if(isset($_SESSION['record_admin'])){
        $admin = $_SESSION['record_admin'];
        $username = $_SESSION['username'];
    }else{
        $admin = "";
    }
}

function login(){
    global $conn;
    if(isset($_POST['username']) && isset($_POST['password']) && isset($_SESSION['verifyCode'])){
        $username = mysql_real_escape_string($_POST['username']);
        $verifyCode = mysql_real_escape_string($_POST['verifyCode']);
        $password = sha1(SALT . $_POST['password']);

        $_verifyCode = $_SESSION['verifyCode'];

        $verifyCode = strtolower($verifyCode);
        $_verifyCode = strtolower($_verifyCode);

        if(strcmp($_verifyCode, $verifyCode) != 0){
            return output(OUTPUT_ERROR,"验证码不正确");        
        }else if($username == 'tiankonguse' && $password == 'dcd3eeb3b04e6d3fc4247bfec3a614ec86fe9db7' ){
            $_SESSION['record_admin'] = 'record_admin';
            $_SESSION['username'] = $username;
            return output(OUTPUT_SUCCESS,"");
        }else{
            return output(OUTPUT_ERROR,"你的用户名或密码不正确" );
        }
    }else{
        return output(OUTPUT_ERROR,"非法操作");
    }
}

function alter(){
    global $conn;

    $staic = array(513,609,610);

    if(isset($_POST['title']) && isset($_POST['time']) && isset($_POST['content'])){
        //获得表单数据
        $title    = $_POST['title'];
        $time     = $_POST['time'];
        $content  = $_POST['content'];
        $id = $_SESSION['record_id'];
        $tags     = $_POST['tags'];

        //检查表单数据是否合法
        if(strcmp($title,"") == 0 || strcmp($content,"") == 0){
            return  output(OUTPUT_ERROR,"表单填写不完整");
        }


        if(strcmp($time,"") != 0){
            //06/11/2013 00:00
            sscanf($time,"%d/%d/%d %d:%d",$month, $day, $year, $hour, $minute);
            $second = 0;
            $time = mktime($hour, $minute, $second ,$month ,$day, $year);
        }else{
            $time = time();
            $year = date("Y",$time);;
        }
        if(in_array($id, $staic)){
            $last_time = $time;
        }else{
            $last_time = time();
        }

        //防止sql注入
        $title   = mysql_real_escape_string($title);
        $content = mysql_real_escape_string($content);
        $tags = mysql_real_escape_string($tags);

        $tags = explode(",", $tags);

        //操作数据库
        $sql = "UPDATE `record_record` SET `title`= '$title',`content`= '$content',`time`= '$time', `last_time` = '$last_time' WHERE `id` = '$id'";

        $result = mysql_query($sql ,$conn);
        if($result){
            updateTags($id, $tags);
            return output(OUTPUT_SUCCESS, $id);
        }else{
            return output(OUTPUT_ERROR,"数据库操作失败，请联系管理员");
        }

    }else{
        return output(OUTPUT_ERROR,"非法操作");
    }
}


function write(){
    global $conn;
    if(isset($_POST['title']) && isset($_POST['time']) && isset($_POST['content']) && isset($_SESSION["record_id"]) ){
        //获得表单数据
        $title    = $_POST['title'];
        $time     = $_POST['time'];
        $content  = $_POST['content'];
        $tags     = $_POST['tags'];
        $id = $_SESSION['record_id'];

        //检查表单数据是否合法
        if(strcmp($title,"") == 0 || strcmp($content,"") == 0){
            return  output(OUTPUT_ERROR,"表单填写不完整");
        }

        if(strcmp($time,"") != 0){
            //06/11/2013 00:00
            sscanf($time,"%d/%d/%d %d:%d",$month, $day, $year, $hour, $minute);
            $second = 0;
            $time = mktime($hour, $minute, $second ,$month ,$day, $year);
        }else{
            $time = time();
            $year = date("Y",$time);
        }
        $last_time = time();



        //防止sql注入
        $title   = mysql_real_escape_string($title);
        $content = mysql_real_escape_string($content);
        $tags = mysql_real_escape_string($tags);

        $tags = explode(",", $tags);

        //操作数据库
        //$sql = "insert into `record_record` (`title`,`time`,`content`, `last_time`) values('$title','$time','$content','$last_time')";
        $sql = "UPDATE `record_record` SET `title`= '$title',`content`= '$content',`time`= '$time', `last_time` = '$last_time', lockauthor = '' WHERE `id` = '$id'";
        $result = mysql_query($sql ,$conn);
        if($result){
            //$sql = "select id from `record_record` where time = '$time' and title = '$title'";
            //$result = mysql_query($sql ,$conn);
            //$row= mysql_fetch_array($result);
            //$id = $row['id'];
            addTags($id, $tags);
            return output(OUTPUT_SUCCESS,$id);
        }else{
            return output(OUTPUT_ERROR,"数据库操作失败，请联系管理员");
        }
    }else{
        return output(OUTPUT_ERROR,"非法操作");
    }
}

function addTags($recordId, $tags){
    global $conn;

    foreach($tags as $key=>$name){
        $name = mysql_real_escape_string($name);
        $sql = "select id from `record_tag` where name = '$name'";
        $result = mysql_query($sql ,$conn);
        $row= mysql_fetch_array($result);

        $tagId = $row['id'];
        if(!$row){
            $sql = "INSERT INTO `record_tag`(`name`) VALUES ('$name')";
            mysql_query($sql ,$conn);

            $sql = "select id from `record_tag` where name = '$name'";
            $result = mysql_query($sql ,$conn);
            $row= mysql_fetch_array($result);
            $tagId = $row['id'];
        }


        $sql = "INSERT INTO `record_tag_map`(`tag_id`, `record_id`) VALUES ('$tagId','$recordId')";
        mysql_query($sql ,$conn);

        $sql = "update record_tag set number=numberr+1 where id in (select tag_id from record_tag_map where record_id = '$recordId')"; 
        mysql_query($sql ,$conn);
    }
}

function updateTags($recordId, $tags){
    global $conn;

    $recordId = intval($recordId);
    $sql = "update record_tag set number=number-1 where id in (select tag_id from record_tag_map where record_id = '$recordId')"; 
    mysql_query($sql ,$conn);


    $sql = "delete from `record_tag_map` where record_id = '$recordId' ";
    mysql_query($sql ,$conn);

    addTags($recordId, $tags);
}

function getTags($recordId){
    global $conn;
    $recordId = intval($recordId);
    $sql = "select name from `record_tag` where id in (select tag_id from record_tag_map where record_id = '$recordId')";
    $result = mysql_query($sql ,$conn);
    $res = array();
    while($row= mysql_fetch_array($result)){
        $res[] = $row["name"];
    }
    return $res;
}

function getAllTags(){
    global $conn;
    $sql = "select name from `record_tag`";
    $result = mysql_query($sql ,$conn);
    $res = array();
    while($row= mysql_fetch_array($result)){
        $res[] = $row["name"];
    }
    return $res;
}



function delete(){
    global $conn;

}

function autoSave(){
    global $conn;
    if(isset($_POST['title']) && isset($_POST['content'])){
        //获得表单数据
        $title    = $_POST['title'];
        $content  = $_POST['content'];
        $id = $_SESSION['record_id'];

        //防止sql注入
        $title   = mysql_real_escape_string($title);
        $content = mysql_real_escape_string($content);

        $sql = "UPDATE `record_record` SET `title`= '$title',`content`= '$content' WHERE `id` = '$id'";
        $result = mysql_query($sql ,$conn);
        if($result){
            return output(OUTPUT_SUCCESS,$id);
        }else{
            return output(OUTPUT_ERROR,"数据库操作失败，请联系管理员");
        }
    }else{
        return output(OUTPUT_ERROR,"非法操作");
    }
}

?>
