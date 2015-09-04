<?php

/**
 * @file
 * Default template for HTML Mail
 *
 * DO NOT EDIT THIS FILE. Copy it to your theme directory, and edit the copy.
 *
 * ========================================================= Begin instructions.
 *
 * When formatting an email message with a given $module and $key, [1]HTML
 * Mail will use the first template file it finds from the following list:
 *  1. htmlmail--$module--$key.tpl.php
 *  2. htmlmail--$module.tpl.php
 *  3. htmlmail.tpl.php
 *
 * For each filename, [2]HTML Mail looks first in the chosen Email theme
 * directory, then in its own module directory, before proceeding to the
 * next filename.
 *
 * For example, if example_module sends mail with:
 * drupal_mail("example_module", "outgoing_message" ...)
 *
 *
 * the possible template file names would be:
 *  1. htmlmail--example_module--outgoing_message.tpl.php
 *  2. htmlmail--example_module.tpl.php
 *  3. htmlmail.tpl.php
 *
 * Template files are cached, so remember to clear the cache by visiting
 * admin/config/development/performance after changing any .tpl.php files.
 *
 * The following variables available in this template:
 *
 * $body
 *        The message body text.
 *
 * $module
 *        The first argument to [3]drupal_mail(), which is, by convention,
 *        the machine-readable name of the sending module.
 *
 * $key
 *        The second argument to [4]drupal_mail(), which should give some
 *        indication of why this email is being sent.
 *
 * $message_id
 *        The email message id, which should be equal to
 *        "{$module}_{$key}".
 *
 * $headers
 *        An array of email (name => value) pairs.
 *
 * $from
 *        The configured sender address.
 *
 * $to
 *        The recipient email address.
 *
 * $subject
 *        The message subject line.
 *
 * $body
 *        The formatted message body.
 *
 * $language
 *        The language object for this message.
 *
 * $params
 *        Any module-specific parameters.
 *
 * $template_name
 *        The basename of the active template.
 *
 * $template_path
 *        The relative path to the template directory.
 *
 * $template_url
 *        The absolute URL to the template directory.
 *
 * $theme
 *        The name of the Email theme used to hold template files. If the
 *        [5]Echo module is enabled this theme will also be used to
 *        transform the message body into a fully-themed webpage.
 *
 * $theme_path
 *        The relative path to the selected Email theme directory.
 *
 * $theme_url
 *        The absolute URL to the selected Email theme directory.
 *
 * $debug
 *        TRUE to add some useful debugging info to the bottom of the
 *        message.
 *
 * Other modules may also add or modify theme variables by implementing a
 * MODULENAME_preprocess_htmlmail(&$variables) [6]hook function.
 *
 * References
 *
 * 1. http://drupal.org/project/htmlmail
 * 2. http://drupal.org/project/htmlmail
 * 3. http://api.drupal.org/api/drupal/includes--mail.inc/function/drupal_mail/7
 * 4. http://api.drupal.org/api/drupal/includes--mail.inc/function/drupal_mail/7
 * 5. http://drupal.org/project/echo
 * 6. http://api.drupal.org/api/drupal/modules--system--theme.api.php/function/hook_preprocess_HOOK/7
 *
 * =========================================================== End instructions.
 */ ?>
<div style="width:100%; height:100%; float: left; background-color:#d9dfdE;">
<table style="width:600px; margin:auto; font-family: Times,serif; padding:0; border-collapse:collapse;" align="center">
  <tr style="height: 20px;"></tr>
  <tr align="center">
    <td valign="top" style="padding:0; margin:0">
      <img style="width:300px; margin: auto;" src="//ds9464c56tfjs.cloudfront.net/media/passported-black-logo.png"/>
    </td>
  </tr>
  <tr style="height: 20px; border-bottom:dotted 1px #333333;"><td></td></tr>
  <!--<tr style="height: 20px; border-top:solid 1px #333333; ">
    <td style="padding:10px; margin:0; font-size:22px; font-style: italic; color:#333333; font-weight:bold; text-align: center;">
      <?php echo $params['account']->mail; ?>
    </td>
  </tr>
  <tr>
    <td style="padding:0px; margin:0px; font-size:18px; color:#333333; font-weight:bold; text-align: left; border-bottom:dotted 1px #333333;"></td>
  </tr>-->
  <tr>
    <td style="padding: 0; padding-top:20px; margin:0; font-family: Arial,sans-serif; font-size:16px; color:#333333; line-height: 22px; text-align: left ">
      <p style="color:#333333 !important;">A request to reset the password for your account has been made at PASSPORTED.<br>
        You may now log in by clicking this link or copying and pasting it to your browser:<br>
        <a style="color:#333333; text-decoration: none; font-style: normal; font-weight: bold;" href="<?php echo $body; ?>"><?php echo $body; ?></a><br>
        This link can only be used once to log in and will lead you to a page where you can set your password. It expires after one day and nothing will happen if it's not used.
      </p>
    </td>
  </tr>
  <tr>
    <td style="padding-bottom:20px; margin:0; font-size:16px; border-bottom:dotted 1px #333333; color:#333333; font-family: Times,serif; font-style: italic; line-height: 22px; text-align: left ">
      <p>PASSPORTED team</p>
    </td>
  </tr>
  <tr style="height: 20px;">
    <td style="border-top:solid 1px #333333;"></td>
  </tr>
  <tr align="center">
    <td style="padding:20px; margin:0; font-size:16px;font-family: Arial,sans-serif; color:#333333; line-height: 22px; text-align: center " align="center">
      <a href="http://www.passported.com" style="text-decoration: none; text-align: center; font-size: 12px; text-transform: uppercase; padding: 20px; background-color: #333333; color: white;">Go to Passported</a>
    </td>
  </tr>
  <tr style="height: 50px;"></tr>
</table>
</div>