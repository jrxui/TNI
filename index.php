<!DOCTYPE html>
<html lang="en">
<head>
<title>~[ IDBTE4M SMS BOMBER ]~</title>
<link rel="shortcut icon" href="http://pre14.deviantart.net/b668/th/pre/i/2010/059/9/d/wallpaper___fuck_you_by_mindjek.png">
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="stylesheet" href="css.css" media="screen">
<style>
  body{
    background: linear-gradient(to bottom, #ffffff 0%, #feedb7 50%, #fed452 100%);
    position:absolute;left:0;right:0;top:10%;
  }
  #login {
    border: solid 1px #527dff;
    margin: 10px;
    padding: 5px;
    background-color: #ccd9ff;
    border-radius: 15px;
    box-shadow: 1px 1px 10px #b8c9ff;
  }
  #mailist{
    color:white;
  }
  #valid{
    color:lime;
  }
  #limit{
    color:orange;
  }
  #die{
    color:red;
  }
  #recheck{
    color:cyan;
  }
  textarea{
	   resize:none;
	   background-repeat:no-repeat;
	   background-color:#C0C0C0;
	   padding:5px;
	   box-shadow:2px 2px 2px gray, -1px -1px 2px white;
	 }
	 *{
	   border-radius:0px !important;
	 }
	 .label{
	   position:absolute;
	   left:72px;
	   top:-20px;
	 }
</style>
<script src="cok.js"></script>
<script type="application/javascript">

function hajar(){
  var nomer = document.getElementById('msisdn').value;
  var total = document.getElementById('jumlah').value;
  var pesan = document.getElementById('pesan').value;
  var current = 0;
  var sukses = 0;
  var gagal = 0;
  ajax();
  function ajax(){
    if(current < total){
      var cur = current + 1;
      document.getElementById("load").innerHTML='<h5 style="color: #FFF;font-weight: bold;"><b>Sending (' + nomer + '): ' + cur + '</b></h5><div class="progress progress-striped active"><div class="progress-bar" style="width: 50%"></div></div>';
      var http = new XMLHttpRequest();
      http.open("POST", "api.php", true);
      http.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
      http.send("nomer=" + nomer + "&pesan=" + pesan);
      current++;
      http.onreadystatechange=function() {
        if (http.readyState == 4){
          var resp = http.responseText;
          if(resp == "sukses"){
            sukses++;
            document.getElementById("success").innerHTML = "Success: " + sukses;
          }
          else{
            gagal++;
            document.getElementById("gagal").innerHTML = "Failed: " + gagal;
          }
          ajax();
        }
      }
    }
    else{
      document.getElementById("load").innerHTML='';
      alert('DONE');
    }
  }
}
</script>
</head>
<body>
<div id="login">
  <center>
    <h3 style="color: #FFF;font-weight: bold;"><b>SMS BOMBER</b></h3>
    <div id="label">Msisdn:</div>
    <input type="number" id="msisdn" class="form-control"><br/>
    <div id="label">Jumlah</div>
    <input type="number" id="jumlah" class="form-control">
    <div id="label">Message Text:</div>
    <textarea id="pesan" style="height: 200px;" class="form-control" rows="3"></textarea><br/>
    <input onclick="hajar()" id="hajarbro" value="Kirim" style="color: #FFF; background-color: #589DF4; font-weight: bold; cursor: pointer;" type="submit">
    <div class="form-group">
      <center>
        <div id="load"></div>
      </center>
    </div>
    
    <div id="result">
      <div id="total"></div>
      <div id="success"></div>
      <div id="gagal"></div>
    </div>
  </center>
</div>
</body>
</html>