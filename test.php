<?php 
$title= 'ubuntu里home目录里的"桌面"等目录改成英文';
echo str_replace( array("\""," ","<",">","&"), array("&quot;","&nbsp;","&lt;","&gt;","&amp;"),$title);
echo "<br>";
$t = mb_convert_encoding ($title, "HTML-ENTITIES");
echo "<a href=\"#\" title=\"$t\">$title</a>";
?>