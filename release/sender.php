<?php

require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
require 'phpmailer/Exception.php';

header("Content-type: application/json");
header("Access-Control-Allow-Origin: *");

$type = addslashes($_POST['type'] ?? '');
$name = addslashes($_POST['name'] ?? '');
$company = addslashes($_POST['company'] ?? '');
$website = addslashes($_POST['website'] ?? '');
$themes = addslashes($_POST['themes'] ?? '');
$project = addslashes($_POST['project'] ?? '');
$phone = addslashes($_POST['phone'] ?? '');
$track = addslashes($_POST['track'] ?? '');
$telegram = addslashes($_POST['telegram'] ?? '');
$partnertype = addslashes($_POST['partner-type'] ?? '');
$agreement = addslashes($_POST['agreement'] ?? '');

$fields = [];

switch($type){
    case "Спикер":
        $fields = [
            "name" => $name,
            "company" => $company,
            "website" => $website,
            "themes" => $themes,
            "phone" => $phone,
            "telegram" => $telegram,
            "track" => $track
        ];
        break;
    case "Партнёр":
        $fields = [
            "name" => $name,
            "company" => $company,
            "website" => $website,
            "phone" => $phone,
            "telegram" => $telegram,
            "partnertype" => $partnertype
        ];
        break;
    case "Альманах": 
        $fields = [
            "name" => $name,
            "company" => $company,
            "website" => $website,
            "project" => $project,
            "phone" => $phone,
            "telegram" => $telegram,
        ];
        break;
    default:
        $fields = ["name" => $name,
            "company" => $company,
            "website" => $website,
            "themes" => $themes,
            "phone" => $phone,
            "telegram" => $telegram,
            "track" => $track
        ];
        break;

}

$required = [
    'name' => $name,
    'phone' => $phone
];

// Проверяем поля на пустышки
$empties = [];
foreach ($required as $key => $value) {
    if($value === ""){
        $empties[] = $key;
    }
}

if(count($empties) > 0){
    http_response_code(400);
    die(json_encode([
        'message' => 'Не заполнены обязательные поля',
        'success' => false,
        'fields' => $empties
    ], JSON_UNESCAPED_UNICODE));
}

$subject = "";
switch($type){
    case "Спикер": $subject = "Регистрация спикера"; break;
    case "Партнёр": $subject = "Регистрация партнёра"; break;
    case "Альманах": $subject = "Регистрация на участие в аналитическом сборнике"; break;
}

$fieldNames = [
    'name' => 'Имя, отчество',
    'company' => 'Компания',
    'website' => 'Сайт компании',
    'themes' => 'Темы выступления',
    'phone' => 'Телефон',
    'telegram' => 'Телеграм',
    'project' => 'Описание проекта',
    'track' => 'Название трека',
    'partnertype' => 'Тип партнёрства',
];

$body = "
<style>
body{
font-family: sans-serif;
}
table{
width: 100%;
border: 0;
border-spacing: 0;
}
tr td{
border-top: 1px solid #ccc;
padding: .75em;
}
tr:last-of-type td{
border-bottom: 1px solid #ccc;
}
</style>
";
$body .= "<h1>Заявка на участие</h1>";
$body .= "<p>На сайте Smart Social зарегистрирована заявка. Данные отправителя:</p>";
$body .= "<table>";
foreach($fields as $key => $field){
    if($key !== 'agreement'){
        $body .= "<tr><td>{$fieldNames[$key]}</td><td>{$field}</td></tr>";
    }
}
$body .= "</table>";
$body .= "<p>Письмо сгенерировано автоматически, не нужно на него отвечать.</p>";


// Настройки PHPMailer
$mail = new PHPMailer\PHPMailer\PHPMailer();

$mail->isSMTP();
$mail->CharSet = "UTF-8";
$mail->SMTPAuth   = true;
//$mail->SMTPDebug = 2;
//$mail->Debugoutput = function($str, $level) {$GLOBALS['data']['debug'][] = $str;};

// Настройки вашей почты
$mail->Host       = 'smtp.mail.ru'; // SMTP сервера вашей почты
$mail->Username   = 'info@smart-social.org'; // Логин на почте
$mail->Password   = '9NiyMPgzlKcapxeXtsgj'; // Пароль на почте
//$mail->Password = '9scs2pnTzICp3VYoUUq2';
$mail->SMTPSecure = 'ssl';
$mail->Port       = 465;
$mail->setFrom('info@smart-social.org', 'from site'); // Адрес самой почты и имя отправителя

// Получатель письма
$mail->addAddress('info@smart-social.org');

$mail->isHTML(true);
$mail->Subject = $subject;
$mail->Body = $body;

if($mail->send()){

    echo json_encode([
        'message' => 'Ваша заявка принята! Спасибо за Ваше участие!',
        'success' => true,
    ], JSON_UNESCAPED_UNICODE);
}else{
    http_response_code(500);
    echo json_encode([
        'message' => 'Ошибка отправки сообщения!',
        'success' => false,
    ], JSON_UNESCAPED_UNICODE);
}

