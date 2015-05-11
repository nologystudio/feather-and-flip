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
if (Helpers::get_device_type() != 'desktop') {
  //header('Location: http://m.featherandflip.com');
  //exit();
}

menu_execute_active_handler();


//watchdog('Index.php', 'Probando graylog2', array(), $data, WATCHDOG_INFO);
//error_log('Testtttt- error_log');
//echo '<h1>Result profiler:</h1>' . Profiler::generateResults().'<br/><br/><br/>';