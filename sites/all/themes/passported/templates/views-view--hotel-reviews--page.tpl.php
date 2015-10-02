<?php
$arg = request_uri();
if (strpos($arg, 'hotel-reviews') !== false){
    $uri = str_replace('hotel-reviews', 'city-guide', $arg);
    $dest = ltrim($uri, '/');
    drupal_goto($dest);
}
?>