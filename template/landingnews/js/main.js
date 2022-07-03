$(function(){

        $(document).on('click','.btn-responsive',function(el){ 
            el.preventDefault();
            $("body").toggleClass("responsive-menu-hide"); 
        }); 
        
        $(window).on('resize', function(){
            if ( $( this ).width() > 990 ) {
                if( !$("body").hasClass('responsive-menu-hide') ) {
                    $("body").addClass('responsive-menu-hide');
                }
            }
        });

        var toggleMainMenu = function(el , type) {

            if (type === 'menu') {
                // type menu
                var currentMenu = el.currentTarget.parentNode;
                var currentMenuParent = el.currentTarget.parentNode.parentNode;
                $(currentMenuParent).find('ul.sub-menu').each(function(i,el){
                    $(el).fadeOut();
                });

                if($( $(currentMenu).attr('id') ).find('ul.sub-menu')){  
                    var subMenu = $('#'+ $(currentMenu).attr('id') + ' ul.sub-menu');
                    if( subMenu.css('display') === 'none') {
                        subMenu.first().fadeIn();
                    } else {
                        subMenu.first().fadeOut();
                    } 
                }
            } else {
                // type page
                var currentMenu = el.currentTarget.parentNode;
                var currentMenuParent = el.currentTarget.parentNode.parentNode;
                $(currentMenuParent).find('ul').each(function(i,el){
                    $(el).fadeOut();
                });
 
                
                if($( currentMenu ).find('ul.children')){  
                    var currentMenuId = $(currentMenu).attr('class').split(' ').join('.');
                    var subMenu = $( '.' + currentMenuId +' ul.children');
                    if( subMenu.css('display') === 'none') {
                        subMenu.first().fadeIn();
                    } else {
                        subMenu.first().fadeOut();
                    } 
                }
            }
        }
            
        // parent menu
        $(document).on('click','#main-menu > ul > li.menu-item-has-children > a',function(el){
            el.preventDefault();
            toggleMainMenu(el,'menu');
        });

        // sub menu
        $(document).on('click','#main-menu ul.sub-menu > li.menu-item-has-children > a',function(el){
            el.preventDefault(); 
            toggleMainMenu(el,'menu'); 
        }); 
        

        $('body').find('ul.accordion li').each(function(i){
            $(this).attr('id','list-'+ i);
            $(this).find('div.answer').hide();
            $(this).addClass('slide-up');
            $(this).find('div.question').click(function(){
                // all close
                var currentContext = $(this).closest('li');
                $(this).closest('ul.accordion').find('li').each(function(){
                    if( $(this).attr('id') !== currentContext.attr('id')  ){
                        $(this).find('.answer').slideUp();
                        $(this).addClass('slide-up');
                        $(this).removeClass('slide-down'); 
                    }
                });
                
                if(currentContext.hasClass('slide-up')) {
                    currentContext.find('div.answer').slideDown();
                    currentContext.addClass('slide-down');
                    currentContext.removeClass('slide-up');
                }  else {
                    currentContext.find('div.answer').slideUp();
                    currentContext.addClass('slide-up');
                    currentContext.removeClass('slide-down');
                }
            });
        });


        // hash scoll
        var scrolltoOffset = $('.main-menu-container').outerHeight() - 1;
        $(document).on('click', '.main-menu a ', function(e) {
          if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
              
            var target = $(this.hash);
            if (target.length) {
              e.preventDefault(); 
              var scrollto = target.offset().top -  scrolltoOffset;   
              $('html, body').animate({
                scrollTop: scrollto
              }, 1500, 'easeInOutExpo'); 
              window.location.hash = this.hash;
              return false;
            }
          }

        });
       
        // side menu auto close jika di klik (hash menu)
        $(document).on('click','#responsive-menu ul.sidemenu li a',function(e){

            if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
            
              var target = $(this.hash);
              if (target.length) {
                e.preventDefault(); 
                var scrollto = target.offset().top -  scrolltoOffset;   
                $('html, body').animate({
                  scrollTop: scrollto
                }, 1500, 'easeInOutExpo');  
                window.location.hash = this.hash;
                $("body").toggleClass("responsive-menu-hide");  
                return false;
              }
            } 
        }); 


        var actionScroll = function(context) {
            if (context.scrollTop() > 450) { 
                $('#back-to-top').fadeIn('slow');
            } else { 
                $('#back-to-top').fadeOut('slow');
            }
        }

        var actionNavbar = function(context) {
 
            if (context.scrollTop() >= 50) {
                $('.header nav.homepage').addClass('scroll')
              } else {
                $('.header nav.homepage').removeClass('scroll');
              }
        }

        $(document).ready(function() {
          if (window.location.hash) {
            var initial_nav = window.location.hash;
            if ($(initial_nav).length) {
              var scrollto = $(initial_nav).offset().top - scrolltoOffset;
              $('html, body').animate({
                scrollTop: scrollto
              }, 1500, 'easeInOutExpo');
            }
          }

          actionScroll($(this));
          actionNavbar($(this));
          
          // scroll sidemenu
          var getLengthSideMenu = $('#responsive-menu ul.sidemenu').find('li').length;
          var getHeightItem = $('#responsive-menu ul.sidemenu li').height();
          $('#responsive-menu ul.sidemenu').height((getLengthSideMenu * getHeightItem) + 80 );
          /// end
        });

        
         // Back to top button
        $('#back-to-top').click(function(e) {
            e.preventDefault(); 
            $('html, body').animate({
              scrollTop: 0
            }, 1500, 'easeInOutExpo');
            return false;
        });

        $(window).scroll(function() { 
          actionScroll($(this));
          actionNavbar($(this)); 
        });
 
        $(".featured-item").owlCarousel({
            items: 3,
            dots: false,
            autoplay: false,
            margin: 0,
            loop: true,
            smartSpeed: 1200,
            nav: true,
            navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
            responsive: {
                0: {
                    items: 1,
                },
                480: {
                    items: 2,
                },
                768: {
                    items: 3,
                }, 
            }
        });

        $(".breaking-news-slider").owlCarousel({
            loop: true,
            nav: true,
            items: 1,
            dots: false,
            animateOut: 'fadeOut',
            animateIn: 'fadeIn',
            navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
            smartSpeed: 1200,
            autoHeight: false,
            autoplay: true,
            mouseDrag: false
        });

        $(document).on('click','.btn-header-search', function(e){
            e.preventDefault();
            var formSearch = $(this).closest('div.header-main-menu').find('.form-header-search');
            if( formSearch.css('display') === 'none') { 
                formSearch.fadeIn();
            } else { 
                formSearch.fadeOut();
            } 

        });
});