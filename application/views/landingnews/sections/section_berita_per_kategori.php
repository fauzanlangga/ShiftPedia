<section id="<?php echo $section_id;?>" class="section category  py-4 <?php echo $section_class;?>"> 
	<div class="container">
		<div class="section-container ">	
			<?php 
				$section_berita_per_kategori_judul = 'Berita Per Kategori'; 
				$jumlah_berita = 0;
				$kategori_id = 0;
				if( isset($section_setting['kategori']) ) {
					$kategori_id = (int) $section_setting['kategori'];
					$kategori_data = $this->model_utama->view_where('kategori',array('id_kategori' => $kategori_id))->row_array();
					$section_berita_per_kategori_judul = $kategori_data['nama_kategori'];
				}

				if( isset($section_setting['jumlah']) ) {
					$jumlah_berita = (int) $section_setting['jumlah'];
				} 
			?> 															 
			<h5 class="section-title">	
				<?php  
					echo $section_berita_per_kategori_judul;
				?> 
			</h5>  
			<div class="section-body"> 
				<div class="row justify-content-center">  
					<?php 
						$berita_list = $this->model_utama->view_join_two(
							'berita',
							'users',
							'kategori',
							'username',
							'id_kategori',
							array(
								'berita.status' => 'Y', 
								'berita.id_kategori' => $kategori_id
							),
							'tanggal','DESC',0,$jumlah_berita
						)->result_array(); 

						if(!function_exists('get_viewer')) {
							function get_viewer($number) {
								if($number > 1000) {
									$number = $number /1000;
									return number_format($number,0,',','.').'k';
								}
								return number_format($number,0,',','.');
							}
						}
						foreach ($berita_list as $i => $berita) {
							$total_komentar = $this->model_utama->view_where('komentar',array('id_berita' => $berita['id_berita']))->num_rows();
				
							$img_src= base_url().'asset/foto_berita/small_no-image.jpg';
							if ($berita['gambar'] !==''){
								$img_src =base_url().'asset/foto_berita/'.$berita['gambar'];
							} 
 
							?>  
								<div class="col-md-4 mb-4 space-y-5">
									<div class="section-post card">															
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
											<div class="post-content">
												<a href="<?php echo base_url().$berita['judul_seo'];?>">
													<h5 class="post-title">
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
			<a href="<?php echo base_url("kategori/detail/".$kategori_data['kategori_seo']);?>" class="read-more text-center">
				Selengkapnya 
			</a>
		</div> 
	</div>  
</section>