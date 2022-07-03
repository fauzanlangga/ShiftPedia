<div class="overlay-responsive-menu">
    <div id="responsive-menu" class="responsive-menu">
        <div class="menu-top">
            <a href="#" class="btn-responsive">
                <i class="fa fa-times" aria-hidden="true"></i>
            </a>
        </div>
        <div class="menu-header">
            Main Menu
        </div> 
        <div class="menu-content">
        <?php 
        echo build_nav_menu($menu_utama_id,$menu_utama_id,'sidemenu');  
        ?>	 
        </div>
    </div>  
</div>