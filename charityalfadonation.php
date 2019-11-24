<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Charity Alfa Lite - Blockchain Donation System plugin modul</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script src="https://code.jquery.com/jquery-3.1.1.min.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/semantic-ui@2.4.2/dist/semantic.min.css">
<script src="https://cdn.jsdelivr.net/npm/semantic-ui@2.4.2/dist/semantic.min.js"></script>
<script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="main.bundle.js"></script>


</head>

<body>
<div align="center" class="ui cards">
<?php
if(!isset($_GET['lang'])){
	$descr=" Az EOS címre közvetlenül is küldhet adományt vagy használja az alábbi nyomógombot.";
}else {
	$descr="You can transfer to EOS account directly or use the Scatter button.";
}
require_once('mysql_connect.php');
$link=Mysql_OpenDB();
if(!isset($_GET['donationUserId'])){
	$sql="SELECT * FROM charityOrganization WHERE aktive='1'";
}
else {
	$sql="SELECT * FROM charityOrganization WHERE aktive='1' and donationOrgId='".$_GET['donationUserId']."'";
}

$res=mysqli_query($link,$sql);

while ($row=mysqli_fetch_array($res)){?>  

  <div align="center" class="card">
    <div class="content">
      <img class="right floated mini ui image" src="img/logo/<?php echo $row['donationOrgId'];?>_logo.png">
      <div align="left" class="header">
        <?php echo $row['orgName'];?>
      </div>
      <div align="left" class="meta">
        EOS account: <?php echo $row['orgEosAddress'];?>
      </div>
      <div align="left" class="description">
        <?php if (!isset($_GET['lang'])) { echo $row['descript']; }else{ echo $row['descriptEng'];}?> <a href="https://bloks.io/account/<?php echo $row['orgEosAddress'];?>" target="_blank">EOS account explorer.</a> <?php echo $descr; ?> 
      </div>
    </div>
    <div class="extra content">
      <div class="ui two buttons">
        <a href="scatter://transfer?payload=safetransfer/<?php echo $row['minimal'];?>/eos/aca376f206b8fc25a6ed44dbdc66547c36c6c33e3a119ffbeaef943642f0e906/<?php echo $row['orgEosAddress'];?>"><div class="ui basic green button">Donation (Scatter)</div></a>
        <div class="ui basic red button" onClick="window.open('./info_donation.php?donationUserId=<?php echo $row['donationOrgId'];?>')">Information</div>
      </div>
    </div>
  </div>

 <?php }//while end ?>    
</div>
</body>
</html>