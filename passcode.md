# Passcode Access

### Passcode List

```php
$skywatch->getPasscodeList($doorlock_id);
```

| Property      | Type     | Required | Description |
| ------------- | -------- | -------- | ----------- |
| `doorlock_id` | `string` | YES      | Sensor id   |

#### Example Output:

```json
[
  {
    "code": "46260013",
    "alias": "#46260013",
    "id": "8c69af",
    "status": "success",
    "timestamp": 1638160855,
    "email_address": ""
  },
  {
    "alias": "Testttt",
    "code": "59023310",
    "recurring": "1638374400-1641139199:0-36000:56",
    "origin_recurring": "1638374400-1641139199:28800-64800:56",
    "endless": "false",
    "id": "d55956",
    "status": "not_yet",
    "timestamp": 1638411380,
    "email_address": ""
  },
  {
    "alias": "ScheduleTest",
    "code": "21933305",
    "schedule": "1640577960-1640581560",
    "id": "f0df4c",
    "status": "not_yet",
    "timestamp": 1640577960,
    "email_address": ""
  }
]
```

### Set Always Passcode

```php
$skywatch->setAlwaysPasscode($doorlock_id, $passcode_num, $passcode_alias);
```

| Property         | Type     | Required | Description             |
| ---------------- | -------- | -------- | ----------------------- |
| `doorlock_id`    | `string` | YES      | Sensor id               |
| `passcode_num`   | `string` | YES      | passcode (4 - 8 digits) |
| `passcode_alias` | `string` | YES      | passcode name           |

### Set Onetime Passcode

```php
$skywatch->setOnetimePasscode($doorlock_id, $passcode_num, $passcode_alias);
```

| Property         | Type     | Required | Description             |
| ---------------- | -------- | -------- | ----------------------- |
| `doorlock_id`    | `string` | YES      | Sensor id               |
| `passcode_num`   | `string` | YES      | passcode (4 - 8 digits) |
| `passcode_alias` | `string` | YES      | passcode name           |

### Set Schedule Passcode

```php
$skywatch->setSchedulePasscode($doorlock_id, $start_time, $end_time, $passcode_num, $passcode_alias);
```

| Property         | Type     | Required | Description             |
| ---------------- | -------- | -------- | ----------------------- |
| `doorlock_id`    | `string` | YES      | Sensor id               |
| `start_time`     | `string` | YES      | timestamp               |
| `end_time`       | `string` | YES      | timestamp               |
| `passcode_num`   | `string` | YES      | passcode (4 - 8 digits) |
| `passcode_alias` | `string` | YES      | passcode name           |

### Set Recurring Passcode

```php
$skywatch->setRecurringPasscode($doorlock_id, $start_date, $end_date, $start_time, $end_time, $week, $timezone, $passcode_num, $passcode_alias);
```

| Property         | Type     | Required | Description                               |
| ---------------- | -------- | -------- | ----------------------------------------- |
| `doorlock_id`    | `string` | YES      | Sensor id                                 |
| `start_date`     | `string` | YES      | start date timestamp                      |
| `end_date`       | `string` | YES      | end date timestamp                        |
| `start_time`     | `string` | YES      | seconds of start time ex. 8:00 -> 28800   |
| `end_time`       | `string` | YES      | seconds of end time ex. 8:00 -> 28800     |
| `week`           | `string` | YES      | selected week list ex. Sun,Mon,Wed -> 013 |
| `timezone`       | `string` | YES      | cuttent time ex. 8                        |
| `passcode_num`   | `string` | YES      | passcode (4 - 8 digits)                   |
| `passcode_alias` | `string` | YES      | passcode name                             |

### Delete Passcode

```php
$skywatch->removePasscode($doorlock_id, $code_id);
```

| Property      | Type     | Required | Description |
| ------------- | -------- | -------- | ----------- |
| `doorlock_id` | `string` | YES      | Sensor id   |
| `code_id`     | `string` | YES      | Passcode id |

### Get Unregisterd Card List

```php
$skywatch->getUnregisteredCardList($start_time, $end_time);
```

| Property         | Type     | Required | Description             |
| ---------------- | -------- | -------- | ----------------------- |
| `start_time`     | `string` | YES      | timestamp               |
| `end_time`       | `string` | YES      | timestamp               |

