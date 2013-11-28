<?php
session_start ();

require ("../inc/common.php");
require ("../inc/function.php");
initPage ( 30 );

header ('Content-Type: text/xml');
$nowPage = $_GET ['nowPage'];
$allPageNum = $_GET ['allPageNum'];
$pageSize = $_GET ['pageSize'];
$baseurl = MAIN_DOMAIN . "record.php";

$feed .= "<?xml version=\"1.0\" encoding=\"utf-8\" ?>\n";

$feed .= "<?xml-stylesheet type=\"text/xsl\" title=\"XSL Formatting\" href=\"feed.xsl\" media=\"all\" ?>";
$feed .= "<rss version=\"2.0\" >\n";
$feed .= "<channel>\n";
$feed .= "<title>tiankonguse的记录</title>\n";
$feed .= "<image>\n<link>http://tiankonguse.com/record/</link>\n<url>http://tiankonguse.com/common/img/logo.png</url>\n</image>\n";
$feed .= "<description>牛奶会有的，面包会有的. </description>\n";
$feed .= "<link>http://tiankonguse.com/record/</link>\n";
$feed .= "<language>zh-CN</language>\n";;


$sql = "select * from `record_record`  ORDER BY  `time` DESC LIMIT " . ($nowPage - 1) * $pageSize . " , $pageSize";
$result = mysql_query ( $sql, $conn );
while ( $row = @mysql_fetch_array ( $result ) ) {
	$id = $row ['id'];
	// htmlspecialchars
	$title = (getDateFromMysql ( $row ['title'] ));
	$time = date ( "Y-m-d H:i:s", $row ['time'] );
	$content = (getDateFromMysql ( $row ['content'] ));
	$feed .= "<item>\n";
	$feed .= "<title><![CDATA[$title]]></title>\n";
	$feed .= "<link>$baseurl?id=$id</link>\n";
	$feed .= "<guid>$baseurl?id=$id</guid>\n";
	$feed .= "<author>tiankonguse</author>\n";
	$feed .= "<pubDate>$time</pubDate>\n";
	$feed .= "<description><![CDATA[\n $content \n]]></description>\n";

	$tags = getTags ( $id );
	foreach ( $tags as $key => $val ) {
		$feed .= "<category><![CDATA[$val]]></category>\n";
	}
	
	$feed .= "</item>\n";
}

$feed .= "</channel>\n";
$feed .= "</rss>\n";

echo $feed;

?>