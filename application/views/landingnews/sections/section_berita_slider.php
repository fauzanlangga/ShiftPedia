<?php   
	$jumlah_berita = 0;
	if( isset($section_setting['judul']) ) {
		if( !empty(trim($section_setting['judul']))) {
			$section_berita_slider_judul = $section_setting['judul'];
		}
	}
	$filter_berita = array();
	if( isset($section_setting['group']) ) {
		$group_berita =  $section_setting['group'];
		if(!empty(trim($group_berita))) {
			switch ($group_berita) {
				case 'headline':
					$filter_berita = array('berita.headline' => 'Y');
					break;
				case 'pilihan':								
					$filter_berita = array('berita.aktif' => 'Y');
					break;
				case 'utama':	
					$filter_berita = array('berita.utama' => 'Y');
					break; 
			}
		}
	} 
	if( isset($section_setting['jumlah']) ) {
		$jumlah_berita = (int) $section_setting['jumlah'];
	} 
?>   
<?php 
	$filter_berita = array_merge($filter_berita,array(
		'berita.status' => 'Y'
	));
	$berita_slider = $this->model_utama->view_join_two(
			'berita',
			'users',
			'kategori',
			'username',
			'id_kategori',
			$filter_berita,
			'tanggal','DESC',0,$jumlah_berita)->result_array();
?>    
 
 <?php if( !empty($berita_slider)) {
	 	
	$this->load->helper('text'); 

	 if(!function_exists('get_viewer')) {
		function get_viewer($number) {
			if($number > 1000) {
				$number = $number /1000;
				return number_format($number,0,',','.').'k';
			}
			return number_format($number,0,',','.');
		}
	}
		 
?> 
<section id="<?php echo $section_id;?>" class="carousel slide section-news-slider" data-ride="carousel"> 
    <div class="carousel-inner" role="listbox">
        <?php foreach($berita_slider as $i =>  $berita) {?>
            <div class="carousel-item <?php echo ($i == 0 ? 'active' : '');?>">
                <div class="carousel-content">
					<?php
						$img_src= base_url().'asset/foto_berita/small_no-image.jpg';
						if ($berita['gambar'] !==''){
							$img_src =base_url().'asset/foto_berita/'.$berita['gambar'];
						} 
					?>
                    <div class="image-container"
						style="
							background:url('<?php echo $img_src;?>');
							background-position:center;
							background-size:cover;
							background-repeat:no-repeat
						"> 
                    </div> 
                        <div class="carousel-caption">
                            <div class="container carousel-caption-body">
                                <a href="<?php echo base_url().$berita['judul_seo'];?>">
									<h1>
										<?php echo $berita['judul'];?>
									</h1>
								</a>	
								<div class="caption-content d-none d-md-block">
									<?php echo word_limiter( strip_tags($berita['isi_berita']),20);?> 
								</div>
								<div class="post-meta">
									<i class="fa fa-clock-o"></i> <?php echo tgl_indo($berita['tanggal']);?> ,
									<i class="fa fa-flash" aria-hidden="true"></i> dilihat <?php echo get_viewer($berita['dibaca']);?> 
								</div> 	
                                <div class="button-link pt-4 d-none d-md-block">
                                    <a href="<?php echo base_url().$berita['judul_seo'];?>" class="btn btn-theme btn-read-more">
                                        <?php echo (empty(trim($section_hero['label_link'])) ? 'Selengkapnya' : $section_hero['label_link']);?>
                                    </a>
                                </div>
                            </div>
                        </div>  
                </div>
            </div>                 
        <?php }?>
    </div>
    <a class="carousel-control-prev" href="#<?php echo $section_id;?>" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#<?php echo $section_id;?>" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a> 
</section> 
<?php }?> 