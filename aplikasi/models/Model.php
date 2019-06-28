<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model extends CI_Model {
	public function __construct(){ 
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		notget();
	}
	function getDepartement(){
		isajax();
		$minta = where('is_deleted', null);
		$minta = minta('departement');
		$hasil = $minta->result();
		$no = 0;
		$result = ['data' => []];
		$data = $hasil;
		foreach ($data as $key => $value) { $no++;
			$id = $value->id;
			
			$opsi = "<div id='opsi' style='cursor: pointer;'>
						<center>
							<a href='javascript:void(0)' class='edit' data-id='$id' id='edit-departement' data-toggle='tooltip' title='Klik untuk mengedit data'><i class='far fa-edit'></i></a>
							<a href='javascript:void(0)' class='hapus' data-id='$id' id='hapus-departement' data-toggle='tooltip' title='Klik untuk menghapus data'><i class='fas fa-trash' aria-hidden='true'></i></a>
						</center>
	 				</div>";
	 				$result['data'][$key] = array(
						$no,
						$value->departement,
						$opsi
				);
		}
		JSON($result);
	}
	function getDivisi(){
		isajax();
		$minta = query("SELECT i.*, d.departement FROM divisi i INNER JOIN departement d ON i.id_departement = d.id WHERE i.is_deleted IS NULL");
		$hasil = $minta->result();
		$no = 0;
		$result = ['data' => []];
		$data = $hasil;
		foreach ($data as $key => $value) { $no++;
			$id = $value->id;
			
			$opsi = "<div id='opsi' style='cursor: pointer;'>
						<center>
							<a href='javascript:void(0)' class='edit' data-id='$id' id='edit-divisi' data-toggle='tooltip' title='Klik untuk mengedit data'><i class='far fa-edit' aria-hidden='true'></i></a>
							<a href='javascript:void(0)' class='hapus' data-id='$id' id='hapus-divisi' data-toggle='tooltip' title='Klik untuk menghapus data'><i class='fas fa-trash' aria-hidden='true'></i></a>
						</center>
	 				</div>";
	 				$result['data'][$key] = array(
						$no,
						$value->divisi,
						$value->departement,
						$opsi
				);
		}
		JSON($result);
	}
	function getJabatan(){
		isajax();
		$minta = where('is_deleted', null);
		$minta = minta('jabatan');
		$hasil = $minta->result();
		$no = 0;
		$result = ['data' => []];
		$data = $hasil;
		$result = ['data' => []];
		foreach ($data as $key => $value) { $no++;
			$id = $value->id;
			
			$opsi = "<div id='opsi' style='cursor: pointer;'>
						<center>
							<a href='javascript:void(0)' class='edit' data-id='$id' id='edit-jabatan' data-toggle='tooltip' title='Klik untuk mengedit data'><i class='far fa-edit' aria-hidden='true'></i></a>
							<a href='javascript:void(0)' class='hapus' data-id='$id' id='hapus-jabatan' data-toggle='tooltip' title='Klik untuk menghapus data'><i class='fas fa-trash' aria-hidden='true'></i></a>
						</center>
	 				</div>";
	 				$result['data'][$key] = array(
						$no,
						$value->jabatan,
						$value->kode,
						$value->posisi,
						$opsi
				);
		}
		JSON($result);
	}
	function getUser(){
		isajax();
		// check apakah sudah ada tanda tangan apa belum ?
		$minta = query("SELECT k.*, d.departement, j.jabatan FROM user k INNER JOIN departement d ON k.id_departement = d.id INNER JOIN jabatan j ON k.id_jabatan = j.id WHERE k.is_deleted IS NULL");

		$hasil = $minta->result();
		$no = 0;
		
		$result = ['data' => []];
		$data = $hasil;

		foreach ($data as $key => $value) { 
			$no++;

			$id = $value->id;
			$opsi = "<div id='opsi' style='cursor: pointer;'>
						<center>
							<a href='javascript:void(0)' class='edit' data-id='$id' id='edit-user' data-toggle='tooltip' title='Klik untuk mengedit data'><i class='far fa-edit' aria-hidden='true' onclick='ClearFormData('#formUser')'></i></a>
							<a href='javascript:void(0)' class='hapus' data-id='$id' id='hapus-user' data-toggle='tooltip' title='Klik untuk menghapus data'><i class='fas fa-trash' aria-hidden='true'></i></a>
						</center>
	 				</div>";
	 				$result['data'][$key] = array(
						$no,
						$value->nama,
						$value->departement,
						$value->jabatan,
						$value->email,
						$value->telepon,
						$opsi
				);
		}
		JSON($result);
	}
	function getKaryawan(){
		isajax();
		$minta = query("SELECT * FROM karyawan WHERE is_deleted IS NULL");
		$hasil = $minta->result();
		$no = 0;
		$result = ['data' => []];
		$data = $hasil;
		foreach ($data as $key => $value) { 
			$no++;	
			$id = $value->id;
			$opsi = "<div id='opsi' style='cursor: pointer;'>
						<center>
							<a href='javascript:void(0)' class='edit' data-id='$id' id='edit-karyawan' data-toggle='tooltip' title='Klik untuk mengedit data'><i class='far fa-edit' aria-hidden='true' onclick='ClearFormData('#formKaryawan')'></i></a>
							<a href='javascript:void(0)' class='hapus' data-id='$id' id='hapus-karyawan' data-toggle='tooltip' title='Klik untuk menghapus data'><i class='fas fa-trash' aria-hidden='true'></i></a>
						</center>
	 				</div>";
	 				$result['data'][$key] = array(
						$no,
						$value->nik,
						$value->nama,
						$value->telepon,
						$opsi
				);
		}
		JSON($result);
	}
	function getAkun(){
		isajax();
		$minta = where('is_deleted', null);
		$minta = minta('akun');
		$hasil = $minta->result();
		$no = 0;
		$result = ['data' => []];
		$data = $hasil;
		foreach ($data as $key => $value) { $no++;
			$id = $value->id;
			
			$opsi = "<div id='opsi' style='cursor: pointer;'>
						<center>
							<a href='javascript:void(0)' class='edit' data-id='$id' id='edit-akun' data-toggle='tooltip' title='Klik untuk mengedit data'><i class='far fa-edit'></i></a>
							<a href='javascript:void(0)' class='hapus' data-id='$id' id='hapus-akun' data-toggle='tooltip' title='Klik untuk menghapus data'><i class='fas fa-trash' aria-hidden='true'></i></a>
						</center>
	 				</div>";
	 				$result['data'][$key] = array(
						$no,
						$value->kode,
						$value->nama,
						$value->jenis,
						$value->saldo,
						$opsi
				);
		}
		JSON($result);
	}
	function getKasKeluar(){
		isajax();
		$minta = query("SELECT k.*, d.id_kaskeluar, d.id_akun, d.nominal as nominaldetail, y.nama as user, a.nama as akun FROM kaskeluar k INNER JOIN detail_kaskeluar d ON d.id_kaskeluar = k.id INNER JOIN user y ON k.id_user = y.id INNER JOIN  akun a ON d.id_akun = a.id WHERE k.is_deleted IS NULL");
		$hasil = $minta->result();
		$no = 0;
		$result = ['data' => []];
		$data = $hasil;
		foreach ($data as $key => $value) { $no++;
			$id = $value->id;
			
			$opsi = "<div id='opsi' style='cursor: pointer;'>
						<center>
							<a href='javascript:void(0)' class='edit' data-id='$id' id='edit-kas-keluar' data-toggle='tooltip' title='Klik untuk mengedit data'><i class='far fa-edit'></i></a>
							<a href='javascript:void(0)' class='hapus' data-id='$id' id='hapus-kas-keluar' data-toggle='tooltip' title='Klik untuk menghapus data'><i class='fas fa-trash' aria-hidden='true'></i></a>
						</center>
	 				</div>";
	 				$result['data'][$key] = array(
						$no,
						$value->nomor,
						$value->tanggal,
						$value->user,
						$value->memo,
						$value->akun,
						$value->nominaldetail,
						$opsi
				);
		}
		JSON($result);
	}
	function getJurnal(){
		isajax();
		// ------------------------------------------------------------------------
		// kk = kaskeluar
		// k  = user
		// dks = detail_kaskeluar
		// a = akun
		// j = jurnal
		// jd = jurnal_detail
		// INNER JOIN = Semua kondisi harus terpenuhi, baik all primary key & all foreign key
		// LEFT JOIN = tidak semua kondisi harus terpenuhi, salah satu sudah cukup
		$minta = query(
			"SELECT 

					kk.id as id_kaskeluar, 
					kk.id_user,
					kk.nomor as nomorkaskeluar,
					kk.tanggal,
					kk.memo as memo,
					k.nama as user,
					dks.id as id_detailkaskeluar,
					dks.id_akun,
					dks.nominal,
					a.id as id_akun,
					a.kode as kode_akun,
					a.nama as akun,
					a.jenis,
					a.saldo,
					j.id as id_jurnal,
					j.nomor_referensi as nomor_jurnal,
					j.tanggal as tanggal_jurnal,
					j.keterangan as keterangan_jurnal,
					jd.id as id_jurnal_detail,
					jd.debet as debet_jurnal_detail,
					jd.kredit as kredit_jurnal_detail

					FROM kaskeluar kk
					INNER JOIN user k ON kk.id_user = k.id
					INNER JOIN detail_kaskeluar dks ON dks.id_kaskeluar = kk.id
					INNER JOIN akun a ON dks.id_akun = a.id
					LEFT JOIN jurnal j ON j.id_kaskeluar = kk.id
					LEFT JOIN jurnal_detail jd ON jd.id_jurnal = j.id

					WHERE kk.is_deleted IS NULL AND 
					dks.is_deleted IS NULL AND
					a.is_deleted IS NULL AND
					j.is_deleted IS NULL");

		$hasil = $minta->result();
		$no = 0;
		$result = ['data' => []];
		$data = $hasil;
		foreach ($data as $key => $value) { $no++;
			$id = $value->id_jurnal;
			
			$debet = $value->debet_jurnal_detail;
			$kredit = $value->kredit_jurnal_detail;
			$total = (int)($debet) - (int)($kredit);
			if ($total == 0) {
				$status = '<span class="pcoded-badge label label-success">Balance</span>';
			}else{
				$status = '<span class="pcoded-badge label label-danger">Tidak Balance</span>';
			}
			$opsi = "<div id='opsi' style='cursor: pointer;'>
						<center>
							<a href='javascript:void(0)' class='edit' data-id='$id' id='edit-jurnal' data-toggle='tooltip' title='Klik untuk mengedit data'><i class='far fa-edit'></i></a>
							<a href='javascript:void(0)' class='hapus' data-id='$id' id='hapus-jurnal' data-toggle='tooltip' title='Klik untuk menghapus data'><i class='fas fa-trash' aria-hidden='true'></i></a>
						</center>
	 				</div>";
	 				$result['data'][$key] = array(
						$no,
						$value->nomor_jurnal,
						$value->nomorkaskeluar,
						$value->user,
						$value->akun,
						$debet,
						$kredit,
						$total,
						$value->keterangan_jurnal,
						$status,
						$opsi
				);
		}
		JSON($result);
	}
	function getRiwayatLogin(){
		isajax();
		$minta = query("SELECT r.*, k.nama FROM riwayatlogin r INNER JOIN user k ON r.id_user = k.id ORDER BY last_login DESC");
		$hasil = $minta->result();
		$no = 0;
		$result = ['data' => []];
		$data = $hasil;
		foreach ($data as $key => $value) { $no++;
			$id = $value->id;
	 				$result['data'][$key] = array(
						$no,
						$value->nama,
						$value->os,
						$value->browser,
						$value->ip_address,
						$value->version,
						$value->last_login
				);
		}
		JSON($result);
	}
	function getLogAktivitas(){
		isajax();
		$minta = query("SELECT * FROM log ORDER BY tanggal DESC");
		$hasil = $minta->result();
		$no = 0;
		$result = ['data' => []];
		$data = $hasil;
		foreach ($data as $key => $value) { $no++;
			$id = $value->id;
	 				$result['data'][$key] = array(
						$no,
						$value->nama,
						$value->departement,
						$value->divisi,
						$value->jabatan,
						$value->tanggal,
						$value->log
				);
		}
		JSON($result);
	}

}