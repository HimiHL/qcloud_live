<?php
namespace QCloud;

class Base
{
    # AppID
    protected $appid = '';
    # API鉴权key
    protected $api_key = '';
    # 推流防盗链key
    protected $push_key = '';
    # 腾讯云分配bizid
    protected $bizid = '';
    # 接口url
    protected $url = '';
    # 统计URL 
    protected $stat_url = '';
    # 视频直播过期时间
    protected $expire = 2 * 3600;
    protected $time = 0;

    public function setAppInfo($appid, $api_key, $push_key, $bizid, $url = '', $stat_url = '')
    {
        $this->appid = $appid;
        $this->api_key = $api_key;
        $this->push_key = $push_key;
        $this->bizid = $bizid;
        $this->url = $url == '' ? 'http://fcgi.video.qcloud.com/common_access' : $url;
        $this->stat_url = $stat_url == '' ? 'http://statcgi.video.qcloud.com/common_access' : $stat_url;
    }
    
    /**
     *  获取签名
     * 
     */
    public function getSign()
    {
        $this->time = time();
        return md5($this->api_key.$this->time);
    }
}