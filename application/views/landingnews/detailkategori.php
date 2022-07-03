<?php 
$base_path = FCPATH;
?> 
<div class="post-head mb-2"> 
 Kategori : <?php echo  $rows['nama_kategori'];?> 
</div>
		<div class="row"> 
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

			  foreach ($beritakategori->result_array() as $i => $berita) { 
 
				  $isi_berita =(strip_tags($berita['isi_berita'])); 
				  $isi = substr($isi_berita,0,220); 
				  $isi = substr($isi_berita,0,strrpos($isi," ")); 
				  $judul = $berita['judul']; 
				  $total_komentar = $this->model_utama->view_where('komentar',array('id_berita' => $berita['id_berita']))->num_rows();
				  $img_src = base_url()."asset/foto_berita/no-image.jpg";
				  if ($berita['gambar'] !== '' &&  file_exists( $base_path ."asset/foto_berita/".($berita['gambar']) ) ){
						$img_src = base_url()."asset/foto_berita/". $berita['gambar'];
				  } 
				  ?>
				  <div class="col-md-6 mb-4">
					  <div class="blog card h-100">
						<div class="image-container"  
							style="
								background:url('<?php echo $img_src;?>');
								background-position:center;
								background-size:cover;
								background-repeat:no-repeat
							">
						</div>
						<div class="card-body">
							<div class="post-category">
									<a href="<?php echo base_url('kategori/detail/'.$berita['kategori_seo']);?>">	
										<div class="color-label">
											<?php echo $berita['nama_kategori'];?>
										</div>
									</a> 
							</div> 
							<a href="<?php echo base_url().$berita['judul_seo'];?>">
								<h4 class="card-title"><?php echo $judul;?></h4>
							</a>
							<div class="post-meta">
								<i class="fa fa-clock-o"></i> <?php echo tgl_indo($berita['tanggal']); ?> ,
								<i class="fa fa-flash"></i> dilihat <?php echo get_viewer($berita['dibaca']); ?>
							</div>
							<div class="card-text">
								<?php echo $isi;  ?>
							</div>
							<?php 
							if( !empty($berita['tag'])) {
								$tags = explode(",",$berita['tag']);							
								$hitung = count($tags);	 
							?>
								<div class="tags">
								<i class="fa fa-tags"></i>
									<?php									
										$hitung = count($tags);
										for ($x=0; $x<=$hitung-1; $x++) {
											if ($tags[$x] != ''){
												echo "<a href='".base_url()."tag/detail/$tags[$x]'>$tags[$x]</a>";
											}
										}
									?>
								</div>
							<?php } ?> 
						</div>
					</div> 
				</div>
				<?php
			  }
			?> 
		</div>
<div class="pagination">
	<?php echo $this->pagination->create_links(); ?>
</div>