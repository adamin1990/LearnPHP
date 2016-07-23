<?php
/**
 * Created by PhpStorm.
 * User: Adam
 * Date: 2016/7/23
 * Time: 15:02
 */
session_start();
$_SESSION["username"]="李涛";
?>
<html>
<body>
<?php
if(isset($_SESSION["username"])){
    echo "用户名字是： ".$_SESSION["username"];
    unset($_SESSION["username"]);
    session_destroy();

}else{
    die("没有设置username!");
}
?>
</body>
</html>
