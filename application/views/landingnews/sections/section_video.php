<section id="<?php echo $section_id;?>" class="section video  py-4 <?php echo $section_class;?>"> 
	<div class="container">
		<div class="section-container">
			<h5 class="section-title">	 
				<?php 
					$section_video_judul = 'Video'; 
					$jumlah_video = 0;
					if( isset($section_setting['judul']) ) {
						if( !empty(trim($section_setting['judul'])) && 
							trim($section_setting['judul']) !== 'Semua'
						) {
							$section_video_judul = $section_setting['judul'];
						}
					} 

					$filter_video = array();
					if( isset($section_setting['playlist']) ) {
						$playlist =  $section_setting['playlist'];
						if(!empty(trim($playlist))) { 
							$filter_video = array('playlist.id_playlist' => (int) $playlist );
						}
					} 

					if( isset($section_setting['jumlah']) ) {
						$jumlah_video = (int) $section_setting['jumlah'];
					}
					echo $section_video_judul;
				?> 
			</h5>
			<div class="section-body"> 
				<div class="row justify-content-center">  
					<?php  

						$filter_video = array_merge($filter_video,array(
							'playlist.aktif' => 'Y'
						));

						$video_data = $this->model_utama->view_join_one(
								'video',
								'playlist',
								'id_playlist', 
								$filter_video,
								'video.jdl_video','ASC',0,$jumlah_video)->result_array(); 
						foreach ($video_data as $video) { 
							$img_src= base_url().'asset/img_video/small_no-image.jpg';
							if ($video['gbr_video'] !==''){
								$img_src =base_url().'asset/img_video/'.$video['gbr_video'];
							}  
							?> 
								<div class="col-md-4 mb-4 space-y-5">
									<a href="<?php echo base_url('playlist/watch/'.$video['video_seo']);?>">
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
												<div class="post-title">
													<?php echo $video['jdl_video'];?> 
												</div>
												<small>	<?php echo $video['jdl_playlist'];?> </small>
											</div>
											<div class="icon">
												<i class="fa fa-play-circle-o" aria-hidden="true"></i>
											</div>
										</div>
									</div>
									</a>
								</div>
							<?php
						}
					?>    
				</div>
			</div>
			<a href="<?php echo base_url("playlist");?>" class="read-more text-center">
				Selengkapnya 
			</a>
		</div>  
	</div>  
</section>