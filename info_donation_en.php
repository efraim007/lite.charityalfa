<?php 

require_once('mysql_connect.php');
$link=Mysql_OpenDB();

if (is_numeric($_GET['donationUserId']) == true) {
		$custId=$_GET['donationUserId'];
	} else {
		$custId=0;
		echo "Error!!!!!";
	}

$sql="SELECT * FROM charityOrganization WHERE donationOrgId='".$_GET['donationUserId']."'";
$res=mysqli_query($link,$sql);
while ($row=mysqli_fetch_array($res)){		  	

?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title><?php echo $row['orgNameEng'];?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script src="https://code.jquery.com/jquery-3.1.1.min.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/semantic-ui@2.4.2/dist/semantic.min.css">
<script src="https://cdn.jsdelivr.net/npm/semantic-ui@2.4.2/dist/semantic.min.js"></script>

</head>

<body>
<div class="ui top attached tabular menu">
  <div class="active item"><?php echo $row['orgNameEng'];?></div>
</div>
<div class="ui bottom attached active tab segment">
  
  
  <div align="center"><img src="img/logo/<?php echo $row['donationOrgId'];?>_logo.png" height="150">
  <br>
  <p><b><?php echo $row['orgName'];?></b></p>
  <p><div class="ui message">
  <div class="header">
   Donation by EOS
  </div>
  <ul class="list">
    <li>Contact: <b><?php echo $row['contact'];?></b></li>
    <li>EOS donation address: <b><?php echo $row['orgEosAddress'];?></b></li>
    <li>Please do not send less than <?php echo $row['minimal'];?> EOS</li>
	<li>Click on the icon for the EOS address of the organization:<br>
	  <a href="https://bloks.io/account/<?php echo $row['orgEosAddress'];?>" target="_blank"><img src="img/bloks_logomark.png" width="25" height="25" border="0"></a></li>
	<li><?php echo $row['descriptEng'];?></li>
  </ul>
  
   <br><a href="scatter://transfer?payload=safetransfer/<?php echo $row['minimal'];?>/eos/aca376f206b8fc25a6ed44dbdc66547c36c6c33e3a119ffbeaef943642f0e906/<?php echo $row['orgEosAddress'];?>"><button class="ui secondary button">Transfer donation</button></a><br>
  <p>The application will be start the Scatter wallet.<br>
    If you don't have installed Scatter wallet download from here: <a href="https://get-scatter.com" target="_blank">https://get-scatter.com</a>   </p>
</div>
</p>
  <p></p>
  <br><br>
  <p>
	  <div class="ui message">
	  <i class="close icon"></i>
	  <div class="header">
		Do you need help, or more information?<br>
	  </div><br><br>
	  <p>Buy EOS tokens on the regulated and fully licensed <a href="https://mrcoin.eu">https://mrcoin.eu</a> website.</p>
	  <p>Create your EOS wallet on your mobile:</p>
	  <p>Mobil EOS wallet (CRG token included): <a href="https://play.google.com/store/apps/details?id=vip.mytokenpocket">Token Pocket</a> (Google Play)  <a href="https://itunes.apple.com/us/app/tokenpocket/id1436028697" target="_blank">Token Pocket</a> (IOS)<br>
	    or</p>
	  <p><a href="https://get-scatter.com">https://get-scatter.com</a><br>
	  </p>
	  <p>If you need help with creating an EOS address please feel free to contact us.</p>
	  </div>
  
  
    <p>
	  <div class="ui icon message">
	  <i class="inbox icon"></i>
	  <div class="content">
		<div class="header">
		  What can you use your CRG tokens for donation?
		</div>
		<p>Visit our website for more information:<a href="http://cryptogcoin.com"><br>
	    <img src="img/charityalfa_atlatszo.png" width="25" height="25" border="0"></a> <br>
	    <a href="http://cryptogcoin.com">http://cryptogcoin.com</a>, <a href="http://charityalfa.io">http://charityalfa.io</a></p>
	  </div>
</div>
</p>
  
  
  <p><div class="ui icon message">
  <i class="inbox icon"></i>
  <div class="content">
    <div class="header">
	For any questions or problems, please write to the following email address:
    </div>
    <p>info@charityalfa.io</p>
    <p><a href="https://t.me/charityalfa" target="_blank">Telegram</a><a href="https://discord.gg/jYS75Wr" target="_blank"><br>
Discord</a></p>
  </div>
</div>
</p>
  </div>
</div>
<?php }//while end ?>
</body>
</html>
