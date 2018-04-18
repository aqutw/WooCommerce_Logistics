<?php
/**
 * Save debug log
 * @param  string $content Log content
 * @return integer
 */
function save_debug_log($content = '')
{
    $logPath = '/tmp/debug_log_' . date('ymd') . '.txt';
    $parseList = array('array', 'object');
    $dataType = gettype($content);
    if (in_array($dataType, $parseList) === true) {
        $logContent = print_r($content, true);
    } else {
        $logContent = $content;
    }
    $log = date('Y-m-d H:i:s') . ' ' . $logContent . PHP_EOL;
    return file_put_contents($logPath, $log, FILE_APPEND);
}


/**
 * Unset specific session data
 * @param  array $names Session name
 * @return void
 */
function unset_session_data($names = array())
{
    save_debug_log('unset_session_data'); // test
    save_debug_log($_SESSION); // test
    foreach ($names as $name) {
        if (isset($_SESSION[$name]) === true) {
    save_debug_log('unset ' . $name); // test
            unset($_SESSION[$name]);
        }
    save_debug_log($name . ' is not set'); // test
    }
}
