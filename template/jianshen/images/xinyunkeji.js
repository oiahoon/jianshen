
xinyunkeji(function(){
	
    //我的课程
	xinyunkeji('.progress').live("mouseover",function(){		
		var oLeft = 126+xinyunkeji(this).find('.progress_c').width()-22;
		xinyunkeji(this).next().show();	
		xinyunkeji(this).next().css('left',oLeft);	
	});
    xinyunkeji('.progress').live("mouseout",function(){		
		xinyunkeji(this).next().hide();		
	});
	
	//最新更新、排行
	xinyunkeji('.column_list_t li').mouseover(function(){
	  var index=xinyunkeji(".column_list_t li").index(this); 
	  xinyunkeji(".column_list_t li").removeClass("on");
	  xinyunkeji(this).addClass("on");
	  xinyunkeji(".column_list_c ul").hide();
	  xinyunkeji(".column_list_c ul").eq(index).show();
    });
	
	//讲师团队	
	xinyunkeji('.jstd li').hover(function(){
		var aWrap = xinyunkeji('.jstd ul');
		var aBox = xinyunkeji(this).find('.jsinfo'); 
		
		var wrapX = aWrap.offset().left + aWrap.width() + 35;
		var wrapY = aWrap.offset().top + aWrap.height() + 18;		
		var divX = xinyunkeji(this).offset().left + xinyunkeji(this).width() + 78; 
		var divY = xinyunkeji(this).offset().top + xinyunkeji(this).width() + 127; 
		
		//alert(divX); 
		
		if( divX > wrapX){
			aBox.css({ left: -( divX - wrapX + 20 ) + 'px'});
		};
		if( divY > wrapY ){
			aBox.css({ top: ( wrapY - divY - 15 ) + 'px'});
		};
		
		xinyunkeji(this).addClass('active');
		xinyunkeji(this).find('.jsinfo').delay(250).fadeIn(200);
	},function(){
		xinyunkeji(this).removeClass('active');
		xinyunkeji(this).find('.jsinfo').stop(true,true).hide(100);
	});
	
	
	//轮播图 
	var idx = 1;
	var obj_li = xinyunkeji('#lunbo li');
	var obj_hotman = xinyunkeji('.hotmain');
	var _bg = obj_li.eq(0).attr('bg');
	obj_hotman.css('background-color',_bg);
	
	xinyunkeji('#slides').slides({
		generateNextPrev: true,
		preload: true,
		preloadImage: 'http://i3.umivi.net/u/2012/index/images/loading.gif',
		effect:'fade',
		crossfade: true,
		play: 4000,
		slideSpeed: 0,
		fadeSpeed: 0,
		pause: 2500,
		hoverPause: true,
		animationStart: function(){
		},
		animationComplete: function(current){
			var _bg = obj_li.eq(current-1).attr('bg');			
			obj_hotman.css('background', _bg);
			idx=current;
		}
	});
	xinyunkeji("#slides").hover(function(){
		
		xinyunkeji(".hotmain_l .next,.hotmain_l .prev").show();
		},function(){
			
		xinyunkeji(".hotmain_l .next,.hotmain_l .prev").hide();	
	});
	
	
	//视频滚动
	xinyunkeji('#videoplay').slides({
		preload: true,
		preloadImage: 'http://i3.umivi.net/u/2012/index/images/loading.gif',
		play: 5000,
		pause: 2500,
		hoverPause: true,
		pagination: false,
		generatePagination: false,
		animationComplete: function(current){
			xinyunkeji('.video_group').animate({
				bottom:0
			},200);
		}
	});
	
	
	//热门检索关键字
	xinyunkeji('.searchBox_l div .text').focus(function(){ 
		xinyunkeji(this).addClass('gray3');
		var txtValue = xinyunkeji(this).val(); 
		if(txtValue == this.defaultValue){ 
			xinyunkeji(this).val(""); 
		} 
	}); 	 
	xinyunkeji(".searchBox_l div .text").blur(function(){ 
		xinyunkeji(this).removeClass('gray3'); 
		if(xinyunkeji(this).val()==''){
			xinyunkeji(this).val(this.defaultValue);  
		} 
	}); 
		
});


function get_xyd() //课程许愿单
{
	xinyunkeji.getJSON('http://api.v.umiwi.com/api5/coursewish/?jsonp=?',function(r){
		var xyd_obj =  xinyunkeji('#course_xyd');
		var total = r.length;
		var htmlxyd = '';

		for (i=0;i<total;i++)
		{
			htmlxyd +='<li><h3>';
			if (r[i].tutorurl)
			{
				htmlxyd +='<a href="'+r[i].tutorurl+'" target="_blank">'+r[i].tutorname+'</a>学习';
			}
			else
			{
				htmlxyd +='<strong>'+r[i].tutorname+'</strong>学习';
			}
			if (r[i].titleurl)
			{
				htmlxyd +='<a href="'+r[i].titleurl+'" target="_blank">'+r[i].title+'</a>';
			}
			else
			{
				htmlxyd +='<strong>'+r[i].title+'</strong>';
			}
			htmlxyd +='<div class="time"><span>'+r[i].username+'发起</span>'+r[i].daynum+' 天前</div>';
			htmlxyd +='<div class="study"><a href="'+r[i].titleurl+'" target="_blank">想学</a><span id="course_'+r[i].id+'"</span>'+r[i].num+'人想学</div>';
			if (i != total -1)
			{
				htmlxyd +='<div class="line"></div>';
			}
			htmlxyd +='</li>';
		}
		xyd_obj.html(htmlxyd);
	});
}
