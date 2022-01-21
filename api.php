<?php

require __DIR__ . '/vendor/autoload.php';

use Skywatch\SkywatchResource;

$auth_code = @$_GET['auth_code'];
$auth_code = urldecode($auth_code);

$skywatch = new SkywatchResource();
$access_token = $skywatch->getAccessToken($auth_code);
$skywatch->init($access_token);

if ($_GET['action'] == 'devices') {
    $ret = $skywatch->getDeviceList();
    echo $ret;
} else if ($_GET['action'] == 'lock_info') {
    $doorlock_id = $_GET['lock_id'];
    $ret = $skywatch->getStatus($doorlock_id);
    echo $ret;
} else if ($_GET['action'] == 'passcode_list') {
    $doorlock_id = $_GET['lock_id'];
    $ret = $skywatch->getPasscodeList($doorlock_id);
    echo $ret;
} else if ($_GET['action'] == 'set_passcode') {
    $doorlock_id = $_GET['lock_id'];
    $passcode_num = $_GET['passcode_num'];
    $passcode_alias = $_GET['passcode_alias'];
    $is_schedule = isset($_GET['start_date']) && isset($_GET['start_time']) && isset($_GET['end_date']) && isset($_GET['end_time']);
    $is_onetime = isset($_GET['onetime']);
    if ($is_schedule) {
        $start_date = urldecode($_GET['start_date']);
        $start_time = urldecode($_GET['start_time']);
        $end_date = urldecode($_GET['end_date']);
        $end_time = urldecode($_GET['end_time']);
        $timezone_offset = -60 * 60 * 8; // UTC+8

        // form schedule passcode format
        $start = DateTime::createFromFormat('Y-m-d H:i', $start_date . " " . $start_time);
        $end = DateTime::createFromFormat('Y-m-d H:i', $end_date . " " . $end_time);

        $ret = $skywatch->setSchedulePasscode($doorlock_id, ($start->format('U') + $timezone_offset), ($end->format('U') + $timezone_offset), $passcode_num, $passcode_alias);
    } else if ($is_onetime) {
        $ret = $skywatch->setOnetimePasscode($doorlock_id, $passcode_num, $passcode_alias);
    } else {
        $ret = $skywatch->setAlwaysPasscode($doorlock_id, $passcode_num, $passcode_alias);
    }
    echo $ret;
} else if ($_GET['action'] == 'get_status') {
    $doorlock_id = $_GET['lock_id'];
    $ret = $skywatch->getStatus($doorlock_id);
    echo $ret;
} else if ($_GET['action'] == 'control_doorlock') {
    $doorlock_id = $_GET['lock_id'];
    $stauts = $_GET['status'] == '1' ? '1' : '0'; // 1: Locked, 0: Unlocked
    $ret = $skywatch->updateStatus($doorlock_id, $status);
    echo $ret;
} else if ($_GET['action'] == 'get_histroy') {
    $doorlock_id = $_GET['lock_id'];
    $start_time = $_GET['start_time'];
    $end_time = $_GET['end_time'];
    $ret = $skywatch->getLockHistory($doorlock_id, $start_time, $end_time);
    echo $ret;
}
