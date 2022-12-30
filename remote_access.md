# Remote Access

### Get Remote Access Shared Token
get list of created remote access shared token info

```php
$skywatch->getRemoteAccessSharedTokens();
```


### Set Always Remote Access Shared Token

```php
$skywatch->setAlwaysRemoteAccessSharedToken($device_ids, $token_alias, $token_activate_time, $token_deactivate_time);
```

| Property                | Type     | Required | Description                                |
| ----------------------- | -------- | -------- | ------------------------------------------ |
| `device_ids`            | `array`  | YES      | Lock id list ex. `array('59974', '59998')` |
| `token_alias`           | `string` | YES      | shared token name                           |
| `token_activate_time`   | `string` | YES      | shared token activate timestamp             |
| `token_deactivate_time` | `string` | YES      | shared token deactivate timestamp           |

### Set Schedule Remote Access Shared Token

```php
$skywatch->setScheduleRemoteAccessSharedToken($lock_ids, $token_alias, $access_activate_time, $access_deactivate_time, $token_activate_time, $token_deactivate_time);
```

| Property                 | Type     | Required | Description                                |
| ------------------------ | -------- | -------- | ------------------------------------------ |
| `device_ids`             | `array`  | YES      | Lock id list ex. `array('59974', '59998')` |
| `token_alias`            | `string` | YES      | shared token name                           |
| `access_activate_time`   | `string` | YES      | remote access activate timestamp           |
| `access_deactivate_time` | `string` | YES      | remote access deactivate timestamp         |
| `token_activate_time`    | `string` | YES      | shared token activate timestamp             |
| `token_deactivate_time`  | `string` | YES      | shared token deactivate timestamp           |

### Set Remote Access Card Number

```php
$skywatch->setRemoteAccessCardNumber($token, $card_number, $access_alias);
```

| Property                 | Type     | Required | Description           |
| ------------------------ | -------- | -------- | ----------------------|
| `token`                  | `string` | YES      | shared token          |
| `card_number`            | `string` | YES      | card number           |
| `access_alias`           | `string` | YES      | access alias          |
