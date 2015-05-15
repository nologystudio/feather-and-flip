<?php

class Lock {

  /**
   * @param string $key unique key name of the mutex
   * @param int $time time to open the mutex in seconds. Default 2 minutes
   * @return bool TRUE if mutex is opened, FALSE otherwise
   */
  public static function openAndLock($key, $time = 120) {
    $result = FALSE;
    if ($memcache = self::openConnection()) {
      if (!$memcache->get($key)) {
        $result = $memcache->set($key, '<enabled>1</enabled>', FALSE, $time);
      }
    }
    return $result;
  }

  private static function openConnection() {
    try {
      $memcache = new Memcache;
      $memcache->connect(Env::MEMCACHE_GENERAL_HOST, Env::MEMCACHE_GENERAL_PORT);
      $result = $memcache;
    }
    catch (Exception $e) {
      watchdog('Lock', 'Error trying to open connection to memcache. Exception: ' . $e);
      $result = FALSE;
    }
    return $result;
  }
}