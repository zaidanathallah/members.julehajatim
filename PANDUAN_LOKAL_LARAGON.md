# PANDUAN MENJALANKAN CODEIGNITER 3 DI LOKAL (UNTUK DEVELOPER REACT / NEXT.JS)
> **"Bahasa Bayi":** Panduan ramah pemula tanpa istilah membingungkan, khusus untuk kamu yang terbiasa dengan ekosistem `npm run dev`, React, atau Next.js!

---

## 👶 Kamus Kilat: Dari Dunia Next.js ke Dunia PHP CI3

Biar nggak bingung, ini perbandingan konsepnya:

| Konsep di Next.js / React | Konsep di PHP CodeIgniter 3 | Fungsinya |
| :--- | :--- | :--- |
| `npm run dev` | **Laragon "Start All"** ATAU `php -S localhost:8000` | Menyalakan local server agar bisa dibuka di browser. |
| `localhost:3000` | `http://localhost:8000` atau `http://members-juleha.test` | URL aplikasi yang dibuka di browser. |
| File `.env` (`DATABASE_URL=...`) | File `git/application/config/database.php` | Tempat nyimpen user, password, dan nama database. *(Sudah kita settingkan ke user `root` tanpa password)*. |
| `next.config.js` (`basePath`) | File `git/application/config/config.php` (`base_url`) | Setting alamat dasar web. *(Sudah kita buat otomatis!)* |
| Folder `pages/` atau `app/` | Folder `git/application/controllers/` | Tempat ngatur rute & logika halaman web. |

---

## 🚀 2 Cara Menjalankan Aplikasi di Laptop Kamu

Pilih salah satu cara di bawah ini yang paling kamu suka:

---

### CARA 1: Gaya Anak Frontend (Paling Mirip `npm run dev`) ⭐️
*Cara ini paling gampang dan tidak perlu pusing mikirin settingan Apache.*

1. **Nyalakan Database di Laragon:**
   * Buka aplikasi **Laragon** di Windows kamu.
   * Klik tombol besar bertuliskan **"Start All"** (agar MySQL menyala).
2. **Buka Terminal di IDE (VS Code / Terminal Anda):**
   * Masuk ke folder `git` dengan perintah:
     ```bash
     cd git
     ```
   * Jalankan server lokal:
     ```bash
     php -S localhost:8000
     ```
3. **Buka Browser:**
   * Buka link: **[http://localhost:8000](http://localhost:8000)**
   * Otomatis kamu akan diarahkan ke halaman login anggota Juleha!

---

### CARA 2: Gaya Laragon (Pakai Domain Keren `.test`)
*Folder `git` sudah kami hubungkan langsung ke Laragon `C:\laragon\www\members-juleha`.*

1. **Buka Laragon:**
   * Klik kanan pada aplikasi Laragon $\rightarrow$ pilih **PHP** $\rightarrow$ **Version** $\rightarrow$ pastikan tercentang **`php-8.3.30`**.
   * Klik tombol **"Start All"** pada jendela Laragon.
2. **Buka Browser:**
   * Ketik alamat: **[http://members-juleha.test](http://members-juleha.test)**
   * Halaman login Juleha langsung muncul.

---

## 🔍 Cara Cek Versi PHP & Koneksi Database Lewat Browser

Kami sudah buatkan file pengecek otomatis bernama `check_php.php` di dalam folder `git`.

1. Pastikan server lokal sudah nyala (pakai Cara 1 atau Cara 2).
2. Buka salah satu link ini di browser kamu:
   * Jika pakai Cara 1: **[http://localhost:8000/check_php.php](http://localhost:8000/check_php.php)**
   * Jika pakai Cara 2: **[http://members-juleha.test/check_php.php](http://members-juleha.test/check_php.php)**
3. **Hasil yang akan kamu lihat di layar:**
   * **Versi PHP:** `8.3.30` (warna hijau)
   * **Koneksi Database:** `Terhubung (Database: julehaaja_members, 1050 Anggota)`

---

## 🛠️ Ringkasan Settingan yang Sudah Dikonfigurasikan

Kamu tidak perlu pusing utak-atik file lagi, semuanya sudah kami bereskan:

1. **Koneksi Database** ([git/application/config/database.php](file:///d:/Members%20juleha%20jatim/git/application/config/database.php)):
   * Host: `localhost` (127.0.0.1)
   * User: `root`
   * Password: ` ` *(kosong)*
   * Nama Database: `julehaaja_members`
2. **Base URL Otomatis** ([git/application/config/config.php](file:///d:/Members%20juleha%20jatim/git/application/config/config.php)):
   * Sudah dibuat dinamis sehingga kamu bisa buka lewat `localhost:8000` maupun `members-juleha.test` tanpa redirect nyasar ke web live.
3. **Junction Link Laragon:**
   * Jalan pintas dari `C:\laragon\www\members-juleha` ke `D:\Members juleha jatim\git` sudah aktif.

---

## ❓ Troubleshooting (Kalau Ketemu Kendala)

* **Q: Pas buka browser muncul "Database Error"?**  
  *Jawab:* Cek aplikasi Laragon kamu, pastikan tombol **"Start All"** sudah diklik dan tulisan MySQL berwarna hijau.
* **Q: Gimana cara mematikan server `php -S` di terminal?**  
  *Jawab:* Sama seperti Next.js, tekan kombinasi tombol `Ctrl + C` di terminal.
