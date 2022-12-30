### Status API

`403 Forbidden`
#### 錯誤內容
- api_key 對指定的 device 並無操作權限
#### 可能的解決方法
- 確認 api_key 及 device_id 是否正確

`400 Bad Request!`
#### 錯誤內容
- params 格式錯誤
- gateway 目前不在線上

### Passcode API

`Unauthorized`
#### 錯誤內容
- 此 api_key 對指定的 device 並無操作權限
#### 可能的解決方法
- 確認 api_key 及 device_id 是否正確

`gateway_offline`
#### 錯誤內容
- gateway 不在線上時，無法新增、刪除、更改密碼
#### 可能的解決方法
- 設定密碼前，透過 `api/v2/devices` API 確認 gateway 在線上

`incorrect_code_length`
#### 錯誤內容
- 密碼長度為4~8碼
#### 可能的解決方法
- 設定正確長度的密碼

`invalid_schedule_time`
#### 錯誤內容
- 結束時間比開始時間還早
#### 可能的解決方法
- 設定正確的開始及結束時間

`invalid_schedule_start_time`
#### 錯誤內容
- 已生效的密碼無法更改開始時間
#### 可能的解決方法
- 五分鐘內即將生效的密碼無法更改開始時間

`invalid_schedule_end_time`
#### 錯誤內容
- 五分鐘內即將到期的密碼，無法更改結束時間
#### 可能的解決方法

`duplicated_with_master_code`
#### 錯誤內容
- 此密碼和管理者密碼相同
#### 可能的解決方法
- 更換欲設定的密碼

`change_passcode_type`
#### 錯誤內容
- 常駐密碼無法改成排成密碼
#### 可能的解決方法
- 刪掉舊的密碼並設定一組新的密碼

`error_parameters`
#### 錯誤內容
- 密碼格式錯誤
#### 可能的解決方法

`invalid_code_id`
#### 錯誤內容
- 更改密碼時，傳入錯誤的passcode id
#### 可能的解決方法

`exceed_user_code_limit`
#### 錯誤內容
- 超過密碼組數上限(30組)
#### 可能的解決方法
- 目前限制一組門鎖最多只能儲存30組密碼

`doorlock_is_inuse`
#### 錯誤內容
- 門鎖一次只能設定（新增/修改/刪除）一組密碼
#### 可能的解決方法
- 待正在設定中的密碼完成設定後，再做操作

`duplicate_code`
#### 錯誤內容
- 欲新增的密碼重複
#### 可能的解決方法
- 更換欲設定的密碼

`user_code_id_not_found`
#### 錯誤內容
- 更改密碼時，傳入錯誤的passcode id
#### 可能的解決方法
- 可透過 `api/v2/passcode` 拿去密碼列表，確認 passcode id 正確

`cannot_change_passcode`
#### 錯誤內容
- 已設定成功的密碼(包含未生效的排程密碼)，無法更改密碼
#### 可能的解決方法
- 刪掉舊的密碼並設定一組新的密碼

`exception_error`
#### 錯誤內容
- 未知的錯誤
