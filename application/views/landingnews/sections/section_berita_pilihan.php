<section id="<?php echo $section_id;?>" class="section featured  py-4 <?php echo $section_class;?>"> 
	<div class="container">
		<div class="section-container">
			<h5 class="section-title">	
				<?php 
					$section_berita_pilihan_judul = 'Berita Pilihan'; 
					$jumlah_berita = 0;
					if( isset($section_setting['judul']) ) {
						if( !empty(trim($section_setting['judul']))) {
							$section_berita_pilihan_judul = $section_setting['judul'];
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
					echo $section_berita_pilihan_judul;
				?> 
			</h5>
			<div class="section-body m-0"> 
				<div class="row featured-item owl-carousel">   
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

						$filter_berita = array_merge($filter_berita,array(
							'berita.status' => 'Y'
						));
						
						$berita_utama = $this->model_utama->view_join_two(
								'berita',
								'users',
								'kategori',
								'username',
								'id_kategori',
								$filter_berita,
								'tanggal','DESC',0,$jumlah_berita);

						foreach ($berita_utama->result_array() as $i => $berita) {
							$total_komentar = $this->model_utama->view_where('komentar',array('id_berita' => $berita['id_berita']))->num_rows();
				
							$img_src= base_url().'asset/foto_berita/small_no-image.jpg';
							if ($berita['gambar'] !==''){
								$img_src =base_url().'asset/foto_berita/'.$berita['gambar'];
							}  
							?> 
								<div class="col-md-4 pl-0 pr-3">
									<div class="section-post card">									
										<div class="post-img-container"
											style="
												background:url('<?php echo $img_src;?>');
												background-position:center;
												background-size:cover;
												background-repeat:no-repeat
											">
										</div>
											<div class="card-body">
												<div class="post-content">
													<div class="post-category"> 
														<a href="<?php echo base_url('kategori/detail/'.$berita['kategori_seo']);?>">
															<div class="color-label">
																<?php echo $berita['nama_kategori'];?>
															</div> 
														</a> 
													</div> 													
													<a href="<?php echo base_url().$berita['judul_seo'];?>">
														<h5 class="post-title pt-3">
															<?php echo $berita['judul'];?> 
														</h5>														
													</a> 
													<div class="post-meta">
													<i class="fa fa-clock-o"></i> <?php echo tgl_indo($berita['tanggal']);?> ,
													<i class="fa fa-flash" aria-hidden="true"></i> dilihat <?php echo get_viewer($berita['dibaca']);?> 
													</div>
												</div>
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