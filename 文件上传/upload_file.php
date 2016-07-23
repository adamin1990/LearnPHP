<?php
/**
 * Created by PhpStorm.
 * User: Adam
 * Date: 2016/7/23
 * Time: 10:40
 */

if($_FILES["file"]["error"]>0){
    echo "上传文件出错了：".$_FILES["file"]["error"]."<br>";
}
else{

    if ((($_FILES["file"]["type"] == "image/gif")
            || ($_FILES["file"]["type"] == "image/jpeg")
            || ($_FILES["file"]["type"] == "image/pjpeg"))
        && ($_FILES["file"]["size"] > 20000)){

        //文件上传的详细参数信息
//   http://php.net/manual/en/features.file-upload.post-method.php
        echo "文件名称：".$_FILES["file"]["name"]."<br>";
        echo "文件类型：".$_FILES["file"]["type"]."<br>";
        echo "文件大小： ".$_FILES["file"]["size"]."<br>";
        echo "文件临时名称：".$_FILES["file"]["tmp_name"]."<br>";
        echo "错误信息".$_FILES["file"]["error"]."<br>";    //关于错误代码的详细信息 http://php.net/manual/en/features.file-upload.errors.php
//       echo "<script>alert('文件最大为10b')</script>";

        if(file_exists("upload/".$_FILES["file"]["name"])){
            echo "文件名称：".$_FILES["file"]["name"]."已经存在了！"."<br>";
        }else{
            move_uploaded_file($_FILES["file"]["tmp_name"],
                "upload/".$_FILES["file"]["name"]);   //转存文件；
            echo "文件转存成功";
        }

    }else{
        echo "文件无效<br>";
    }

}