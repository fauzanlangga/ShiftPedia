<?php
// footer menu 
$get_lokasi_menu    = $this->model_utama->view_where('tbl_landingnews',array('key' => 'lokasi_menu'))->row_array();
if(isset($get_lokasi_menu['value'])){
	if(!empty($get_lokasi_menu['value'])){
		$lokasi_menu = json_decode($get_lokasi_menu['value'],true);
	}
} 
$menu_footer_id = '';
if(isset($lokasi_menu['menu_footer'])) {
	$menu_footer_id = $lokasi_menu['menu_footer'];
}


//menampilkan identias website 
$id_website = $this->model_utama->view('identitas')->row_array();	 
?>
<footer>
	<div id="footer" class="py-5">  
		<div class="container footer-widget">		
			<?php include 'footer_widget.php'; ?>
		</div>
	</div>
	<div id="footer-bottom" class="py-4 ">
		<div class="container"> 
			<div class="row">
				<div class="col-lg-12 text-center pb-3">
					<?php
						if(!empty($menu_footer_id)) {
							echo build_nav_menu( $menu_footer_id , $menu_footer_id ,'footer-menu',false,false);  
						}
					?>
				</div>
				<div class="col-lg-12 text-center pb-3">
					<div class="pb-1">
					<b><?php echo $id_website['nama_website']; ?></b>
					<?php  
					if( isset($tagline['footer']) && isset($tagline['text'])) {
						if(!empty($tagline['text'] && $tagline['footer'] ==  '1') ){
							echo ' - '.$tagline['text'];
						}
					}?> 
					</div>
					<div class="p-0 mb-2">
						&copy; <?php echo date('Y');?> , All Rights reserved
					</div>
				</div>
			</div>
		</div>
	</div>
</footer>
<?php $this->model_utama->kunjungan(); ?>