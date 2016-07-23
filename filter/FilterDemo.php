<?php
/**
 * Created by PhpStorm.
 * User: Adam
 * Date: 2016/7/23
 * Time: 16:40
 */
//外部输入是指 1.来自表单的输入数据
//2.Cookies
//3.服务器变量
//4.数据库查询结果

$int=222;
//验证过滤列表  http://php.net/manual/en/filter.filters.validate.php
if(!filter_var($int,FILTER_VALIDATE_INT)){
    echo "验证不是整数\n";

}else{
    echo "是有效整数\n";
}
$options=array(
    "options"=>array(
        "min_range"=>1,
        "max_range"=>222
    ));
if(!filter_var($int,FILTER_VALIDATE_INT,$options)){
    echo  "无效\n";

}else{
    echo  "有效\n";
}
//测试地址  http://localhost/phpdemo/filterdemo.php?email=14846869@qq.com
if(!filter_has_var(INPUT_GET, "email"))
{
    echo("email参数不存在\n");
}
else
{
    filter_input(INPUT_GET,"email",FILTER_SANITIZE_EMAIL); //净化Email
//    if (!filter_input(INPUT_GET, "email", FILTER_VALIDATE_EMAIL))
//    {
//        echo "email地址无效\n";
//    }
//    else
//    {
//        echo "E-Mail地址邮箱\n";
//    }
}



function convertSpace($string)
{
    return str_replace("_", " ", $string);
}

$string = "Peter_is_a_great_guy!";

echo filter_var($string, FILTER_CALLBACK, array("options"=>"convertSpace"));