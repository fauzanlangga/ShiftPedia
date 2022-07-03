<div class="post-head mb-4"> 
    <?php echo $title;?>
</div>
<?php 
$base_path = FCPATH;
?>

<div class="row"> 
	<?php 
		$no=$this->uri->segment(3)+1;
		foreach ($playlist->result_array() as $h) {	 
		$total_video = $this->model_utama->view_where('video',array('id_playlist' => $h['id_playlist']))->num_rows();			
		$img_src = base_url()."asset/img_playlist/no-image.jpg";
		if ($h['gbr_playlist'] !== '' &&  file_exists( $base_path ."asset/img_playlist/".$h['gbr_playlist'] ) ){
			  $img_src = base_url()."asset/img_playlist/".$h['gbr_playlist'];
		}	
		$img_size = getimagesize($img_src);
		$class_image= ($img_size[0] > $img_size[1]) ? 'landscape':'portrait';
		?>
		<div class="col-md-6 mb-4">
			<div class="grid card h-100">
				<div class="image-container">
					<div class="thumbnail">
						<div class="center">
							<img class="<?php echo $class_image;?>" src="<?php echo $img_src;?>" title="image" />
						</div>
					</div> 
				</div> 
				<div class="card-body">
					<h4 class="card-title">
						<a href="<?php echo base_url()."playlist/detail/".$h['playlist_seo'];?>">
							<?php echo $h['jdl_playlist'];?>
						</a>
					</h4> 
					<div class="card-text">
						<?php echo $total_video;?> Video
					</div> 
					<a href="<?php echo base_url()."playlist/detail/".$h['playlist_seo'];?>" class="read-more">
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