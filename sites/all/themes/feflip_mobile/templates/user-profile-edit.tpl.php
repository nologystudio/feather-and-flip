<?php
$params = drupal_get_query_parameters();
$options = array('query' => $params);
drupal_goto('<front>', $options);
exit();
?>