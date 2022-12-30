# Device API

### User Info

```php
$skywatch->getUserInfo();
```

### Device List

```php
$skywatch->getDeviceList();
```

#### Example Output:

```json
[
  {
    "id": "1",
    "model_id": "74",
    "parent": "1",
    "online": "1",
    "name": "Gateway 2",
    "active": "1",
    "type": "own",
    "share_permission": "111",
    "device_type": "gateway",
    "ibit": "0",
    "mobile_view_available": "0",
    "sphere_available": "0",
    "model": "74",
    "armactive": "1",
    "audio_id": "0",
    "owner_name": ""
  },
  {
    "id": "3",
    "model_id": "63",
    "parent": "1",
    "online": "1",
    "name": "Door Lock",
    "active": "1",
    "type": "own",
    "share_permission": "111",
    "device_type": "sensor",
    "ibit": "0",
    "mobile_view_available": "1",
    "sphere_available": "0",
    "params": {
      "background_color": {
        "r": "0",
        "g": "165",
        "b": "230",
        "a": "100",
        "type": "color",
        "raw": ""
      },
      "image": {
        "value": "/api/v2/models/doorlock/image?status=online&value=__U__",
        "type": "image",
        "raw": "__U__"
      },
      "name": {
        "value": "Door Lock",
        "type": "text",
        "raw": "Door Lock"
      },
      "value_control": {
        "value": "--",
        "type": "text",
        "title": "",
        "raw": ""
      },
      "user_code": {
        "value": "api/v2/devices/3/doorcodeview",
        "type": "ext_page",
        "text": "管理通行密碼"
      },
      "switch_control": {
        "value": "__U__",
        "type": "switch",
        "raw": ""
      },
      "detail_control": {
        "value": "",
        "type": "list",
        "color": "blue",
        "trigger_based": "1"
      }
    },
    "modes_available": [
      {
        "key": "daily",
        "title": "日"
      },
      {
        "key": "weekly",
        "title": "週"
      },
      {
        "key": "monthly",
        "title": "月"
      }
    ],
    "model": "doorlock",
    "armactive": "1",
    "audio_id": "0",
    "owner_name": "",
    "doorlock_qrcode_enable": "1"
  }
]
```

| Parameter                | Description                                                                                    |
| ------------------------ | ---------------------------------------------------------------------------------------------- |
| `id`                     | Device Id                                                                                      |
| `name`                   | Device name                                                                                    |
| `online`                 | Online: 1, Offline: 0                                                                          |
| `doorlock_qrcode_enable` | If support Qrcode Access or not                                                                |
| `model_id`               | Gateway 2: 74, Gateway 2.5: 91, Gateway 3: 95, DoorLock: 63, PowerLock(斷電解鎖): 83, PowerLock(上電解鎖): 84, CardReader: 97, CardReader(配門位感測): 99 |

### Set Device Name

```php
$skywatch->updateDeviceName($device_id, $name)
```

| Property    | Type     | Required | Description |
| ----------- | -------- | -------- | ----------- |
| `device_id` | `string` | YES      | Sensor id   |
| `name`      | `string` | YES      | Sensor name |

### Lock Info

```php
$skywatch->getStatus($doorlock_id);
```

| Property      | Type     | Required | Description |
| ------------- | -------- | -------- | ----------- |
| `doorlock_id` | `string` | YES      | Sensor id   |

#### Example Output:

```json
{
  "cameraStatusCode": "online",
  "firmwareUpgradeAvailable": "false",
  "rebootAvailable": "true",
  "wrong_password": "0",
  "cameraAlert": "false",
  "cameraServiceImage": "",
  "has_er": "0",
  "has_cr": "0",
  "has_cr_pro": "0",
  "recover_from_sd": "0",
  "params": {
    "background_color": {
      "r": "0",
      "g": "165",
      "b": "230",
      "a": "100",
      "type": "color",
      "raw": ""
    },
    "image": {
      "value": "/api/v2/models/doorlock/image?status=online&value=0",
      "type": "image",
      "raw": "0"
    },
    "name": {
      "value": "Door Lock",
      "type": "text",
      "raw": "Door Lock"
    },
    "value_control": {
      "value": "開著",
      "type": "text",
      "title": "",
      "raw": "0"
    },
    "user_code": {
      "value": "api/v2/devices/3/doorcodeview",
      "type": "ext_page",
      "text": "管理通行密碼"
    },
    "switch_control": {
      "value": "0",
      "type": "switch",
      "raw": "0"
    },
    "detail_control": {
      "value": "",
      "type": "list",
      "color": "blue",
      "trigger_based": "1"
    },
    "master_code": "1234",
    "is_online": "1"
  },
  "modes_available": [
    {
      "key": "daily",
      "title": "日"
    },
    {
      "key": "weekly",
      "title": "週"
    },
    {
      "key": "monthly",
      "title": "月"
    }
  ],
  "master_code": "1234",
  "max_code_num": "30"
}
```

#### Note:

```
If the model_id is 63, 83, 97 or 99, please check "switch_control"
value=0 -> unlocked
value=1 -> locked
If the model_id is 84, please check "switch_control"
value=0 -> locked
value=1 -> unlocked
```

### Open / Close Lock

```php
$skywatch->updateStatus($doorlock_id, $status);
```

| Property      | Type     | Required | Description   |
| ------------- | -------- | -------- | ------------- |
| `doorlock_id` | `string` | YES      | Sensor id     |
| `status`      | `string` | YES      | Sensor status |

#### Note:

```
If the model_id is 63, 83, 97 or 99, please set
status = 0 -> unlocked
status = 1 -> locked
If the model_id is 84, please set
status = 0 -> locked
status = 1 -> unlocked
```

### Get Lock History

```php
$skywatch->getLockHistory($doorlock_id, $start_time, $end_time)
```

| Property      | Type     | Required | Description |
| ------------- | -------- | -------- | ----------- |
| `doorlock_id` | `string` | YES      | Sensor id   |
| `start_time`  | `string` | YES      | timestamp   |
| `end_time`    | `string` | YES      | timestamp   |
