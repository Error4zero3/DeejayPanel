<center>

<?php
error_reporting(0);

$domains = array(
                  "AU" => ".com.au",
                  "UK" => ".co.uk",
                  "CA" => ".com.ca",                  
                  "US" => ".com",
                  "SG" => ".com.sg"
                 );

$hotels = array(
                  "AU" => "Australia",
                  "UK" => "United Kingdom",
                  "CA" => "Canada",                  
                  "US" => "United States",
                  "SG" => "Singapore"
                 );

if (isset($_POST['render']))
{
  extract($_POST);

  $url  = "http://www.habbo".$domains[$hotel];
  $url .= "/habbo-imaging/avatarimage?user={$habbo}";
  $url .= "&action=sit";
  $url .= "&direction=4";
  $url .= "&head_direction=3";
  $url .= "&gesture=sml";
  $url .= "&size=1";
  $url .= "&img_format=gif";

  if (!isset($habbo)|| !isset($hotel))
  {
    $error = "Error: You must enter all fields.";
  }
  
  elseif (!array_key_exists($hotel, $domains))
  {
    $error = "Error: That hotel isn't supported.";
  }
  
  elseif (!file_get_contents($url, 0, NULL, "0", 10))
  {
    $error = "Error: That habbo does not exist.";
  }

  else
  {
    $error = "<img src=\"head.php?habbo={$_POST['habbo']}&amp;hotel={$_POST['hotel']}\" alt=\"\" />";
  }
}

if (isset($error))
{
  echo $error."<br />\n";
}
?>

<form method="post">
  <label>Habbo:</label>
  <input name="habbo" type="text" /><br />

  <label>Hotel:</label>
  <select name="hotel">
<?php
foreach ($hotels as $key => $value)
{
  echo "      <option value=\"$key\">$value</option>\n";
}
?>
    </select><br />

    <input type="submit" name="render" value="Submit" />
</form>
</center>