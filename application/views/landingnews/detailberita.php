<?php
	$baca = $rows['dibaca']+1;	
	$total_komentar = $this->model_utama->view_where('komentar',array('id_berita' => $rows['id_berita'],'aktif' => 'Y'))->num_rows(); 
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
 
	<div class="blog-detail card mb-4"> 
		<div class="card-body">  
			<div class="post-category">
					<a href="<?php echo base_url('kategori/detail/'.$rows['kategori_seo']);?>">	
						<div class="color-label">
							<?php echo $rows['nama_kategori'];?>
						</div>
					</a> 
			</div> 
			<h2 class="card-title">
				<?php echo $rows['judul'] ."<small>$rows[sub_judul] </small>"; ?>
			</h2>
			<div class="post-meta"> 
				<i class="fa fa-user" aria-hidden="true"> </i> <?php echo $rows['nama_lengkap']; ?> ,
				<i class="fa fa-clock-o"></i> <?php echo tgl_indo($rows['tanggal']);?> ,
				<i class="fa fa-flash" aria-hidden="true"></i> dilihat <?php echo get_viewer($baca);?> 
			</div>    
			<?php include 'partials/share.php';?>
			<?php 
			if ($rows['gambar'] !=''){ 
				?>
				<div class="image-container">
					<img src="<?php echo base_url("asset/foto_berita/".$rows['gambar']);?>" alt='$rows[judul]' />
					<?php
					if ($rows['keterangan_gambar'] !=''){ 
						?>
						<small class="image-caption">Keterangan Gambar : <?php echo $rows['keterangan_gambar'];?></small>
						<?php
					}
					?>
				</div>	
				<?php
			}								
			?>
			<div class="card-text">
			<?php echo $rows['isi_berita'];?>	 
			<?php 
				if ($rows['youtube']!=''){
					?>
					<h5>Video Terkait</h5>
					<?php
					if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $rows['youtube'], $match)) {
						?>
						<iframe width="100%" height="350px" id="ytplayer" type="text/html"
							src="https://www.youtube.com/embed/<?php echo $match[1];?>?rel=0&showinfo=1&color=white&iv_load_policy=3"
							frameborder="0" allowfullscreen></iframe>
						<?php
					} 
				}

			?>
			</div> 
			<?php 
			if( !empty($rows['tag'])) {
				$tags = explode(",",$rows['tag']);							
				$hitung = count($tags);				
				?>
				<div class="tags">
				<i class="fa fa-tags"></i>
					<?php						
						for ($x=0; $x<=$hitung-1; $x++) {
							if ($tags[$x] != ''){
								echo "<a href='".base_url()."tag/detail/$tags[$x]'>$tags[$x]</a>";
							}
						}
					?>
				</div>
			<?php } ?>
			<?php include 'partials/share.php';?>
		</div>  
		
	</div>

	<?php
	$ia = $this->model_utama->view_ordering_limit('iklantengah','id_iklantengah','ASC',3,1)->row_array();
	if( !empty($ia)) {
		echo '<div class="my-4">';
		echo "<a href='$ia[url]' target='_blank'>";
			$string = $ia['gambar'];
			if ($ia['gambar'] != ''){
				if(preg_match("/swf\z/i", $string)) {
					echo "<embed src='".base_url()."asset/foto_iklantengah/$ia[gambar]' width='100%' height=90px quality='high' type='application/x-shockwave-flash'>";
				} else {
					echo "<img width='100%' src='".base_url()."asset/foto_iklantengah/$ia[gambar]' title='$ia[judul]' />";
				}
			}
		echo "</a>";
		echo '</div>';
	}
	?>
			

	<?php 
		$pisah_kata  = explode(",",$rows['tag']);
		$jml_katakan = (integer)count($pisah_kata);
		$jml_kata = $jml_katakan-1; 
		$ambil_id = substr($rows['id_berita'],0,4);
		$cari = "SELECT * FROM berita join kategori on kategori.id_kategori = berita.id_kategori WHERE (id_berita<'$ambil_id') and (id_berita!='$ambil_id') and (" ;
		for ($i=0; $i<=$jml_kata; $i++){
		$cari .= "tag LIKE '%$pisah_kata[$i]%'";
		if ($i < $jml_kata ){
		$cari .= " OR ";}}
		$cari .= ") ORDER BY id_berita DESC LIMIT 3";
		$hasil  = $this->db->query($cari);
		if ($hasil->num_rows()>=1) {
	?>
	<div class="related-blog card mb-4">
		<h5 class="card-header">
			Baca Lainnya
		</h5>
		<div class="card-body">
			<div class="row">
				<?php				 
					foreach ($hasil->result_array() as $i => $related_row) {	 
						$total_komentar_terkait = $this->model_utama->view_where('komentar',array('id_berita' => $related_row['id_berita'],'aktif' => 'Y'))->num_rows(); 
					  
				?>
				<div class="col-sm-6  col-md-4 column">
					<div class="blog card mb-4 h-100">
						<?php  
							$img_src= base_url().'asset/foto_berita/no-image.jpg';
							if ($related_row['gambar'] !==''){
								$img_src =base_url().'asset/foto_berita/'.$related_row['gambar'];
							}   	
						?>							
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
									<a href="<?php echo base_url('kategori/detail/'.$related_row['kategori_seo']);?>">	
										<div class="color-label">
											<?php echo $related_row['nama_kategori'];?>
										</div>
									</a> 
							</div> 
							<a href="<?php echo base_url().$related_row['judul_seo'];?>">
								<h5 class="card-title m-0"><?php echo $related_row['judul'];?></h5>
							</a>
							<div class="post-meta">		
								
								<i class="fa fa-calendar"></i> <?php echo tgl_indo($related_row['tanggal']); ?> ,
								<i class="fa fa-flash" aria-hidden="true"></i> dilihat <?php echo get_viewer($related_row['dibaca']);?> 
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
	<?php			
	}
	?>
	<?php include 'partials/komentar.php';?> 
 