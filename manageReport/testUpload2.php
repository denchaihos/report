<html>
<head>
    <title>ThaiCreate.Com Tutorial</title>
</head>
<body>
<?php
if(move_uploaded_file($_FILES["filUpload"]["tmp_name"],$_FILES["filUpload"]["name"]))
{
    echo "Copy/Upload Complete";
    echo "<br>";
    print_r ($_FILES["filUpload"]);
}

?>
</body>
</html>