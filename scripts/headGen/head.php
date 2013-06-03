<?php

error_reporting(0);

$hotel = $_GET['hotel'];
$habbo = $_GET['habbo'];

$domains = array(
                  "AU" => ".com.au",
                  "UK" => ".co.uk",
                  "CA" => ".com.ca",                  
                  "US" => ".com",
                  "SG" => ".com.sg"
                 );

$url  = "http://www.habbo".$domains[$hotel];
$url .= "/habbo-imaging/avatarimage?user={$habbo}";
$url .= "&action=non";
$url .= "&direction=3";
$url .= "&head_direction=3";
$url .= "&gesture=non";
$url .= "&size=1";
$url .= "&img_format=gif";

if (!isset($habbo)|| !isset($hotel))
{
  echo "Error: You must enter all fields.";
}

elseif (!array_key_exists($hotel, $domains))
{
  echo "Error: That hotel isn't supported.";
}

elseif (!file_get_contents($url, 0, NULL, "0", 10))
{
  echo "Error: That habbo does not exist.";
}

else
{
  $habbo = imagecreatefromgif($url);
  $head = imagecreatefromgif("./head.gif");
  $patch = imagecreatefromgif("./patch.gif");

  $white = imagecolorallocate($head, 255, 255, 255);
  $purple = imagecolorallocate($head, 200, 0, 200);

  imagefilledrectangle($head, 0, 0, 55, 50, $purple);

  imagecopy($head, $habbo, 0, 0, 5, 7, 64, 110);
  imagecopy($head, $patch, 13, 43, 0, 0, 31, 7);

  imagecolortransparent($head, $purple);

  header("Content-type: image/gif");
  imagegif($head);
}

?>