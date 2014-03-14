
oiahoon(function(){
	
    //我的课程
	oiahoon('.progress').live("mouseover",function(){		
		var oLeft = 126+oiahoon(this).find('.progress_c').width()-22;
		oiahoon(this).next().show();	
		oiahoon(this).next().css('left',oLeft);	
	});
    oiahoon('.progress').live("mouseout",function(){		
		oiahoon(this).next().hide();		
	});
	
	//最新更新、排行
	oiahoon('.column_list_t li').mouseover(function(){
	  var index=oiahoon(".column_list_t li").index(this); 
	  oiahoon(".column_list_t li").removeClass("on");
	  oiahoon(this).addClass("on");
	  oiahoon(".column_list_c ul").hide();
	  oiahoon(".column_list_c ul").eq(index).show();
    });
	
	//讲师团队	
	oiahoon('.jstd li').hover(function(){
		var aWrap = oiahoon('.jstd ul');
		var aBox = oiahoon(this).find('.jsinfo'); 
		
		var wrapX = aWrap.offset().left + aWrap.width() + 35;
		var wrapY = aWrap.offset().top + aWrap.height() + 18;		
		var divX = oiahoon(this).offset().left + oiahoon(this).width() + 78; 
		var divY = oiahoon(this).offset().top + oiahoon(this).width() + 127; 
		
		//alert(divX); 
		
		if( divX > wrapX){
			aBox.css({ left: -( divX - wrapX + 20 ) + 'px'});
		};
		if( divY > wrapY ){
			aBox.css({ top: ( wrapY - divY - 15 ) + 'px'});
		};
		
		oiahoon(this).addClass('active');
		oiahoon(this).find('.jsinfo').delay(250).fadeIn(200);
	},function(){
		oiahoon(this).removeClass('active');
		oiahoon(this).find('.jsinfo').stop(true,true).hide(100);
	});
	
	
	//轮播图 
	var idx = 1;
	var obj_li = oiahoon('#lunbo li');
	var obj_hotman = oiahoon('.hotmain');
	var _bg = obj_li.eq(0).attr('bg');
	obj_hotman.css('background-color',_bg);
	
	oiahoon('#slides').slides({
		generateNextPrev: true,
		preload: true,
		preloadImage: 'loading.gif',
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
	oiahoon("#slides").hover(function(){
		
		oiahoon(".hotmain_l .next,.hotmain_l .prev").show();
		},function(){
			
		oiahoon(".hotmain_l .next,.hotmain_l .prev").hide();	
	});
	
	
	//视频滚动
	oiahoon('#videoplay').slides({
		preload: true,
		preloadImage: 'loading.gif',
		play: 5000,
		pause: 2500,
		hoverPause: true,
		pagination: false,
		generatePagination: false,
		animationComplete: function(current){
			oiahoon('.video_group').animate({
				bottom:0
			},200);
		}
	});
	
	
	//热门检索关键字
	oiahoon('.searchBox_l div .text').focus(function(){ 
		oiahoon(this).addClass('gray3');
		var txtValue = oiahoon(this).val(); 
		if(txtValue == this.defaultValue){ 
			oiahoon(this).val(""); 
		} 
	}); 	 
	oiahoon(".searchBox_l div .text").blur(function(){ 
		oiahoon(this).removeClass('gray3'); 
		if(oiahoon(this).val()==''){
			oiahoon(this).val(this.defaultValue);  
		} 
	}); 
		
});


function get_xyd() //课程许愿单
{
	oiahoon.getJSON('http://api.v.umiwi.com/api5/coursewish/?jsonp=?',function(r){
		var xyd_obj =  oiahoon('#course_xyd');
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
