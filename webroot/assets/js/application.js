
$(".sideNav").pageslide({ direction: "right", modal: true });

$.waypoints.settings.scrollThrottle = 30;
$('body').waypoint(function(event, direction) {
	$('.top').toggleClass('hidden', direction === "up");
}, {
	offset: '-100%'
}).find('.navbarMain').waypoint(function(event, direction) {
	$(this).parent().toggleClass('sticky', direction === "down");
	event.stopPropagation();
});
$(window).load(function() {
  $('.flexslider').flexslider({
    animation: "slide",
    animationLoop: false,
    itemWidth: 270,

  });
});
$('.feedComments').focus(function() {
    $('.CommentPoster').show('fast');
    $(document).bind('focusin.CommentPoster click.CommentPoster',function(e) {
        if ($(e.target).closest('.CommentPoster, .feedComments').length) return;
        $(document).unbind('.CommentPoster');
        $('.CommentPoster').fadeOut('medium');
    });
});
$('.CommentPoster').hide();
