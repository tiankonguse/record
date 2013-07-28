<?php
session_start();
$num = 4;
$width = $num *10 + 5;
$height = 28;

$str = "23456789abcdefghijkmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVW";

$verifyCode = '';
for ($i = 0; $i < $num; $i++) {
	$verifyCode .= $str[mt_rand(0, strlen($str)-1)];
}
$_SESSION['verifyCode'] = $verifyCode;

header ('Content-Type: image/png');
$im = imagecreatetruecolor($width, $height);

// 定义要用到的颜色
$back_color = imagecolorallocate($im, 235, 236, 237);
$boer_color = imagecolorallocate($im, 118, 151, 199);
$text_color = imagecolorallocate($im, mt_rand(0, 200), mt_rand(0, 120), mt_rand(0, 120));

// 画背景
imagefilledrectangle($im, 0, 0, $width, $height, $back_color);

// 画边框
imagerectangle($im, 0, 0, $width-1, $height-1, $boer_color);

// 画干扰线
for($i = 0;$i < 5;$i++) {
	$font_color = imagecolorallocate($im, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255));
	imagearc($im, mt_rand(- $width, $width), mt_rand(- $height, $height), mt_rand(30, $width * 2), mt_rand(20, $height * 2), mt_rand(0, 360), mt_rand(0, 360), $font_color);
}

for($i = 0;$i<50;$i++){
	$font_color = imagecolorallocate($im, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255));
	imagesetpixel($im, mt_rand(0,$width),mt_rand(0,$height),$font_color);
}

imagestring($im, 5, 5, 6,  $verifyCode, $text_color);
imagepng($im);
imagedestroy($im);

?>

