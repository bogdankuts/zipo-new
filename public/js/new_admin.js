/**
 * Created by BogdanKootz on 04.05.16.
 */
var setCookie = function (name, value, expires, path, domain, secure) { document.cookie = name + "=" + escape(value) +((expires) ? "; expires=" + expires : "") +((path) ? "; path=" + path : "") +((domain) ? "; domain=" + domain : "") +((secure) ? "; secure" : ""); };
var getCookie = function (name) { var cookie = " " + document.cookie; var search = " " + name + "="; var setStr = null; var offset = 0; var end = 0; if (cookie.length > 0) { offset = cookie.indexOf(search); if (offset != -1) { offset += search.length; end = cookie.indexOf(";", offset); if (end == -1) { end = cookie.length; } var setStr = unescape(cookie.substring(offset, end)); } } return(setStr); };


$('#items_more_statistic').on('click', function() {
    $('.articles_more_statistic_block').slideUp();
    $('.items_more_statistic_block').slideDown();
});
$('#articles_more_statistic').on('click', function() {
    $('.items_more_statistic_block').slideUp();
    $('.articles_more_statistic_block').slideDown();
});
$('.list_make_hit').on('change', function() {
    $.post(
	    'admin/toggle_item_hit/'+$(this).data('id'));
});
function countNotifications() {
    var existing = $('.one_notification').filter(function() {
        return $(this).css('display') !== 'none';
    }).length;

	if(existing < 1) {
		$('.notifications').hide();
	}
}
$('.close_notification-admins').on('click', function() {
    $('#newAdmins').hide();
    countNotifications();

});
$('.close_notification-users').on('click', function() {
    $('#newUsers').hide();
    countNotifications();

});
$('.close_notification-clients').on('click', function() {
    $('#newClients').hide();
    countNotifications();

});
$('.close_notification-articles').on('click', function() {
    $('#newArticles').hide();
    countNotifications();

});
$('.close_notification-discount').on('click', function() {
    $('#newDiscount').hide();
    countNotifications();

});
$('.close_notification-orders').on('click', function() {
    $('#newOrders').hide();
    countNotifications();

});

$('.mark_order_done').on('click', function() {
	$.post('/admin/mark-order-as-done/'+$(this).data('id'))
		.done(
			location.reload()
		);
});