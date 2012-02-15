$(document).ready(function() {
	var items = $("input[type=text],input[type=password],textarea").not("active").get();
	$.each(items, function(index, item){
		item = $(item);
		var default_str = item.val();	
		item.focus(function () {
			var me = $(this);
			me.addClass("active");
			if(me.val() == default_str){
				me.val("");
			}
		});
		item.blur(function () {
			var me = $(this);			
			if(!me.val()){
				me.val(default_str);
				me.removeClass("active");
			}
		});
	});
});