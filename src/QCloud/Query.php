<?php
namespace QCloud;

class Query extends Base
{
    /**
     * 获取直播推流地址
     * 
     */
    public function getPushUrl($channel_id, $expire = null) 
    {
        if ($expire == null) {
            $time = date('Y-m-d H:i:s', time() + $this->expire);
        }else {
            $time = date('Y-m-d H:i:s', time() + $expire);
        }
        $tx_time = strtoupper(base_convert(strtotime($time), 10, 16));
        $live_code = $this->bizid . '_' . $channel_id;
        $tx_secret = md5($this->api_key . $live_code. $tx_time);
        $query = '?' . http_build_query([
            'bizid' => $this->bizid,
            'txSecret' => $tx_secret,
            'txTime' => $tx_time
        ]);
        return 'rtmp://'. $this->bizid . '.livepush.myqcloud.com/live/' . $live_code . $query;
    }
    
    /**
     * 获取播放地址
     * 
     */
    public function getPlayUrl($channel_id)
    {
        $livecode = $this->bizid . '_' . $channel_id; //直播码
        return [
            'rtmp' => "rtmp://".$this->bizid.".liveplay.myqcloud.com/live/".$livecode,
            'flv' => "http://".$this->bizid.".liveplay.myqcloud.com/live/".$livecode.".flv",
            'm3u8' => "http://".$this->bizid.".liveplay.myqcloud.com/live/".$livecode.".m3u8"
        ];
    }

    /**
     * 查询直播状态
     * 
     */
    public function Live_Channel_GetStatus($channel_id)
    {
        $sign = $this->getSign();

        $body = [
            'appid' => $this->appid,
            'interface' => 'Live_Channel_GetStatus',
            't' => $this->time,
            'sign' => $sign,
            'Param.s.channel_id' => $channel_id
        ];
        
        return Http::get($this->url, $body);
    }

    /**
     *  查询录制文件
     * 
     */
    public function Live_Tape_GetFilelist($channel_id, $page = 1, $pagesize = 10, $sort = 'asc', $start_time = NULL, $end_time = NULL)
    {
        $sign = $this->getSign();

        $body = [
            'appid' => $this->appid,
            'interface' => 'Live_Tape_GetFilelist',
            't' => $this->time,
            'sign' => $sign,
            'Param.s.channel_id' => $channel_id,
            'Param.n.page_no' => $page,
            'Param.n.page_size' => $pagesize,
            'Param.s.sort_type' => $sort
        ];
        if ($start_time !== NULL)
        {
            $body['Param.s.start_time'] = $start_time;
        }
        if ($end_time !== NULL)
        {
            $body['Param.s.end_time'] = $end_time;
        }
        
        return Http::get($this->url, $body);
    }

    /**
     *  查询频道列表
     * 
     */
    public function Live_Channel_GetChannelList($page = 1, $pagesize = 10, $status = NULL, $order_field = 'create_time', $order_type = NULL)
    {
        $sign = $this->getSign();

        $body = [
            'appid' => $this->appid,
            'interface' => 'Live_Tape_GetFilelist',
            't' => $this->time,
            'sign' => $sign,
            'Param.n.page_no' => $page,
            'Param.n.page_size' => $pagesize,
            'Param.s.order_field' => $order_field
        ];
        if ($status !== NULL)
        {
            $body['Param.n.status'] = $status;
        }
        if ($order_type !== NULL)
        {
            $body['Param.n.order_type'] = $order_type;
        }
        
        return Http::get($this->url, $body);
    }

    /**
     *  查询直播中的频道列表
     * 
     */
    public function Live_Channel_GetLiveChannelList()
    {
        $sign = $this->getSign();

        $body = [
            'appid' => $this->appid,
            'interface' => 'Live_Tape_GetFilelist',
            't' => $this->time,
            'sign' => $sign
        ];
        
        return Http::get($this->url, $body);
    }
}