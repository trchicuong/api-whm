<?php

// FUNCTION CREATEACCT HOSTING

require_once('src/Whm.php');

set_time_limit(0);

$api_method = 'json-api/createacct';
$api_version = '1';
$header[0] = 'Authorization: Basic ' . base64_encode($acc_whm.":".$mk_whm) . "\n\r";
$method = $url_whm.':'.$port_whm.'/'.$api_method;

$user = array(
    'username'      => $acc_host,
    'domain'        => $domain_host,
    'password'      => $mk_host,
    'cpmod'         => 'paper_lantern',
    'plan'         => $pack,
    'contactemail'  => $mail_host
);

$data['api.version'] = $api_version;
$query = http_build_query($user);

$curl_cron = curl_init();
curl_setopt($curl_cron, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl_cron, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl_cron, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl_cron, CURLOPT_HEADER, false);
curl_setopt($curl_cron, CURLOPT_HTTPHEADER, $header);
curl_setopt($curl_cron, CURLOPT_URL, $method . '?' . $query);
$resp = curl_exec($curl_cron);

$result_cron = json_decode($resp, true);
curl_close($curl_cron);

if ($result_cron['result'][0]['status'] == 1) {
    // TẠO TÀI KHOẢN HOSTING THÀNH CÔNG
} else {
    die(json_encode(array(
        'statusmsg' => ''.$result_cron['cpanelresult']['error'].''
    )));
}

?>