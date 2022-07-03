<section id="<?php echo $section_id;?>" class="section latest-news  py-4 <?php echo $section_class;?>"> 
	<div class="container">
		<div class="section-container">
			<h5 class="section-title">		
				<?php 
					$section_berita_terbaru_judul = 'Berita Terbaru'; 
					$jumlah_berita = 0;
					if( isset($section_setting['judul']) ) {
						if( !empty(trim($section_setting['judul']))) {
							$section_berita_terbaru_judul = $section_setting['judul'];
						}
					}

					if( isset($section_setting['jumlah']) ) {
						$jumlah_berita = (int) $section_setting['jumlah'];
					}
					echo $section_berita_terbaru_judul;
				?> 
			</h5>
			<div class="section-body m-0"> 
				<div class="row justify-content-center">  
				<?php 

					if(!function_exists('get_viewer')) {
						function get_viewer($number) {
							if($number > 1000) {
								$number = $number /1000;
								return number_format($number,0,',','.').'k';
							}
							return number_format($number,0,',','.');
						}
					}
					
					$this->load->helper('text');
					$berita_populer = $this->model_utama->view_join_two(
						'berita','users','kategori','username','id_kategori',
						array('berita.status' => 'Y'),'tanggal','DESC',0,$jumlah_berita);

					foreach ($berita_populer->result_array() as $i => $berita) { 
						$img_src= base_url().'asset/foto_berita/no-image.jpg';
						if ($berita['gambar'] !==''){
							$img_src =base_url().'asset/foto_berita/'.$berita['gambar'];
						}  
						?>
							<div class="col-md-4 mb-4">
								<div class="section-post card post-list">															
									<a href="<?php echo base_url($berita['judul_seo']) ;?>">				
										<div class="post-img-container"
											style="
												background:url('<?php echo $img_src;?>');
												background-position:center;
												background-size:cover;
												background-repeat:no-repeat
											">
										</div>
									</a>		 
									<div class="card-body">
										<div class="post-category">
												<a href="<?php echo base_url('kategori/detail/'.$berita['kategori_seo']);?>">	
													<div class="color-label">
														<?php echo $berita['nama_kategori'];?>
													</div>
												</a> 
										</div> 
										<a href="<?php echo base_url().$berita['judul_seo'];?>">
											<h4>
												<?php echo $berita['judul'];?> 
											</h4>
										</a>  
										<div class="post-meta">
											<i class="fa fa-clock-o"></i> <?php echo tgl_indo($berita['tanggal']);?> ,
											<i class="fa fa-flash" aria-hidden="true"></i> dilihat <?php echo get_viewer($berita['dibaca']);?> 
										</div> 
										<div class="post-content py-1">
											<?php echo word_limiter( strip_tags($berita['isi_berita']),15);?> 
										</div>	
											<a href="<?php echo base_url().$berita['judul_seo'];?>" class="read-more d-none d-md-block">
												Selengkapnya 
											</a>
									</div>
								</div>
							</div>  
						<?php 
					}
				?>  			
				</div>
			</div>
		</div>  
	</div>  
</section>