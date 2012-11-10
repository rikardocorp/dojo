$(function(){
	var top = $('.sidebar').offset().top;
	$(window).on('scroll',function(e){
		var y = $(this).scrollTop();
		console.log(y)
		if(top >= y){
			$('.sidebar .container').removeClass('fixed');
			
		}else{
			$('.sidebar .container').addClass('fixed');


		}
	})
})