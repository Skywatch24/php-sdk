# skywatch-php-sdk

PHP library for skywatch platform.

**Reminder: Only support Doorlock sensor for now!**

# Demo

- Install http server such as Apache, Nginx or `php -S localhost:port -t php-sdk`
- Make sure 'http://localhost:port/index.php' and 'http://localhost:port/api.php' are available.
- Open the demo page: http://localhost:port/index.php
- Click `Link to Skywatch` and login with Skywatch's account

# Usage

- Set `redirect_url` in xxxxx.php
- Set `APP_ID` in xxxxx.php
- Set `APP_SECRET` in xxxxx.php

<img src="./images/sdk.png">

### initialize

#### Step 1. Get `auth_code` from Authorization URL:

Open this URL below in the web browser.

```
service.skywatch24.com/oauth2?app_id='app_ip'&redirect_uri='redirect_uri'
```

When user grants authorization, the website will redirect to the `redirect_url` and contain `auth_code` in the url.

| Parameter      | Type     | Required | Description                                                         |
| -------------- | -------- | -------- | ------------------------------------------------------------------- |
| `app_id`       | `string` | YES      | The `app_id` is a public identifier for your skywatch applications. |
| `redirect_url` | `string` | YES      | The URL that you want to receive the authorization code.            |

#### Step 2. Initialize with $auth_code

```php
use Skywatch\SkywatchResource;
$skywatch = new SkywatchResource();
$access_token = $skywatch->getAccessToken($auth_code);
$skywatch->init($access_token);
```

# API Document

[Device API](/device.md)

[Passcode Access](/passcode.md)

[QRcode Access](/qrcode.md)

[Doorlock API Error Response](/error_response.md)
