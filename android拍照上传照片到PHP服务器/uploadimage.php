<?php
/**
 * Created by PhpStorm.
 * User: Adam
 * Date: 2016/7/21
 * Time: 15:01
 */
header('Content-type ： bitmap; charset=utf-8;');
$dbms = 'mysql';     //数据库类型

$host = 'localhost'; //数据库主机名

$dbName = 'tutorial_upload_image';    //使用的数据库

$user = 'root';      //数据库连接用户名

$pass = '';          //对应的密码

$dsn = "$dbms:host=$host;dbname=$dbName";

if (isset($_POST["encoding_string"])) {
    $encoding_string = $_POST["encoding_string"];

    $image_name = $_POST["image_name"];

    //decode 客户端上传的base64数据
    $decoded_string = base64_decode($encoding_string);

    $path = "images/" . $image_name;  //定义存放路径
    $file = fopen($path, "wb");

    $is_written = fwrite($file, $decoded_string);
    fclose($file);
    //写入数据库
    if ($is_written > 0) {
        //sql语句
        $strSql = "insert into photos(name,path) values('$image_name','$path')";


        //方法一 pdo方式  支持多种数据库
        try {

            $dbh = new PDO($dsn, $user, $pass); //初始化一个PDO对象
            $temp = $dbh->prepare($strSql);
            $temp->execute();
            $array = array(
                "status" => true,
                "msg" => "插入数据成功"
            );
            echo json_encode($array);
            $dbh = null; //运行完成后关闭链接
        } catch (PDOException $e) {
            $array = array(
                "status" => false,
                "msg" => "插入数据失败" . ($e->getMessage())
            );
            echo json_encode($array);

        }


        //方法2  mysqli方式
//        $connection=mysqli_connect('localhost','root','','tutorial_upload_image');
//        $result=mysqli_query($connection,$strSql);
//        if($result){
//            $array = array (
//                "status" => true,
//                "msg" => "插入数据成功"
//            );
//            echo json_encode($array);
//        }else{
//            $array = array (
//                "status" => false,
//                "msg" => "插入数据失败"
//            );
//            echo json_encode($array);
//        }
//        mysqli_close($connection);   //关闭连接
    }

}
?>