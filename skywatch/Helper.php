<?php 

namespace Skywatch {

    function curl($address, $url, $params, $method, $timeout = 14000, $digest = FALSE) {
        $ch = curl_init();

        if ($method == "GET") {
            if (is_array($params)) {
                $params = toHttpString($params);
            }
            if (!empty($params)) {
                $params = '?' . $params;
            }
            $url = "$address$url$params";
            curl_setopt($ch, CURLOPT_URL, $url);
        } else {
            $url = "$address$url";
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST,  TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS,  $params); 
        }
        
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT_MS, 7000);
        curl_setopt($ch, CURLOPT_TIMEOUT_MS, $timeout);
        if ($digest) {
            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_DIGEST);
        }

        // get data and http code
        $data = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        // do return 
        return array('data' => $data, 'http_code' => $http_code);
    }

    function toHttpString($params, $seperator = "&") {
        if (is_array($params) === FALSE)
            return $params;
        if (count($params) === 0)
            return '';
        $data = '';
        foreach($params as $key => $value) {
            $url_encode_key = urlencode($key);
            $url_encode_value = urlencode($value);
            $data .= "$url_encode_key=$url_encode_value$seperator";
        }
        return substr($data, 0, -1);
    }
}


?>