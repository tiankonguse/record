<?php
session_start ();

require ("../inc/common.php");
require ("../inc/function.php");
initPage ( 30 );

header ('Content-Type: text/xml; charset=UTF-8');
$nowPage = $_GET ['nowPage'];
$allPageNum = $_GET ['allPageNum'];
$pageSize = $_GET ['pageSize'];
$baseurl = MAIN_DOMAIN . "record.php";

$feed = "<?xml version=\"1.0\" encoding=\"utf-8\" ?>\n";

$feed .= "<?xml-stylesheet type=\"text/xsl\" title=\"XSL Formatting\" href=\"feed.xsl\" media=\"all\" ?>\n";
$feed .= "<rss xmlns:content=\"http://purl.org/rss/1.0/modules/content/\" xmlns:wfw=\"http://wellformedweb.org/CommentAPI/\" xmlns:dc=\"http://purl.org/dc/elements/1.1/\" xmlns:atom=\"http://www.w3.org/2005/Atom\" xmlns:sy=\"http://purl.org/rss/1.0/modules/syndication/\" xmlns:slash=\"http://purl.org/rss/1.0/modules/slash/\" version=\"2.0\" >\n";
$feed .= "<channel>\n";
$feed .= "<title><![CDATA[tiankonguse的记录]]></title>\n";
$feed .= "<atom:link href=\"http://tiankonguse.com/record/feed/\" rel=\"self\" type=\"application/rss+xml\"/>\n";
$feed .= "<image>\n<link>http://tiankonguse.com/record/</link>\n<url>http://tiankonguse.com/common/img/logo.png</url>\n<title><![CDATA[tiankonguse的记录]]></title>\n</image>\n";
$feed .= "<description><![CDATA[牛奶会有的，面包会有的. ]]></description>\n";
$feed .= "<link>http://tiankonguse.com/record/</link>\n";
$feed .= "<language>zh-CN</language>\n";;


$sql = "select * from `record_record`  ORDER BY  `time` DESC LIMIT " . ($nowPage - 1) * $pageSize . " , $pageSize";
$result = mysql_query ( $sql, $conn );
while ( $row = @mysql_fetch_array ( $result ) ) {
	$id = $row ['id'];
	// htmlspecialchars
	$title = (getDateFromMysql ( $row ['title'] ));
	//$time = date ( "Y-m-d H:i:s", $row ['time'] );
	$time = date ( DateTime::RFC2822 , $row ['time'] );
	$content = (getDateFromMysql ( $row ['content'] ));
	$feed .= "<item>\n";
	$feed .= "<title><![CDATA[$title]]></title>\n";
	$feed .= "<link>$baseurl?id=$id</link>\n";
	$feed .= "<comments>$baseurl?id=$id#disqus_thread</comments>\n";
	$feed .= "<guid>$baseurl?id=$id</guid>\n";
	//$feed .= "<author><![CDATA[tiankonguse]]></author>\n";
	$feed .= "<dc:creator><![CDATA[tiankonguse]]></dc:creator>\n";
	$feed .= "<pubDate>$time</pubDate>\n";
	$feed .= "<description><![CDATA[ \n $content \n ]]> </description>\n";

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
