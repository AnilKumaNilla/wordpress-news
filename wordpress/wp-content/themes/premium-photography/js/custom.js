jQuery(document).ready(function(e) {
    jQuery('#respond').addClass('col-md-12 comments-blog');
	if(jQuery('.premiumphotography-nav-next').text()=='' || jQuery('.premiumphotography-nav-next').text()==null){
		jQuery('.premiumphotography-nav-next').hide();
	}
	if(jQuery('.premiumphotography-nav-previous').text()=='' || jQuery('.premiumphotography-nav-previous').text()==null){
		jQuery('.premiumphotography-nav-previous').hide();
	}
	jQuery('.logo-text').find('img').each(function(index, element) {
		jQuery('.premiumphotography-menu').css("margin","3% auto");
    });
});