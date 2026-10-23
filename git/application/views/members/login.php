<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Login Anggota - Juru Sembelih Halal (Juleha) Jawa Timur</title>

  <!-- Google Font: Poppins -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/assets/adminlte/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style (AdminLTE / Bootstrap 4) -->
  <link rel="stylesheet" href="/assets/adminlte/dist/css/adminlte.min.css">

  <style>
    :root {
      --primary-color: #059669;
      --primary-hover: #047857;
      --primary-dark: #064e3b;
      --accent-gold: #d97706;
    }

    * {
      box-sizing: border-box;
      font-family: 'Poppins', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
    }

    body.login-page-modern {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      background: #f1f5f9;
      background-image: 
        radial-gradient(at 10% 20%, rgba(5, 150, 105, 0.12) 0px, transparent 50%),
        radial-gradient(at 90% 80%, rgba(13, 148, 136, 0.1) 0px, transparent 50%),
        radial-gradient(at 50% 50%, rgba(245, 158, 11, 0.05) 0px, transparent 50%);
      padding: 20px 15px;
      margin: 0;
    }

    .login-wrapper {
      width: 100%;
      max-width: 440px;
      margin: auto;
    }

    .login-card-modern {
      background: #ffffff;
      border: 1px solid rgba(226, 232, 240, 0.8);
      border-radius: 20px;
      box-shadow: 0 20px 45px -12px rgba(15, 23, 42, 0.15), 0 4px 12px -2px rgba(15, 23, 42, 0.05);
      overflow: hidden;
      transition: transform 0.25s ease, box-shadow 0.25s ease;
    }

    .login-card-modern:hover {
      box-shadow: 0 25px 50px -12px rgba(5, 150, 105, 0.2);
    }

    .card-top-accent {
      height: 6px;
      background: linear-gradient(90deg, #059669 0%, #10b981 50%, #d97706 100%);
    }

    .card-content-body {
      padding: 34px 30px 28px 30px;
    }

    @media (max-width: 480px) {
      .card-content-body {
        padding: 26px 20px 22px 20px;
      }
    }

    .brand-section {
      text-align: center;
      margin-bottom: 24px;
    }

    .brand-logo-wrap {
      width: 82px;
      height: 82px;
      margin: 0 auto 12px auto;
      border-radius: 50%;
      background: #ffffff;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 6px;
      box-shadow: 0 8px 20px rgba(5, 150, 105, 0.18);
      border: 2px solid #ecfdf5;
    }

    .brand-logo-img {
      max-width: 100%;
      max-height: 100%;
      object-fit: contain;
    }

    .brand-title {
      font-size: 1.25rem;
      font-weight: 700;
      color: #064e3b;
      margin-bottom: 2px;
      letter-spacing: -0.2px;
    }

    .brand-subtitle {
      font-size: 0.88rem;
      font-weight: 600;
      color: #059669;
      text-transform: uppercase;
      letter-spacing: 1px;
      margin-bottom: 4px;
    }

    .brand-desc {
      font-size: 0.8rem;
      color: #64748b;
      margin: 0;
    }

    /* Custom Input Controls */
    .form-group-custom {
      margin-bottom: 18px;
    }

    .form-label-custom {
      display: block;
      font-size: 0.84rem;
      font-weight: 600;
      color: #334155;
      margin-bottom: 6px;
    }

    .input-group-custom {
      position: relative;
      display: flex;
      align-items: stretch;
      width: 100%;
      border-radius: 12px;
      overflow: hidden;
      border: 1.5px solid #cbd5e1;
      background: #f8fafc;
      transition: all 0.2s ease;
    }

    .input-group-custom:focus-within {
      border-color: #059669;
      background: #ffffff;
      box-shadow: 0 0 0 3px rgba(5, 150, 105, 0.15);
    }

    .input-icon-left {
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 0 14px;
      color: #64748b;
      font-size: 0.95rem;
      background: transparent;
    }

    .input-group-custom:focus-within .input-icon-left {
      color: #059669;
    }

    .form-input-custom {
      flex: 1;
      border: none;
      background: transparent;
      padding: 12px 10px 12px 0;
      font-size: 0.92rem;
      color: #1e293b;
      outline: none;
      width: 100%;
    }

    .form-input-custom::placeholder {
      color: #94a3b8;
      font-size: 0.85rem;
    }

    .input-btn-toggle {
      border: none;
      background: transparent;
      color: #64748b;
      padding: 0 14px;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1rem;
      transition: color 0.2s ease;
      outline: none;
    }

    .input-btn-toggle:hover, .input-btn-toggle:focus {
      color: #059669;
      outline: none;
    }

    /* Submit Button */
    .btn-login-submit {
      width: 100%;
      padding: 12px 18px;
      background: linear-gradient(135deg, #059669 0%, #047857 100%);
      color: #ffffff;
      border: none;
      border-radius: 12px;
      font-size: 0.95rem;
      font-weight: 600;
      letter-spacing: 0.3px;
      cursor: pointer;
      box-shadow: 0 6px 18px rgba(5, 150, 105, 0.3);
      transition: all 0.25s ease;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-top: 10px;
    }

    .btn-login-submit:hover {
      background: linear-gradient(135deg, #047857 0%, #065f46 100%);
      box-shadow: 0 8px 24px rgba(5, 150, 105, 0.4);
      transform: translateY(-1px);
      color: #ffffff;
      text-decoration: none;
    }

    .btn-login-submit:active {
      transform: translateY(0);
      box-shadow: 0 3px 10px rgba(5, 150, 105, 0.25);
    }

    /* Alert Styling */
    .alert-login-error {
      background-color: #fef2f2;
      border: 1px solid #fecaca;
      border-left: 4px solid #ef4444;
      color: #991b1b;
      border-radius: 12px;
      padding: 12px 16px;
      font-size: 0.85rem;
      line-height: 1.45;
      margin-bottom: 20px;
      display: flex;
      align-items: flex-start;
      gap: 10px;
      animation: fadeIn 0.3s ease;
    }

    .alert-login-error .alert-icon {
      font-size: 1.05rem;
      color: #ef4444;
      flex-shrink: 0;
      margin-top: 1px;
    }

    .alert-login-error .alert-text {
      flex: 1;
      font-weight: 500;
    }

    .alert-login-error .close-alert {
      background: transparent;
      border: none;
      color: #991b1b;
      font-size: 1.1rem;
      cursor: pointer;
      line-height: 1;
      padding: 0 0 0 8px;
      opacity: 0.7;
      transition: opacity 0.2s;
    }

    .alert-login-error .close-alert:hover {
      opacity: 1;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(-6px); }
      to { opacity: 1; transform: translateY(0); }
    }

    /* Footer */
    .login-footer {
      text-align: center;
      margin-top: 20px;
      font-size: 0.76rem;
      color: #64748b;
      line-height: 1.5;
    }

    .login-footer strong {
      color: #064e3b;
    }
  </style>
</head>
<body class="login-page-modern">

<div class="login-wrapper">
  <div class="login-card-modern">
    <div class="card-top-accent"></div>
    <div class="card-content-body">
      
      <!-- Brand Section -->
      <div class="brand-section">
        <div class="brand-logo-wrap">
          <img src="/assets/juleha/logo.png" alt="Logo Juleha Jatim" class="brand-logo-img" onerror="this.onerror=null;this.src='/assets/juleha/julehajatim72.png';">
        </div>
        <h1 class="brand-title">Juru Sembelih Halal</h1>
        <div class="brand-subtitle">Jawa Timur</div>
        <p class="brand-desc">Sistem Informasi Manajemen Keanggotaan</p>
      </div>

      <!-- Error Notification Banner -->
      <?php if (!empty($login_error)): ?>
        <div class="alert-login-error" role="alert" id="loginAlert">
          <i class="fas fa-exclamation-circle alert-icon"></i>
          <div class="alert-text">
            <?php echo htmlspecialchars($login_error, ENT_QUOTES, 'UTF-8'); ?>
          </div>
          <button type="button" class="close-alert" onclick="$('#loginAlert').fadeOut(250);" aria-label="Tutup">
            &times;
          </button>
        </div>
      <?php endif; ?>

      <!-- Login Form -->
      <form action="/members/loginhandler" method="post" id="loginForm" autocomplete="on">
        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

        <!-- Input ID Juleha -->
        <div class="form-group-custom">
          <label for="juleha_id" class="form-label-custom">
            <i class="fas fa-id-card text-success mr-1"></i> Nomor ID Juleha
          </label>
          <div class="input-group-custom">
            <span class="input-icon-left">
              <i class="fas fa-user-circle"></i>
            </span>
            <input 
              type="text" 
              name="juleha_id" 
              id="juleha_id" 
              class="form-input-custom" 
              placeholder="Contoh: SDA220003" 
              value="<?php echo htmlspecialchars($prev_juleha_id ?? '', ENT_QUOTES, 'UTF-8'); ?>"
              required 
              autofocus 
              autocomplete="username"
              style="text-transform: uppercase; font-weight: 600; letter-spacing: 0.5px;"
            >
          </div>
        </div>

        <!-- Input Password with Eye Toggle -->
        <div class="form-group-custom">
          <label for="inputPassword" class="form-label-custom">
            <i class="fas fa-lock text-success mr-1"></i> Password Akun
          </label>
          <div class="input-group-custom">
            <span class="input-icon-left">
              <i class="fas fa-key"></i>
            </span>
            <input 
              type="password" 
              name="password" 
              id="inputPassword" 
              class="form-input-custom" 
              placeholder="Masukkan password Anda" 
              required 
              autocomplete="current-password"
            >
            <button 
              type="button" 
              id="btnTogglePassword" 
              class="input-btn-toggle" 
              title="Lihat / Sembunyikan Password" 
              aria-label="Lihat / Sembunyikan Password"
              tabindex="-1"
            >
              <i class="fas fa-eye" id="eyeIcon"></i>
            </button>
          </div>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn-login-submit" id="btnSubmit">
          <i class="fas fa-sign-in-alt mr-2"></i> Masuk ke Sistem
        </button>
      </form>

    </div>
  </div>

  <!-- Footer Branding -->
  <div class="login-footer">
    &copy; 2021-2026 <strong>Juru Sembelih Halal (Juleha) Jawa Timur</strong>.<br>
    Halal, Syar'i, Terpercaya & Profesional.
  </div>
</div>

<!-- Scripts -->
<script src="/assets/adminlte/plugins/jquery/jquery.min.js"></script>
<script src="/assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script>
  $(document).ready(function() {
    // 1. Logika Mata (Show / Hide Password)
    $('#btnTogglePassword').on('click', function(e) {
      e.preventDefault();
      var $pwd = $('#inputPassword');
      var $icon = $('#eyeIcon');

      if ($pwd.attr('type') === 'password') {
        $pwd.attr('type', 'text');
        $icon.removeClass('fa-eye').addClass('fa-eye-slash text-success');
        $(this).attr('title', 'Sembunyikan Password');
      } else {
        $pwd.attr('type', 'password');
        $icon.removeClass('fa-eye-slash text-success').addClass('fa-eye');
        $(this).attr('title', 'Lihat Password');
      }
      $pwd.focus();
    });

    // 2. Otomatis Huruf Kapital pada Input ID Juleha
    $('#juleha_id').on('input', function() {
      var start = this.selectionStart;
      var end = this.selectionEnd;
      this.value = this.value.toUpperCase();
      this.setSelectionRange(start, end);
    });

    // 3. Efek Loading Saat Submit Form agar tidak dobel klik
    $('#loginForm').on('submit', function() {
      var $btn = $('#btnSubmit');
      $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-2"></i> Memeriksa...');
    });
  });
</script>

</body>
</html>
