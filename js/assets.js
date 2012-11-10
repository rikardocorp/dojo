
$(window).on('load',function(){
	var top = $('nav').offset().top;

	$(window).on('scroll',function(e){
		var y = $(this).scrollTop();
		console.log(y)
		if(top >= y){
			$('nav , .sidebar .container').removeClass('fixed');
			
		}else{
			$('nav , .sidebar .container').addClass('fixed');


		}
	})
})