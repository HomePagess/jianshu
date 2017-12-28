window.onload=function() {
	var reply_btn=$(".reply_btn");
	reply_btn.click(function() {
		$(this).siblings("form").toggle("slow");
	});
}




