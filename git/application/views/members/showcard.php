<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Kartu Tanda Anggota - <?php echo htmlspecialchars($obj->nickname ?? $obj->juleha_id, ENT_QUOTES, 'UTF-8'); ?> - Juleha Jatim</title>
    <!-- Bootstrap 4 & FontAwesome & Poppins Font -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/adminlte/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <script type="text/javascript" src="https://code.jquery.com/jquery-latest.js"></script>
    <script src="/assets/easy.qrcode.js" type="text/javascript" charset="utf-8"></script>

    <style>
        body {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            font-family: 'Poppins', sans-serif;
            color: #1e293b;
            min-height: 100vh;
            padding: 20px 10px 40px;
        }
        .kta-card-wrapper {
            max-width: 540px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            border: 1px solid rgba(226, 232, 240, 0.8);
        }
        .kta-header {
            background: linear-gradient(135deg, #ea580c, #c2410c);
            color: #ffffff;
            padding: 20px 15px;
            text-align: center;
        }
        .kta-header h4 {
            margin: 0;
            font-size: 1.25rem;
            font-weight: 700;
            letter-spacing: 0.5px;
        }
        .kta-header p {
            margin: 4px 0 0;
            font-size: 0.85rem;
            opacity: 0.95;
        }
        .canvas-container {
            padding: 20px 15px;
            text-align: center;
            background: #f1f5f9;
        }
        #canvas {
            max-width: 100%;
            width: 100%;
            height: auto;
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
            display: inline-block;
        }
        .kta-actions {
            padding: 20px 22px;
            background: #ffffff;
        }
        .status-badge {
            font-size: 0.85rem;
            font-weight: 600;
            padding: 5px 14px;
            border-radius: 50px;
            display: inline-block;
        }
        .badge-aktif {
            background-color: #dcfce7;
            color: #15803d;
            border: 1px solid #bbf7d0;
        }
        .badge-nonaktif {
            background-color: #fee2e2;
            color: #b91c1c;
            border: 1px solid #fecaca;
        }
        .btn-download-kta {
            background: linear-gradient(135deg, #16a34a, #15803d);
            color: #ffffff;
            font-weight: 600;
            border: none;
            border-radius: 10px;
            padding: 12px;
            transition: all 0.2s ease;
        }
        .btn-download-kta:hover {
            background: linear-gradient(135deg, #15803d, #166534);
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(22, 163, 74, 0.3);
        }
        .btn-ganti-foto {
            background-color: #f59e0b;
            color: #ffffff;
            font-weight: 600;
            border: none;
            border-radius: 10px;
            padding: 12px;
            transition: all 0.2s ease;
        }
        .btn-ganti-foto:hover {
            background-color: #d97706;
            color: #ffffff;
        }
        .btn-back {
            border-radius: 10px;
            padding: 11px;
            font-weight: 500;
        }
        #mybarcode {
            display: none !important;
        }
        @media (max-width: 576px) {
            body { padding: 10px 6px 30px; }
            .kta-card-wrapper { border-radius: 14px; }
            .canvas-container { padding: 12px 6px; }
            .kta-header { padding: 15px 10px; }
            .kta-actions { padding: 15px 14px; }
        }
    </style>
</head>
<body>

    <div id="mybarcode"></div>

    <div class="container">
        <div class="kta-card-wrapper">
            <div class="kta-header">
                <h4>KARTU TANDA ANGGOTA</h4>
                <p>Juru Sembelih Halal (Juleha) Jawa Timur</p>
                <div class="mt-2">
                    <?php if (strtolower($obj->mstatus) === 'aktif'): ?>
                        <span class="status-badge badge-aktif"><i class="fas fa-check-circle mr-1"></i> Status: Anggota Aktif</span>
                    <?php else: ?>
                        <span class="status-badge badge-nonaktif"><i class="fas fa-exclamation-circle mr-1"></i> Status: <?php echo htmlspecialchars($obj->mstatus, ENT_QUOTES, 'UTF-8'); ?></span>
                    <?php endif; ?>
                </div>
            </div>

            <?php if ($this->input->get('updated')): ?>
            <div class="alert alert-success alert-dismissible fade show m-3 text-center mb-0" role="alert" style="border-radius: 10px;">
                <i class="fas fa-check-circle mr-1"></i> <strong>Foto KTA Berhasil Diperbarui!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php endif; ?>

            <div class="canvas-container">
                <canvas id="canvas" width="597" height="919"></canvas>
            </div>

            <div class="kta-actions">
                <div class="text-center mb-3">
                    <span class="text-muted font-weight-bold" style="font-size: 0.95rem;">
                        <?php echo htmlspecialchars($obj->nickname ?? $obj->juleha_id, ENT_QUOTES, 'UTF-8'); ?> 
                        &bull; ID: <code><?php echo htmlspecialchars($obj->juleha_id, ENT_QUOTES, 'UTF-8'); ?></code>
                    </span>
                </div>

                <button onclick="download()" class="btn btn-download-kta btn-block shadow-sm">
                    <i class="fas fa-download mr-1"></i> Download Kartu KTA (.PNG)
                </button>
                <a href="<?php echo base_url('members/uploder/' . rawurlencode($obj->juleha_id)); ?>" class="btn btn-ganti-foto btn-block shadow-sm mt-2">
                    <i class="fas fa-camera mr-1"></i> Ganti / Perbarui Foto KTA
                </a>
                <a href="<?php echo base_url(); ?>" class="btn btn-outline-secondary btn-back btn-block mt-2">
                    <i class="fas fa-arrow-left mr-1"></i> Kembali ke Daftar Anggota
                </a>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        var julehaId = "<?php echo addslashes($obj->juleha_id); ?>";
        var nickName = "<?php echo addslashes($obj->nickname); ?>";
        var mstatus  = "<?php echo addslashes(strtolower($obj->mstatus)); ?>";
        var timestamp = "<?php echo time(); ?>";

        // 1. Generate QR Code ke container tersembunyi
        var qrParams = {
            text: "https://members.julehajatim.com/members/show/" + encodeURIComponent(julehaId),
            width: 240,
            height: 240,
            colorDark: "#000000",
            colorLight: "#ffffff",
            quietZone: 15,
            quietZoneColor: "#ffffff",
            correctLevel: QRCode.CorrectLevel.H
        };
        new QRCode(document.getElementById("mybarcode"), qrParams);

        // 2. Siapkan Objek Gambar
        var kta  = new Image();
        var foto = new Image();
        var logo = new Image();

        var fotoLoaded = false;
        var ktaLoaded  = false;
        var logoLoaded = false;

        kta.onload = function() { ktaLoaded = true; renderCard(); };
        foto.onload = function() { fotoLoaded = true; renderCard(); };
        foto.onerror = function() { fotoLoaded = false; renderCard(); };
        logo.onload = function() { logoLoaded = true; renderCard(); };

        kta.src  = "<?php echo base_url('assets/kta.jpg'); ?>";
        foto.src = "<?php echo base_url('images/' . $obj->juleha_id . '.jpg?t='); ?>" + timestamp;
        logo.src = "<?php echo base_url('assets/juleha.jpg'); ?>";

        // 3. Fungsi Menggambar KTA ke Canvas
        function renderCard() {
            var canvas = document.getElementById("canvas");
            var ctx    = canvas.getContext("2d");

            var cWidth  = (kta && (kta.naturalWidth || kta.width)) ? (kta.naturalWidth || kta.width) : 597;
            var cHeight = (kta && (kta.naturalHeight || kta.height)) ? (kta.naturalHeight || kta.height) : 919;
            canvas.width  = cWidth;
            canvas.height = cHeight;

            // Bersihkan kanvas
            ctx.clearRect(0, 0, cWidth, cHeight);

            // A. Gambar Background Template KTA
            if (kta && (kta.complete || ktaLoaded) && kta.naturalWidth > 0) {
                ctx.drawImage(kta, 0, 0, cWidth, cHeight);
            }

            // B. Gambar QR Code
            var qrCanvas = document.querySelector("#mybarcode canvas");
            if (qrCanvas) {
                var bwidth  = qrCanvas.width * 0.6;
                var bheight = qrCanvas.height * 0.6;
                var bx = cWidth * 0.37;
                var by = cHeight * 0.70;
                ctx.drawImage(qrCanvas, bx, by, bwidth, bheight);

                // Tambahkan Logo Juleha kecil di tengah QR Code
                if (logo && (logo.complete || logoLoaded) && logo.naturalWidth > 0) {
                    var lSize = bwidth * 0.25;
                    var lx = bx + (bwidth - lSize) / 2;
                    var ly = by + (bheight - lSize) / 2;
                    ctx.drawImage(logo, lx, ly, lSize, lSize);
                }
            }

            // C. Frame & Foto Anggota
            var fotoframetop = cHeight * 0.27399;
            ctx.fillStyle = "white";
            ctx.fillRect(cWidth * 0.06, fotoframetop - 2, 227, 305);

            if (foto && (foto.complete || fotoLoaded) && foto.naturalWidth > 0) {
                ctx.drawImage(
                    foto,
                    0, 0, foto.naturalWidth, foto.naturalHeight,
                    cWidth * 0.08, fotoframetop,
                    175, 250
                );
            } else {
                // Placeholder jika foto belum diunggah
                ctx.fillStyle = "#f8fafc";
                ctx.fillRect(cWidth * 0.08, fotoframetop, 175, 250);
                ctx.strokeStyle = "#cbd5e1";
                ctx.lineWidth = 2;
                ctx.strokeRect(cWidth * 0.08, fotoframetop, 175, 250);
                ctx.fillStyle = "#64748b";
                ctx.font = "bold 16px Poppins, sans-serif";
                ctx.textAlign = "center";
                ctx.fillText("FOTO KTA", cWidth * 0.08 + 87, fotoframetop + 120);
                ctx.font = "12px Poppins, sans-serif";
                ctx.fillText("(Belum Diunggah)", cWidth * 0.08 + 87, fotoframetop + 145);
                ctx.textAlign = "left";
            }

            // D. Garis Kotak & Teks Nama / ID Juleha
            var lineX = cWidth * 0.435;
            var lineY = fotoframetop + 150;
            ctx.beginPath();
            ctx.lineWidth = 5;
            ctx.strokeStyle = "black";
            ctx.moveTo(lineX + 256, lineY);
            ctx.lineTo(lineX, lineY);
            ctx.lineTo(lineX, lineY + 48);
            ctx.lineTo(lineX + 256, lineY + 48);
            ctx.stroke();

            ctx.fillStyle = "black";
            ctx.font = "bold 24px Poppins, sans-serif";
            ctx.fillText(nickName, cWidth * 0.46, cHeight * 0.42);
            ctx.font = "bold 24px Poppins, sans-serif";
            ctx.fillText(julehaId, cWidth * 0.46, cHeight * 0.47);

            // E. Penanda Jika Status Tidak Aktif
            if (mstatus !== "aktif") {
                ctx.strokeStyle = "red";
                ctx.fillStyle = "red";
                ctx.font = "bold 20px Poppins, sans-serif";
                ctx.fillText("Bukan lagi anggota Juleha Jatim", cWidth * 0.4, cHeight * 0.37);
                ctx.beginPath();
                ctx.lineWidth = 6;
                ctx.moveTo(lineX + 400, lineY - 200);
                ctx.lineTo(0, lineY + 150);
                ctx.stroke();
            }
        }

        function download() {
            renderCard();
            var canvas = document.getElementById('canvas');
            var link = document.createElement('a');
            link.download = "KTA_JULEHA_" + julehaId + ".png";
            link.href = canvas.toDataURL("image/png");
            link.click();
        }

        // Trigger render berulang untuk menjamin tampil 100% mulus
        $(document).ready(function(){
            renderCard();
            setTimeout(renderCard, 80);
            setTimeout(renderCard, 250);
            setTimeout(renderCard, 600);
            setTimeout(renderCard, 1200);
        });
    </script>
</body>
</html>
