cleanto_holder=document.getElementById('cleanto');
var sites_urls=document.getElementById('cleanto').getAttribute('data-url');

cleanto_holder.innerHTML='<object id="cleanto_content" style="width:100%; height:101%;" type="text/html" data="'+sites_urls+'" onload="cleantodivload()" ></object>';
var normal_height = 2000;

function cleantodivload(){
	setInterval(function() {
		var new_page_height = jQuery('#cleanto object').contents().find('.ct-main-wrapper').height()+50;
		if(new_page_height < normal_height){
			jQuery('#cleanto').height(normal_height);
		}else{
			jQuery('#cleanto').height(new_page_height);
		}
	}, 500);
	
	jQuery('#cleanto object').contents().find('.scroll_top_complete').click(function(e){
		jQuery('html, body').animate({scrollTop: 0 }, 1000);
	});
	
	jQuery('#cleanto object').contents().find('.ct-service-embed').click(function(e){
	  jQuery('html, body').stop().animate({'scrollTop': jQuery('#cleanto object').contents().find('.ct-scroll-meth-unit').offset().top}, 800, 'swing', function () {});
	});
}