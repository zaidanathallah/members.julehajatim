<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Upload Foto KTA Juleha Jatim</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding-top: 40px;
        }
        .upload-card {
            max-width: 520px;
            margin: auto;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
            border: none;
        }
        .upload-header {
            background: linear-gradient(135deg, #e67e22, #d35400);
            color: #ffffff;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
            padding: 20px;
            text-align: center;
        }
        .upload-header h4 {
            margin: 0;
            font-size: 1.35rem;
            font-weight: 700;
        }
        .upload-body {
            padding: 25px;
            background-color: #ffffff;
            border-bottom-left-radius: 12px;
            border-bottom-right-radius: 12px;
        }
        .btn-upload {
            background-color: #d35400;
            border-color: #d35400;
            color: #fff;
            font-weight: 600;
            width: 100%;
            padding: 10px;
            border-radius: 6px;
        }
        .btn-upload:hover {
            background-color: #ba4a00;
            color: #fff;
        }
        .preview-box {
            text-align: center;
            margin-bottom: 15px;
        }
        .preview-box img {
            max-width: 160px;
            max-height: 200px;
            border-radius: 8px;
            border: 2px dashed #ccc;
            padding: 4px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card upload-card">
        <div class="upload-header">
            <h4>Upload Foto KTA Anggota</h4>
            <small>Juru Sembelih Halal (Juleha) Jawa Timur</small>
        </div>
        <div class="upload-body">
            <?php 
                $hasId = !empty($juleha_id); 
                $cleanId = $hasId ? htmlspecialchars($juleha_id, ENT_QUOTES, 'UTF-8') : '';
                $currentImg = $hasId ? base_url('images/' . $cleanId . '.jpg') : 'https://via.placeholder.com/160x200?text=Foto+KTA';
            ?>
            <form id="uploadForm" action="<?php echo base_url('members/upload_foto_kta'); ?>" method="post" enctype="multipart/form-data" onsubmit="handleSubmit();">
                <div class="preview-box">
                    <img id="imgPreview" src="<?php echo $currentImg; ?>" onerror="this.src='https://via.placeholder.com/160x200?text=Foto+KTA'" alt="Preview Foto">
                </div>

                <div class="form-group">
                    <label for="custom_name" class="font-weight-bold">Nomor ID Juleha / Nama File:</label>
                    <input type="text" name="custom_name" id="custom_name" class="form-control" 
                           value="<?php echo $cleanId; ?>" 
                           placeholder="Contoh: SDA220003" 
                           <?php echo $hasId ? 'readonly' : ''; ?> required>
                    <small class="form-text text-muted"><?php echo $hasId ? 'ID Juleha telah terkunci sesuai data anggota.' : 'Masukkan Nomor ID Juleha (misal: SDA220003) untuk foto KTA.'; ?></small>
                </div>

                <div class="form-group">
                    <label for="fileToUpload" class="font-weight-bold">Pilih Berkas Foto:</label>
                    <input type="file" name="fileToUpload" id="fileToUpload" class="form-control-file" accept=".jpg,.jpeg,.png" required onchange="previewImage(this);">
                    <small class="form-text text-muted">Format: <strong>JPG, JPEG, PNG</strong> (Foto ukuran besar/kamera HP akan <strong>otomatis dikompres & disesuaikan</strong> oleh sistem agar pas di kartu KTA).</small>
                    <div id="fileInfo" class="mt-1" style="font-size: 0.85rem; color: #28a745; display: none;"></div>
                </div>

                <div class="mt-4">
                    <button type="submit" id="btnSubmit" class="btn btn-upload">Upload & Perbarui Foto KTA</button>
                    <a id="btnBatal" href="<?php echo $hasId ? base_url('members/showcard/' . $cleanId) : base_url(); ?>" class="btn btn-outline-secondary btn-block mt-2">Batal & Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        var file = input.files[0];
        var sizeMB = (file.size / (1024 * 1024)).toFixed(2);
        var infoDiv = document.getElementById('fileInfo');
        infoDiv.style.display = 'block';
        infoDiv.innerHTML = '&#10004; File terpilih: <strong>' + file.name + '</strong> (' + sizeMB + ' MB). <em>Sistem akan otomatis mengompres foto ini.</em>';

        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('imgPreview').src = e.target.result;
        }
        reader.readAsDataURL(file);
    }
}

function handleSubmit() {
    var btn = document.getElementById('btnSubmit');
    btn.disabled = true;
    btn.innerHTML = 'Mengompres & Mengunggah...';
}

document.getElementById('custom_name').addEventListener('input', function() {
    var id = this.value.trim();
    var btn = document.getElementById('btnBatal');
    if (id) {
        btn.href = '<?php echo base_url('members/showcard/'); ?>' + encodeURIComponent(id);
    } else {
        btn.href = '<?php echo base_url(); ?>';
    }
});
</script>

</body>
</html>
