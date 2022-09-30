<?php
/**
 * Created by PhpStorm.
 * User: CosMOs
 * Date: 9/30/2022
 * Time: 10:30 AM
 */


//ini_set('max_execution_time',0);
//ini_set('memory_limit',0);

echo 'bal';

include_once 'functions.php';





//file_put_contents('test.jpg',$filedata);


$url = "https://faylab.com/hamazon-php.zip";


$filesize = remotefileSize($url);

exit();
$chunksize = 1 * (1024 * 1024); //5 MB (= 5 242 880 bytes) per one chunk of file.

$data = func_get_split_content($url,'0-'.$chunksize);
file_put_contents('xyz.w',$data);

function func_get_split_content($myurl, $range = '0-')
{

    $host = parse_url(urldecode($myurl))['host'];
    //   /*

    $headers = [
        "Host: ".$host,
        "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.00".rand(0,999999),
        "Accept-Language: en-US,en;q=0.5",
        // "Accept-Encoding: gzip, deflate, br",
        "Connection: keep-alive",
        "Range: bytes=".$range,
        "Upgrade-Insecure-Requests: 1",
        "TE: Trailers",];

    // */

    $myurl = str_replace(" ","%20",$myurl);
    // global $range;
    $ch = curl_init();

    //  $agent = 'tab mobile';
    // curl_setopt($ch, CURLOPT_PROXY, '85.26.146.169:80');
    curl_setopt($ch, CURLOPT_URL, $myurl);
    // curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_2_0);

    //  curl_setopt($ch, CURLOPT_COOKIEJAR, dirname(__FILE__) . '/cookie.txt');
    //  curl_setopt( $ch, CURLOPT_COOKIEFILE,dirname(__FILE__) . '/cookie.txt');
    //  curl_setopt($ch, CURLOPT_HEADER, true); // header
    // curl_setopt($ch, CURLOPT_NOBODY, true); // header
    curl_setopt($ch, CURLOPT_ENCODING, 'UTF-8');
    //  curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    // curl_setopt($ch, CURLOPT_RANGE, $range);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch,CURLOPT_TIMEOUT , 60);
    # sending manually set cookie
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;

}