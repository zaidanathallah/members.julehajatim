<?php
#[AllowDynamicProperties]
Class Members extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->library('session');
        $this->load->model('member');
        $this->load->model('epiagam');
        $this->load->model('portofolio');
        $this->load->model('certificate');
        $this->load->model('training');
        $this->load->helper('inflector');
        $this->load->library('julehalibs');
        $this->load->model('region');
    }

    private function ensure_session_started(){
        if (session_status() === PHP_SESSION_NONE) {
            @session_start();
        }
    }

    private function get_session_data($key){
        $this->ensure_session_started();
        if (!empty($_SESSION[$key])) {
            return $_SESSION[$key];
        }
        if (isset($this->session) && is_object($this->session)) {
            $val = $this->session->userdata($key);
            if (!empty($val)) {
                return $val;
            }
        }
        return null;
    }

    private function is_logged_in(){
        return !empty($this->get_session_data('juleha_id'));
    }

    function getmax(){
        $region = $this->uri->segment(3);
        $max = $this->member->getmax($region);
        echo json_encode($max);
    }
    
    public function uploder(){
        if (!$this->is_logged_in()) {
            redirect('/members/login');
            return;
        }
        $juleha_id = $this->uri->segment(3);
        $this->load->view('members/uploder', array('juleha_id' => $juleha_id));
    }

    public function upload_foto_kta(){
        if (!$this->is_logged_in()) {
            redirect('/members/login');
            return;
        }

        $customName = $this->input->post('custom_name', TRUE);
        if (empty($customName)) {
            $customName = $this->get_session_data('juleha_id');
        }
        $customName = preg_replace('/[^A-Za-z0-9_\-]/', '_', $customName);

        // Pastikan folder penyimpanan gambar ada
        $uploadPath = './images/';
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0755, TRUE);
        }

        // Konfigurasi library CI_Upload - Izinkan hingga 30MB, sistem otomatis mengompres
        $config['upload_path']   = $uploadPath;
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['file_name']     = $customName . '_temp_' . time() . '.jpg';
        $config['overwrite']     = TRUE;
        $config['max_size']      = 30720; // 30MB untuk mendukung foto kamera resolusi tinggi (2K/4K)

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('fileToUpload')) {
            $error = $this->upload->display_errors('', '');
            echo "<script>alert('Gagal mengunggah foto KTA: " . addslashes(strip_tags($error)) . "'); window.history.back();</script>";
            return;
        }

        $uploadData = $this->upload->data();
        $sourceFilePath = $uploadData['full_path'];
        $targetJpg = $uploadPath . $customName . '.jpg';

        // Logika Auto-Kompresi & Penyesuaian Foto KTA menggunakan GD Library
        $imageContent = file_get_contents($sourceFilePath);
        $sourceImg = @imagecreatefromstring($imageContent);

        if ($sourceImg !== false) {
            // Perbaiki orientasi EXIF (khusus foto kamera HP / smartphone yang sering miring 90 derajat)
            if (function_exists('exif_read_data')) {
                $exif = @exif_read_data($sourceFilePath);
                if (!empty($exif['Orientation'])) {
                    switch ($exif['Orientation']) {
                        case 3:
                            $sourceImg = imagerotate($sourceImg, 180, 0);
                            break;
                        case 6:
                            $sourceImg = imagerotate($sourceImg, -90, 0);
                            break;
                        case 8:
                            $sourceImg = imagerotate($sourceImg, 90, 0);
                            break;
                    }
                }
            }

            $origWidth  = imagesx($sourceImg);
            $origHeight = imagesy($sourceImg);

            // Skala dimensi maksimum ideal untuk kartu KTA (tajam, proporsional, dan ringan)
            $maxWidth  = 800;
            $maxHeight = 1000;

            if ($origWidth > $maxWidth || $origHeight > $maxHeight) {
                $ratio = min($maxWidth / $origWidth, $maxHeight / $origHeight);
                $newWidth  = (int) round($origWidth * $ratio);
                $newHeight = (int) round($origHeight * $ratio);
            } else {
                $newWidth  = $origWidth;
                $newHeight = $origHeight;
            }

            // Buat kanvas baru dengan latar belakang putih bersih
            $canvas = imagecreatetruecolor($newWidth, $newHeight);
            $white  = imagecolorallocate($canvas, 255, 255, 255);
            imagefilledrectangle($canvas, 0, 0, $newWidth, $newHeight, $white);

            // Resample dengan interpolasi halus
            imagecopyresampled($canvas, $sourceImg, 0, 0, 0, 0, $newWidth, $newHeight, $origWidth, $origHeight);

            // Kompres dan simpan sebagai file JPG standar KTA (kualitas 82%, ukuran otomatis hemat 80KB-200KB)
            imagejpeg($canvas, $targetJpg, 82);

            imagedestroy($canvas);
            imagedestroy($sourceImg);

            // Bersihkan file upload sementara jika nama berbeda
            if ($sourceFilePath !== $targetJpg && file_exists($sourceFilePath)) {
                @unlink($sourceFilePath);
            }
        } else {
            // Fallback jika tidak dapat diproses GD
            if ($sourceFilePath !== $targetJpg) {
                rename($sourceFilePath, $targetJpg);
            }
        }

        echo "<script>alert('Foto KTA berhasil diunggah dan otomatis dikompres.'); window.location.href='" . base_url('members/showcard/' . rawurlencode($customName)) . "';</script>";
    }

    // Alias aman untuk endpoint legacy ngaplod
    public function ngaplod(){
        $this->upload_foto_kta();
    }
    function edit(){
        if (!$this->is_logged_in()) {
            redirect('/members/login');
            return;
        }
        $objs = $this->member->get($this->uri->segment(3));
        $regions = $this->region->gets();
        $data = array(
            'objs'=>$objs['res'],
            'title'=>'Edit Keanggotaan Juleha',
            'active'=>array('list'=>'active','profile'=>''),
            'region'=>$this->julehalibs->getcomboformat($regions['res'],'initial','name')
        );
        $this->load->view('members/edit',$data);
    }
    function encryptpwd(){
        echo sha1($this->uri->segment(3));
    }
    function index(){
        if (!$this->is_logged_in()) {
            redirect('/members/login');
            return;
        }
        $objs = $this->member->gets();
        $regions = $this->region->gets();
        $data = array(
            'objs'=>$objs['res'],
            'title'=>'Keanggotaan Juleha',
            'active'=>array('list'=>'active','profile'=>''),
            'region'=>$this->julehalibs->getcomboformat($regions['res'],'initial','name')
        );
        $this->load->view('members/all',$data);
    }
    function login(){
        $this->load->view('members/login');
    }
    function loginhandler0(){
        $juleha_id = $this->input->post('juleha_id', TRUE);
        $password = $this->input->post('password');

        if (empty($juleha_id) || empty($password)) {
            redirect('/members/login');
            return;
        }

        $memberdata = $this->member->getpassword($juleha_id);

        if ($memberdata && password_verify($password, $memberdata['password'])) {
            $this->ensure_session_started();
            @session_regenerate_id(true);

            $session_data = [
                'juleha_id'   => $juleha_id,
                'id'          => $memberdata['id'],
                'memberlevel' => $memberdata['memberlevel'],
                'logged_in'   => TRUE
            ];
            
            $_SESSION['juleha_id'] = $juleha_id;
            $_SESSION['id'] = $memberdata['id'];
            $_SESSION['memberlevel'] = $memberdata['memberlevel'];
            if (isset($this->session) && is_object($this->session)) {
                $this->session->set_userdata($session_data);
            }
            redirect('/members/profile');
        } else {
            redirect('/members/login');
        }
    }
    function loginhandler(){
        $this->ensure_session_started();
        $params = $this->input->post();
        if (empty($params['juleha_id']) || empty($params['password'])) {
            redirect('/members/login');
            return;
        }
        $gpw = $this->member->getpassword($params['juleha_id']);
        if($gpw && isset($gpw['password']) && $gpw['password']===sha1($params['password'])){
            $_SESSION['juleha_id'] = $params['juleha_id'];
            $_SESSION['id'] = $gpw['id'];
            $_SESSION['memberlevel'] = $gpw['memberlevel'];
            if (isset($this->session) && is_object($this->session)) {
                $this->session->set_userdata([
                    'juleha_id'   => $params['juleha_id'],
                    'id'          => $gpw['id'],
                    'memberlevel' => $gpw['memberlevel']
                ]);
            }
            redirect('/members/profile');
        }else{
            redirect('/members/login');
        }
    }
    function authhandler_(){
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept"); 

        $this->ensure_session_started();
        $params = $this->input->post();
        if (!empty($params['juleha_id']) && !empty($params['password'])) {
            $gpw = $this->member->getpassword($params['juleha_id']);
            if($gpw && isset($gpw['password']) && $gpw['password']===sha1($params['password'])){
                $_SESSION['juleha_id'] = $params['juleha_id'];
                $_SESSION['id'] = $gpw['id'];
                $_SESSION['memberlevel'] = $gpw['memberlevel'];
                if (isset($this->session) && is_object($this->session)) {
                    $this->session->set_userdata([
                        'juleha_id'   => $params['juleha_id'],
                        'id'          => $gpw['id'],
                        'memberlevel' => $gpw['memberlevel']
                    ]);
                }
                echo json_encode(array("result"=>true));
                return;
            }
        }
        echo json_encode(array("result"=>false));
    }
    function authhandler(){
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept"); 

        $this->ensure_session_started();
        $params = $this->input->post();
        if (!empty($params['juleha_id']) && !empty($params['password'])) {
            $gpw = $this->member->getpassword($params['juleha_id']);
            if($gpw && isset($gpw['password']) && $gpw['password']===sha1($params['password'])){
                $_SESSION['juleha_id'] = $params['juleha_id'];
                $_SESSION['id']= $gpw['id'];
                $_SESSION['memberlevel'] = $gpw['memberlevel'];
                if (isset($this->session) && is_object($this->session)) {
                    $this->session->set_userdata([
                        'juleha_id'   => $params['juleha_id'],
                        'id'          => $gpw['id'],
                        'memberlevel' => $gpw['memberlevel']
                    ]);
                }
                echo json_encode(array("result"=>true));
                return;
            }
        }
        echo json_encode(array("result"=>false));
    }

    public function logout(){
        $this->ensure_session_started();
        $_SESSION = [];
        if (session_id()) {
            @session_destroy();
        }
        if (isset($this->session) && is_object($this->session)) {
            $this->session->sess_destroy();
        }
        redirect('/members/login');
    }

    function profile(){
        if (!$this->is_logged_in()) {
            redirect('/members/login');
            return;
        }
        $memberId = $this->get_session_data('id');
        $julehaId = $this->get_session_data('juleha_id');
        if ($memberId) {
            $obj = $this->member->get($julehaId);
            $data = array(
                'juleha_id' => $julehaId,
                'obj'=>$obj['res'],
                'portofolio'=>$this->portofolio->gets($memberId),
                'certificate'=>$this->certificate->gets($memberId),
                'training'=>$this->training->gets($memberId),
                'active'=>array('list'=>'','profile'=>'active')
            );
            $this->load->view('members/profile',$data);    
        }else{
            redirect('/members/login');
        }
    }
function save(){
    $params = $this->input->post();
    $params['columns']['password'] = sha1($params['columns']['password']);
    
    $juleha_id = $params['columns']['juleha_id'];
    
    // Cek apakah ada file gambar yang dikirim dari frontend
    if (!empty($_FILES['img_file']['tmp_name'])) {
        // Tentukan lokasi dan nama file tujuan
        $fileName = $this->config->item('userimagepath') . $juleha_id . '.jpg';
        
        // Langsung pindahkan file asli ke folder tujuan
        move_uploaded_file($_FILES['img_file']['tmp_name'], $fileName);
    } else {
        log_message('error', 'Tidak ada file gambar yang diterima oleh server.');
    }
    
    // Simpan data text ke database dan kirim respon json
    echo json_encode($this->member->save($params));
}

function saveImage($img, $juleha_id){
    if (empty($img)) {
        log_message('error', 'Data gambar kosong.');
        return false;
    }

    // WAJIB: Ambil indeks [1] agar menjadi string base64 murni tanpa header data:image
    if (strpos($img, ',') !== false) {
        $parts = explode(',', $img);
        $img = $parts[1]; 
    }
    
    // Decode data gambar
    $fileData = base64_decode($img, true);
    
    if ($fileData === false) {
        log_message('error', 'Gagal decode base64 untuk ID: ' . $juleha_id);
        return false;
    }
    
    // Tentukan lokasi folder dan nama file
    $fileName = $this->config->item('userimagepath') . $juleha_id . '.jpg';
    
    return file_put_contents($fileName, $fileData);
}

    function saveori1(){
        $params = $this->input->post();
        $params['columns']['password'] = sha1($params['columns']['password']);
        echo json_encode($this->member->save($params));
        $img = $_POST['img'];
        $this->saveImage($img,$params['columns']['juleha_id']);
    }
    function saveori2(){
    // 1. Ambil semua data input
    $params = $this->input->post();
    
    // Enkripsi password
    $params['columns']['password'] = sha1($params['columns']['password']);
    
    // 2. Ambil data gambar dari POST
    $img = $this->input->post('img'); // Menggunakan standard CodeIgniter lebih aman
    $juleha_id = $params['columns']['juleha_id'];
    
    // 3. Jalankan fungsi simpan gambar TERLEBIH DAHULU
    if (!empty($img)) {
        $this->saveImage($img, $juleha_id);
    }
    
    // 4. TERAKHIR: Simpan data ke database dan kirim respons ke AJAX
    $result = $this->member->save($params);
    echo json_encode($result);
}

    function saveImageori2($img, $juleha_id){
    // 1. Cek apakah data kosong atau tidak
    if (empty($img)) {
        log_message('error', 'Data gambar kosong.');
        return false;
    }

    // 2. Bersihkan header base64 jika ada
    if (strpos($img, ',') !== false) {
        $img = explode(',', $img)[1];
    }
    
    // 3. Decode data gambar
    $fileData = base64_decode($img, true); // true untuk cek validasi
    
    // 4. Jika gagal decode, hentikan proses
    if ($fileData === false) {
        log_message('error', 'Gagal decode base64 untuk ID: ' . $juleha_id);
        return false;
    }
    
    // 5. Tentukan lokasi dan simpan file
    $fileName = $this->config->item('userimagepath') . $juleha_id . '.jpg';
    
    return file_put_contents($fileName, $fileData);
}

    function saveImageori1($img, $juleha_id){
    // Menghapus teks header base64 secara dinamis (bisa untuk png, jpg, jpeg)
    if (preg_match('/^data:image\/(\w+);base64,/', $img, $type)) {
        $img = substr($img, strpos($img, ',') + 1);
    }
    
    // Mengganti spasi menjadi plus akibat proses pengiriman data
    $img = str_replace(' ', '+', $img);
    
    // Decode data gambar
    $fileData = base64_decode($img);
    
    // Menentukan lokasi dan nama file
    $fileName = $this->config->item('userimagepath') . $juleha_id . '.jpg';
    
    // Menyimpan file ke dalam folder
    file_put_contents($fileName, $fileData);
    }

    function saveImageori($img,$juleha_id){
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $fileData = base64_decode($img);
        $fileName = $this->config->item('userimagepath').$juleha_id.'.jpg';

        file_put_contents($fileName, $fileData);
    }
    function save_image(){
        $params = $this->input->post();
        $this->saveImage($params['image'],$params['imagename']);
        echo json_encode($params);
    }
    function updatedata(){
        $params = $this->input->post();
        echo json_encode($this->member->update($params));
    }
    function update(){
        $params = $this->input->post();
        $params['columns']['password'] = sha1($params['columns']['password']);
        echo json_encode($this->member->update($params));
    }
    function get(){
        $obj = $this->member->get($this->uri->segment(3));
        $myarr = [
            ["name"=>"loc1","address"=>"addr1"],
            ["name"=>"loc2","address"=>"addr2"],
            ["name"=>"loc3","address"=>"addr3"],
            ["name"=>"loc4","address"=>"addr4"],
            ["name"=>"loc5","address"=>"addr5"],
            ["name"=>"loc6","address"=>"addr6"],
        ];
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept"); 
        echo json_encode($obj);
    }
    function trainingget(){
        $obj = $this->training->gets($this->uri->segment(3));
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept"); 
        echo json_encode($obj);
    }
    function portofolioget(){
        $obj = $this->portofolio->gets($this->uri->segment(3));
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept"); 
        echo json_encode($obj);
    }
    function certificateget(){
        $obj = $this->certificate->gets($this->uri->segment(3));
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept"); 
        echo json_encode($obj);
    }
    function showqr(){
        $juleha_id = $this->uri->segment(3);
        $obj = $this->member->get($juleha_id);
        $data = array(
            'juleha_id'=>$juleha_id,
            'obj'=>$obj['res'],
         );
        $this->load->view('members/showqr',$data);
    }
    function show(){
        $juleha_id = $this->uri->segment(3);
        $obj = $this->member->get($juleha_id);
        if($obj!=false){
        $data = array(
            'juleha_id'=>$juleha_id,
            'obj'=>$obj['res'],
         );
        $this->load->view('members/show',$data);
        }else{
           // echo "NOMOR tidak valid";
            $this->load->view("members/inputidtoshowcard");
        }
    }
    function showcard(){
        $juleha_id = $this->uri->segment(3);
        $obj = $this->member->get($juleha_id);
        if($obj!=false){
        $data = array(
            'juleha_id'=>$juleha_id,
            'obj'=>$obj['res'],
         );
        $this->load->view('members/showcard',$data);
        }else{
            //echo "NOMOR tidak valid";
            $this->load->view("members/inputidtoshowcard");
        }
    }

}