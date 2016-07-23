<?php
/**
 * Created by PhpStorm.
 * User: Adam
 * Date: 2016/7/23
 * Time: 11:50
 */
$success=setcookie("username","李涛",time()+3600);  //setCookie 必须在任何html标签之前
setcookie("pwd","ccccccccc",time()+3600);
?>
<html>
<head>
    <title>
        设置cookie
    </title>
</head>

<body>
<label>取回cookie<br></label>
<?php
if($success){
    if(isset($_COOKIE["username"])&&isset($_COOKIE["pwd"])){
        echo "用户名：".$_COOKIE["username"]."<br>";
        echo "密码：".$_COOKIE["pwd"]."<br>";
        print_r($_COOKIE);
        setcookie("username","",time()-3600);  //删除此cookie
        print_r($_COOKIE);
    }

}
?>
</body>
</html>