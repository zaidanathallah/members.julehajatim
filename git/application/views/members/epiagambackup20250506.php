<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>KTA Juleha Jatim</title>
		<script type="text/javascript" src="https://code.jquery.com/jquery-latest.js">
		</script>
		<script src="/assets/easy.qrcode.js" type="text/javascript" charset="utf-8"></script>
		<link rel="stylesheet" href="/assets/epiagam.css">
	</head>
	<body>
		<img id="logo" src="/assets/juleha.jpg" style="display:none"/>
		<img id="foto" style="display:none" src="/images/<?php echo $obj->juleha_id;?>.jpg" alt="">
		<img id="kta" style="display:none" src="/assets/e-piagam-masjid-agung-sidoarjo.png
" alt="">
		<div id="container">
			<canvas id="canvas" width="600" height="999"></canvas>
		</div>
		<div class="puji" id="mybarcode">

		</div>
	</body>
</html>
		<script type="text/javascript">
			var demoParams = 	{
				title: "Logo + quietZoneColor",
				config: {
					text: "https://members.julehajatim.com/members/show/<?php echo $obj->juleha_id;?>", // Content
					width: 240, // Widht
					height: 240, // Height
					colorDark: "#000000", // Dark color
					colorLight: "#ffffff", // Light color
                      quietZone: 15,
                      quietZoneColor: 'gold',
					//logo: "juleha.jpg", // LOGO
					//logoBackgroundColor: '#ffffff', // Logo backgroud color, Invalid when `logBgTransparent` is true; default is '#ffffff'
					logoBackgroundTransparent: false, // Whether use transparent image, default is false
					correctLevel: QRCode.CorrectLevel.H // L, M, Q, H
				}
			}
			x = new QRCode(document.getElementById("mybarcode"),demoParams.config)
		</script>
		<script type="text/javascript">
			x = $("#mybarcode canvas")
			y = x[0]
			x.hide()
			var ctx2 = y.getContext("2d")
			console.log("Canvas",x[0].toDataURL())
			barcode = new Image()
			barcode.src = y.toDataURL()
		</script>
		<script type="text/javascript">
			var canvas = document.getElementById("canvas")

			var ctx = canvas.getContext("2d")
			var kta = document.getElementById("kta")
			var foto = document.getElementById("foto")
			canvas.width = kta.width
			canvas.height = kta.height
			ctx.drawImage(kta,0,0)
			var bwidth = (barcode.width)*0.6
			var bheight = (barcode.height)*0.6
			/*ctx.drawImage(
				barcode,
				((canvas.width)*0.37),
				(canvas.height)*0.70,
				bwidth,
				bheight,
		)*/
		var fotoframetop = (canvas.height)*0.27399
		ctx.fillStyle = "white"
		ctx.fillRect((canvas.width)*0.06,fotoframetop-2,227,305)
		ctx.font = "34px Sans Serif"
		ctx.fillStyle = "black"

		ctx.lineWidth = 5
		var lineX = (canvas.width)*0.435
		var lineY = fotoframetop+150
		/*ctx.beginPath();*/
		/*ctx.moveTo(lineX+256,lineY);*/
		/*ctx.lineTo(lineX,lineY)*/
		/*ctx.lineTo(lineX, lineY+48);*/
		/*ctx.lineTo(lineX+256,lineY+48)*/
		ctx.stroke();

		ctx.fillText("<?php echo $obj->nickname;?>",(canvas.width)*0.46,(canvas.height)*0.42)
		ctx.font = "34px Sans Serif"
		/*ctx.fillText("<?php echo $obj->juleha_id;?>",(canvas.width)*0.46,(canvas.height)*0.47)*/
		/*ctx.drawImage(
			foto,
			0,
			0,
			foto.width,
			foto.height,
			(canvas.width)*0.08,
			1*(fotoframetop),
			175,
			250
		)*/
		/*ctx.drawImage(
			logo,
            ((canvas.width)*0.37)+bwidth*0.38,
            ((canvas.height)*0.70)+bwidth*0.38,
			bwidth*0.25,
			bheight*0.25,
		)*/
		console.log("foto.height",foto.height)
		</script>
