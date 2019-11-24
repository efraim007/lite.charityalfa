<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Charity Alfa Lite - Blockchain Donation System</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script src="https://code.jquery.com/jquery-3.1.1.min.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/semantic-ui@2.4.2/dist/semantic.min.css">
<script src="https://cdn.jsdelivr.net/npm/semantic-ui@2.4.2/dist/semantic.min.js"></script>
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/eosjs@16.0.9/lib/eos.min.js"></script>
<script src="./scatter-js-master/bundles/scatterjs-core.min.js"></script>
<script src="./scatter-js-master/bundles/scatterjs-plugin-eosjs.min.js"></script>
<script src="./scatter-js-master/bundles/scatterjs-plugin-lynx.min.js"></script>

<script>
$(document).ready(function(){  
	//panel prebuy
    $("#regForm").css("display","none");
	//$("#startbuy").show("slow");
	/*
	$('#content').click(function(e) {  
      alert(1);
    });
	*/
	  
	$("#startBuyClick").click(function () {
	
		$("#regForm").show("slow");
        
    });
	
	$("#cancel").click(function () {
	
		$("#regForm").hide("slow");
        
    });
    	  
});// dokument ready vége

</script>


</head>

<body>
<div class="ui tall stacked segment">
	<div align="center">
	<table width="478" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td width="41"><img src="img/scatter.jpg" width="35" height="35"></td>
		<td width="159" align="left" valign="middle"><button class="ui primary basic button" onclick="login()">Login with Scatter</button></td>
		<td width="278"><div id="status"></div><img id="avatar" /></td>
	  </tr>
	</table>
	</div>
</div>

<div align="center"><br>
  <img src="img/header_2.png" width="500" height="80">  <br>
  <i class="hu flag" onClick="window.open('./index_hu.php', '_self')"></i>
  <i class="gb uk flag" onClick="window.open('./index_en.php', '_self')"></i>
  <br>
  <br>
  <div class="ui floating message">
  <p>
	<strong>1 EOS donation you will get 10 CRG tokens for gift.</strong><br>
    <?php require('eoscalc.php');?>
	<br>
	
</p>
</div>
  
<br><br>
<div align="center" class="ui cards">

<?php 
require_once('mysql_connect.php');
$link=Mysql_OpenDB();
$sql="SELECT * FROM charityOrganization WHERE aktive='1'";
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
        <?php echo $row['descriptEng'];?> <a href="https://bloks.io/account/<?php echo $row['orgEosAddress'];?>" target="_blank">EOS account explorer.</a> You can transfer to EOS account directly or use the Scatter button. 
      </div>
    </div>
    <div class="extra content">
      <div class="ui two buttons">
       <div class="ui basic green button" onclick="donateFreely()">Donation (Scatter)</div>
        <div class="ui basic red button" onClick="window.open('./info_donation.php?donationUserId=<?php echo $row['donationOrgId'];?>')">Information</div>
      </div>
    </div>
  </div>

 <?php }//while end ?>    
</div>

<br><br>
<div class="ui floating message">
  <p>The Charity Alfa Lite is the  first interface of the The Charity Alfa donation system, where the reward of charity is the CRG token.<br>
	You will be able to use the CRG tokens in our Charity Market, please visit our webste for more information. <br>
	The Charity Alfa Lite donation system keep records of these blockchain donation lines.<br><br>
	If you donate EOS to these addresses you can get back CRG tokens.<br>
	<br>
	<strong>1 EOS donation you will get 10 CRG tokens for gift.</strong><br>
    <?php //require('eoscalc.php');?>
</p>
</div>

  <br>
  <div class="ui floating message">
  <p>  Attention! The transaction is done for donation purposes!<br>
  The amount received will be used for the goodwill of the organizations in accordance with applicable law.</p>
   <p><i class="comment alternate icon"></i></p>
  <p>info@charityalfa.io</p>
  <p><a href="http://charityalfa.io">charityalfa.io</a></p>
  <p><a href="https://t.me/charityalfa" target="_blank">Telegram</a><a href="https://discord.gg/jYS75Wr" target="_blank"><br>Discord</a></p>
</div>

<br>
<!--
  <br>
  <div class="ui message" id="startBuyClick" style="width:400 ">
  <div class="header">
   Click here to register for the gift CRG tokens <br>
    </div>
  <p><i class="keyboard icon"></i>  
  </p>
</div>
<div id="regForm">
<?php //require_once('registration_en.php');?>
</div>
-->
</div>

<script>

    console.log(typeof Eos);
	ScatterJS.plugins( new ScatterEOS(), new ScatterLynx(Eos) );

    const network2 = ScatterJS.Network.fromJson({
        blockchain:'eos',
        chainId:'e70aaab8997e1dfce58fbfac80cbbb8fecec7b99cf982a9444273cbc64c41473',
        host:'jungle2.cryptolions.io',
        port:80,
        protocol:'http'
    });

   const network = ScatterJS.Network.fromJson({
	   blockchain:'eos',
	   chainId:'aca376f206b8fc25a6ed44dbdc66547c36c6c33e3a119ffbeaef943642f0e906',
	   host:'nodes.get-scatter.com',
	   port:443,
	   protocol:'https'
   });

    let scatter, eos;

    const setStatus = () => {
    	const status = document.getElementById('status');
    	if(!scatter) return status.innerText = 'No Scatter connection';
    	if(!scatter.identity) return status.innerText = 'No Identity';
    	status.innerText = "Logged in: "+scatter.identity.name;
    };

    setStatus();
    setInterval(() => {
	    setStatus();
    }, 1);

    // ScatterJS.connect('LernaVanillaTest', {network, allowHttp:false}).then(async connected => {
    // 	console.log('connected', connected);
    //     if(!connected) return false;
    //     scatter = ScatterJS.scatter;
    //     eos = scatter.eos(network, Eos);
    //
    //     scatter.addEventHandler((event, payload) => {
    //         console.log('app event', event, payload);
    //     });
    // });

    window.getVersion = async () => {
        const version = await scatter.getVersion();
        console.log('version', version);
    };

    window.login = async () => {
	    // await ScatterJS.login();
	    // eos = scatter.eos(network, Eos);

	    ScatterJS.connect('LernaVanillaTest', {network, allowHttp:false}).then(async connected => {
		    console.log('connected from dapp', connected);
		    if(!connected) return false;
		    await ScatterJS.login();
		    scatter = ScatterJS;
	    });
    };

    window.loginWithoutNetworks = async () => {
        // await scatter.suggestNetwork(network);
        await ScatterJS.login({accounts:[]});
    };

    window.loginAll = async () => {
        // await scatter.suggestNetwork(network);
        await ScatterJS.suggestNetwork(network2);
        await ScatterJS.loginAll({
	        personal:['firstname', 'lastname', 'email'],
	        location:['country', 'phone', 'address'],
	        accounts:[network]
        });
        console.log(ScatterJS.identity);
        eos = scatter.eos(network, Eos);
    };

    window.loginWithRequirements = async () => {
        await scatter.suggestNetwork(network);
        await scatter.getIdentity({
            personal:['firstname', 'lastname', 'email'],
            location:['country', 'phone', 'address'],
            accounts:[network]
        })
        console.log(scatter.identity);
        eos = scatter.eos(network, Eos);
    };

    window.updateIdentity = async () => {
        const done = await scatter.updateIdentity({
            name:'Lite Charity ALfa',
        })
        console.log('done', done);
    };

    window.getAvatar = async () => {
        const avatar = await scatter.getAvatar()
        document.getElementById('avatar').src = avatar;
    };

    window.authenticate = async () => {
    	const getRandom = () => Math.round(Math.random() * 8 + 1).toString();
    	let randomString = '';
    	for(let i = 0; i < 12; i++) randomString += getRandom();
    	console.log('randomString', randomString);
        await scatter.authenticate(randomString).then(res => console.log(res));
    };

    window.authenticateSpecific = async () => {
    	const getRandom = () => Math.round(Math.random() * 8 + 1).toString();
    	let nonce = '';
    	for(let i = 0; i < 12; i++) nonce += getRandom();
	    const account = scatter.identity.accounts.find(x => x.blockchain === 'eos');

	    // You can't use authenticate with Hardware Devices! Use the identity key in that instance.
	    const publicKey = account.isHardware ? scatter.identity.publicKey : account.publicKey;

	    const toSign = 'helloworldiamtheonethatknocks';
        await scatter.authenticate(nonce, toSign, publicKey)
            .then(res => {
            	const {ecc} = Eos.modules;
            	const shaData = ecc.sha256(
		            ecc.sha256(toSign) +
            		ecc.sha256(nonce)
                );
            	const recovered = ecc.recoverHash(res, shaData);
            	console.log('recovered?', recovered === publicKey);
            }).catch(err => {
            	console.log('err', err);
            })
    };

	 window.hardwareCapableProofs = async () => {
		 const account = scatter.identity.accounts.find(x => x.blockchain === 'eos');


		 // We're going to catch a reference to the buffer
		 let buffer;
		 const signProvider = async buf => buffer = buf;

		 // NOTICE WE ARE PUTTING THE signProvider HERE!!!!!
		 const contract = await eos.contract('scatterproof', {signProvider});

		 // NOTICE THE BROADCAST FALSE!!!!!!!!!!
		 const opts = { broadcast:false, authorization:[`${account.name}@${account.authority}`] };

		 const signed = await contract.prove(
			 'now you can sign a sha256 (f0e4c2f76c58916ec258f246851bea091d14d4247a2fc3e18694461b1816e13b) or an EOS key: EOS5yhN6BBC42eLKxrNDXcQ4pbpmr3QBiroQBrEgZAVTufT3rgVXv from hardware devices',
			 opts
		 );

		 const signature = signed.transaction.signatures[0];

		 const {ecc} = Eos.modules;
		 const recovered = ecc.recover(signature, buffer);
		 console.log('recovered?', recovered === account.publicKey);
	 }

	 window.updateAuth = async () => {
		 const accounts = scatter.identity.accounts.filter(x => x.blockchain === 'eos');

		 eos.transaction({
             actions:accounts.map(account => {
             	console.log('account', account);
	             let auth = {
		             accounts:[],
		             keys:[{key:'EOS7jdkKQLhUq9FtWZcLexS9dpYFzs9PFJNM8ydxxTPZibyqxkQva', weight:1}],
		             threshold:1,
		             waits:[],
	             };

             	return {
	                account: 'eosio',
	                name: 'updateauth',
	                data: {
		                account: account.name,
		                permission: 'active',
                        parent:'owner',
		                auth
	                },
	                authorization: [{
		                actor:account.name,
		                permission:account.authority
	                }]
                }
             })
         })

	 }

	 window.approveMSIG = async () => {
		 const account = scatter.identity.accounts.filter(x => x.blockchain === 'eos')[0];



		 eos.transaction({
			 actions: [{
				 account: 'eosio.msig',
				 name: 'approve',
				 data: {
					 proposer:account.name,
                     proposal_name:'test',
                     level:{
					 	actor:account.name,
                         permission:account.authority
                     }
				 },
				 authorization: [{
					 actor:account.name,
					 permission:account.authority
				 }]
             }]
		 });
	 }

    window.logout = async () => {
        await scatter.forgetIdentity();
    };


    window.addToken = async () => {

    	const token = ScatterJS.Token.fromJson({
		    blockchain:'eos',
            contract:'ridlridlcoin',
            symbol:'RIDL1',
            decimals:4
        })

        await scatter.addToken(token);
    };

    window.transfer = async () => {
	    const account = ScatterJS.account('eos');
        const opts = { authorization:[`${account.name}@${account.authority}`], requiredFields:{} };
        eos.transfer(account.name, 'charityalfa1', '0.0001 EOS', account.name, opts).then(trx => {
            console.log('trx', trx);
        }).catch(err => {
//            console.error(err);
        })
    };

    window.transferWithFields = async () => {
        const account = scatter.identity.accounts.find(x => x.blockchain === 'eos');
        const requiredFields = {
        	personal:['firstname', 'lastname'],
            location:['address']
        };
        const opts = { authorization:[`${account.name}@${account.authority}`], requiredFields };
        eos.transfer(account.name, 'eosio', '1.0000 EOS', '', opts).then(trx => {
            console.log('trx', trx);
        }).catch(err => {
//            console.error(err);
        })
    };

    window.donate = () => {
        const tokenDetails = {contract:'eosio.token', symbol:'EOS', memo:'Charity Alfa Donation', decimals:4};
        scatter.requestTransfer(network, 'charityalfa1', '1.0000', tokenDetails).then(res => console.log(res));
    };

    window.donateFreely = () => {
        const tokenDetails = {contract:'eosio.token', symbol:'EOS', memo:'Charity Alfa Donation', decimals:4};
        scatter.requestTransfer(network, 'zentesmababy', 0, tokenDetails).then(res => console.log(res));
    };

    window.contract = () => {
        const account = scatter.identity.accounts.find(x => x.blockchain === 'eos');
        const opts = { authorization:[`${account.name}@${account.authority}`] };
        // eos.contract('eosio.token', {requiredFields:{}}).then(contract => {
        //     contract.transfer(account.name, 'eosio', '1.0000 EOS', '', opts).then(trx => {
        //         console.log('trx', trx);
        //     }).catch(err => {
        //         console.error(err);
        //     })
        // })
        eos.contract('wizardstoken').then(contract => {
            contract.createwizard(opts).then(trx => {
                console.log('trx', trx);
            }).catch(err => {
                console.error(err);
            })
        })
    }

    window.multi = () => {
        const account = scatter.identity.accounts.find(x => x.blockchain === 'eos');
        const opts = { authorization:[`${account.name}@${account.authority}`] };

	    eos
		    .transaction(tr => {
			    tr.newaccount({
				    creator: account.name,
				    name: 'eosio',
				    owner: account.publicKey,
				    active: account.publicKey
			    });
			    tr.delegatebw(account.name, account.name, '1.0000 EOS', '1.0000 EOS', 0, opts);
			    tr.transfer(account.name, 'eosio', '1.0000 EOS', '', opts);
		    })
		    .then(trx => {
			    console.log(trx.transaction_id);
		    })
		    .catch(err => {
			    console.log(err);
		    });
    };

    window.suggestNetwork = async () => {
	    await scatter.suggestNetwork(ScatterJS.Network.fromJson({
		    blockchain:'eos',
		    chainId:'1',
		    host:'not-real.com',
		    port:443,
		    protocol:'https',
            token:{
                symbol:'SYS',
                contract:'eosio.token'
            }
	    })).then(res => console.log(res));
    }

    window.arbitrary = () => {
	    const account = scatter.identity.accounts.find(x => x.blockchain === 'eos');
        scatter.getArbitrarySignature(account.publicKey, 'This should be able to be signed by anything', 'Testing', false).then(signed => {
        	console.log('signed', signed);
        })
    }

    window.unsignableArbitrary = () => {
	    const account = scatter.identity.accounts.find(x => x.blockchain === 'eos');
        scatter.getArbitrarySignature(account.publicKey, 'hello_world_im_too_long_yo', 'Testing', false);
    }

	 window.hasAccountFor = () => {
		 scatter.hasAccountFor(network).then(res => {
			 console.log('res', res);
			 scatter.hasAccountFor({ host:'not-real.com', port:80, blockchain:'eos', chainId:'2' }).then(res => {
				 console.log('should fail', res);
			 }).catch(error => {
				 console.log('should fail', error);
			 });
		 }).catch(error => {
			 console.log('error', error)
		 });

	 }

    let publicKey;
    window.getPublicKey = () => {
        scatter.getPublicKey('eos').then(res => {
	        publicKey = res;
            console.log('res', res);
        }).catch(error => {
        	console.log('error', error)
        });
    }

    window.linkAccount = () => {

    	const account = {
    	    name:'hello',
            authority:'active',
            publicKey
        };

        scatter.linkAccount(account, network).then(res => {
            console.log('res', res);
        }).catch(error => {
        	console.log('error', error)
        });
    }

</script>

</body>
</html>