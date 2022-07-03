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
	  foreach ($agenda->result_array() as $r) {	
		  $tgl_posting = tgl_indo($r['tgl_posting']);
		  $tgl_mulai   = tgl_indo($r['tgl_mulai']);
		  $tgl_selesai = tgl_indo($r['tgl_selesai']); 
		  $judul = $r['tema'];
		  $isi_agenda =(strip_tags($r['isi_agenda'])); 
		  $isi = substr($isi_agenda,0,280); 
		  $isi = substr($isi_agenda,0,strrpos($isi," "));		
		  $img_src = base_url()."asset/foto_agenda/small_no-image.jpg";
		  if ($r['gambar'] !== '' &&  file_exists( $base_path ."asset/foto_agenda/".($r['gambar']) ) ){
				$img_src = base_url()."asset/foto_agenda/". $r['gambar'];
		  }	 
		  ?>
			<div class="col-md-12 mb-4">
			  <div class="agenda card h-100">
		  			<div class="row">
						<div class="col-sm-6 col-md-4">
							<div class="card">
								<div class="image-container"
									style="
										background:url('<?php echo $img_src;?>');
										background-position:center;
										background-size:cover;
										background-repeat:no-repeat
									"> 
								</div>
							</div>
						</div>
						<div class="col-md-8 col-sm-6">
							<div class="card card-content">
								<div class="card-body">
									<a href="<?php echo base_url()."agenda/detail/".$r['tema_seo'];?>">
										<h4 class="card-title"><?php echo $judul;?></h4>
									</a>
									<div class="post-meta"> 
										<i class="fa fa-clock-o"></i> <?php echo  $tgl_posting; ?> ,
										<i class="fa fa-flash" aria-hidden="true"></i> dilihat <?php echo get_viewer($r['dibaca']);?>
									</div>

									<div class="card-text">
										<?php echo $isi;  ?>
									</div> 
									<a href="<?php echo base_url()."agenda/detail/".$r['tema_seo'];?>" class="read-more">
										Selengkapnya
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