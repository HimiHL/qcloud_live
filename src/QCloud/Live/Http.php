<?php
namespace QCloud\Live;

class Http
{
    public static function get($url, $body)
    {
		$ch = curl_init();
        if (is_array($body)) {
            $symbol = strstr($url, "?") ? "&" : "?";
            $url = $body == NULL ? $url : $url . $symbol . http_build_query($body);
        } else {
            $url = $url . '?' . $body;
        }
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, 0); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_TIMEOUT, 100000);//超时时间
        $ret = curl_exec($ch);
		curl_close($ch);
		return $ret;
    }
}