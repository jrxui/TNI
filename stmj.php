<?php
error_reporting('0');
ini_set('display_errors', '0');

function get_contents($url){
  $ch = curl_init("$url");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0(Windows NT 6.1; rv:32.0) Gecko/20100101 Firefox/32.0");
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
  curl_setopt($ch, CURLOPT_COOKIEJAR, '/tmp/cookie/stmj');
  curl_setopt($ch, CURLOPT_COOKIEFILE, '/tmp/cookie/stmj');
  $result = curl_exec($ch);
  return $result;
}

function set_msisdn($msisdn){
  if(substr($msisdn, 0, 1) === '0'){
    $msisdn = '62'.substr($msisdn, 1, 100);
  }
  $msisdn = str_replace('-', '', str_replace(' ', '', $msisdn));
  return $msisdn;
}

if(isset($_GET['cek'])){
  $nomer = $_GET['cek'];
  if(!empty($nomer)){
    $nomer = set_msisdn($nomer);
    $pesan = urlencode("$msisdn");
    $url = "http://iring.indosat.com/isatlp/data/?uid=huawei&pwd=huaweipwd&serviceid=80800001000001&msisdn=$nomer&sms=$pesan";
    echo get_contents($url);
  }
}

function check(){
  $url = "http://iring.indosat.com/isatlp/data/";
  if(preg_match("/404/", get_contents($url))){
    return false;
  }
  return true;
}

if(isset($_GET['cek'])){
  $res = array('status' => check());
  echo json_encode($res);
}

if(isset($_POST["nomer"]) and isset($_POST["pesan"])){
  $nomer = set_msisdn($_POST["nomer"]);
  $pesan = urlencode(substr($_POST["pesan"], 0, 160));
  $url = "https://smsblast.id/api/sendsingle.json?username=tni-ad&password=M3n3k3t3h3!&sender=TNI-AD&message=$pesan&msisdn=$nomer";
  $result = get_contents("$url");
  if(preg_match("/succes/i", $result)){
    echo "<span style=\"color:green\">Sucess</span>";
  }
  else{
    echo "<span style=\"color:red\"> Failed</span>";
  }
  echo "<br/>";
}