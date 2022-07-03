<div class="container mt-120 ">
		<div class="row">            
            <?php
                // untuk iklan atas   
                if(!empty($this->uri->segment(1)) &&  $this->uri->segment(1) != 'main' ) { 
                    ?>
                    <div class="col-lg-12">
                    <?php
                        include "partials/iklan_atas.php"; 
                    ?>
                    </div>    
                    <?php
                } 
                // 
            ?>
            <div class="col-lg-8">  
                <?php echo $contents; ?> 
            </div>
            <div class="col-lg-4"> 
                <?php include "partials/sidebar.php"; ?>
            </div>
    </div>
</div>