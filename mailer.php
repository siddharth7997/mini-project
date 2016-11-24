<!DOCTYPE html>
<html>
    <center><h1>Thank you for using group mail </h1></center>
<head>
    <style>
        body {
    background-image: url('http://www.themesrefinery.net/wp-content/uploads/2014/06/Elegant_Background-19.jpg');
    background-repeat: no-repeat;
    background-position: center center;
    background-attachment: fixed;
    background-size:cover;
    color:yellow;
	}
	
    </style>
</head>
<body>
<center><img src="https://www.lehigh.edu/google/gmail.png"></center>
<br>
<center><h2 style="color:green">
<?php

    $f=fopen("uploads/new.txt","r");
    require("libphp-phpmailer/class.phpmailer.php");
    $mail = new PHPMailer();
    $str=array();
    for($i=0;!feof($f);$i++)
    {fscanf($f,"%s",$str[]);
    }
    fscanf($f,"%s\n",$str[]);
        $text=file_get_contents("uploads/msg.txt");
        $sender=file_get_contents("uploads/sender.txt");
        $subject=file_get_contents("uploads/sub.txt");
        $name=file_get_contents("uploads/name.txt");
    $mail->IsSMTP();
    $mail->Host = "smtp.gmail.com";
    
    $mail->Port = 587;
    $mail->SMTPAuth = true;
    $mail->SMTPDebug = 1;
    $mail->SMTPSecure = "tls";
    $mail->Username = "way2cbit@gmail.com";
    $mail->Password = "cbithyd123";
    $mail->Subject=$subject;
    for($i=0;$i<count($str)-1;$i++)
    {$mail->SetFrom("way2cbit@gmail.com");
    
    $mail->Body =$mail->Body.PHP_EOL."SENT FROM:".$name.PHP_EOL."MAIL ID: ".$sender.PHP_EOL.PHP_EOL."MESSAGE:".PHP_EOL.$text;
    
    $temp=$str[$i];
    if($temp==''||$temp=="\r")
    continue;
        $mail->addAddress($temp);
        if ($mail->Send())
        {
            echo "Sent text to ".$str[$i]."<br>";
        }
        else
        {
            
        }
        sleep(1);
        $mail->ClearAddresses();
    }
    $mail->ClearAddresses();
    
?></h2></center>
<br><br><center><a href="newhome.html" style="color:yellow">GO BACK</a></center>
</body>
<marquee><h2>Have a nice day!</h2></marquee>
</html>