<?php
/**
 * [if 格式化时间]
 * @var [type]
 */
if (!function_exists('getFormatTime')) {
    function getFormatTime($date)
    {
        $time = strtotime($date);
        $time = date('Y-m-d H:i:s', $time);

        return $time;
    }
}
