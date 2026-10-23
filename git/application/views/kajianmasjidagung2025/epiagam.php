<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>e-piagam Juleha Jatim</title>

		<script type="text/javascript" src="https://code.jquery.com/jquery-latest.js">
		</script>
		<script src="/assets/easy.qrcode.js" type="text/javascript" charset="utf-8"></script>
		<link rel="stylesheet" href="/assets/epiagam.css">
	</head>
	<body>
		<img id="epiagam" style="display:none" src="/assets/template-epiagam.png" alt="">
		<img id="logo" src="/assets/juleha.jpg" style="display:none"/>
        <a href="https://members.julehajatim.com/kajianmasjidagung/epiagam/<?php echo $prev_id;?>" style="display:none">Prev</a>
        <a href="https://members.julehajatim.com/kajianmasjidagung/epiagam/<?php echo $next_id;?>" style="display:none">Next</a>
        <button onclick="download()" style="display:none">Download</button>
		<div id="container">
			<canvas id="canvas" width="600" height="999"></canvas>


		</div>
	</body>
</html>
<script>
    var download = function(){
    var link = document.createElement('a');
    link.download = "<?php echo $peserta->name;?>.png";
    link.href = document.getElementById('canvas').toDataURL()
    link.click();
    }
</script>
<script type="text/javascript">
    var canvas = document.getElementById("canvas")

    <?php $koef=30;?>
    var nametextstart = "<?php echo $koef*strlen($peserta->name)/2;?>"
    var ctx = canvas.getContext("2d")
    var epiagam = document.getElementById("epiagam")
    canvas.width = epiagam.width
    canvas.height = epiagam.height
    ctx.drawImage(epiagam,0,0)
    ctx.font = "34px Sans Serif"
    ctx.fillStyle = "black"
var abibas = new FontFace('abibas', 'url(/assets/fonts/abibas/Abibas.ttf)');
abibas.load().then(function(font){
  document.fonts.add(font);
    ctx.lineWidth = 5
    var lineX = (canvas.width)*0.435
    ctx.font = " 70px abibas";
    ctx.fillStyle = "#ff0000"
    ctx.fillText("<?php echo $peserta->name;?>",(canvas.width/2)-nametextstart,(canvas.height)*0.42)
    ctx.font = "34px Sans Serif"
    download()
});





</script>
