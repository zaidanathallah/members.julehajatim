<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Keanggotaan julehajatim.com</title>
		<script src="/assets/puji/easy.qrcode.min.js" type="text/javascript" charset="utf-8"></script>
        <style>
            .imgblock{
                text-align:center;
            }
            .imgblock .title{
                background:none;
                color:red;
                padding: 10px;
                font-weight: large;
            }
            #footer{
                text-align:center;
            }
        </style>
	</head>
	<body>
		<div id="container"></div>
		<div id="footer">
			<a href="https://julehajatim.com">https://julehajatim.com</a>
		</div>
	</body>
</html>
        <script type="text/template" id="qrcodeTpl">
			<div class="imgblock">
				<div class="title"><?php echo strtoupper($juleha_id);?></div>
				<div class="qr" id="qrcode_0"></div>
			</div>
		</script>
		<script type="text/javascript">
			var demoParams = [
				{
					title: "Cek Keanggotaan Saya, Kak!!!",
					config: {
						text: "https://members.julehajatim.com/members/show/<?php echo strtoupper($juleha_id);?>", // Content

						width: 240, // Widht
						height: 240, // Height
						colorDark: "black", // Dark color
						colorLight: "#ffffff", // Light color
                        
                        quietZone: 15,
                        quietZoneColor: 'white',

						// === Logo
						//logo: "logo-transparent.png", // LOGO
						logo: "/assets/juleha/logo.png",
						//					logo:"http://127.0.0.1:8020/easy-qrcodejs/demo/logo.png",  
						//					logoWidth:80, 
						//					logoHeight:80,
						logoBackgroundColor: '#ffffff', // Logo backgroud color, Invalid when `logBgTransparent` is true; default is '#ffffff'
						logoBackgroundTransparent: false, // Whether use transparent image, default is false


						correctLevel: QRCode.CorrectLevel.H // L, M, Q, H

					}

				
				}

			]
			var qrcodeTpl = document.getElementById("qrcodeTpl").innerHTML;
			var container = document.getElementById('container');
			var qrcodeHTML = qrcodeTpl;
			container.innerHTML+=qrcodeHTML;
			var t = new QRCode(document.getElementById("qrcode_0"),demoParams[0].config)
		</script>