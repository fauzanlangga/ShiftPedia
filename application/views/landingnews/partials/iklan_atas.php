<?php            
// get iklan atas
$get_iklan_header = $this->model_utama->view_where('tbl_landingnews',array('key' => 'iklan_header'))->row_array();
$iklan_header_id = "";
if(isset($get_iklan_header['value'])){
    if(!empty($get_iklan_header['value'])){
        $iklan_header_id = json_decode($get_iklan_header['value'],true);
    }
} 

if( !empty($iklan_header_id) ) {
 
    switch ($iklan_header_id) {
        case 'semua':
            
            $pasang_iklan_atas = $this->db->query("
                SELECT 
                    judul,
                    url,
                    gambar,
                    source
                FROM 
                    iklanatas
                ORDER BY tgl_posting DESC
            ")->result_array();

            break;
        case 'semua-acak':
            
            $pasang_iklan_atas = $this->db->query("
                SELECT 
                    judul,
                    url,
                    gambar,
                    source
                FROM 
                    iklanatas
                ORDER BY RAND() LIMIT 1
            ")->row_array();

            break;
        default: 

            $pasang_iklan_atas = $this->db->query("
                SELECT 
                    judul,
                    url,
                    gambar,
                    source
                FROM 
                    iklanatas 
                WHERE 
                    id_iklanatas ='". $iklan_header_id."'"
            )->row_array(); 

            break;
    }
		

?>
<div class="mb-4"> 
    <?php if($iklan_header_id == 'semua') { ?>
        <?php 
            if(!empty($pasang_iklan_atas)) {
                foreach($pasang_iklan_atas as $iklan_item) {
                    ?>
                    <div class="iklan-atas text-center mb-2">
                        <?php if( $iklan_item['gambar'] !='') { ?>            
                            <?php 
                                if(preg_match("/swf\z/i", $iklan_item['gambar'] )) { ?>
                                <embed width="100%" 
                                    src=" <?php echo base_url()."asset/foto_iklanatas/". $iklan_item['gambar'];?>" 
                                        quality='high' type='application/x-shockwave-flash'>
                                <?php
                                } else {
                            ?>
                                    <a href="<?php echo $iklan_item['url'];?>" target='_blank'>
                                        <img style='width:100%' 
                                                src="<?php echo base_url()."asset/foto_iklanatas/".$iklan_item['gambar'];?>" 
                                                alt="<?php echo $pasang_iklan_atas['judul'];?>" 
                                        />
                                    </a>
                            <?php  
                                }
                            }

                            if (trim($iklan_item['source']) != '') { 
                                echo $iklan_item['source'];
                            }

                        ?> 
                    </div> 
                    <?php
                }
            }
        ?>
    <?php } else { ?>
        <div class="iklan-atas text-center">
            <?php if( $pasang_iklan_atas['gambar'] !='') { ?>            
                <?php 
                    if(preg_match("/swf\z/i", $pasang_iklan_atas['gambar'] )) { ?>
                    <embed width="100%" 
                        src=" <?php echo base_url()."asset/foto_iklanatas/". $pasang_iklan_atas['gambar'];?>" 
                            quality='high' type='application/x-shockwave-flash'>
                    <?php
                    } else {
                ?>
                        <a href="<?php echo $pasang_iklan_atas['url'];?>" target='_blank'>
                            <img style='width:100%' 
                                    src="<?php echo base_url()."asset/foto_iklanatas/".$pasang_iklan_atas['gambar'];?>" 
                                    alt="<?php echo $pasang_iklan_atas['judul'];?>" 
                            />
                        </a>
                <?php  
                    }
                }

                if (trim($pasang_iklan_atas['source']) != '') { 
                    echo $pasang_iklan_atas['source'];
                }

            ?> 
        </div> 
    <?php } ?>
</div>
<?php
}
?>