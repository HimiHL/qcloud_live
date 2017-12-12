<?php
namespace QCloud\Live;

class Stat extends Base
{
    /**
     * 查询统计信息
     * 
     */
    public function Get_LiveStat($page = 1, $pagesize = 300, $stream_id = NULL, $domain = NULL)
    {
        $sign = $this->getSign();

        $body = [
            'cmd' => $this->appid,
            'interface' => 'Get_LiveStat',
            't' => $this->time,
            'sign' => $sign,
            'Param.n.page_no' => $page,
            'Param.n.page_size' => $pagesize
        ];
        if ($stream_id !== NULL)
        {
            $body['Param.s.stream_id'] = $stream_id;
        }
        if ($domain !== NULL)
        {
            $body['Param.s.pull_domain'] = $domain;
        }
        
        return Http::get($this->stat_url, $body);
    }
    
    /**
     * 查询统计信息
     * 
     * 仅返回推流统计信息以提高查询效率
     */
    public function Get_LivePushStat($page = 1, $pagesize = 300, $stream_id = NULL, $domain = NULL)
    {
        $sign = $this->getSign();

        $body = [
            'cmd' => $this->appid,
            'interface' => 'Get_LivePushStat',
            't' => $this->time,
            'sign' => $sign,
            'Param.n.page_no' => $page,
            'Param.n.page_size' => $pagesize
        ];
        if ($stream_id !== NULL)
        {
            $body['Param.s.stream_id'] = $stream_id;
        }
        if ($domain !== NULL)
        {
            $body['Param.s.pull_domain'] = $domain;
        }
        
        return Http::get($this->stat_url, $body);
    }

    /**
     * 查询统计信息
     * 
     * 仅返回播放统计信息以提高查询效率
     */
    public function Get_LivePlayStat($page = 1, $pagesize = 300, $stream_id = NULL, $domain = NULL)
    {
        $sign = $this->getSign();

        $body = [
            'cmd' => $this->appid,
            'interface' => 'Get_LivePushStat',
            't' => $this->time,
            'sign' => $sign,
            'Param.n.page_no' => $page,
            'Param.n.page_size' => $pagesize
        ];
        if ($stream_id !== NULL)
        {
            $body['Param.s.stream_id'] = $stream_id;
        }
        if ($domain !== NULL)
        {
            $body['Param.s.pull_domain'] = $domain;
        }
        
        return Http::get($this->stat_url, $body);
    }

    /**
     * 获取推流历史信息
     * 
     */
    public function Get_LivePushStatHistory($start_time, $end_time, $stream_id)
    {
        $sign = $this->getSign();

        $body = [
            'cmd' => $this->appid,
            'interface' => 'Get_LivePushStat',
            't' => $this->time,
            'sign' => $sign,
            'Param.n.start_time' => $start_time,
            'Param.n.end_time' => $end_time,
            'Param.s.stream_id' => $stream_id
        ];
        
        return Http::get($this->stat_url, $body);
    }

    /**
     * 获取播放统计历史信息
     * 
     */
    public function Get_LivePlayStatHistory($start_time, $end_time, $stream_id = NULL, $domain = NULL)
    {
        $sign = $this->getSign();

        $body = [
            'cmd' => $this->appid,
            'interface' => 'Get_LivePushStat',
            't' => $this->time,
            'sign' => $sign,
            'Param.n.start_time' => $start_time,
            'Param.n.end_time' => $end_time,
        ];
        if ($stream_id !== NULL)
        {
            $body['Param.s.stream_id'] = $stream_id;
        }
        if ($domain !== NULL)
        {
            $body['Param.s.domain'] = $domain;
        }
        
        return Http::get($this->stat_url, $body);
    }
}