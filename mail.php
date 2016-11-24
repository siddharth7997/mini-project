<!DOCTYPE html>
<html>
<head>
    <style>
        body {
    background-image: url('http://bluewallpaperbackground.weebly.com/uploads/1/9/7/6/19768865/2324599_orig.jpg');
    background-repeat: no-repeat;
    background-position: center center;
    background-attachment: fixed;
    background-size:cover;
    color:white;
	}
    </style>
</head>
<body>    <center><h1>
<?php

$target_dir = "uploads/";
$target_file = $target_dir."new.txt";
$uploadOk = 1;
$target_filemsg=$target_dir."msg.txt";
$file_ext=strtolower(end(explode('.',$_FILES['uploaded']['name'])));

// Check file size
if ($_FILES["uploaded"]["size"]>500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
$subject=fopen('uploads/sub.txt',w);
fwrite($subject,$_POST["subject"]);

$sender=fopen('uploads/sender.txt',w);
fwrite($sender,$_POST["sender"]);

$name=fopen('uploads/name.txt',w);
fwrite($name,$_POST["name"]);

if($file_ext!="txt") {
    echo "Sorry,only txt format is allowed.";
    $uploadOk = 0;
}

if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";

}
else 
{
    if (move_uploaded_file($_FILES["uploaded"]["tmp_name"],$target_file)) 
    {$f=fopen($target_filemsg,"w");
      fwrite($f,$_POST["message"]);
        echo "The file ". basename( $_FILES['uploaded']['name']). " has been uploaded.";
        
        header('Refresh:5; URL=process.php'); 
        exit;
    } 
    else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>
</h1></center>
</body>
</html>
