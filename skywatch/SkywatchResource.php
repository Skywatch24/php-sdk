<?php

namespace Skywatch;

require_once __DIR__ . '/../vendor/autoload.php';

class SkywatchResource
{

    public static $base_url = "https://beta.skywatch24.com/";
    public static $DOORLOCK = '63';
    public static $ALWAYS = 'always';
    public static $SCHEDULE = 'schedule';

    public static $APP_ID = "1";
    public static $APP_SECRET = "F95202B80D769D335094216BE27692C5";

    private $_token;

    function __construct()
    {
        $this->_token = "";
    }

    function init($auth_code)
    {
        $params = array(
            'app_id' => self::$APP_ID,
            'app_secret' => self::$APP_SECRET,
            'code' => $auth_code,
            'method_type' => 'POST'
        );

        $output = curl(self::$base_url, "api/general/oauth_access_token.php", $params, 'POST');
        $this->_token = $output['data'];
        return json_encode($output);
    }

    function getUserInfo()
    {
        $params = array(
            'access_token' => $this->_token
        );
        $ret = curl(self::$base_url, "api/v2/user/info", $params, 'GET');
        return $ret['data'];
    }

    function getDeviceList($filter = "")
    {
        $params = array(
            'access_token' => $this->_token
        );
        $ret = curl(self::$base_url, "api/v2/devices", $params, 'GET');
        return $ret['data'];
    }

    function getStatus($device_id)
    {
        $params = array(
            'access_token' => $this->_token
        );
        $ret = curl(self::$base_url, "api/v2/devices/$device_id/status", $params, 'GET');
        return $ret['data'];
    }

    function updateStatus($device_id, $status)
    {
        $params = array(
            'access_token' => $this->_token,
            'params[switch_control]' => ($status == 1) ? "1" : "0"
        );
        $ret = curl(self::$base_url, "api/v2/devices/$device_id/status", $params, 'POST');
        return $ret['data'];
    }

    function getPasscodeList($device_id)
    {
        $params = array(
            'access_token' => $this->_token
        );
        $ret = curl(self::$base_url, "api/v2/devices/$device_id/passcode", $params, 'GET');
        return $ret['data'];
    }

    function setAlwaysPasscode($device_id, $passcode_num, $passcode_alias)
    {
        $params = array(
            'access_token' => $this->_token,
            'user_code' => json_encode(array(
                'code' => $passcode_num,
                'alias' => $passcode_alias
            ))
        );
        $ret = curl(self::$base_url, "api/v2/devices/$device_id/passcode", $params, 'POST');
        return $ret['data'];
    }

    function setSchedulePasscode($device_id, $schedule, $passcode_num, $passcode_alias)
    {
        $params = array(
            'access_token' => $this->_token,
            'user_code' => json_encode(array(
                'code' => $passcode_num,
                'alias' => $passcode_alias,
                'schedule' => $schedule
            ))
        );
        $ret = curl(self::$base_url, "api/v2/devices/$device_id/passcode", $params, 'POST');
        return $ret['data'];
    }

    function removePasscode($device_id, $code_id)
    {
        $params = array(
            'access_token' => $this->_token,
            'user_code' => json_encode(array(
                'id' => $code_id
            )),
            'method_type' => 'DELETE'
        );
        $ret = curl(self::$base_url, "api/v2/devices/$device_id/passcode", $params, 'POST');
        return $ret['data'];
    }

    function getDeviceHistory($device_id, $start_time, $end_time)
    {
        $params = array(
            'access_token' => $this->_token,
            'start_time' => $start_time,
            'end_time' => $end_time
        );
        $ret = curl(self::$base_url, "api/v2/devices/$device_id/history", $params, 'GET');
        return $ret['data'];
    }
}
