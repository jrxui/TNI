<?php
set_time_limit(0);
error_reporting(0);
//die("sukses");
if(isset($_POST['nomer'])){
  $nomer = $_POST['nomer'];
  $pesan = $_POST['pesan'];
  $pesan = substr($pesan, 0, 159);
  $url = 'http://xblast.com/stmj.php';
  $data = array('nomer' => $nomer, 'pesan' => $pesan);
  $result = sendRequest($url, $data);
  if(eregi('cess', $result)){
    echo "sukses";
  }
  else{
    echo "gagal";
  }
}

function SendRequest($url, $data){
  $ch = curl_init("$url");
  curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt ($ch, CURLOPT_POST, 1);
  curl_setopt ($ch, CURLOPT_POSTFIELDS, $data);
  $result = curl_exec($ch);
  curl_close($ch);
  return $result;
}