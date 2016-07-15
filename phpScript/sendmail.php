<?php

function sendMail($to = array(), $title = '', $content = '') {
    require('PHPMailer/PHPMailerAutoload.php');
    $mail = new PHPMailer(); //实例化
    $mail->IsSMTP(); // 启用SMTP
    $mail->Host = 'smtp.qq.com'; //smtp服务器的名称（这里以QQ邮箱为例）
    $mail->SMTPAuth = TRUE; //启用smtp认证
    $mail->Username = 'pms@genedenovo.com'; //你的邮箱名
    $mail->Password = 'gdPMS403'; //邮箱密码
    $mail->From = 'pms@genedenovo.com'; //发件人地址（也就是你的邮箱地址）
    $mail->FromName = '公司管理系统管理员'; //发件人姓名
    if (is_array($to)) {
        foreach ($to as $k => $v) {
            $mail->AddAddress($k, $v);
        }
    } else {
        $mail->AddAddress($to, "");
    }
    $mail->WordWrap = 50; //设置每行字符长度
    $mail->TRUE; // 是否HTML格式邮件
    $mail->CharSet = 'utf-8'; //设置邮件编码
    $mail->Subject = $title; //邮件主题
    $mail->Body = $content; //邮件内容
    $mail->AltBody = "这是一个纯文本的内容在非营利的HTML电子邮件客户端"; //邮件正文不支持HTML的备用显示
    return($mail->Send());
}

?>