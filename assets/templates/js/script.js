$(document).ready(function() { 
 
    //انتخاب لینک با نام مودال
    $('a[name=member]').click(function(e) {
        //لغو حالت پیش فرض عملکرد لینک
        e.preventDefault();
        //دریافت آیدی عنصر پاپ آپ
        var id = $(this).attr('href');
     
        // دریافت طول و عرض صفحه نمایش
        var bgCoverHeight = $(document).height();
        var bgCoverWidth = $(window).width();
     
        // تنظیم طول و عرض ماسک به اندازه صفحه نمایش
        $('#bgCover').css({'width':bgCoverWidth,'height':bgCoverHeight});
         
        //اعمال افکت نمایش تدریجی بر روی ماسک      
        $('#bgCover').fadeIn(100);   
        $('#bgCover').fadeTo("slow",0.8); 
     
        // دریافت طول و عرض پنجره مرورگر
        var winH = $(window).height();
        var winW = $(window).width();
               
        // تنظیم محل باز شدن پاپ آپ در مرکز صفحه
        $(id).css('top',  winH/2-$(id).height()/1.20);
        $(id).css('left', winW/2-$(id).width()/2);
     
        //اعمال افکت نمایش تدریجی پاپ آپ
        $(id).fadeIn(200);    
    });
     
    //رویداد دکمه بستن پاپ آپ
    $('.window .close').click(function (e) {
        // لغو حالت پیش فرض عملکرد لینک
        e.preventDefault();
        $('#bgCover, .window').hide();
    });    
     
    //بسته شدن پاپ آپ با کلیک روی ماسک اطراف آن
    $('#bgCover').click(function () {
        $(this).hide();
        $('.window').hide();
    });
	
	//Start Gallarey-------------------------------------------------------------------------------------------------------------------
	// Mouseenter Overlay Effect
	$('ul#gallery li').on('mouseenter',function(){
		// Get data attribute values
		var title = $(this).children().data('title');
		var desc = $(this).children().data('desc');

		if(desc == null){
			desc = 'کلیک کنید';
		}

		if(title == null){
			title = '';
		}

		// Create an overlay div
		$(this).append('<div class="overlay"></div>');

		// Get the overlay div
		var overlay = $(this).children('.overlay');

		// Add html to overlay
		overlay.html('<h3>'+title+'</h3><p>'+desc+'</p>');

		// Fade in overlay
		overlay.fadeIn();
	});

	// Mouseleave Overlay Effect
	$('ul#gallery li').on('mouseleave',function(){
		// Create an overlay div
		$(this).append('<div class="overlay"></div>');

		// Get the overlay div
		var overlay = $(this).children('.overlay');

		// Fade out overlay
		overlay.fadeOut();
	});

});