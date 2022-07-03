<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 
 * Mod_Landingnews
 * landingnews option
 * untuk konfigurasi template landingnews
 * 
 * module admin
 * 
 * @package landingnews
 * @author noor hadi (no3r_hadi@yahoo.com)
 * @license http://opensource.org/licenses/MIT  MIT License
 * 
 * @copyright 2020
 * 
 */


class Mod_Landingnews extends CI_Controller {
	public function index(){         

        cek_session_akses('landingnews',$this->session->id_session); 

        if (isset($_POST['set_config'])){

            $this->update_config();

        } elseif(isset($_POST['set_config_menu'])){
            
            $this->set_config_section('lokasi_menu');

        }  elseif(isset($_POST['set_setting_sections'])){
            
            $this->set_config_section('setting_sections');

        }  elseif(isset($_POST['set_setting_sidebar'])){

            $this->set_config_section('setting_sidebar');

        }  elseif(isset($_POST['set_group_setting_footer'])){

            $this->set_group_setting_footer('setting_footer');

        } else {

            $this->view_index();

        }
    }

    protected function view_index(){

        /**
         * get data option dari database
         */
        $get_options  = $this->model_app->view('tbl_landingnews')->result_array(); 
        if(!empty($get_options)){
            foreach($get_options as $item) {
                $data['get_' . $item['key'] ]= $this->extract_data($item['value']);
            }
        }  
          

        // widget
        $data['widget']  = array(
            'widget_berita_pilihan' => 'Berita Pilihan', 
            'widget_berita_tag' => 'Berita Tags',
            'widget_search' => 'Form Pencarian',
            'widget_gallery' => 'Galeri',
            'widget_iklan_sidebar' => 'Iklan Sidebar',
            'widget_iklan_link' => 'Iklan Link',
            'widget_berita_kategori' => 'Kategori Berita',            
            'widget_contact' => 'Kontak',
            'widget_komentar' => 'Komentar Terakhir',
            'widget_logo' => 'Logo Web',
            'widget_menu' => 'Menu',
            'widget_polling' => 'Polling',
            'widget_sekilas_info' => 'Sekilas Info',
            'widget_social' => 'Social Media',
            'widget_text' => 'Teks',
            'widget_video' => 'Video' 
        ); 

        // data section
        $data['sections'] = array(  
            'section_berita_pilihan' => 'Berita Pilihan',
            'section_berita_per_kategori' => 'Berita Per Kategori', 
            'section_berita_terbaru' => 'Berita Terbaru', 
            'section_agenda' => 'Agenda', 
            'section_video' => 'Video', 
            'section_gallery' => 'Galeri',
            'section_berita_slider' => 'Berita Slider' ,
            'section_iklan_home' => 'Iklan Home'
        );

        //dropdown
        $data['get_halaman_dropdown'] = $this->get_halaman_dropdown();
        $data['get_kategori_dropdown'] = $this->get_kategori_dropdown(); 
        $data['get_playlist_dropdown'] = $this->get_playlist_dropdown(); 
        $data['get_album_dropdown'] = $this->get_album_dropdown(); 
        $data['get_iklan_link_list'] = $this->get_iklan_link_list();
        $data['get_iklan_sidebar_dropdown'] = $this->get_iklan_sidebar_dropdown();
        $data['get_iklan_home_dropdown'] = $this->get_iklan_home_dropdown();
        $data['get_iklan_atas_dropdown'] = $this->get_iklan_atas_dropdown();
        $data['get_menu_dropdown'] = $this->get_menu_dropdown();
        $this->template->load('administrator/template','administrator/mod_landingnews/view_index',$data);
    }
 

    /**
     * update_config
     * untuk menyumpan konfigurasi template
     */
    protected function update_config(){  

        // tambahkan tagline        
        $this->save_config('tagline',  $this->input->post('tagline') );
 
        // iklan atas / header
        $this->save_config('iklan_header',  $this->input->post('iklan_header') ); 

        // hidden / show btn_back_to_top
        $this->save_config('btn_back_to_top',  $this->input->post('btn_back_to_top') ); 
        
        // header & footer embeded code
        $this->save_config('header_embeded_code',  $this->input->post('header_embeded_code') ); 
        $this->save_config('footer_embeded_code',  $this->input->post('footer_embeded_code') );  

		$this->session->set_flashdata('alert','Konfigurasi Telah Diupdate');
        redirect($this->uri->segment(1).'/landingnews');
    }
    
    /**
     * set_group_setting_footer
     * untuk mengisi data group footer
     */
    protected function set_group_setting_footer($section_id){
        // prepare value
        for ($i = 1; $i <= 4; $i++) { 
            $key = $section_id .'_'.$i;
            $data = '';
            if( !empty($this->input->post($key)) ) {            
                $data = $this->input->post($key); 
            }         
            $this->save_config($key, $data );             
        }

		$this->session->set_flashdata('alert','Konfigurasi Telah Diupdate');
        redirect($this->uri->segment(1).'/landingnews#content_'.$section_id);
    } 

    /**
     * set_config_section
     * untuk mengisi data section
     */
    protected function set_config_section($section_id){
        // prepare value
        $data = '';
        if( !empty($this->input->post($section_id)) ) {            
            $data = $this->input->post($section_id);  
        }         
        $this->save_config($section_id, $data ); 
		$this->session->set_flashdata('alert','Konfigurasi Telah Diupdate');
        redirect($this->uri->segment(1).'/landingnews#content_'.$section_id);
    } 
    
    /**
     * save config
     * method ini digunakan untnuk menyimpan konfigurasi
     * dengan berbagai key (sections, sidebar dll)
     * ke table
     */
    protected function save_config($key='',$value = '') {

        // get options value 
        $get_option  = $this->model_app->view_where('tbl_landingnews',array('key' => $key ))->row_array(); 
        $value = json_encode($value);
        // cek key
        if(!empty($get_option) && $get_option['key'] == $key ){ 
            if( !empty($value)) {
                // save data pisah dengan koma
                $this->model_app->update(
                    'tbl_landingnews', 
                    array(
                        'key' => $key,
                        'value' => $value
                    ),
                    array(
                        'key' => $key
                    )
                ); 
            } else {
        
                $this->model_app->update(
                    'tbl_landingnews', 
                    array(
                        'value' => ''
                    ),
                    array(
                        'key' => $key
                    )
                );
            }
        } else { 
            if( !empty($value) ) {                
                // save data pisah dengan koma
                $this->model_app->insert(
                    'tbl_landingnews', 
                    array(
                        'key' => $key,
                        'value' => $value
                    )
                );
            }
        } 
    }

    /**
     * extract_data
     * untuk mengextrak data dari jason format / string
     */
    protected function extract_data($value,$from_json = true){
        if($from_json == true && is_string($value)) {
            return json_decode($value,true);
        } else {
            return $value;
        }
    }


    /**
     * get_menu_dropdown
     * untuk mendapatkan menu parent
     */
    protected function get_menu_dropdown(){        
        $get_menu = $this->db->query("
			SELECT 
                m.id_menu as id,
				m.nama_menu as nama
			FROM 
                menu m
            WHERE
                m.id_parent = 0      
                AND
                m.aktif = 'Ya'
			ORDER BY m.nama_menu ASC
        ")->result_array();
        
        $data_dropdown = array();
        if(!empty($get_menu)){
            $data_dropdown = $get_menu;
        } 
        return $data_dropdown;
    }

    /**
     * get_halaman_dropdown
     * untuk mendapatkan halaman statis
     */
    protected function get_halaman_dropdown(){             
        $get_halaman = $this->db->query("
			SELECT 
                hal.id_halaman as id,
                hal.judul as nama
			FROM 
                halamanstatis  hal
			ORDER BY hal.judul ASC
        ")->result_array();   
        $data_dropdown = array();
        if(!empty($get_halaman)){
            $data_dropdown = $get_halaman;
        } 
        return $data_dropdown;
    }

    /**
     * get_kategori_dropdown
     * untuk mendapatkan kategori
     */
    protected function get_kategori_dropdown(){        
        $get_kategori = $this->db->query("
            SELECT 
				cat.id_kategori as id,
				concat(cat.nama_kategori,' (',count(b.id_kategori),')') as nama
			FROM 
				kategori cat
				LEFT JOIN berita b ON b.id_kategori = cat.id_kategori  and b.status = 'Y'
			WHERE 
				cat.aktif='Y' 
			group by cat.id_kategori 
            ORDER BY cat.nama_kategori ASC
        ")->result_array();
        
        $data_dropdown = array();
        if(!empty($get_kategori)){
            $data_dropdown = $get_kategori;
        } 
        return $data_dropdown;
    } 

    /**
     * get_playlist_dropdown
     * untuk mendapatkan playlist
     */
    protected function get_playlist_dropdown(){        
        $get_playlist = $this->db->query("
            SELECT 
				pl.id_playlist as id,
				concat(pl.jdl_playlist,' (',count(v.id_video),')') as nama
			FROM 
				playlist pl
				LEFT JOIN video v ON v.id_playlist = pl.id_playlist 
			WHERE 
				pl.aktif='Y' 
			group by pl.id_playlist 
            ORDER BY pl.jdl_playlist ASC
        ")->result_array();
        
        $data_dropdown = array();
        if(!empty($get_playlist)){
            $data_dropdown = $get_playlist;
        } 
        return $data_dropdown;
    } 

    /**
     * get_album_dropdown
     * untuk mendapatkan album
     */
    protected function get_album_dropdown(){        
        $get_album = $this->db->query("
            SELECT 
                alb.id_album as id,
				concat(alb.jdl_album,' (',count(g.id_gallery),')') as nama
			FROM 
				album alb
				LEFT JOIN gallery g ON g.id_album = alb.id_album
			WHERE 
                alb.aktif='Y' 
			group by alb.id_album 
            ORDER BY alb.jdl_album ASC
        ")->result_array();
        
        $data_dropdown = array();
        if(!empty($get_album)){
            $data_dropdown = $get_album;
        } 
        return $data_dropdown;
    } 

    /**
     * get_iklan_sidebar_dropdown
     * untuk mendapatkan iklan gambar sidebar
     */
    protected function get_iklan_sidebar_dropdown(){        
        $get_iklan = $this->db->query(" 
			SELECT 
                iklan.id_pasangiklan as id,
                iklan.judul as nama
			FROM 
                pasangiklan iklan
			ORDER BY iklan.judul ASC
        ")->result_array();
        
        $data_dropdown = array();
        if(!empty($get_iklan)){
            $data_dropdown = $get_iklan;
        } 
        return $data_dropdown;
    }

    /**
     * get_iklan_link_list
     * untuk mendapatkan iklan link
     */
    protected function get_iklan_link_list(){        
        $get_iklan_link = $this->db->query(" 
			SELECT 
                iklan.id_banner as id,
                iklan.judul as nama
			FROM 
                banner iklan
			ORDER BY iklan.judul ASC
        ")->result_array();
        
        $data_list = array();
        if(!empty($get_iklan_link)){
            $data_list = $get_iklan_link;
        } 
        return $data_list;
    }

    /**
     * get_iklan_home_dropdown
     * untuk mendapatkan iklan gambar home
     */
    protected function get_iklan_home_dropdown(){        
        $get_iklan = $this->db->query(" 
			SELECT 
                iklan.id_iklantengah as id,
                iklan.judul as nama
			FROM 
                iklantengah iklan
			ORDER BY iklan.judul ASC
        ")->result_array();
        
        $data_dropdown = array();
        if(!empty($get_iklan)){
            $data_dropdown = $get_iklan;
        } 
        return $data_dropdown;
    }

    /**
     * get_iklan_atas_dropdown
     * untuk mendapatkan iklan atas
     */
    protected function get_iklan_atas_dropdown(){        
        $get_iklan = $this->db->query(" 
			SELECT 
                iklan.id_iklanatas as id,
                iklan.judul as nama
			FROM 
                iklanatas iklan
			ORDER BY iklan.judul ASC
        ")->result_array();
        
        $data_dropdown = array();
        if(!empty($get_iklan)){
            $data_dropdown = $get_iklan;
        } 
        return $data_dropdown;
    }
 
}
?>