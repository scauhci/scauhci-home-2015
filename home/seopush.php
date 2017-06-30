<?php

$urls = array(
    'http://wubocong.com/'
);
$api = 'http://data.zz.baidu.com/urls?site=wubocong.com&token=YfvaXQrSwrKOdJtx';
for($i=0;$i<500;$i++){
$ch = curl_init();
$options =  array(
    CURLOPT_URL => $api,
    CURLOPT_POST => true,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POSTFIELDS => implode("\n", $urls),
    CURLOPT_HTTPHEADER => array('Content-Type: text/plain'),
);
curl_setopt_array($ch, $options);
$result = curl_exec($ch);
echo $result;
}