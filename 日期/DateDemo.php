<?php
/**
 * Created by PhpStorm.
 * User: Adam
 * Date: 2016/7/23
 * Time: 10:01
 */
date_default_timezone_set("Asia/Shanghai");  //设置服务器默认时区，时区列表：http://php.net/manual/en/timezones.asia.php
echo "今天是".date("Y/m/d  l")."<br>";
echo date("h:i:s a")."<br>";
echo date_default_timezone_get()."<br>";  //获取所在时区

$time=mktime(4,20,22,2,2,1999);     //创建时间
echo "创建日期是：".date("Y-m-d h:i:s a",$time)."<br>";

$time2=strtotime("10:27 am July 23 2016");  //创建日期
echo "创建日期是".date("Y-m-d h:i:s a",$time2)."<br>";