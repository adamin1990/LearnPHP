<?php
/**
 * Created by PhpStorm.
 * User: Adam
 * Date: 2016/7/23
 * Time: 16:07
 */

function checkNum($num){
    if($num>10){
        throw new Exception("数值必须大于1 ");
    }

    return true;


}
// c alt t 捕获异常
try {
    checkNum(11);
} catch (Exception $e) {
    echo $e->getMessage();
}