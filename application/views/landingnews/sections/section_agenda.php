<section id="<?php echo $section_id;?>" class="section agenda  py-4 <?php echo $section_class;?>"> 
	<div class="container">
		<div class="section-container">
			<h5 class="section-title">	 
				<?php 
					$section_agenda_judul = 'Agenda'; 
					$jumlah_agenda = 0;
					if( isset($section_setting['judul']) ) {
						if( !empty(trim($section_setting['judul']))) {
							$section_agenda_judul = $section_setting['judul'];
						}
					} 

					if( isset($section_setting['jumlah']) ) {
						$jumlah_agenda = (int) $section_setting['jumlah'];
					}
					echo $section_agenda_judul;
				?> 
			</h5>
			<div class="section-body"> 
				<div class="row justify-content-center">   
					<?php 
						$agenda_data =  $this->db->query("
							SELECT
								* 
							FROM
								agenda
							WHERE
								tgl_mulai >= curdate()
							ORDER BY
								tgl_mulai asc
							LIMIT 0,".$jumlah_agenda
						)->result_array();    
						if(!empty($agenda_data)) {
							foreach ($agenda_data as $agenda) { 
								$img_src= base_url().'asset/foto_agenda/no-image.jpg';
								if ($agenda['gambar'] !==''){
									$img_src =base_url().'asset/foto_agenda/'.$agenda['gambar'];
								}  
								?> 
									<div class="col-md-4 mb-4 space-y-5" >
										<div class="section-post card">										
											<a href="<?php echo base_url('agenda/detail/'.$agenda['tema_seo']);?>">
											<div class="post-img-container"
												style="
													background:url('<?php echo $img_src;?>');
													background-position:center;
													background-size:cover;
													background-repeat:no-repeat
												"> 
											</div>
											</a>
											<a href="<?php echo base_url('agenda/detail/'.$agenda['tema_seo']);?>">
											<div class="card-body">
												<div class="post-content">
													<h5 class="post-date">
														<i class="fa fa-calendar-o"></i> <?php echo tgl_indo($agenda['tgl_mulai']);?> 
													</h5>										
													<h5 class="post-title">
														<?php echo $agenda['tema'];?> 
													</h5>
												</div>
											</div>										
											</a> 
										</div>
									</div>
								<?php
							}
						} else {
							?>
							<div class="col-md-12 text-center py-5">
								Belum Ada <?php echo $section_agenda_judul;?> Terdekat
							</div>
							<?php
						}
					?>    
				</div>
			</div>
			<a href="<?php echo base_url("agenda");?>" class="read-more text-center">
				Selengkapnya 
			</a>
		</div>  
	</div>  
</section>