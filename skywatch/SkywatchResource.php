<?php

namespace Skywatch;

require_once __DIR__ . '/../vendor/autoload.php';

class SkywatchResource
{

    public static $base_url = "https://service.skywatch24.com/";
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

    function init($access_token)
    {
        $this->_token = $access_token;
    }

    function getAccessToken($auth_code)
    {

        $params = array(
            'app_id' => self::$APP_ID,
            'app_secret' => self::$APP_SECRET,
            'code' => $auth_code,
            'method_type' => 'POST'
        );

        $output = curl(self::$base_url, "api/general/oauth_access_token.php", $params, 'POST');

        //return json_encode($output);
        return $output['data'];
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

    function updateDeviceName($device_id, $name)
    {
        $params = array(
            'access_token' => $this->_token,
            'params[name]' => $name,
        );
        $ret = curl(self::$base_url, "api/v2/devices/$device_id/settings", $params, 'POST');
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

    function setOnetimePasscode($device_id, $passcode_num, $passcode_alias)
    {
        $params = array(
            'access_token' => $this->_token,
            'user_code' => json_encode(array(
                'code' => $passcode_num,
                'alias' => $passcode_alias,
                'onetime' => true,
            ))
        );

        $ret = curl(self::$base_url, "api/v2/devices/$device_id/passcode", $params, 'POST');
        return $ret['data'];
    }

    function setSchedulePasscode($device_id, $start_time, $end_time, $passcode_num, $passcode_alias)
    {
        $params = array(
            'access_token' => $this->_token,
            'user_code' => json_encode(array(
                'code' => $passcode_num,
                'alias' => $passcode_alias,
                'schedule' => $start_time . "-" . $end_time,
            ))
        );
        $ret = curl(self::$base_url, "api/v2/devices/$device_id/passcode", $params, 'POST');
        return $ret['data'];
    }

    function setRecurringPasscode($device_id, $start_date, $end_date, $start_time, $end_time, $week, $timezone, $passcode_num, $passcode_alias)
    {
        $params = array(
            'access_token' => $this->_token,
            'user_code' => json_encode(array(
                'code' => $passcode_num,
                'alias' => $passcode_alias,
                'recurring' => $start_date . "-" . $end_date . ":" . $start_time . "-" . $end_time . ":" . $week,
                'timezone' => $timezone,
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

    function getLockHistory($device_id, $start_time, $end_time)
    {
        $params = array(
            'access_token' => $this->_token,
            'start_time' => $start_time,
            'end_time' => $end_time
        );
        $ret = curl(self::$base_url, "api/v2/devices/$device_id/history", $params, 'GET');
        return $ret['data'];
    }

    function getQRcodeList()
    {
        $params = array(
            'access_token' => $this->_token
        );
        $ret = curl(self::$base_url, "api/v2/sharing", $params, 'GET');
        return $ret['data'];
    }

    function setAlwaysQRcode($device_ids, $passcode_num, $passcode_alias)
    {
        $params = array(
            'access_token' => $this->_token,
            'sharing_passcode' => $passcode_num,
            'sharing_name' => $passcode_alias,
            'device_ids' => json_encode($device_ids),
            'method_type' => 'POST',
        );
        $ret = curl(self::$base_url, "api/v2/sharing", $params, 'POST');
        return $ret['data'];
    }

    function setOnetimeQRcode($device_ids, $passcode_num, $passcode_alias)
    {
        $params = array(
            'access_token' => $this->_token,
            'sharing_passcode' => $passcode_num,
            'sharing_name' => $passcode_alias,
            'device_ids' => json_encode($device_ids),
            'onetime' => true,
            'method_type' => 'POST',
        );
        $ret = curl(self::$base_url, "api/v2/sharing", $params, 'POST');
        return $ret['data'];
    }

    function setScheduleQRcode($device_ids, $start_time, $end_time, $passcode_num, $passcode_alias)
    {
        $params = array(
            'access_token' => $this->_token,
            'sharing_passcode' => $passcode_num,
            'sharing_name' => $passcode_alias,
            'device_ids' => json_encode($device_ids),
            'start_time' => $start_time,
            'end_time' => $end_time,
            'method_type' => 'POST',
        );
        $ret = curl(self::$base_url, "api/v2/sharing", $params, 'POST');
        return $ret['data'];
    }

    function setRecurringQRcode($device_ids, $start_date, $end_date, $start_time, $end_time, $week, $timezone, $passcode_num, $passcode_alias)
    {
        $params = array(
            'access_token' => $this->_token,
            'sharing_passcode' => $passcode_num,
            'sharing_name' => $passcode_alias,
            'device_ids' => json_encode($device_ids),
            'recurring' => $start_date . "-" . $end_date . ":" . $start_time . "-" . $end_time . ":" . $week,
            'timezone' => $timezone,
            'method_type' => 'POST',
        );
        $ret = curl(self::$base_url, "api/v2/sharing", $params, 'POST');
        return $ret['data'];
    }

    function removeQRcode($sharingUid)
    {
        $params = array(
            'access_token' => $this->_token,
            'method_type' => 'DELETE'
        );
        $ret = curl(self::$base_url, "api/v2/sharing/$sharingUid", $params, 'POST');
        return $ret['data'];
    }

    function getUnregisteredCardList($start_time, $end_time) 
    {
        $params = array(
            'access_token' => $this->_token,
            'start_time' => $start_time,
            'end_time' => $end_time
        );
        $ret = curl(self::$base_url, "api/v2/unregistered-card", $params, 'GET');
        return $ret;
    }

    function getUnregisteredCardListBySharedToken($shared_token, $start_time, $end_time) 
    {
        $params = array(
            'access_creation_token' => $shared_token,
            'start_time' => $start_time,
            'end_time' => $end_time
        );
        $ret = curl(self::$base_url, "api/v2/unregistered-card", $params, 'GET');
        return $ret;
    }

    function getRemoteAccessSharedTokens()
    {
        $params = array(
            'access_token' => $this->_token,
        );
        $ret = curl(self::$base_url, "api/v2/shared-link/access-creation", $params, 'GET');
        return $ret;
    }

    function setAlwaysRemoteAccessSharedToken($device_ids, $token_alias, $token_activate_time, $token_deactivate_time)
    {
        $validity = array('start_time'=>$token_activate_time, 'end_time'=>$token_deactivate_time);
        $params = array(
            'access_token' => $this->_token,
            'max_num' => 1,
            'link_alias' => $token_alias,
            'device_ids' => json_encode($device_ids),
            'method_type' => 'POST',
            'setting' => '{}',
            'validity' => json_encode($validity)
        );
        $ret = curl(self::$base_url, "api/v2/shared-link/access-creation", $params, 'POST');
        return $ret;
    }

    function setScheduleRemoteAccessSharedToken($device_ids, $token_alias, $access_activate_time, $access_deactivate_time, $token_activate_time, $token_deactivate_time)
    {
        $validity = array('start_time'=>$token_activate_time, 'end_time'=>$token_deactivate_time);
        $setting = array('schedule'=>"{$access_activate_time}-{$access_deactivate_time}");
        $params = array(
            'access_token' => $this->_token,
            'max_num' => 1,
            'link_alias' => $token_alias,
            'device_ids' => json_encode($device_ids),
            'method_type' => 'POST',
            'setting' => json_encode($setting),
            'validity' => json_encode($validity)
        );
        $ret = curl(self::$base_url, "api/v2/shared-link/access-creation", $params, 'POST');
        return $ret;
    }

    function setRemoteAccessCardNumber($shared_token, $card_number, $access_alias) {
        $params = array(
            'token' => $shared_token
        );
        $remote_access_ret = curl(self::$base_url, "api/v2/shared-link/access-creation", $params, 'GET');
        if ($remote_access_ret['http_code'] == 200) {
            $remote_access_data = json_decode($remote_access_ret['data'], true);
            $settable_remote_access_list = array_filter($remote_access_data['access_list'], function($access) {
                return $access['status'] == 'settable';
            });
            $remote_access = !empty($settable_remote_access_list) ? array_shift($settable_remote_access_list) : array_shift($remote_access_data);

            $params = array(
                'token' => $shared_token,
                'alias' => $access_alias,
                'code' => $card_number
            );

            $id = $remote_access['id'];
            $uri = "api/v2/shared-link/access-creation/{$id}/card";
            $ret = curl(self::$base_url, $uri, $params, 'POST');
            return $ret;
        }
        return $remote_access_ret;
    }
}
