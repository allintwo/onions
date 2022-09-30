<?php
/**
 * Created by PhpStorm.
 * User: CosMOs
 * Date: 9/30/2022
 * Time: 12:03 PM
 */

ini_set('max_execution_time',300);
ini_set('memory_limit','2048M');

include_once 'config.php';
include_once 'functions.php';



ini_set('max_execution_time',300);

// file split downloader -


$url = "https://faylab.com/hamazon-php.zip";


$work_folder = 'dler';
$file_name = "";
$filesize = 0;
$filesize = remotefileSize($url);
// echo $filesize;exit();
$chunksize = 10 * (1024 * 1024); //5 MB (= 5 242 880 bytes) per one chunk of file.
$savefolder = "test";


$target_folder = $work_folder .'/'.$savefolder;
if(!is_dir($target_folder))
{
    mkdir($target_folder,0777,1);
}

// curl_setopt($ch, CURLOPT_HTTPHEADER, array("Range: bytes=-200"));
$total_part = 1;

$tmp_part = $filesize / $chunksize;
$x = intval($tmp_part);
if($tmp_part < 1)
{
    $total_part = 1;
}
if($tmp_part > $x)
{
    $total_part = $x + 1;
}


$rane_html = '';

$files_array = [];

$real_chunksize = $chunksize -1;

$file_range = range(0,$total_part -1);
shuffle($file_range);


//for ($i = 0;$i< $total_part;$i++)
foreach ($file_range as $key => $i)
{
   // echo $i ."<hr/>"; continue;


    $file_name = $target_folder .'/'.$i;
    $files_array[] = $file_name;

    $rr = $chunksize * $i;
    $rrr = ($rr+$chunksize) -1;
    if($rrr > $filesize)
    {
        $rrr = '';
    }

    $rng_str = "{$rr}-{$rrr}";
    $rane_html .= "{$rng_str} <hr/>";
    if(is_file($file_name))
    {
        $filsz = filesize($file_name);
        if($filsz < $real_chunksize)
        {
            // download
          // $data = func_get_split_content($url,$rng_str);
          // file_put_contents($file_name,$data);

        }
    }else{
        // download
        $data = func_get_split_content($url,$rng_str);
        file_put_contents($file_name,$data);
    }
}





// catFiles($files_array,"sc4.7z");
// download function

function func_get_split_content($myurl,$range = '0-')
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
// concat function
echo <<<sdlhgdslkgfdsiufgiudsfiugds

file size {$filesize} <hr/>
Total part {$total_part} <hr/>
Range html ::: {$rane_html}


sdlhgdslkgfdsiufgiudsfiugds;
