xinyunkeji(function(){
	
	var _userAgent = window.navigator.userAgent.toLowerCase();
	if(_userAgent.indexOf('android')<0 && _userAgent.indexOf('iphone')<0 &&  _userAgent.indexOf('ipad')<0 )
	{ 
	
	if(xinyunkeji.cookie("onlineSP")==null||xinyunkeji.cookie("onlineSP")=="0"||xinyunkeji.cookie("onlineSP")=="")
		{
			xinyunkeji('.onlineService').hide();
			xinyunkeji('.box_os').show();		
		}
		else if(xinyunkeji.cookie("onlineSP")=="1")
		{
			xinyunkeji('.onlineService').show();
			xinyunkeji('.box_os').hide();		
		}
	
	}
	else{
		xinyunkeji('.onlineService').hide();
		xinyunkeji('.box_os').hide();
		
	}
	
	xinyunkeji('.onlineService .ico_os').click(function()
	{		
		xinyunkeji('.onlineService').hide();
		xinyunkeji('.box_os').show();
		xinyunkeji.cookie("onlineSP","0",{expires:1,path:"/",domain:"umiwi.com"});		
	});
	xinyunkeji('.os_x').click(function()
	{
		xinyunkeji('.box_os').hide();
		xinyunkeji('.onlineService').show();
		xinyunkeji.cookie("onlineSP","1",{expires:2100000000,path:"/",domain:"umiwi.com"});
	});
	xinyunkejiboxOsFun = function(){var st=xinyunkeji(document).scrollTop();if (!window.XMLHttpRequest) {xinyunkeji('.box_os').css('top',st+44);xinyunkeji('.onlineService').css('top',st+44);}};
	xinyunkeji(window).bind('scroll', xinyunkejiboxOsFun);
	xinyunkejiboxOsFun();
	
	var feedback_url ='http://www.umiwi.com/account/suggestion.php?action=save';
	
	xinyunkeji('.acbox .ico_pp').hover(function(){
		xinyunkeji(this).stop().animate({height:'52px'},'fast');
		},function(){
		xinyunkeji(this).stop().animate({height:'33px'},'fast');
		}
	);
	xinyunkeji('.acbox .ico_gt').hover(function(){
		xinyunkeji(this).stop().animate({height:'52px'},'fast');
		},function(){
		xinyunkeji(this).stop().animate({height:'33px'},'fast');
		}
	);
	
	xinyunkeji('.onlineService .ico_pp').hover(function(){
		xinyunkeji(this).stop().animate({width:'87px'},'fast');
		},function(){
		xinyunkeji(this).stop().animate({width:'39px'},'fast');
		}
	);
	xinyunkeji('.onlineService .ico_gt').hover(function(){
		xinyunkeji(this).stop().animate({width:'97px'},'fast');
		},function(){
		xinyunkeji(this).stop().animate({width:'39px'},'fast');
		}
	);
	
	xinyunkeji('.ico_gt').click(function(){
		xinyunkeji("html, body").animate({scrollTop:0}, 1);
	})
	
	
	//分辨率
	if ( xinyunkeji(window).width()<1200 || screen.width<1200) 
    { 
    	xinyunkeji('.hydp950,.w_950,.sdmain,.main').css('overflow','hidden');
		xinyunkeji('.top_bg').css({'overflow':'hidden','width':'950px','margin':'0 auto'});
		xinyunkeji('.db_bg2').addClass('db_bg2_s');
		xinyunkeji('.jstd_c .bg_l,.jstd_c .bg_r').css('display','none');
		xinyunkeji('#js_play .prev').css('left','0');
		xinyunkeji('#js_play .next').css('right','0');
		xinyunkeji('#videoplay .prev, #videoplay2 .prev').addClass('prev_s');
		xinyunkeji('#videoplay .next, #videoplay2 .next').addClass('next_s');
    }else{
    	xinyunkeji('.hydp950,.w_950,.sdmain,.main').removeAttr('style');
		xinyunkeji('.top_bg').removeAttr('style');
		xinyunkeji('.db_bg2').removeClass('db_bg2_s');
		xinyunkeji('.jstd_c .bg_l,.jstd_c .bg_r').removeAttr('style');
		xinyunkeji('#js_play .prev').removeAttr('style');
		xinyunkeji('#js_play .next').removeAttr('style');
		xinyunkeji('#videoplay .prev, #videoplay2 .prev').removeClass('prev_s');
		xinyunkeji('#videoplay .next, #videoplay2 .next').removeClass('next_s');
    }

});