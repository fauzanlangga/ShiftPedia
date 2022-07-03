<?php

$get_setting_footer_1 = $this->model_utama->view_where('tbl_landingnews',array('key' => 'setting_footer_1'))->row_array();
$get_setting_footer_2 = $this->model_utama->view_where('tbl_landingnews',array('key' => 'setting_footer_2'))->row_array();
$get_setting_footer_3 = $this->model_utama->view_where('tbl_landingnews',array('key' => 'setting_footer_3'))->row_array();
$get_setting_footer_4 = $this->model_utama->view_where('tbl_landingnews',array('key' => 'setting_footer_4'))->row_array();  
function get_footer_widget($get_setting_footer) {
	$footer = array();
	if(isset($get_setting_footer['value'])) {

		if(!empty($get_setting_footer['value'])){

			$setting_footer = json_decode($get_setting_footer['value'],true); 
			if(!empty($setting_footer)) {
				$number = 0;
				foreach($setting_footer as $i => $widget_id){ 
					$id = key($widget_id); 
					$footer[$number]['widget_id'] = $id;
					$footer[$number]['widget_setting'] = $widget_id[$id];
					$number++; 
				}

			}

		}

	} 
	return $footer;
}

?>

<div class="row">
	<div class="col-md-6 col-lg-3">
		<?php  
			$footer_1 = get_footer_widget($get_setting_footer_1);
			foreach($footer_1 as $i => $item) {
				$file_footer = VIEWPATH . template().'/widgets/' . $item['widget_id'] . '.php';
				
				if( file_exists($file_footer)) { 
					$widget_setting = $item['widget_setting'];
					include $file_footer;
				}
			}
		?>
	</div>
	<div class="col-md-6 col-lg-3">
		<?php  
			$footer_2 = get_footer_widget($get_setting_footer_2);
			foreach($footer_2 as $i => $item) {
				$file_footer = VIEWPATH . template().'/widgets/' . $item['widget_id'] . '.php';
				
				if( file_exists($file_footer)) { 
					$widget_setting = $item['widget_setting'];
					include $file_footer;
				}
			}
		?>
	</div>
	<div class="col-md-6 col-lg-3">
		<?php  
			$footer_3 = get_footer_widget($get_setting_footer_3);
			foreach($footer_3 as $i => $item) {
				$file_footer = VIEWPATH . template().'/widgets/' . $item['widget_id'] . '.php';
				
				if( file_exists($file_footer)) { 
					$widget_setting = $item['widget_setting'];
					include $file_footer;
				}
			}
		?>
	</div>
	<div class="col-md-6 col-lg-3">
		<?php  
			$footer_4 = get_footer_widget($get_setting_footer_4);
			foreach($footer_4 as $i => $item) {
				$file_footer = VIEWPATH . template().'/widgets/' . $item['widget_id'] . '.php';
				
				if( file_exists($file_footer)) { 
					$widget_setting = $item['widget_setting'];
					include $file_footer;
				}
			}
		?>
	</div>
</div>