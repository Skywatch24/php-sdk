# QRcode Access

### QRcode List

```php
$skywatch->getQRcodeList();
```

### Set Always QRcode

```php
$skywatch->setAlwaysQRcode($device_ids, $passcode_num, $passcode_alias)
```

| Property         | Type     | Required | Description                                |
| ---------------- | -------- | -------- | ------------------------------------------ |
| `device_ids`     | `array`  | YES      | Lock id list ex. `array('59974', '59998')` |
| `passcode_num`   | `string` | YES      | passcode (4 - 8 digits)                    |
| `passcode_alias` | `string` | YES      | passcode name                              |

### Set Onetime QRcode

```php
$skywatch->setOnetimeQRcode($device_ids, $passcode_num, $passcode_alias);
```

| Property         | Type     | Required | Description                                |
| ---------------- | -------- | -------- | ------------------------------------------ |
| `device_ids`     | `array`  | YES      | Lock id list ex. `array('59974', '59998')` |
| `passcode_num`   | `string` | YES      | passcode (4 - 8 digits)                    |
| `passcode_alias` | `string` | YES      | passcode name                              |

### Set Schedule QRcode

```php
$skywatch->setScheduleQRcode($device_ids, $start_time, $end_time, $passcode_num, $passcode_alias);
```

| Property         | Type     | Required | Description                                |
| ---------------- | -------- | -------- | ------------------------------------------ |
| `device_ids`     | `array`  | YES      | Lock id list ex. `array('59974', '59998')` |
| `start_time`     | `string` | YES      | timestamp                                  |
| `end_time`       | `string` | YES      | timestamp                                  |
| `passcode_num`   | `string` | YES      | passcode (4 - 8 digits)                    |
| `passcode_alias` | `string` | YES      | passcode name                              |

### Set Recurring QRcode

```php
$skywatch->setRecurringQRcode($device_ids, $start_date, $end_date, $start_time, $end_time, $week, $timezone, $passcode_num, $passcode_alias);
```

| Property         | Type     | Required | Description                                |
| ---------------- | -------- | -------- | ------------------------------------------ |
| `device_ids`     | `array`  | YES      | Lock id list ex. `array('59974', '59998')` |
| `start_date`     | `string` | YES      | start date timestamp                       |
| `end_date`       | `string` | YES      | end date timestamp                         |
| `start_time`     | `string` | YES      | seconds of start time ex. 8:00 -> 28800    |
| `end_time`       | `string` | YES      | seconds of end time ex. 8:00 -> 28800      |
| `week`           | `string` | YES      | selected week list ex. Sun,Mon,Wed -> 013  |
| `timezone`       | `string` | YES      | cuttent time ex. 8                         |
| `passcode_num`   | `string` | YES      | passcode (4 - 8 digits)                    |
| `passcode_alias` | `string` | YES      | passcode name                              |

### Delete QRcode

```php
$skywatch->removeQRcode($sharingUid);
```

| Property     | Type     | Required | Description |
| ------------ | -------- | -------- | ----------- |
| `sharingUid` | `string` | YES      | QRcode id   |
