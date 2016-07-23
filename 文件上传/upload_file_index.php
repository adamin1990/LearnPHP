<html>
<body>

<form action="upload_file.php" method="post"
      enctype="multipart/form-data">
    <label for="file">文件名称:</label>
    <input type="hidden" name="MAX_FILE_SIZE " value="1000">
    <input type="file" name="file" id="file" />
    <br />
    <input type="submit" name="submit" value="提交" />
</form>

</body>
</html>