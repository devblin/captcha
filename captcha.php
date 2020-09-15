<?php
session_start();

$randCode = md5(rand());

$code = substr($randCode, 0, 6);

$_SESSION['code'] = $code;

header('Content-Type: image/png');
$image = imagecreatetruecolor(200, 38);
$bg_color = imagecolorallocate($image, 214, 200, 230);

$text_color = imagecolorallocate($image, 0, 0, 0);

imagefilledrectangle($image, 0, 0, 200, 38, $bg_color);
$font_fam  = __DIR__ . "/Roboto-Regular.ttf";
$angle = rand(-2, 10);
imagettftext($image, 20, $angle, 60, 35, $text_color, $font_fam, $code);
$pixel = imagecolorallocate($image, 0, 0, 0);
for ($i = 0; $i < 1000; $i++) {
    imagesetpixel($image, rand() % 200, rand() % 50, $pixel);
}
$line = imagecolorallocate($image, 17, 18, 195);
for ($i = 0; $i < 12; $i++) {
    imageline($image, rand(0, 200), rand(0, 38), rand(0, 200), rand(0, 38), $line);
}
imagepng($image);
imagedestroy($image);