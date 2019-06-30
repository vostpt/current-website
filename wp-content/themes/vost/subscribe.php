<?php

$data = [
    'email' => "",
    'status' => 'subscribed',
];
$data["email"] = $_POST["email"];
function syncMailchimp($data)
{
    include('subscribe.keys.php');
    $apiKey = $MAILCHIMP_API_KEY;
    $listId = $MAILCHIMP_LIST_ID;
    $listId = '741b62cca2';
    $memberId = md5(strtolower($data['email']));
    $dataCenter = substr($apiKey, strpos($apiKey, '-') + 1);
    $url = 'https://' . $dataCenter . '.api.mailchimp.com/3.0/lists/' . $listId . '/members/';
    $json = json_encode([
        'email_address' => $data['email'],
        'status' => $data['status'], // "subscribed","unsubscribed","cleaned","pending"
    ]);
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_USERPWD, 'user:' . $apiKey);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
    $result = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    return $httpCode;
}
syncMailchimp($data);
