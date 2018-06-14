<?php
/**
 * Save debug log
 * @param  string $content Log content
 * @return integer
 */
function saveDebugLog($content = '')
{
    $logPath = '/var/www/html/debug_log_' . date('ymd') . '.txt';
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
 * Check if the URL use HTTPS
 * @return boolean  Check result
 */
function isHttps()
{
    if (empty($_SERVER['HTTPS'] === false)) {
        if ($_SERVER['HTTPS'] !== 'off') {
            return true;
        }
    }

    if ($_SERVER['SERVER_PORT'] == 443) {
        return true;
    }

    return false;
}

/**
 * 取得 Cookie Secure 屬性
 * boolean $value   Secure value
 * @return boolean  Secure value
 */
function getCookieSecure($value = true)
{
    $isHttps = isHttps();
    if ($isHttps === true) {
        return $value;
    } else {
        return false;
    }
}

/**
 * 取得 Cookie Httponly 屬性
 * @return boolean  Httponly value
 */
function getCookieHttponly()
{
    return ini_get('session.cookie_httponly');
}

/**
 * Unset specific session data
 * @param  array $names Session name
 * @return void
 */
function unsetSessionData($names = array())
{
    startSession();
    foreach ($names as $name) {
        if (isset($_SESSION[$name]) === true) {
            unset($_SESSION[$name]);
        }
    }
}

/**
 * Start session
 * @return void
 */
function startSession()
{
    if (isset($_SESSION) === false) {
        session_start();
    }
}
