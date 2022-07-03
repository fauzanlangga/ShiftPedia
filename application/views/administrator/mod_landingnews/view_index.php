<style>
.tab-container{
      display: flex;
      flex-direction: row;
}
.tab-container .tab-container-navigation{
      width: 225px;
}


.tab-container .tab-container-navigation .nav-tabs {
      display:block;
}

.tab-container .tab-container-content{
      width: 100%;
}
.tab-container .tab-container-content .tab-content{
      min-height: 650px;
}

.nav-tabs .nav-link {
      border: 1px solid #eff2f5;
      background: #f9f9f9;
      color: #a8a8a8;
      margin: 0;
      border-radius:0;
}
.nav-tabs .nav-link.active {      
      border-top: 1px solid #17a2b8;
      border-left: 1px solid #17a2b8;
      border-bottom: 1px solid #17a2b8;
      border-right: 0;
      background: #17a2b8;
      color:#fff;
}

.style-alert-success{
      color: #23923d;
      border-color: #23923d;
      background: #e8f9ec;
}
 
.style-alert-danger{
      color: #dc3545;
      border-color: #dc3545;
      background: #ffe3e5;
}
.tab-content {
      padding: 0 20px 20px 20px;
      border: 1px solid #dee2e6;
}
</style>
<?php

      $this->load->helper('text');
      $get_sections_aktif = isset($get_sections_aktif) ? $get_sections_aktif : array(); 
      // for widget control
      include 'controls/view_widget_control.php';

      // for sections control
      include 'controls/view_sections_control.php';
?>
<div class="card" id="landingnews-panel">
    <div class="card-header bg-secondary">
        <h3 class="card-title py-1">Konfigurasi Template Landingnews</h3>
    </div> 
        <div class="card-body">
            <?php      
            if($this->session->flashdata('alert')!=null) {?>
                  <div id="landingnews-alert" class="alert style-alert-success alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                              <span class="sr-only">Close</span>
                        </button>
                       <?php echo $this->session->flashdata('alert');?>
                  </div>
            <?php
            }
            ?>
            <div class="tab-container">
               <div class="tab-container-navigation">                        
                        <ul class="nav nav-tabs"role="tablist"> 
                              <li class="nav-item">
                              <a class="nav-link active" id="content_home_tab" data-toggle="pill" href="#content_home" role="tab"
                                    aria-controls="content-home" aria-selected="true">Home</a>
                              </li>
                              <li class="nav-item">
                                    <a class="nav-link " id="content_lokasi_menu_tab" data-toggle="pill" href="#content_lokasi_menu" role="tab"
                                    aria-controls="content" aria-selected="false">Setting Menu</a>
                              </li>  
                              <li class="nav-item">
                                    <a class="nav-link " id="content_setting_sections_tab" data-toggle="pill" href="#content_setting_sections" role="tab"
                                    aria-controls="content" aria-selected="false">Setting Homepage</a>
                              </li> 
                              <li class="nav-item">
                                    <a class="nav-link " id="content_setting_sidebar_tab" data-toggle="pill" href="#content_setting_sidebar" role="tab"
                                    aria-controls="content" aria-selected="false">Setting Sidebar</a>
                              </li> 
                              <li class="nav-item">
                                    <a class="nav-link " id="content_setting_footer_tab" data-toggle="pill" href="#content_setting_footer" role="tab"
                                    aria-controls="content" aria-selected="false">Setting Footer</a>
                              </li>  
                        </ul>   
                  </div>
                  <div class="tab-container-content">
                        <div class="tab-content">
                        <div class="tab-pane fade show active" id="content_home">  
                              <?php include 'view_tab_home.php';?>
                        </div> 
                        <div class="tab-pane fade" id="content_lokasi_menu">  
                              <?php include 'view_tab_menu.php';?>
                        </div> 
                        <div class="tab-pane fade" id="content_setting_sidebar">  
                              <?php include 'view_tab_setting_sidebar.php';?>
                        </div> 
                        <div class="tab-pane fade" id="content_setting_footer">  
                              <?php include 'view_tab_setting_footer.php';?>
                        </div> 
                        <div class="tab-pane fade" id="content_setting_sections">  
                              <?php include 'view_tab_setting_sections.php';?>
                        </div>   

                  </div>
            </div>
        </div>
    </div>
</div>

<script>

$(function(){  
      if (window.location.hash) {
        var initial_nav = window.location.hash; 

        // deactive tabs
        if($('#landingnews-panel .nav-tabs').find('a.nav-link').hasClass('active')){
            $('#landingnews-panel .nav-tabs').find('a.nav-link').removeClass('active');
            $('#landingnews-panel .nav-tabs').find('a.nav-link').removeClass('show'); 
        }
        
        if($('#landingnews-panel .tab-content').find('.tab-pane').hasClass('active')){ 
            $('#landingnews-panel .tab-content').find('.tab-pane').removeClass('active');
            $('#landingnews-panel .tab-content').find('.tab-pane').removeClass('show');
        }

        // active tab
        $('#landingnews-panel .nav-tabs .nav-link'+initial_nav+'_tab').addClass('active');
        $('#landingnews-panel .nav-tabs .nav-link'+initial_nav+'_tab').addClass('show');
        $('#landingnews-panel .tab-content .tab-pane'+initial_nav).addClass('active');
        $('#landingnews-panel .tab-content .tab-pane'+initial_nav).addClass('show'); 

        // side menu, reopen menu 
        $('body div.sidebar ul').find('li.module-landingnews').addClass('menu-open');
        $('body div.sidebar ul').find('li.landingnews').addClass('menu-open');
        $('body div.sidebar ul').find('li.landingnews a').addClass('active');
      } 

      
        // auto remove / hide alert message
        if( $(document).find('#landingnews-alert.alert')) {
            $('#landingnews-alert.alert').fadeOut(3000,function(){
                //remove it 
                $('#landingnews-alert.alert').remove();
            }); 
        } 
      
});
</script>