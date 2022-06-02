<?php

function generate_title($str, $type)
{
    return "<$type> " . $str . "</$type>" . PHP_EOL;
}

function generate_description($str)
{
    return "<pre><code> " . $str . "</code></pre>" . PHP_EOL;
}

function generate_form(&$html, $action, $method, $callback)
{
    $html .= "<form target='_blank' action='$action' method='$method'>" . PHP_EOL;
    $html .= $callback($html);
    $html .= '</form>' . PHP_EOL;
}

function generate_edittext($key, $value, $hidden = False)
{
    return "<input type='text' name='$key' value='$value' " . ($hidden ? 'hidden' : '') . "/>" . PHP_EOL;
}

function generate_input($type, $value)
{
    return "<input type='$type' value='$value' />" . PHP_EOL;
}

global $auth_code;
$auth_code = @$_GET['code'];

$html = '<html>' . PHP_EOL;
$html = '<body>' . PHP_EOL;

$html .= generate_title('Demo Page', 'h1');

$html .= "<a target=\"_blank\" href=\"https://service.skywatch24.com/oauth2.php?app_id=1&redirect_uri=http://localhost:8888/index.php\" > Link to Skywatch </a>";

$html .= generate_title('Get Device List', 'h3');
$html .= generate_description("id 為 device 的序號，用來對 Device 做資料查詢及操作。可透過 model_id = 63 判斷裝置是否為電子門鎖。<br /><br /> model_id:'74' -> Gateway 2 <br /> model_id:'91' -> Gateway 2.5 <br /> model_id:'63' -> DoorLock <br /> model_id:'83' -> PowerLock (斷電解鎖) <br /> model_id:'84' -> PowerLock (上電解鎖)");

generate_form($html, 'api.php', 'get', function (&$html) {
    global $auth_code;
    $html .= generate_edittext('action', 'devices', True);
    $html .= generate_edittext('auth_code', $auth_code, True);
    $html .= generate_input('submit', 'Get Device List');
});
$html .= '<br>';

$html .= generate_title('Get Doorlock Info', 'h3');
$html .= generate_description("cameraStatusCode = online|offline 表示裝置連線或離線, params['switch_control'] = 0|1 表示門鎖開啟或鎖上 <br /><br /> If the model_id is 63 or 83, please check 'switch_control' <br /> value=0 -> unlocked <br /> value=1 -> locked <br /> If the model_id is 84, please check 'switch_control' <br /> value=0 -> locked <br /> value=1 -> unlocked");


generate_form($html, 'api.php', 'get', function (&$html) {
    global $auth_code;
    $html .= generate_edittext('action', 'lock_info', True);
    $html .= generate_edittext('auth_code', $auth_code, True);
    $html .= generate_edittext('lock_id', 'doorlock_id', False);
    $html .= '<br>';
    $html .= generate_input('submit', 'Get Doorlock Info');
});
$html .= '<br>';

$html .= generate_title('Get History', 'h3');
$html .= generate_description("門鎖開啟：門鎖關閉：密碼啟用：密碼失效");
generate_form($html, 'api.php', 'get', function (&$html) {
    global $auth_code;
    $html .= generate_edittext('action', 'get_histroy', True);
    $html .= generate_edittext('auth_code', $auth_code, True);
    $html .= generate_edittext('lock_id', 'doorlock_id', False);
    $html .= '<br>';
    $html .= generate_input('submit', 'Get History');
});
$html .= '<br>';

$html .= generate_title('Get Passcode List', 'h3');
$html .= generate_description("密碼列表");
generate_form($html, 'api.php', 'get', function (&$html) {
    global $auth_code;
    $html .= generate_edittext('action', 'passcode_list', True);
    $html .= generate_edittext('auth_code', $auth_code, True);
    $html .= generate_edittext('lock_id', 'doorlock_id', False);
    $html .= '<br>';
    $html .= generate_input('submit', 'Get Passcode List');
});
$html .= '<br>';

$html .= generate_title('Set Always Passcode', 'h3');
$html .= generate_description("設定常駐密碼");
generate_form($html, 'api.php', 'get', function (&$html) {
    global $auth_code;
    $html .= generate_edittext('action', 'set_passcode', True);
    $html .= generate_edittext('auth_code', $auth_code, True);
    $html .= generate_edittext('lock_id', 'doorlock_id', False);
    $html .= '<br>';
    $html .= generate_edittext('passcode_num', '0-9, 4 digits', False);
    $html .= '<br>';
    $html .= generate_edittext('passcode_alias', 'Passcode Alias');
    $html .= '<br>';
    $html .= generate_input('submit', 'Set Passcode');
});
$html .= '<br>';

$html .= generate_title('Set Onetime Passcode', 'h3');
$html .= generate_description("設定一次性密碼");
generate_form($html, 'api.php', 'get', function (&$html) {
    global $auth_code;
    $html .= generate_edittext('action', 'set_passcode', True);
    $html .= generate_edittext('onetime', 'True', True);
    $html .= generate_edittext('auth_code', $auth_code, True);
    $html .= generate_edittext('lock_id', 'doorlock_id', False);
    $html .= '<br>';
    $html .= generate_edittext('passcode_num', '0-9, 4 digits', False);
    $html .= '<br>';
    $html .= generate_edittext('passcode_alias', 'Passcode Alias');
    $html .= '<br>';
    $html .= generate_input('submit', 'Set Passcode');
});
$html .= '<br>';

$html .= generate_title('Set Schedule Passcode', 'h3');
$html .= generate_description("設定排程密碼");
generate_form($html, 'api.php', 'get', function (&$html) {
    global $auth_code;
    $html .= generate_edittext('action', 'set_passcode', True);
    $html .= generate_edittext('auth_code', $auth_code, True);
    $html .= generate_edittext('lock_id', 'doorlock_id', False);
    $html .= '<br>';
    $html .= generate_edittext('passcode_num', '0-9, 4 digits', False);
    $html .= '<br>';
    $html .= generate_edittext('passcode_alias', 'Passcode Alias');
    $html .= '<br>';
    $html .= "密碼生效日期及時間：<input type='date' name='start_date' />" . PHP_EOL;
    $html .= "<input type='time' name='start_time' />" . PHP_EOL;
    $html .= '<br>';
    $html .= "密碼失效日期及時間：<input type='date' name='end_date' />" . PHP_EOL;
    $html .= "<input type='time' name='end_time' />" . PHP_EOL;
    $html .= '<br>';
    $html .= generate_input('submit', 'Set Passcode');
});
$html .= '<br>';

// $html .= generate_title('Get Doorlock Status', 'h3');
// generate_form($html, 'api.php', 'get', function (&$html) {
//     global $auth_code;
//     $html .= generate_edittext('action', 'get_status', True);
//     $html .= generate_edittext('auth_code', $auth_code, True);
//     $html .= generate_edittext('lock_id', 'doorlock_id', False);
//     $html .= generate_input('submit', 'Get Doorlock Status');
// });
// $html .= '<br>';

$html .= generate_title('Set Doorlock Status', 'h3');
$html .= generate_description("遠端開關電子門鎖 <br /><br /> If the model_id is 63 or 83, <br /> value=0 -> unlocked <br /> value=1 -> locked <br /> If the model_id is 84, <br /> value=0 -> locked <br /> value=1 -> unlocked");
generate_form($html, 'api.php', 'get', function (&$html) {
    global $auth_code;
    $html .= generate_edittext('action', 'control_doorlock', True);
    $html .= generate_edittext('auth_code', $auth_code, True);
    $html .= generate_edittext('status', '0', True);
    $html .= generate_input('submit', 'Open Doorlock');
});
generate_form($html, 'api.php', 'get', function (&$html) {
    global $auth_code;
    $html .= generate_edittext('action', 'control_doorlock', True);
    $html .= generate_edittext('auth_code', $auth_code, True);
    $html .= generate_edittext('status', '1', True);
    $html .= generate_input('submit', 'Close Doorlock');
});
$html .= '<br>';

$html .= generate_title('Set Lock History', 'h3');
$html .= generate_description("門鎖使用紀錄");
generate_form($html, 'api.php', 'get', function (&$html) {
    global $auth_code;
    $html .= generate_edittext('action', 'get_histroy', True);
    $html .= generate_edittext('auth_code', $auth_code, True);
    $html .= generate_edittext('lock_id', 'doorlock_id', False);
    $html .= '<br>';
    $html .= generate_edittext('start_time', 'start_time (timestamp)', False);
    $html .= '<br>';
    $html .= generate_edittext('end_time', 'end_time (timestamp)', False);
    $html .= '<br>';
    $html .= '<br>';
    $html .= generate_input('submit', 'Get History');
});
$html .= '<br>';

$html .= '</body>';
$html .= '</html>';
echo $html;
