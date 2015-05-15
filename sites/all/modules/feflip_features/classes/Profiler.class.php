<?php

class Profiler {
  protected $timersOpen;
  protected $timersClosed;
  static protected $_singleton;

  function __construct() {
    $this->timers = [];
  }

  /**
   * @return Profiler
   */
  private static function singleton() {
    if (!isset(self::$_singleton)) {
      self::$_singleton = new self();
    }
    return self::$_singleton;
  }

  static function startTimer($identifier) {
    $me = self::singleton();
    if (!isset($me->timersOpen[$identifier])) {
      $me->timersOpen[$identifier] = microtime(TRUE);
    }
  }

  static function stopTimer($identifier) {
    $me = self::singleton();
    if (isset($me->timersOpen[$identifier])) {
      $me->timersClosed[$identifier] = microtime(TRUE) - $me->timersOpen[$identifier];
      unset($me->timersOpen[$identifier]);
    }
  }

  static function generateResults() {
    $me = self::singleton();
    $result = '<ul>';
    foreach ($me->timersClosed as $key => $resultTimer) {
      $result .= '<li>' . $key . ' => ' . $resultTimer . '</li>';
    }
    $result .= '</ul>';
    return $result;
  }
}