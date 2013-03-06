$(function(){
	$("ul.nav").superfish({
		animation:{
		height: "show",
		width: "show"
		}, speed : 500
	});
		
	//tooltip
	$(".tooltip").easyTooltip();

	// Check all the checkboxes when the head one is selected:
	$('.checkall').click(
		function(){
			$(this).parent().parent().parent().parent().find("input[type='checkbox']").attr('checked', $(this).is(':checked'));   
		}
	);

	$(".close").live("click",
		function () {
			$(this).fadeTo(400, 0, function () { // Links with the class "close" will close parent
				$(this).slideUp(400, function() {
					$(this).remove();
				});
			});
		return false;
		}
	);

	
	//sortable, portlets
	$(".column").sortable({
		connectWith: '.column'
	});
	
	$(".sort").sortable({
		connectWith: '.sort'
	});
	

	$(".portlet").addClass("ui-widget ui-widget-content ui-helper-clearfix ui-corner-all")
	.find(".portlet-header")
	.addClass("ui-widget-header ui-corner-all")
	.prepend('<span class="ui-icon ui-icon-circle-arrow-s"></span>')
	.end()
	.find(".portlet-content");

	$(".portlet-header .ui-icon").click(function() {
		$(this).toggleClass("ui-icon-minusthick");
		$(this).parents(".portlet:first").find(".portlet-content").toggle();
	});

	$(".column").disableSelection();
	
	$("#left_navigation a + ul:not('.current')").hide();
	$("#left_navigation a").click(function() {
		if($(this).next("").length > 0) {
			$(this).next("").slideToggle();
		}
	});
});

function showMessage(type, title, content, autoClose, closeDelay) {
	var notification = '<div style="display:none;" class="message ' + type + ' close"><h2>' + title + '</h2><p>' + content + '</p></div>';
	$("#main").prepend(notification);
	$("#main .message:first").slideDown("normal");
	if(autoClose) {
		setTimeout(function() {
			$("#main .message:last").fadeTo("normal", 0, function() {
				$(this).slideUp("normal", function() {
					$(this).remove();
				});
			});
		}, closeDelay);
	}
}