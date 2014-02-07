oiahoon(function(){
	
	var _userAgent = window.navigator.userAgent.toLowerCase();
	if(_userAgent.indexOf('android')<0 && _userAgent.indexOf('iphone')<0 &&  _userAgent.indexOf('ipad')<0 )
	{ 
	
	if(oiahoon.cookie("onlineSP")==null||oiahoon.cookie("onlineSP")=="0"||oiahoon.cookie("onlineSP")=="")
		{
			oiahoon('.onlineService').hide();
			oiahoon('.box_os').show();		
		}
		else if(oiahoon.cookie("onlineSP")=="1")
		{
			oiahoon('.onlineService').show();
			oiahoon('.box_os').hide();		
		}
	
	}
	else{
		oiahoon('.onlineService').hide();
		oiahoon('.box_os').hide();
		
	}
	
	oiahoon('.onlineService .ico_os').click(function()
	{		
		oiahoon('.onlineService').hide();
		oiahoon('.box_os').show();
		oiahoon.cookie("onlineSP","0",{expires:1,path:"/",domain:"umiwi.com"});		
	});
	oiahoon('.os_x').click(function()
	{
		oiahoon('.box_os').hide();
		oiahoon('.onlineService').show();
		oiahoon.cookie("onlineSP","1",{expires:2100000000,path:"/",domain:"umiwi.com"});
	});
	oiahoonboxOsFun = function(){var st=oiahoon(document).scrollTop();if (!window.XMLHttpRequest) {oiahoon('.box_os').css('top',st+44);oiahoon('.onlineService').css('top',st+44);}};
	oiahoon(window).bind('scroll', oiahoonboxOsFun);
	oiahoonboxOsFun();
	
	var feedback_url ='http://www.umiwi.com/account/suggestion.php?action=save';
	
	oiahoon('.acbox .ico_pp').hover(function(){
		oiahoon(this).stop().animate({height:'52px'},'fast');
		},function(){
		oiahoon(this).stop().animate({height:'33px'},'fast');
		}
	);
	oiahoon('.acbox .ico_gt').hover(function(){
		oiahoon(this).stop().animate({height:'52px'},'fast');
		},function(){
		oiahoon(this).stop().animate({height:'33px'},'fast');
		}
	);
	
	oiahoon('.onlineService .ico_pp').hover(function(){
		oiahoon(this).stop().animate({width:'87px'},'fast');
		},function(){
		oiahoon(this).stop().animate({width:'39px'},'fast');
		}
	);
	oiahoon('.onlineService .ico_gt').hover(function(){
		oiahoon(this).stop().animate({width:'97px'},'fast');
		},function(){
		oiahoon(this).stop().animate({width:'39px'},'fast');
		}
	);
	
	oiahoon('.ico_gt').click(function(){
		oiahoon("html, body").animate({scrollTop:0}, 1);
	})
	
	
	//分辨率
	if ( oiahoon(window).width()<1200 || screen.width<1200) 
    { 
    	oiahoon('.hydp950,.w_950,.sdmain,.main').css('overflow','hidden');
		oiahoon('.top_bg').css({'overflow':'hidden','width':'950px','margin':'0 auto'});
		oiahoon('.db_bg2').addClass('db_bg2_s');
		oiahoon('.jstd_c .bg_l,.jstd_c .bg_r').css('display','none');
		oiahoon('#js_play .prev').css('left','0');
		oiahoon('#js_play .next').css('right','0');
		oiahoon('#videoplay .prev, #videoplay2 .prev').addClass('prev_s');
		oiahoon('#videoplay .next, #videoplay2 .next').addClass('next_s');
    }else{
    	oiahoon('.hydp950,.w_950,.sdmain,.main').removeAttr('style');
		oiahoon('.top_bg').removeAttr('style');
		oiahoon('.db_bg2').removeClass('db_bg2_s');
		oiahoon('.jstd_c .bg_l,.jstd_c .bg_r').removeAttr('style');
		oiahoon('#js_play .prev').removeAttr('style');
		oiahoon('#js_play .next').removeAttr('style');
		oiahoon('#videoplay .prev, #videoplay2 .prev').removeClass('prev_s');
		oiahoon('#videoplay .next, #videoplay2 .next').removeClass('next_s');
    }

});