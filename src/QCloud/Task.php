<?php
namespace QCloud;

class Task extends Base
{
    /**
     * 开启关闭推流
     * 
     */
    public function Live_Channel_SetStatus($channel_id, $status)
    {
        $sign = $this->getSign();
        $body = [
            'appid' => $this->appid,
            'interface' => 'Live_Channel_GetStatus',
            't' => $this->time,
            'sign' => $sign,
            'Param.s.channel_id' => $channel_id,
            'Param.n.status' => $status
        ];

        return Http::get($this->url, $body);
    }

    /**
     * 断流、暂停并延迟恢复
     * 
     */
    public function Channel_Manager($channel_id, $end_time, $action)
    {
        $sign = $this->getSign();
        $body = [
            'appid' => $this->appid,
            'interface' => 'channel_manager',
            't' => $this->time,
            'sign' => $sign,
            'Param.s.channel_id' => $channel_id, 
            'Param.n.abstime_end' => $end_time,
            'Param.s.action' => $action
        ];
        
        return Http::get($this->url, $body);
    }

    /**
     * 创建录制任务
     * 
     */
    public function Live_Tape_Start($channel_id, $start_time, $end_time, $task_sub_type = 0, $file_format = 'flv', $record_type = 'video')
    {
        $sign = $this->getSign();
        $body = [
            'appid' => $this->appid,
            'interface' => 'Live_Tape_Start',
            't' => $this->time,
            'sign' => $sign,
            'Param.s.channel_id' => $channel_id, 
            'Param.s.start_time' => urlencode($start_time), 
            'Param.s.end_time' => urlencode($end_time), 
            'Param.n.task_sub_type' => $task_sub_type,
            'Param.s.file_format' => $file_format, 
            'Param.s.record_type' => $record_type
        ];

        return Http::get($this->url, $body);
    }

    /**
     * 结束录制任务
     * 
     */
    public function Live_Tape_Stop($channel_id, $task_id, $task_sub_type = 0)
    {
        $sign = $this->getSign();
        $body = [
            'appid' => $this->appid,
            'interface' => 'Live_Tape_Stop',
            't' => $this->time,
            'sign' => $sign,
            'Param.s.channel_id' => $channel_id, 
            'Param.s.task_id' => $task_id, 
            'Param.n.task_sub_type' => $task_sub_type
        ];

        return Http::get($this->url, $body);
    }
}