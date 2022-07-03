<?php 
$total_komentar = $this->model_utama->view_where('komentarvid',array('id_video' => $rows['id_video']))->num_rows();



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
<div class="video-detail card mb-4">
	<div class="card-body">
		<div class="post-category">
			<a href="<?php echo base_url()."playlist/detail/".$rows['playlist_seo']; ?>">
				<div class="color-label">
					<?php echo $rows['jdl_playlist'];?>
				</div>
			</a> 
		</div> 
		<h2 class="card-title">
		<?php echo $rows['jdl_video']; ?>
		</h2>

		<div class="post-meta"> 
			<i class="fa fa-user" aria-hidden="true"> </i> <?php echo $rows['nama_lengkap']; ?> ,
			<i class="fa fa-clock-o"></i>  <?php echo tgl_indo($rows['tanggal']);?> ,
			<i class="fa fa-flash" aria-hidden="true"></i> dilihat <?php echo get_viewer($rows['dilihat']);?>
		</div>  
		<?php include 'partials/share.php';?> 
		<div class="video-container">
			<?php
				if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $rows['youtube'], $match)) {
					?>
					<iframe src="https://www.youtube.com/embed/<?php echo $match[1];?>" frameborder="0" allowfullscreen></iframe>
					<?php
				}
			?>
		</div>
		<div class="card-text"> 
			<?php echo $rows['keterangan']; ?>
		</div> 
		<?php include 'partials/share.php';?> 
	</div>	 
</div>  




<?php
$vdiklan = $this->model_utama->view_where_ordering_limit('iklantengah',array('posisi'=>'detail_video'),'id_iklantengah','ASC',0,5);
if(!empty($vdiklan)){
	foreach ($vdiklan->result_array() as $ia) {		
		echo '<div class="my-4">';
		echo "<a href='$ia[url]' target='_blank'>";
			$string = $ia['gambar'];
			if ($ia['gambar'] != ''){
				if(preg_match("/swf\z/i", $string)) {
					echo "<embed style='margin-top:-10px' src='".base_url()."asset/foto_iklantengah/$ia[gambar]' width='100%' height=90px quality='high' type='application/x-shockwave-flash'>";
				} else {
					echo "<img width='100%' src='".base_url()."asset/foto_iklantengah/$ia[gambar]' title='$ia[judul]' />";
				}
			}
		echo "</a>";
		echo "</div>";
		if (trim($ia['source']) != ''){ echo "$ia[source]"; }
	}
}
?>
 
<?php					
	$related_video = $this->db->query("
		SELECT 
			v.video_seo,
			v.jdl_video
		FROM video v
			JOIN playlist pl ON pl.id_playlist = v.id_playlist
		WHERE
			v.id_playlist ='". $rows['id_playlist']."'
			AND 
			v.id_video !='".  $rows['id_video'] ."'
		ORDER BY v.tanggal	
		LIMIT 0,5	
	")->result_array(); 
	if(!empty($related_video)) {
?>
<div class="related-video card mb-4">
	<h5 class="card-header">
		Video Lainnya
	</h5>
	<div class="card-body"> 
		<ul> 
			<?php					
			foreach ($related_video  as $rvideo) {												  
			?>
			<li> 
				<a href="<?php echo base_url()."playlist/watch/". $rvideo['video_seo'];?>">
				<i class="fa fa-file-video-o"></i> <?php echo $rvideo['jdl_video'];?>
				</a>
			</li>
			<?php
			}   
			?> 
		</ul>
	</div>
</div>
<?php } ?>

<?php include 'partials/komentar_video.php';?> 