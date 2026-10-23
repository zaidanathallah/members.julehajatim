<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>KTA Juleha Jatim</title>
		<script type="text/javascript" src="https://code.jquery.com/jquery-latest.js">
		</script>
		<script src="/assets/easy.qrcode.js" type="text/javascript" charset="utf-8"></script>
		<link rel="stylesheet" href="/assets/puji.css">
	</head>
	<body>
	    <input type="text" id="juleha_id" />
	    <button id="showcard" onclick="gotocard()">Lihat kartu</button>

		
	</body>
</html>
<script>

    function gotocard(){
        window.location.href = 'https://members.julehajatim.com/members/showcard/'+$('#juleha_id').val()
    }
    /*$('#showcard').on('click',function(){
        gotocard();
    })*/
</script>
	