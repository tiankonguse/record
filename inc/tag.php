<div class="filter-box">
    <div class="container-tag">
        <nav class="view-mode">
            <h3>查看模式</h3>
            <ul>
            <li class="thumbs <?php if(isset($style) && strcmp($style, "grid") == 0){echo "on"; }?>" data-rel="thumbs"><a href="<?php echo MAIN_DOMAIN."index_grid.php"?>">缩略图</a>
                </li>
                <li class="list <?php if(isset($style)  && strcmp($style, "list") == 0){echo "on"; }?>" data-rel="list"><a href="<?php echo MAIN_DOMAIN?>">列表</a>
                </li>
            </ul>
        </nav>

        <ul class="view-tags clearfix" >

<?php 
$sql = "select id, name from record_tag ORDER BY `record_tag`.`number`  DESC limit 0,15";
$result = mysql_query($sql ,$conn);
while($row= mysql_fetch_array($result)){
?>
            <li class="<?php if(isset($tag) && strcmp($tag,$row["name"]) == 0){echo "on";}?>"><a href="<?php echo MAIN_DOMAIN."search.php?tag=".$row['name'];?>"  title="" rel=""><?php echo $row["name"];?></a></li>
<?php
}
?> 
        </ul>
    </div>
</div>
