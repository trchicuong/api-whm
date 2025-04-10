<?php

// FUNCTION CREATEACCT HOSTING

require_once('src/Whm.php');

set_time_limit(0);

$api_method = 'json-api/createacct';
$header = ['Authorization: Basic ' . base64_encode("$acc_whm:$mk_whm")];

$user = [
    'username'      => $acc_host,
    'domain'        => $domain_host,
    'password'      => $mk_host,
    'cpmod'         => 'paper_lantern',
    'plan'         => $pack,
    'contactemail'  => $mail_host
];

$query = http_build_query($user);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "$url_whm:$port_whm/$api_method?$query");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
$response = curl_exec($ch);
curl_close($ch);

$result = json_decode($response, true);

if (isset($result['result'][0]['status']) && $result['result'][0]['status'] == 1) {
    return [
        // SUCCESS
    ];
} else {
    return [
        'status' => 'error',
        'msg'    => isset($result['result'][0]['statusmsg']) ? $result['result'][0]['statusmsg'] : 'Error!'
    ];
}

?>
