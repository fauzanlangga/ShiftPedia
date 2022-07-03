<?php
  
  $get_setting_sections    = $this->model_utama->view_where('tbl_landingnews',array('key' => 'setting_sections'))->row_array(); 
 
  $sections = array();
  if(isset($get_setting_sections['value'])) {
  
      if(!empty($get_setting_sections['value'])){
  
          $setting_sections = json_decode($get_setting_sections['value'],true); 
          if(!empty($setting_sections)) {
              $number = 0;
              foreach($setting_sections as $i => $section_id){ 
                  $id = key($section_id); 
                  $sections[$number]['section_id'] = $id;
                  $sections[$number]['section_setting'] = $section_id[$id];
                  $number++; 
              }
  
          }
  
      }
  
  } 
  
  foreach($sections as $i => $item) {
      $file_sections = VIEWPATH . template().'/sections/' . $item['section_id'] . '.php';
      
      if( file_exists($file_sections)) { 
          $section_id = $item['section_id'].'_' .$i;
          $section_setting = $item['section_setting']; 
          include $file_sections;
      }
  }
  
?> 