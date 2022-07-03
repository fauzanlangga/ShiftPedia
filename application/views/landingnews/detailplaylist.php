<div class="post-head mb-4"> 
    <?php echo  $rows['jdl_playlist'];?>
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
			
		  foreach ($detailplaylist->result_array() as $r) {	 
			  
			  $judul = substr($r['jdl_video'],0,33); 
			  $isi_berita =(strip_tags($r['keterangan'])); 
			  $isi = substr($isi_berita,0,280); 
			  $isi = substr($isi_berita,0,strrpos($isi," "));
			  $total_komentar = $this->model_utama->view_where('komentarvid',array('id_video' => $r['id_video'],'aktif' => 'Y'))->num_rows();

			  $img_src = base_url()."asset/img_video/small_no-image.jpg";
			  if ($h['gbr_video'] !== '' &&  file_exists( $base_path ."asset/img_video/".$r['gbr_video'] ) ){
					$img_src = base_url()."asset/img_video/".$r['gbr_video'];
			  }	 
			  $img_size = getimagesize($img_src);
			  $class_image= ($img_size[0] > $img_size[1]) ? 'landscape':'portrait';
			  ?>
			  <div class="col-md-12 mb-4">
				 <div class="video-list card h-100"> 
					<div class="row">
						<div class="col-md-4">
							<div class="card">
								<div class="image-container">
									<div class="thumbnail">
										<div class="center">
											<img class="<?php echo $class_image;?>" src="<?php echo $img_src;?>" title="image" />
										</div>
									</div> 
								</div>  
							</div>
						</div>
						<div class="col-md-8">
							<div class="card card-content">
								<div class="card-body">
									<a href="<?php echo base_url()."playlist/watch/".$r['video_seo'];?>">
										<h3 class="card-title"><?php echo $judul;?></h3>
									</a>
									<div class="post-meta"> 
										<i class="fa fa-clock-o"></i>  <?php echo tgl_indo($r['tanggal']);?> ,
										<i class="fa fa-flash" aria-hidden="true"></i> dilihat <?php echo get_viewer($r['dilihat']);?>
									</div> 

									<div class="card-text">
										<?php echo $isi;  ?>
									</div> 
									<a href="<?php echo base_url()."playlist/watch/".$r['video_seo'];?>" class="read-more">
										Tonton Sekarang
									</a> 
								</div>
							</div>

						</div>
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