<?php

/**
 * @file
 * The PHP page that serves all page requests on a Drupal installation.
 *
 * The routines here dispatch control to the appropriate handler, which then
 * prints the appropriate page.
 *
 * All Drupal code is released under the GNU General Public License.
 * See COPYRIGHT.txt and LICENSE.txt.
 */

/**
 * Root directory of Drupal installation.
 */
define('DRUPAL_ROOT', getcwd());

require_once DRUPAL_ROOT . '/includes/bootstrap.inc';
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);

/*
*	Redirect if mobile
*/
$detect = mobile_detect_get_object();
$is_mobile = $detect->isMobile();
if ($is_mobile && $_SERVER['HTTP_HOST'] != 'm.passported.com') {
  header('Location: http://m.passported.com'.$_SERVER['REQUEST_URI']);
  exit();
}
if (!$is_mobile && $_SERVER['HTTP_HOST'] == 'm.passported.com') {
  header('Location: http://www.passported.com'.$_SERVER['REQUEST_URI']);
  exit();
}

menu_execute_active_handler();
