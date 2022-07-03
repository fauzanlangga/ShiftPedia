<?php  defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Mod_Landingnews_Web
 * web 
 * 
 * controller ini untuk menampilkan informasi ke public
 * 
 * module public
 * 
 * @package landingnews
 * @author noor hadi (no3r_hadi@yahoo.com)
 * @license http://opensource.org/licenses/MIT  MIT License
 * 
 * @copyright 2020
 */

class Mod_Landingnews_Web extends CI_Controller { 

	/**
	 * contact 
	 */
	public function contact(){ 
	 
		if (isset($_POST['submit'])){ 
			if ( !empty($this->input->post('security_code')) && 
				(strtolower($this->input->post('security_code')) == strtolower(  $this->session->userdata('mycaptcha') ))
				) {

				$data = array(
					'nama' => cetak($this->input->post('nama',TRUE)),
					'email' => cetak($this->input->post('email',TRUE)),
					'subjek' => $_SERVER['REMOTE_ADDR'],
					'pesan' => cetak($this->input->post('pesan',TRUE)),
					'tanggal' => date('Y-m-d'),
					'jam' => date('H:i:s')
				);

				$this->model_utama->insert('hubungi',$data);

				$msg['success'] = 'Terimakasih Telah Menghubungi Kami.';
				$this->session->set_flashdata('contact_message', $msg);

			}else{

				$msg['warning'] = 'Kode keamanan yang anda masukkan salah!';
				$this->session->set_flashdata('contact_message', $msg);

			} 
			
			redirect('hubungi');
		} 

	}

	

	public function komentar_berita() {

		if (isset($_POST['submit'])) {

			$cek = $this->model_utama->view_where('berita',array('id_berita' => $this->input->post('berita')));
			$row = $cek->row_array();

			if ($cek->num_rows()<=0){

				redirect('main');

			}else{
				
				if ( !empty($this->input->post('security_code')) && 
					(strtolower($this->input->post('security_code')) == strtolower($this->session->userdata('mycaptcha')))) {

					$data = array(
						'id_berita'	=>	cetak($this->input->post('berita',TRUE)),
		                'nama_komentar'	=>	cetak($this->input->post('nama',TRUE)),
		                'url'	=>	cetak($this->input->post('url_website',TRUE)),
		                'email'	=>	cetak($this->input->post('email',TRUE)),
		                'isi_komentar'	=>	cetak($this->input->post('komentar',TRUE)),
		                'tgl' => date('Y-m-d'),
		                'jam_komentar' => date('H:i:s'),
		                'aktif' => 'N' 
					);

					$this->model_utama->insert('komentar',$data);

					$msg['success'] = 'Terimakasih atas komentar Anda. Komentar akan tampil setelah kami setujui!.';
					$this->session->set_flashdata('komentar_message', $msg); 
				}else{
					$msg['warning'] = 'Kode keamanan yang Anda masukkan salah!';
					$this->session->set_flashdata('komentar_message', $msg); 
				}
			}
			redirect('berita/detail/'.$row['judul_seo'].'#writecomment');
		}
	}
	

	public function komentar_video() {
	
			if (isset($_POST['submit'])) {

				$cek = $this->model_utama->view_where('video',array('id_video' => $this->input->post('video')));
				$row = $cek->row_array();
				if ($cek->num_rows()<=0) {

					redirect('main');

				} else {
					
					if ( !empty($this->input->post('security_code')) && 
						(strtolower($this->input->post('security_code')) == strtolower($this->session->userdata('mycaptcha')))) {
							
						$data = array(
							'id_video'	=>	cetak($this->input->post('video',TRUE)),
							'nama_komentar'	=>	cetak($this->input->post('nama',TRUE)), 
							'url'	=>	cetak($this->input->post('email',TRUE)),
							'isi_komentar'	=>	cetak($this->input->post('komentar',TRUE)),
							'tgl' => date('Y-m-d'),
							'jam_komentar' => date('H:i:s'),
							'aktif' => 'N' 
						);
	
						$this->model_utama->insert('komentarvid',$data);
	
						$msg['success'] = 'Terimakasih atas komentar Anda. Komentar akan tampil setelah kami setujui!.';
						$this->session->set_flashdata('komentar_message', $msg); 
					}else{
						$msg['warning'] = 'Kode keamanan yang Anda masukkan salah!';
						$this->session->set_flashdata('komentar_message', $msg); 
					}
				}
				redirect('playlist/watch/'.$row['video_seo']. '#writecomment');
			} 
	}

}
