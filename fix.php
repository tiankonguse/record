<?php
ignore_user_abort (); // 关掉浏览器，PHP脚本也可以继续执行.
set_time_limit ( 0 ); // 通过set_time_limit(0)可以让程序无限制的执行下去
ini_set ( "display_errors", 1 );
ini_set ( "error_reporting", E_ALL );
session_start ();
require ("../common/inc/init.php");

$flag = 2;

/*
 * 为 record 添加了最后修改时间字段
 */

if ($flag == 0) {
} else if ($flag == 1) {
	/*
	 * 由于为 tag 添加了一个数量的字段，所以写了一个自动更新的SQL 语句。
	 */
} else if ($flag == 2) {
	// 先把所有的tag写到wp
	
	fix_record_to_wp ();
	
	//
	// wp_terms(term_id, name, slug)
	// auto 'name' urldecode 0
	//
	//
	// wp_term_taxonomy
	// (term_taxonomy_id, term_id, taxonomy, count)
	// auto term_id "post_tag" number
	//
	// wp_term_relationships(object_id, term_taxonomy_id, term_order)
	// post_id term_taxonomy_id 0
	//
	// wp_posts(post_author, post_date, post_date_gmt, post_content, post_titlepost_modified, post_modified_gmt
	//
} else if ($flag == 3) {
} else if ($flag == 4) {
} else {
}

echo "finish \n";
function fix_record_to_wp() {
	global $conn;
	$result_record = mysql_query ( "select id, title, content, time, last_time from record_record", $conn );
	while ( $row_record = mysql_fetch_array ( $result_record ) ) {
		$record_id = $row_record ["id"];
		$record_title = $row_record ["title"];
		$record_content = $row_record ["content"];
		$record_time = $row_record ["time"];
		$record_last_time = $row_record ["last_time"];
		
		var_dump ( "$record_title begin", "<br>" );
		
		$dtms = new DateTime ();
		
		$wp_post_author = "1";
		$wp_post_date = $dtms->setTimestamp ( $record_time )->format ( "Y-m-d H:i:s.000000" );
		$wp_post_date_gmt = gmdate ( "Y-m-d H:i:s.000000", $record_time );
		$wp_post_content = mysql_real_escape_string ( $record_content );
		$wp_post_title = mysql_real_escape_string ( $record_title );
		$wp_post_name = urlencode ( $wp_post_title );
		$wp_post_modified = $dtms->setTimestamp ( $record_last_time )->format ( "Y-m-d H:i:s.000000" );
		$wp_post_modified_gmt = gmdate ( "Y-m-d H:i:s.000000", $record_last_time );
		
		var_dump ( "begin select $record_title from wp_posts", "<br>" );
		
		$result_post = mysql_query ( "select * from wp_posts where post_title = '" . $wp_post_title . "'", $conn );
		if ($row_post = mysql_fetch_array ( $result_post )) {
			$wp_post_id = $row_post ["ID"];
			var_dump ( "find $record_title, id is $wp_post_id ,content length is " . strlen ( $row_post ["post_content"] ), "<br>" );
			if (strcmp ( $row_post ["post_content"], "" ) == 0) {
				$sql = "update wp_posts set post_content = '" . $wp_post_content . "', post_name = '" . $wp_post_name . "' and guid = 'http://tiankonguse.com/blog/?p=$wp_post_id' where ID = '" . $wp_post_id . "'";
				$ret = mysql_query ( $sql, $conn );
			}
		} else {
			mysql_query ( "INSERT INTO wp_posts(post_author, post_date, post_date_gmt, post_content, post_title, post_modified, post_modified_gmt) VALUES('" . $wp_post_author . "','" . $wp_post_date . "','" . $wp_post_date_gmt . "','" . $wp_post_content . "','" . $wp_post_title . "','" . $wp_post_modified . "','“.$wp_post_modified_gmt.”')", $conn );
			var_dump ( "insert " . $record_title, "<br>" );
			$wp_post_id = mysql_insert_id ();
		}
		
		add_record_tags_to_wp ( $wp_post_id, $record_id );
	}
}
function add_record_tags_to_wp($wp_post_id, $record_id) {
	global $conn;
	var_dump ( "begin select " . $record_id . " 's tags to " . $wp_post_id, "<br>" );
	$result_tag_name = mysql_query ( "select name, number from record_tag where id in (select tag_id from record_tag_map where record_id = '" . $record_id . "')", $conn );
	while ( $row = mysql_fetch_array ( $result_tag_name ) ) {
		if (strcmp ( $row ["name"], "" ) != 0) {
			var_dump ( "find a tag:" . $row ["name"] . " number:" . $row ["number"], "<br>" );
			$wp_taxonomy_id = get_wp_taxonomy_id ( $row ["name"], $row ["number"] );
			var_dump ( "find wp_taxonomy_id:" . $wp_taxonomy_id, "<br>" );
			wp_map_taxonomy_post ( $wp_post_id, $wp_taxonomy_id );
		}
	}
}
function wp_map_taxonomy_post($wp_post_id, $wp_taxonomy_id) {
	global $conn;
	$result = mysql_query ( "select * from wp_term_relationships where object_id = '" . $wp_post_id . "' and term_taxonomy_id = '" . $wp_taxonomy_id . "'", $conn );
	if (mysql_num_rows ( $result ) == 0) {
		mysql_query ( "INSERT INTO wp_term_relationships(object_id, term_taxonomy_id)VALUES ('" . $wp_post_id . "', '" . $wp_taxonomy_id . "')", $conn );
	}
}
function get_wp_taxonomy_id($tag_name, $count) {
	global $conn;
	$term_id = get_wp_term_id ( $tag_name );
	var_dump ( "get_wp_taxonomy_id get tag $tag_name 's id : $term_id", "<br>" );
	
	// 查看 term_taxonomy_id, 没有则插入新的记录
	
	$result_taxonomy = mysql_query ( "select * from wp_term_taxonomy where term_id = '" . $term_id . "' and taxonomy = 'post_tag'", $conn );
	
	if ($row_terms = mysql_fetch_array ( $result_taxonomy )) {
		$term_taxonomy_id = $row_terms ["term_taxonomy_id"];
	} else {
		mysql_query ( "INSERT INTO wp_term_taxonomy(term_id, taxonomy, count) VALUES ('" . $term_id . "', 'post_tag', '" . $count . "')", $conn );
		
		$term_taxonomy_id = mysql_insert_id ();
	}
	return $term_taxonomy_id;
}
function get_wp_term_id($tag_name) {
	global $conn;
	$slug = urlencode ( $tag_name );
	$slug = mysql_real_escape_string ( $slug );
	$tag_name = mysql_real_escape_string ( $tag_name );
	// 得到 term_id, 没有则插入新的记录。
	var_dump ( "tag_name:" . $tag_name . " slug:" . $slug, "<br>" );
	
	$result_terms = mysql_query ( "select * from wp_terms where name = '" . $tag_name . "'", $conn );
	
	if ($row_terms = mysql_fetch_array ( $result_terms )) {
		$term_id = $row_terms ["term_id"];
		var_dump ( "得到term_id " . $term_id . ", 没有则插入新的记录", "<br>" );
	} else {
		var_dump ( $slug . "： " . $tag_name, "<br>" );
		$sql = "INSERT INTO wp_terms(name, slug) VALUES ('" . $tag_name . "', '" . $slug . "')";
		$result = mysql_query ( $sql, $conn );
		$term_id = mysql_insert_id ();
		var_dump ( "未的到term_id " . $term_id . ", 插入新的记录", "<br>" );
	}
	return $term_id;
}
