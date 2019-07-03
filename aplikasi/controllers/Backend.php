<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'core/Admin.php';

class Backend extends Admin {
	
	function __construct(){
		parent::__construct(); 
		// setheader();
		clear_expired_session();
		$this->checklogin();
	}
	public function createNikAutomaticly(){
		// 0619001
		$date = date('my');
		$checkDatabase = query('SELECT id, count(id) as id, max(RIGHT(nik,4)) as nik_terbaru FROM karyawan WHERE is_deleted IS NULL');
		$data = $checkDatabase->row();
		// json($data->nik_terbaru); die();
		if ($data->nik_terbaru === null) {
			$nomor = '0001';
		}else{
			$nomor = (int)($data->nik_terbaru)+1;
			$nomor = sprintf("%04s", $nomor);
		}
		// json($nomor); die();
		$format = $date.$nomor;
		$response = $this->responses(true, 200, $format);
		json($response);
	}
	private function loadPage($location){
		$data = ['file' => $location];
		interpreter($data);	
	}
	private function checklogin(){
		if($this->session->userdata('user_id')){
     		return true;
		}else{
		    redirect(site_url());
		}
	}
	public function logout(){
        $this->save_activity('keluar dari aplikasi', '', 'logout');
		$user_data = $this->session->all_userdata();
        foreach ($user_data as $key => $value) {
            if ($key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity') {
                $this->session->unset_userdata($key);
            }
        }
    	$this->session->sess_destroy();
    	redirect(site_url(),'refresh');
	}
	public function masukan(){
		$data = [
			'judul' => post('judul'),
			'keterangan' => post('keterangan')
		];
		$simpan = $this->db->insert('masukan', $data);
		$lastid = $this->db->insert_id();
		if ($simpan) {
			$getMasukan = where('id', $lastid);
			$getMasukan = minta('masukan');
			$dataMasukan = $getMasukan->row();
			// send email notification when data masukan inserted.
			$title = 'Pemberitahuan Masukan Aplikasi File Manager';
			$email = 'chiealgalih.com';
			$subject = $dataMasukan->judul;
			$header = 'Hai Sri wahyuni, <br/><br/>';
			$footer = '<br/><br/><br/><i>* Pesan ini dikirim otomatis oleh system, tetap semangat ya!</i>';
			$message = $header.$dataMasukan->keterangan.$footer;
			$this->sendmail($title, $subject, $email, $message);
		}
	}
	function index(){
		$this->loadPage('modul/dashboard/index');
	}
	// ------------------------------------------------------------------------ departement
	function departement(){
		$this->loadPage('modul/departement/index');
	}
	function getDepartement(){
		model("getDepartement");
	}
	function getDepartementById(){
		$this->get_by_id(post('id'), 'departement');
	}
	function updateDepartement(){
		$data = ['departement' => post('departement')];
		$this->update(post('id'), $data, 'departement');
	}
	function simpanDepartement(){
		isajax();
		$data = ['departement' => post("departement")];
		$this->simpan($data, 'departement');
	}
	function hapusDepartement(){
		$id = post('id');
		$this->soft_delete($id, 'departement');
	}
	// ------------------------------------------------------------------------ end departementx
	// ------------------------------------------------------------------------ divisi
	function divisi(){
		$data = ['file' => 'modul/divisi/index'];
		interpreter($data);
	}
	function getDivisi(){
		model("getDivisi");
	}
	function getDivisiById(){
		$this->get_by_id(post('id'), 'divisi');
	}
	function updateDivisi(){
		$data = [
			'divisi' => post('divisi')
		];
		$this->update(post('id'), $data, 'divisi');
	}
	function simpanDivisi(){
		$data = [
			'divisi' => post('divisi')
		];
		$this->simpan($data, 'divisi');
	}
	function hapusDivisi(){
		$id = post('id');
		$this->soft_delete($id, 'divisi');
	}
	function getDepartementData(){
		$data = where('is_deleted', null);
		$data = minta('departement');
		JSON($data->result());
	}
	// ------------------------------------------------------------------------ end divisi
	// ------------------------------------------------------------------------ jabatan
	function jabatan(){
		$this->loadPage('modul/jabatan/index');
	}
	function getJabatan(){
		model("getJabatan");
	}
	function getJabatanById(){
		$this->get_by_id(post('id'), 'jabatan');
	}
	function updateJabatan(){
		$data = [
			'jabatan' => post('jabatan'),
			'kode' => post('kode'),
			'posisi' => post('posisi')
		];
		$this->update(post('id'), $data, 'jabatan');
	}
	function simpanJabatan(){
		$data = [
			'jabatan' => post('jabatan'),
			'kode' => post('kode'),
			'posisi' => post('posisi')
		];
		$this->simpan($data, 'jabatan');
	}
	function hapusJabatan(){
		$id = post('id');
		$this->soft_delete($id, 'jabatan');
	}
	function getDataDivisiByIdDepartement(){
		isajax();
		$idDepartement = post('idDepartement');
		$data = query("SELECT id, id_departement, divisi FROM divisi WHERE is_deleted IS NULL AND id_departement='$idDepartement'");
		if ($data->num_rows() > 0) {
			$response = $this->responses(true, 200, $data->result());
			// JSON($data->result());
		}else{
			$response = $this->responses(false, 500, 'Data tidak ditemukan');
			// JSON($response);
		}
			JSON($response);
	}
	function getUserByIdDepartementAndIdDivisi(){
		isajax();
		$idDepartement = post('idDepartement');
		$idDivisi = post('idDivisi');
		$data = query("SELECT id, nama, id_departement, id_divisi FROM user WHERE is_deleted IS NULL AND id_departement='$idDepartement' AND id_divisi='$idDivisi'");
		JSON($data->result());
	}
	function getDivisiData(){
		$data = query("SELECT * FROM divisi WHERE is_deleted IS NULL");
		JSON($data->result());
	}
	// ------------------------------------------------------------------------ end jabatan
	// ------------------------------------------------------------------------ user
	function user(){
		$this->loadPage('modul/user/index');
	}
	function getUser(){
		model('getUser');
	}
	function getUserById(){
		$this->get_by_id(post('id'), 'user');
	}
	function updateUser(){
		$data = [
			'nik' => post('nik'),
			'nama' => post('nama'),
			'telepon' => post('telepon'),
			'username' => post('username'),
			'email' => post('email')
		];
		$departement = post('departement');
		$jabatan = post('jabatan');
		$password = post('password');
		if ($password != '') {
			$password = password_hash($password, PASSWORD_DEFAULT);
			$data['katasandi'] = $password;
		}elseif ($departement != '') {
			$data['id_departement'] = $departement;
		}elseif ($jabatan != '') {
			$data['id_jabatan'] = $jabatan;
		}
		$update = $this->update(post('id'), $data, 'user');
		if ($update && (!empty($_FILES['file']['name']))) {
			$unggah = $this->unggah(post('id'), 'static/assets/images/profile', 'user');
		}
	}
	function getJabatanData(){
		isajax();
		$minta = where('is_deleted', null);
		$minta = minta('jabatan');
		JSON($minta->result());
	}
	function simpanUser(){
		isajax();
		$password = post('password');
		$hashPassword = password_hash($password, PASSWORD_DEFAULT);

		$data = [
			'nama' => post('nama'),
			'email' => post("email"),
			'id_divisi' => post('divisi'),
			'id_jabatan' => post("jabatan"),
			'username' => post("username"),
			'katasandi' => $hashPassword
		];
		$simpan = $this->db->insert('user', $data);
		$lastid = $this->db->insert_id();
		if ($simpan) {
			$unggah = $this->unggah($lastid, 'static/file/user', 'user');
		}
	}
	function hapusUser(){
		$id = post('id');
		$this->soft_delete($id, 'user');
	}
	// ------------------------------------------------------------------------ end user
	// ------------------------------------------------------------------------ karyawan
	function karyawan(){
		$this->loadPage('modul/karyawan/index');
	}
	function getKaryawan(){
		model('getKaryawan');
	}
	function getKaryawanById(){
		$this->get_by_id(post('id'), 'karyawan');
	}
	function updateKaryawan(){
		$data = [
			'nik' => post('nik'),
			'nama' => post('nama'),
			'divisi' => post('divisi'),
			'telepon' => post("telepon"),
			'alamat'  => post('alamat'),
			'jk'      => post('jk'),
			'tgl_lahir' => post('tgl_lahir')
		];
		$update = $this->update(post('id'), $data, 'karyawan');
		if ($update && (!empty($_FILES['file']['name']))) {
			$unggah = $this->unggah(post('id'), 'static/assets/images/profile', 'karyawan');
		}
	}
	function simpanKaryawan(){
		isajax();
		$data = [
			'nik' => post('nik'),
			'nama' => post('nama'),
			'divisi' => post('divisi'),
			'telepon' => post("telepon"),
			'alamat'  => post('alamat'),
			'jk'      => post('jk'),
			'tgl_lahir' => post('tgl_lahir')
		];
		$this->simpan($data, 'karyawan');
		// $simpan = $this->db->insert('karyawan', $data);
		// $lastid = $this->db->insert_id();
		// if ($simpan) {
		// 	$unggah = $this->unggah($lastid, 'static/file/karyawan', 'karyawan');
		// }
	}
	function hapusKaryawan(){
		$id = post('id');
		$this->soft_delete($id, 'karyawan');
	}
	// ------------------------------------------------------------------------ end karyawan
	// ------------------------------------------------------------------------ akun
	function akun(){
		$this->loadPage('modul/akun/index');
	}
	function getKodeMasterAkunByJenisAkun(){
		$jenis = post('jenis');
		// var_dump($jenis); die();
		if ($jenis === "" || $jenis === NULL) {
			$response = $this->responses(false, 500, 'Value kosong');
		}else{
			$nomorTerakhir = query("SELECT max(right(kode, 4)) as nomor FROM akun WHERE jenis = '$jenis' AND is_deleted IS NULL");
			$nomor = $nomorTerakhir->row();
			if ($nomor->nomor === NULL) {
				if ($jenis === "Kas/Bank" || $jenis === "Aktiva Lancar" || $jenis === "Aktiva Tetap") {
					$response = '1111';
				}else if ($jenis === "Kewajiban") {
					$response = '2111';
				}else if ($jenis === "Modal") {
					$response = '3111';
				}else if ($jenis === "Pendapatan") {
					$response = '4111';
				}else{
					$response = '5111';
				}
			}else{
				$kode = substr($nomor->nomor, 0);
				$kode = (int)($kode)+1;
				$response = $kode;
			}
		}
		json($response);
	}
	function getAkun(){
		model('getAkun');
	}
	function getAkunById(){
		$this->get_by_id(post('id'), 'akun');
	}
	function updateAkun(){
		isajax();
		$id = post('id');
		$data = [
			'kode' => post('kode'),
			'nama' => post('nama'),
			'jenis' => post('jenis'),
			'saldo' => post('saldo')
		];
		$this->update(post('id'), $data, 'akun');
	}
	function simpanAkun(){
		isajax();
		// check kode apakah sudah disimpan atau belum ?
		$check = query("SELECT kode FROM akun WHERE is_deleted IS NULL AND kode='$kode'");
		$data = $check->row();
		// jika kode kosong, maka simpan.
		if ($data->kode === NULL) {
			$data = [
				'kode' => post('kode'),
				'nama' => post('nama'),
				'jenis' => post('jenis'),
				'saldo' => post('saldo')
			];
			$this->simpan($data, 'akun');
		}else{
			// jika kode ditemukan, maka kirim pesan dan tidak akan disimpan.
			$response = $this->responses(false, 500, 'Kode sudah ada');
			json($response);
		}
	}
	function hapusAkun(){
		$id = post('id');
		$this->soft_delete($id, 'akun');
	}
	// ------------------------------------------------------------------------ end akun
	// ------------------------------------------------------------------------ kas keluar
	function kaskeluar(){
		$this->loadPage('modul/kaskeluar/index');
	}
	function checkNominal(){
		$id = post('id');
		$nominal = post('nominal');
		$check = query("SELECT id, kode, nama, saldo FROM akun WHERE id='$id' AND is_deleted IS NULL");
		if ($check->num_rows() > 0) {
			$data = $check->row();
			if ($nominal > $data->saldo) {
				$response = $this->responses(false, 500, 'Saldo tidak mencukupi');
			}else{
				$response = $this->responses(true, 200, 'Saldo mencukupi');
			}
		}else{
			$response = $this->responses(false, 500, 'Data tidak ditemukan');
		}
		json($response);
	}
	function getDataAkunKas(){
		isajax();
		$sql = query("SELECT * FROM akun WHERE is_deleted IS NULL AND jenis='Kas/Bank'");
		if ($sql->num_rows() > 0) {
			$response = $sql->result();
		}else{
			$response = $this->responses(false, 500, 'Tidak ada data');
		}
		json($response);
	}
	function getNomorKas(){
		isajax();
		$nomorTerakhir = query("SELECT max(right(nomor, 6)) as nomor FROM kaskeluar WHERE is_deleted IS NULL");
		$nomor = $nomorTerakhir->row();
		if ($nomor !== null) {
			$prefix = substr($nomor->nomor, 0, 2);
			$kode = substr($nomor->nomor, 2);
			$kode = (int)($kode)+1;
			$nextkode = 'KK'.sprintf("%06s", $kode);
		}else{
			$nextkode = 'KK000001';
		}
		json($nextkode);
	}
	function getDataKaryawan(){
		isajax();
		$sql = query("SELECT id, nama FROM karyawan WHERE is_deleted IS NULL");
		if ($sql->num_rows() > 0) {
			$response = $sql->result();
		}else{
			$response = $this->responses(false, 500, 'Tidak ada data');
		}
		json($response);
	}
	function getDataAkunDebet(){
		isajax();
		$sql = query("SELECT * FROM akun WHERE is_deleted IS NULL");
		if ($sql->num_rows() > 0) {
			$response = $sql->result();
		}else{
			$response = $this->responses(false, 500, 'Tidak ada data');
		}
		json($response);
	}
	function getKasKeluar(){
		model('getKasKeluar');
	}
	function getKasKeluarById(){
		// $this->get_by_id(post('id'), 'kaskeluar');
		// karena harus mengambil nominal, maka pakai query manual
		$query = query("SELECT k.*, d.nominal FROM kaskeluar k INNER JOIN detail_kaskeluar d ON d.id_kaskeluar = k.id WHERE k.is_deleted IS NULL");
		if ($query->num_rows() > 0) {
			json($query->row());
		}else{
			$response = $this->responses(false, 500, 'Data not found');
			json($response);
		}
	}
	function updateKasKeluar(){
		isajax();
		$id = post('id');
		$akundebet = post('debet');
		$nominal = post('nominal');
		$data = [
			'id_user' => post('user'),
			'nomor' => post('nomor'),
			'tanggal' => date('d-m-Y h:i:s'),
			'memo' => post('memo')
		];
		if ($akundebet !== "" && $nominal !== "") {
			$updateDetail = [
				'id_akun' => $akundebet,
				'nominal' => $nominal
			];
			$udpate = where('id_kaskeluar', $id);
			$update = update('detail_kaskeluar', $updateDetail);
			if ($update) {
				# berhasil mengubah data detail kas keluar
			}else{
				$response = $this->response(false, 500, 'Gagal mengubah data detail kas keluar');
				json($response);
			}
		}
		$this->update(post('id'), $data, 'kaskeluar');
	}
	function simpanKasKeluar(){
		isajax();
		$data = [
			'id_karyawan' => post('karyawan'),
			'nomor' => post('nomor'),
			'tanggal' => date('d-m-Y h:i:s'),
			'memo' => post('memo')
		];
		$simpan = $this->db->insert('kaskeluar', $data);
		$lastid = $this->db->insert_id();
		if ($simpan) {
			$dataDebet = [
				'id_kaskeluar' => $lastid,
				'id_akun' => post('debet'),
				'nominal' => post('nominal')
			];
			$simpanDebet = $this->db->insert('detail_kaskeluar', $dataDebet);
			if ($simpanDebet) {
				$response = $this->responses(true, 200, 'Data berhasil disimpan');
			}else{
				$response = $this->responses(false, 500, 'Data gagal disimpan');
			}
		}else{
			$response = $this->responses(false, 500, 'Data gagal disimpan');
		}
		json($response);
	}
	function hapusKasKeluar(){
		$id = post('id');
		$this->soft_delete($id, 'kaskeluar');
	}
	// ------------------------------------------------------------------------ end kas keluar
	// ------------------------------------------------------------------------ jurnalumum
	function jurnal(){
		$this->loadPage('modul/jurnal/index');
	}
	function getNomorJurnal(){
		isajax();
		$nomorTerakhir = query("SELECT max(right(nomor_referensi, 6)) as nomor FROM jurnal WHERE is_deleted IS NULL");
		$nomor = $nomorTerakhir->row();
		if ($nomor !== null) {
			$prefix = substr($nomor->nomor, 0, 2);
			$kode = substr($nomor->nomor, 2);
			$kode = (int)($kode)+1;
			$nextkode = 'JU'.sprintf("%06s", $kode);
		}else{
			$nextkode = 'JU000001';
		}
		json($nextkode);
	}
	function getDataTransaksi(){
		isajax();
		$sql = query("SELECT k.*, w.nama as nama_user FROM kaskeluar k INNER JOIN user w ON k.id_karyawan = w.id WHERE k.is_deleted IS NULL");
		if ($sql->num_rows() > 0) {
			json($sql->result());
		}else{
			$response = $this->responses(false, 500, 'Gagal mengambild data transaksi');
			json($response);
		}
	}
	function getJurnal(){
		model('getJurnal');
	}
	function getJurnalById(){
		$this->get_by_id(post('id'), 'jurnal');
	}
	function updateJurnal(){
		isajax();
		$id = post('id');
		$data = [
			'kode' => post('kode'),
			'nama' => post('nama'),
			'jenis' => post('jenis'),
			'saldo' => post('saldo')
		];
		$this->update(post('id'), $data, 'jurnal');
	}
	function simpanJurnal(){
		isajax();
		$id_kaskeluar = post('transaksi');
		$nomor = post('nomor');
		$tanggal = post('tanggal');
		$keterangan = post('keterangan');

		$dataJurnal = [
			'id_kaskeluar' => $id_kaskeluar,
			'nomor_referensi' => $nomor,
			'tanggal' => $tanggal,
			'keterangan' => $keterangan
		];
		$simpan = $this->db->insert('jurnal', $dataJurnal);
		$id_jurnal = $this->db->insert_id('jurnal', $dataJurnal);
		if ($simpan) {
			// Kredit itu dari -> KAS/BANK
			// Debet itu dari -> SELAIN KAS/BANK
			
			$getInformation = query("SELECT d.*, a.id as id_akun, a.kode, a.nama, a.jenis, a.saldo FROM detail_kaskeluar d INNER JOIN akun a ON d.id_akun = a.id WHERE d.id_kaskeluar='$id_kaskeluar' AND d.is_deleted IS NULL");
			if ($getInformation->num_rows() > 0) {
				$data = $getInformation->row();
				
				if ($data->jenis === "KAS/BANK") {
					$debet = $data->nominal;
					$kredit = $data->nominal;
				}else{
					$kredit = $data->nominal;
					$debet = $data->nominal;
				}
				// simpan detail jurnal
				$dataDetaiJurnal = [
					'id_jurnal' => $id_jurnal,
					'id_akun'   => $data->id_akun,
					'nomor_referensi' => $nomor,
					'debet'  => $debet,
					'kredit' => $kredit
				];
				$simpan = simpan('jurnal_detail', $dataDetaiJurnal);
				if ($simpan) {
					$response = $this->responses(true, 200, 'Data berhasil disimpan');
				}else{
					$response = $this->responses(false, 500, 'Data gagal disimpan');
				}
			}else{
				$response = $this->responses(false, 500, 'Jurnal berhasil menyimpan, namun detail jurnal gagal tersimpan.');
			}
		}else{
			$response = $this->responses(false, 500, 'Gagal menyimpan data jurnal');
		}
		json($response);
	}
	function hapusJurnal(){
		$id = post('id');
		$this->soft_delete($id, 'jurnal');
	}
	// ------------------------------------------------------------------------ end jurnalumum
	// ------------------------------------------------------------------------ laporan
	function perbulan(){
		$this->loadPage('modul/laporan/perbulan');
	}
	function periode(){
		$this->loadPage('modul/laporan/periode');
	}
	function getLaporan(){
		// isajax();
		// j = jurnal
		// k = kas keluar
		// dk = detail kas keluar
		// a = akun
		// jd = jurnal detail
		$type = post('type');
		if ($type === "bulan") {
			$bulan = post('bulan');
			$text = post('text');
			// $tahun = date('Y');
			$tahun = post('tahun');
			$tahunText = post('textTahun');
			$sql = query("SELECT 
								-- j.id,
								 -- j.id_kaskeluar as id_kaskeluar_dari_jurnal,  
								 j.nomor_referensi as nomor_jurnal, 
								 -- j.tanggal as tanggal_jurnal, 
								 -- j.keterangan as keterangan_jurnal,
								 -- j.is_deleted as is_deleted_jurnal,
								 -- k.id as id_kas_keluar,
								 -- k.id_user,
								 -- k.nomor as nomor_kas,
								 -- k.tanggal as tanggal_kas,
								 -- k.memo as memo_kas,
								 -- dk.id as id_detail_kas_keluar,
								 -- dk.id_akun as id_akun,
								 -- a.id as id_akun,
								 -- a.kode as kode_akun,
								 a.nama as akun,
								 -- a.jenis as jenis,
								 jd.kredit as kredit,
								 jd.debet as debet
								 FROM jurnal j
								 INNER JOIN kaskeluar k ON
								 j.id_kaskeluar = k.id
								 INNER JOIN detail_kaskeluar dk ON
								 k.id = dk.id_kaskeluar
								 INNER JOIN akun a ON 
								 dk.id_akun = a.id
								 INNER JOIN jurnal_detail jd ON
								 jd.id_jurnal = j.id
								 WHERE MONTH(j.tanggal) = '$bulan' 
								 AND YEAR(j.tanggal) = '$tahun'

								 AND j.is_deleted IS NULL");
			if ($sql) {
				if ($sql->num_rows() > 0) {
					$data = $sql->result();
					$pathImage = base_url('static/assets/images/windu.jpeg');
					$table = "<table class='table' id='tableReport'>
								<thead>
                                    <tr>
                                        <th>Kode Jurnal</th>
                                        <th>Akun</th>
                                        <th>Debit</th>
                                        <th>Kredit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	<tr>
                                	</tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Kode Jurnal</th>
                                        <th>Akun</th>
                                        <th>Debit</th>
                                        <th>Kredit</th>
                                    </tr>
                                </tfoot>
							  </table>";
					$CreateHTML = "<div class='container'>
										<center>
											<img src='$pathImage' alt='header-img-report'/>	<br/>
											<h4>Laporan Pengeluaran Per Bulan : $text</h4> <hr>
											<div id='rata-kiri' style='float: left;'>
												<div class='container'>
													Bulan : $text <br/>
													$table
												</div>
											</div>
										</center>		
									</div>";
						$response = $data;
						// header("Content-type:application/pdf");
						// header("Content-Disposition:attachment;");
						// header("filename=file1.pdf");
						// source
						// readfile($CreateHTML);
				}else{
					$response = $this->responses(false, 500, 'Data tidak tersedia');
					// JSON($response);
				}
			}else{
				$response = $this->responses(false, 500, 'Query SQL salah.');
			}
				JSON($response);
		}else{
			// periode 
			$tahun = post('tahun');
			$sql = query("SELECT 
								-- j.id,
								 -- j.id_kaskeluar as id_kaskeluar_dari_jurnal,  
								 j.nomor_referensi as nomor_jurnal, 
								 -- j.tanggal as tanggal_jurnal, 
								 -- j.keterangan as keterangan_jurnal,
								 -- j.is_deleted as is_deleted_jurnal,
								 -- k.id as id_kas_keluar,
								 -- k.id_user,
								 -- k.nomor as nomor_kas,
								 -- k.tanggal as tanggal_kas,
								 -- k.memo as memo_kas,
								 -- dk.id as id_detail_kas_keluar,
								 -- dk.id_akun as id_akun,
								 -- a.id as id_akun,
								 -- a.kode as kode_akun,
								 a.nama as akun,
								 -- a.jenis as jenis,
								 jd.kredit as kredit,
								 jd.debet as debet
								 FROM jurnal j
								 INNER JOIN kaskeluar k ON
								 j.id_kaskeluar = k.id
								 INNER JOIN detail_kaskeluar dk ON
								 k.id = dk.id_kaskeluar
								 INNER JOIN akun a ON 
								 dk.id_akun = a.id
								 INNER JOIN jurnal_detail jd ON
								 jd.id_jurnal = j.id
								 WHERE YEAR(j.tanggal) = '$tahun'
								 AND j.is_deleted IS NULL");
			if ($sql->num_rows() > 0) {
				$data = $sql->result();
				json($data);
			}else{
				$response = $this->responses(false, 500, 'Data tidak tersedia');
				JSON($response);
			}
		}
	}
	// ------------------------------------------------------------------------ end laporan
	function riwayatlogin(){
		$this->loadPage('modul/riwayatlogin/index');
	}
	function getRiwayatLogin(){
		model("getRiwayatLogin");
	}
	function logaktivitas(){
		$this->loadPage('modul/logaktivitas/index');
	}
	function getLogAktivitas(){
		model("getLogAktivitas");
	}
	function confirm($token, $id){
		$checkTokenExpectations = hash_hmac('sha256', $id,'HQ=?cUP@Q3p%7BEWqQdss-vX25eNWthC@d*4_#!ZRMD;');
		$data = [
			'tokenparam' => $token,
			'tokenverify' => $checkTokenExpectations
		];
		if ($token === $checkTokenExpectations) {
			$generateID = base64_decode($id);
			$checkID = query("SELECT id FROM user where id='$generateID'");
			$available = $checkID->num_rows();
			// $dataID = $checkID->row();
			if ($checkID) {
				// $data = ['is_active' => 1];
				// $updateStatus = $this->db->where('id', $generateID)
				// 					     ->update('daftar', $data);
				// if ($updateStatus) {
					echo 'Account is activated';
					$this->session->set_flashdata('msg', 'Akun berhasil dikonfirmasi, silahkan buat username dan kata sandi');
					redirect(site_url('next'),'refresh');
				// }
			}else{
				echo 'Your Request is Invalid';
				// redirect(site_url());
			}
		}else{
			echo 'Token tidak sama';
		}
	}
	function backupdatabase(){
		$path = 'backup/database';
		$this->load->dbutil();
		$prefs = [
			'format' => 'zip',
			'filename' => 'filemanager-'. date("d M Y - H-i-s") .'.sql',
			'add_drop' => TRUE,
			'add_insert' => TRUE,
			'new_line' => '\n'
		];
		$backup =& $this->dbutil->backup($prefs);
		$file_name = 'Database SQL'. date("d M Y - H-i-s") .'.zip';
		$this->zip->download($file_name);
	}
	function backupaplikasi(){
		$this->load->library('zip');
		$this->zip->read_dir(FCPATH, TRUE);
		$cms = 'Backup App - '. date("d M Y - H-i-s") .'.zip';
		$this->zip->download($cms);
	}
}