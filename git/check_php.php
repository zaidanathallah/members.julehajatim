<?php
header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Cek PHP & Database Lokal Juleha</title>
    <style>
        body { font-family: sans-serif; padding: 30px; background: #f8fafc; color: #1e293b; }
        .card { background: #fff; padding: 25px; border-radius: 12px; max-width: 600px; margin: auto; box-shadow: 0 4px 12px rgba(0,0,0,0.08); }
        h2 { color: #d97706; margin-top: 0; }
        .badge { display: inline-block; padding: 4px 10px; border-radius: 6px; font-weight: bold; background: #dcfce7; color: #15803d; }
        .row { margin: 12px 0; border-bottom: 1px solid #f1f5f9; padding-bottom: 8px; }
        .label { font-weight: bold; width: 180px; display: inline-block; }
    </style>
</head>
<body>
    <div class="card">
        <h2>Pengecekan Server Lokal</h2>
        <div class="row"><span class="label">Versi PHP:</span> <span class="badge"><?php echo phpversion(); ?></span></div>
        <div class="row"><span class="label">Server Software:</span> <?php echo $_SERVER['SERVER_SOFTWARE'] ?? 'PHP CLI Server'; ?></div>
        <div class="row"><span class="label">Dokument Root:</span> <?php echo $_SERVER['DOCUMENT_ROOT'] ?? __DIR__; ?></div>
        <div class="row">
            <span class="label">Koneksi Database:</span> 
            <?php
            try {
                if (file_exists(__DIR__ . '/application/config/database.php')) {
                    defined('BASEPATH') or define('BASEPATH', TRUE);
                    include __DIR__ . '/application/config/database.php';
                    $cfg = $db['default'] ?? null;
                    if ($cfg) {
                        mysqli_report(MYSQLI_REPORT_OFF);
                        $conn = @mysqli_connect($cfg['hostname'], $cfg['username'], $cfg['password'], $cfg['database']);
                        if ($conn) {
                            $res = @mysqli_query($conn, "SELECT COUNT(*) FROM members");
                            $count = $res ? mysqli_fetch_row($res)[0] : 'OK';
                            echo "<span class='badge' style='background:#dcfce7; color:#15803d;'>Terhubung (" . htmlspecialchars($cfg['database']) . ", $count Anggota)</span>";
                            mysqli_close($conn);
                        } else {
                            echo "<span class='badge' style='background:#fee2e2; color:#b91c1c;'>Gagal Koneksi: " . htmlspecialchars(mysqli_connect_error()) . "</span>";
                        }
                    }
                } else {
                    echo "<span class='badge' style='background:#fef3c7; color:#b45309;'>database.php tidak ditemukan</span>";
                }
            } catch (Throwable $e) {
                echo "<span class='badge' style='background:#fee2e2; color:#b91c1c;'>Info: " . htmlspecialchars($e->getMessage()) . "</span>";
            }
            ?>
        </div>
        <p style="margin-top:20px; font-size:14px; color:#64748b;">
            File ini dibuat untuk pengecekan cepat. Kunjungi <a href="/members/login">/members/login</a> untuk membuka aplikasi utama.
        </p>
    </div>
</body>
</html>
