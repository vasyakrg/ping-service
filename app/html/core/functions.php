<?php

function get_status($toCheckURL)
{
    if (! checkdnsrr(parse_url($toCheckURL, PHP_URL_HOST), 'A')) return 'Domain not found, or service is disable';
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $toCheckURL);
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_NOBODY, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
    curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );
    curl_setopt($ch, CURLOPT_TCP_FASTOPEN, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);


    $ret = curl_exec($ch);

    if (empty($ret)) {
        return '[Curl] Another system error';
        curl_close($ch);
    } else {
        $info = curl_getinfo($ch);
        curl_close($ch);

        if (empty($info['http_code'])) {
            return 'No HTTP code was returned';
        } else {
            $http_codes = parse_ini_file("codes.ini");
            return '['.$info['http_code'] . "] " . $http_codes[$info['http_code']];
        }
    }
}

function set_lamp($status){
    switch ($status) {
        case '[200] OK': $lamp = 'img/on.jpeg'; break;
        case '[404] Not Found': $lamp = 'img/on.jpeg'; break;
        case '0': $lamp = 'img/sleep.jpeg'; break;
        default: $lamp = 'img/off.jpeg'; break;
    };
    return '<img src="'.$lamp.'" width="15" height="15">';
}
