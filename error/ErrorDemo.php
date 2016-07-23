<?php
/**
 * Created by PhpStorm.
 * User: Adam
 * Date: 2016/7/23
 * Time: 15:43
 */
//前两个必选参数
function customError($errorlevel ,$error_message,$errorfile,$errorline,$errorcontext){

    echo "错误级别：".$errorlevel."<br>"
        ."错误信息:".$error_message."<br>".
    "行号：".$errorline;

    error_log("错误信息：\n".$error_message."\n");

}

set_error_handler('customError');


//echo $test;   制造错误


$test=2;
if($test>1){
    //手动触发错误
    trigger_error("测试值必须小鱼1");
}