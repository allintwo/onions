<?php
/**
 * Created by PhpStorm.
 * User: CosMOs
 * Date: 9/30/2022
 * Time: 10:30 AM
 */

function func_get_content($myurl, $method = 'get', $posts = [], $headers = [],$encoding=0)
{

    sleep(rand(0,3));
    $host = parse_url(urldecode($myurl))['host'];
    //   /*
    if($headers == [])
    {
        $headers = [
            "Host: ".$host,
            "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.00".rand(0,999999),
            "Accept-Language: en-US,en;q=0.5",
            // "Accept-Encoding: gzip, deflate, br",
            "Connection: keep-alive",
            "Upgrade-Insecure-Requests: 1",
            "TE: Trailers",];
    }
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
    if($method != 'get')
    {
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($posts));
    }

    //  curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"serialno\":\"$code\"}");


    //   $error = curl_error($ch);
    $result = curl_exec($ch);
    curl_close($ch);
    if($encoding)
    {
        return mb_convert_encoding($result, 'utf-8','auto');
    }

    // debug
    //  file_put_contents($this->ROOT.'/webpage.txt',$result);

    return $result;
    //  return mb_convert_encoding($result, 'UTF-8','auto');
}

function func_get_content_proxy($myurl, $method = 'get', $posts = [], $headers = [],$encoding=0)
{
    $proxy = "127.0.0.1";
    $port = "9050";

   // sleep(rand(0,3));
    $host = parse_url(urldecode($myurl))['host'];
    //   /*
    if($headers == [])
    {
        $headers = [
            "Host: ".$host,
            "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.00".rand(0,999999),
            "Accept-Language: en-US,en;q=0.5",
            // "Accept-Encoding: gzip, deflate, br",
            "Connection: keep-alive",
            "Upgrade-Insecure-Requests: 1",
            "TE: Trailers",];
    }
    // */

    $myurl = str_replace(" ","%20",$myurl);
    // global $range;
    $ch = curl_init();

    //  $agent = 'tab mobile';
   curl_setopt ($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
    curl_setopt ($ch, CURLOPT_PROXY, $proxy.':'.$port );
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
    if($method != 'get')
    {
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($posts));
    }

    //  curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"serialno\":\"$code\"}");


    //   $error = curl_error($ch);
    $result = curl_exec($ch);
    curl_close($ch);
    if($encoding)
    {
        return mb_convert_encoding($result, 'utf-8','auto');
    }

    // debug
    //  file_put_contents($this->ROOT.'/webpage.txt',$result);

    return $result;
    //  return mb_convert_encoding($result, 'UTF-8','auto');
}

function remote_file_size($url){
# Get all header information
    $data = get_headers($url, true);
# Look up validity
    if (isset($data['Content-Length']))
        # Return file size
        return (int) $data['Content-Length'];
    return 0;
}

function remotefileSize($url) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_NOBODY, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 0);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_MAXREDIRS, 3);
    curl_exec($ch);
    $filesize = curl_getinfo($ch, CURLINFO_CONTENT_LENGTH_DOWNLOAD);
    curl_close($ch);
    if ($filesize) return $filesize;
    return 0;
}

function catFiles($arrayOfFiles, $outputPath) {

    $dest = fopen($outputPath,"a");

    foreach ($arrayOfFiles as $f) {

        $FH = fopen($f,"r");

        $line = fgets($FH);

        while ($line !== false) {

            fputs($dest,$line);

            $line = fgets($FH);

        }

        fclose($FH);

    }

    fclose($dest);

}