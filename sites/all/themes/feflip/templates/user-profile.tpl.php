<?php
drupal_goto('<front>');
exit();

include 'slideshowandmainmenu.html.php';?>

<?php if(isset($user_profile['summary']['member_for'])) echo $user_profile['summary']['member_for']['#title'] . ': '. $user_profile['summary']['member_for']['#markup'];?>
<br>
Usuario: <?php echo $user->name; ?><br>
Mail: <?php echo $user->mail;?><br>
First name: <?php if(isset($loadUser->field_first_name['und'][0]['value'])) echo $loadUser->field_first_name['und'][0]['value']; ?><br>
Last name: <?php if(isset($loadUser->field_last_name['und'][0]['value'])) echo $loadUser->field_last_name['und'][0]['value']; ?><br>