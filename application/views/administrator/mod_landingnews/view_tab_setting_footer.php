<style>
#setting-footer ol.list-setting-footer{
    list-style:none;    
    margin: 0;
    padding: 0;
}


#setting-footer li.item-setting-footer {
    line-height:20px;
}
#setting-footer li.item-setting-footer .card ,
#setting-footer li.item-setting-footer.dd-item .card {
    margin-bottom: 10px;
}


#setting-footer li.item-setting-footer .card .card-header .card-title,
#setting-footer li.item-setting-footer.dd-item .card .card-header .card-title{
    font-size:15px; 
}

.dd-dragel >  li.item-setting-footer.dd-item .card .card-header,
.dd-dragel >  li.item-setting-footer.dd-item .card,
#setting-footer ol.list-setting-footer li .card .card-header,
#setting-footer ol.list-setting-footer li .card{
    border-radius:0;
}
 
.dd-dragel >  li.item-setting-footer.dd-item .dd-handle { 
    margin:0; 
    border-radius: 0;   
    height:100%; 
}

#setting-footer ol.list-setting-footer li .dd-handle{
    margin: 0; 
    border-radius: 0; 
    height: auto;
    cursor: move;
    padding: 5px;
    font-weight: normal;
}

.dd-dragel >  li.item-setting-footer.dd-item .dd-handle ,
#setting-footer ol.list-setting-footer li.dd-item .dd-handle{
    float: left;
    padding: 10px;
    font-size: 15px;
    line-height: 1.5em; 
}

#setting-footer .widget-active .card-body .title-active {
    margin-bottom: 10px;
    border-bottom: 1px solid #17a2b8;
    color: #17a2b8;
    font-size: 20px;
}

#setting-footer .widget-available .card-body .title-available {
    margin-bottom: 10px;
    border-bottom: 1px solid #343a40;
    color: #343a40;
    font-size: 20px;
}  

#setting-footer .dd-empty{
    background: none; 
    height: 45px;
    padding: 0;
    margin: 0;
    min-height: 45px;
}

</style>
    <?php    
     
     $get_menu_dropdown = isset($get_menu_dropdown) ? $get_menu_dropdown : array();  
     $get_iklan_sidebar_dropdown = isset($get_iklan_sidebar_dropdown) ? $get_iklan_sidebar_dropdown : array();
     $get_playlist_dropdown = isset($get_playlist_dropdown) ? $get_playlist_dropdown : array();  
     $get_album_dropdown = isset($get_album_dropdown) ? $get_album_dropdown : array();  
     $get_iklan_link_list = isset($get_iklan_link_list) ? $get_iklan_link_list : array();

     $group_setting_footer = array(
        1 => (isset($get_setting_footer_1) ? $get_setting_footer_1 : array()),
        2 => (isset($get_setting_footer_2) ? $get_setting_footer_2 : array()),
        3 => (isset($get_setting_footer_3) ? $get_setting_footer_3 : array()),
        4 => (isset($get_setting_footer_4) ? $get_setting_footer_4 : array()),
     );
    ?>
    <div class="card mt-4" style="min-height:450px" id="setting-footer">
        <div class="card-header bg-info">
            <h3 class="card-title py-1">
               Setting Footer  
            </h3>
        </div>
        <div class="card-body">    
            <div class="row">            
                <div class="col-md-5 " >
                    <div class="card widget-available">
                        <div class="card-body">
                            <div class="title-available">
                                Widget Tersedia
                            </div>
                            <div>
                                <ol class="list-setting-footer">
                                    <?php if ($widget) {?>
                                        <?php
                                        $wi = 0;
                                        foreach($widget as $widget_key => $widget_name) { 
                                        ?>

                                        <li class="item-setting-footer"> 
                                            <div class="card ">
                                                <div class="card-header ">
                                                    <div class="card-tools"> 
                                                        <div class="btn-group" role="group">
                                                            <button id="dropdownId" type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                                                                    aria-expanded="false"> <i class="fas fa-plus-circle"></i> Tambahkan
                                                            </button>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownId">
                                                                <a class="setting-footer-widget-add dropdown-item"  
                                                                    data-id="<?php echo $widget_key;?>"
                                                                    data-name="<?php echo $widget_name;?>"
                                                                    data-target="1"
                                                                    href="#">Footer 1</a>
                                                                <div class="dropdown-divider"></div>
                                                                <a class="setting-footer-widget-add dropdown-item"  
                                                                    data-id="<?php echo $widget_key;?>"
                                                                    data-name="<?php echo $widget_name;?>"
                                                                    data-target="2"
                                                                    href="#">Footer 2</a>
                                                                <div class="dropdown-divider"></div>
                                                                <a class="setting-footer-widget-add dropdown-item"  
                                                                    data-id="<?php echo $widget_key;?>"
                                                                    data-name="<?php echo $widget_name;?>"
                                                                    data-target="3"
                                                                    href="#">Footer 3</a>
                                                                <div class="dropdown-divider"></div>
                                                                <a class="setting-footer-widget-add dropdown-item"  
                                                                    data-id="<?php echo $widget_key;?>"
                                                                    data-name="<?php echo $widget_name;?>"
                                                                    data-target="4"
                                                                    href="#">Footer 4</a>
                                                            </div>
                                                        </div> 
                                                    </div>
                                                    <div class="card-title">
                                                        <?php echo $widget_name; ?>
                                                    </div>
                                                </div>
                                                <div class="card-body form-template d-none">
                                                    <?php  
                                                    switch ($widget_key) {
                                                        case 'widget_video':
                                                            landingnews_control_widget_video($wi,$widget_key,array(),$get_playlist_dropdown,'setting_footer');
                                                            break;
                                                        case 'widget_gallery':
                                                            landingnews_control_widget_gallery($wi,$widget_key,array(),$get_album_dropdown,'setting_footer');
                                                            break;
                                                        case 'widget_iklan_sidebar':
                                                            landingnews_control_iklan_sidebar($wi,$widget_key,array(),$get_iklan_sidebar_dropdown,'setting_footer');
                                                            break;
                                                        case 'widget_iklan_link':
                                                            landingnews_control_iklan_link($i,$id,array(),$get_iklan_link_list,'setting_footer');
                                                            break;
                                                        case 'widget_menu':
                                                            landingnews_control_widget_menu($wi,$widget_key,array(),$get_menu_dropdown,'setting_footer');
                                                            break; 
                                                        default:
                                                            landingnews_control_widget($wi,$widget_key,array(),'setting_footer');
                                                            break;
                                                    } 
                                                    ?> 
                                                </div>
                                            </div>
                                        </li> 
                                    <?php 
                                        $wi++;
                                        }
                                    }
                                    ?>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7" > 
                    <div class="card widget-active"> 
                    <?php echo form_open($this->uri->segment(1)."/landingnews",array( 'class'=> ' form-horizontal' )) ;?>
                        <div class="card-body"> 
                            <div class="row">
                                <?php foreach( $group_setting_footer as $footer_i => $get_setting_footer){?>    
                                <div class="col-md-12"  > 
                                    <div class="title-active">
                                       Footer #<?php echo $footer_i;?>
                                    </div>
                                    <div class="dd-<?php echo $footer_i;?>"  id="setting-footer-active-<?php echo $footer_i;?>">
                                        <ol class="dd-list list-setting-footer">
                                            <?php if ($get_setting_footer) {?>
                                                <?php foreach($get_setting_footer as $i => $widget_active) { 
                                                    $id = key($widget_active); 
                                                ?>

                                                <li class="item-setting-footer dd-item" data-id="<?php echo $id;?>">
                                                    <div class="dd-handle">
                                                        <i class="fa fa-arrows-alt"></i>
                                                    </div>
                                                    <div class="card collapsed-card">
                                                        <div class="card-header bg-info">
                                                            <div class="card-title">
                                                                <?php if(!empty($widget_active[$id]['judul'])) { ?> 
                                                                    <?php echo $widget[$id] .' : "'.word_limiter($widget_active[$id]['judul'],2).'"';?>
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <?php echo $widget[$id]; ?>
                                                                <?php
                                                                }
                                                                ?>
                                                            </div>
                                                            <div class="card-tools">
                                                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                                    <i class="fas fa-plus"></i>
                                                                </button>
                                                                <button 
                                                                    data-target="<?php echo $footer_i;?>" 
                                                                    type="button" 
                                                                    class="setting-footer-widget-remove btn btn-tool">
                                                                    <i class="fas fa-trash-alt"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="card-body">
                                                            <?php  
                                                            $param_name = 'setting_footer_' .$footer_i;
                                                            switch ($id) {
                                                                case 'widget_video':
                                                                    landingnews_control_widget_video($i,$id,$get_setting_footer,$get_album_dropdown, $param_name);
                                                                    break;
                                                                case 'widget_gallery':
                                                                    landingnews_control_widget_gallery($i,$id,$get_setting_footer,$get_album_dropdown, $param_name);
                                                                    break;
                                                                case 'widget_iklan_sidebar':
                                                                    landingnews_control_iklan_sidebar($i,$id,$get_setting_footer,$get_iklan_sidebar_dropdown, $param_name);
                                                                    break;
                                                                case 'widget_iklan_link':
                                                                    landingnews_control_iklan_link($i,$id,$get_setting_footer,$get_iklan_link_list, $param_name);
                                                                    break;
                                                                case 'widget_menu': 
                                                                    landingnews_control_widget_menu($i,$id,$get_setting_footer,$get_menu_dropdown, $param_name);
                                                                    break; 
                                                                default:
                                                                    landingnews_control_widget($i,$id,$get_setting_footer, $param_name);
                                                                    break;
                                                            }   
                                                            ?>
                                                        </div>
                                                    </div>
                                                </li> 
                                            <?php 
                                                }
                                            }
                                            ?>
                                        </ol>
                                    </div>
                                </div>  
                                <?php } ?>
                            </div>
                        </div>
                        <div class="card-footer"> 
                            <button class="btn btn-info" type="submit" name="set_group_setting_footer">Update</button>
                        </div>
                    <?php echo form_close();?> 
                    </div>                    
                </div>
            </div>
        </div>
    </div>
    <div class="callout callout-info">
        <h5>Info</h5>
        <ul>
            <li>Untuk menampilkan Widget pada footer, klik tombol "Tambahkan" dan pilih posisi yang dikehendaki</li>
            <li>Klik tombol "Update" untuk simpan konfigurasi</li>
        </ul>
    </div>
<script>
$(function(){
    // untuk sortlable nested footer  
    $('#setting-footer-active-1').nestable({ 
            rootClass : 'dd-1',
            group: 'footer-1',
            maxDepth: 1
        }).on('change',function(e){
            reIndexListFooter('1');
        });

    $('#setting-footer-active-2').nestable({
            rootClass : 'dd-2',
            group: 'footer-2',
            maxDepth: 1
        }).on('change',function(e){
            reIndexListFooter('2');
        });

    $('#setting-footer-active-3').nestable({ 
            rootClass : 'dd-3',
            group: 'footer-3',
            maxDepth: 1
        }).on('change',function(e){
            reIndexListFooter('3');
        });

    $('#setting-footer-active-4').nestable({
            rootClass : 'dd-4',
            group: 'footer-4',
            maxDepth: 1
        }).on('change',function(e){
            reIndexListFooter('4');
        });

    $(document).on('click','.setting-footer-widget-add',function(e){
        e.preventDefault();
        var widgetKey = $(this).data('id');
        var widgetName = $(this).data('name');
        var targetIndexId = $(this).data('target');

        var itemContext = $(this).closest('li.item-setting-footer');
        var widgetFormElement = $('.form-template',itemContext).html();

        var createElementList = '<li class="item-setting-footer dd-item" data-id="'+ widgetKey +'">'+
                '<div class="dd-handle">'+
                    '<i class="fa fa-arrows-alt"></i>'+
                '</div>'+
                '<div class="card collapsed-card">'+
                    '<div class="card-header  bg-info">'+
                        '<div class="card-title">'+
                            widgetName +
                        '</div>'+
                        '<div class="card-tools">'+
                            '<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>'+
                            '<button data-target="'+ targetIndexId +'" type="button" class="setting-footer-widget-remove btn btn-tool">'+
                                '<i class="fas fa-trash-alt"></i>'+
                            '</button>' +
                        '</div>'+
                    '</div>'+
                    '<div class="card-body">'+
                        widgetFormElement +
                    '</div>'+
                '</div>'+
            '</li>';
        $('#setting-footer-active-'+targetIndexId+' .list-setting-footer').append(createElementList);        
        reIndexListFooter(targetIndexId);
    });

    $(document).on('click','.setting-footer-widget-remove',function(e){
        e.preventDefault();
        $(this).closest('li.item-setting-footer').remove();
        var targetIndexId = $(this).data('target');
        reIndexListFooter(targetIndexId);
    });

    var reIndexListFooter = function(targetIndexId){
        // reindex element
        $('#setting-footer-active-'+targetIndexId+' .list-setting-footer').find('li.item-setting-footer').each(function(i){
            var indexElement = i;
            var listContext = $(this);
            var widgetKey = $(this).data('id');
            $('.form-group' , listContext).find('input,select,textarea').each(function(){
                if( $(this).data('multiple') === 'Y') {
                    $(this).attr('name','setting_footer_'+targetIndexId+'['+indexElement+']['+  widgetKey +']['+ $(this).data('name') +'][]');
                } else {
                    $(this).attr('name','setting_footer_'+targetIndexId+'['+indexElement+']['+  widgetKey +']['+ $(this).data('name') +']');
                }
            });

        });
    }
 

});
</script>