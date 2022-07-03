<div class="post-head mb-4"> 
    <?php echo $title;?>
</div>
<?php 
$base_path = FCPATH;
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
<div class="row"> 
	<?php 
		$no = $this->uri->segment(3)+1;
		foreach ($album->result_array() as $h) {	
			$total_foto = $this->model_utama->view_where('gallery',array('id_album' => $h['id_album']))->num_rows();		
			$img_src = base_url()."asset/img_album/no-image.jpg";
			if ($h['gbr_album'] !== '' &&  file_exists( $base_path ."asset/img_playlist/".$h['gbr_playlist'] ) ){
				  $img_src = base_url()."asset/img_album/".$h['gbr_album'];
			}	 	
		  ?>
		  <div class="col-md-6 mb-4">
			  <div class="grid card h-100">
				  <div class="image-container" 
							style="
								background:url('<?php echo $img_src;?>');
								background-position:center;
								background-size:cover;
								background-repeat:no-repeat
							"> 
				  </div> 
				  <div class="card-body">
					  <h3 class="card-title">
						  <a href="<?php echo base_url()."albums/detail/".$h['album_seo'];?>">
							  <?php echo $h['jdl_album'];?>
						  </a>
					  </h3>
						<div class="post-meta">				
							<i class="fa fa-clock-o"></i>  <?php echo tgl_indo($h['tgl_posting']);?> ,
							<i class="fa fa-flash" aria-hidden="true"></i> dilihat <?php echo get_viewer($h['hits_album']);?> 
						</div>
					  <div class="card-text">
					  	Ada <?php echo $total_foto;?> Foto
					  </div> 
					  <a href="<?php echo base_url()."albums/detail/".$h['album_seo'];?>" class="read-more">
						  Selengkapnya
					  </a> 
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