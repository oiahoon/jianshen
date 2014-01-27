/*


*/
var indexcourse2 = {
	newvideo_list:xinyunkeji('.newvideolist'),
	curr:0,
	load:function()
	{
		xinyunkeji.getScript('template/jianshen/images/api.js');
	},
	date_conv:function(d)
	{
		var ds = d.split('-');
		return ds[0]+'年'+ds[1]+'月'+ds[2]+'日';
	},
	date_conv_short:function(d)
	{
		var ds = d.split('-');
		return ds[1]+'月'+ds[2]+'日';
	},
	callback:function(data)
	{

		var days = new Array;
		for (var d in data )
		{
			days.push(d);
		}
		this.data = data;
		this.days = days;
		var today = this.getToday();
		var html ='';
		html+='<a id="newvideoGoLeft" href="javascript:void(0)" class="up"></a>';
		html+='<a id="newvideoGoRight" href="javascript:void(0)" class="down"></a>';
		html+='<span class="date" id="stay_date">03月04日</span>';
		html+='<div class="newvideolist_c">';
		html+='<ul id=newvideolist>';
		//html+='<div class="newvideo_date" style="height:60px;position:static;">';
		//html+='<div id="newvideoGoLeft" class="jcarousel-prev jcarousel-prev-horizontal jcarousel-prev-disabled jcarousel-prev-disabled-horizontal" style="display: block; " disabled="true"></div>';
		//html+='<span class="date_l" id="date_l"></span> ── <span class="date_r" id="date_r"></span>';
		//html+='<div id="newvideoGoRight" class="jcarousel-next jcarousel-next-horizontal" style="display: block; " disabled="false"></div>';
		//html+='</div>';
		//html+='<ul id="newvideolist" class="newvideo_c" style="width:20000px;overflow:hidden;">';
		var li_class;
		for(var d in data)
		{
			if(today==d)
			{
				li_class = 'today';
			}else
			{
				if(today>d)
				{
					li_class = 'future';
				}else{
					li_class = 'past';
				}
			}
			html+="<li id='day"+d+"' date='"+this.date_conv(d)+"' class='"+li_class+"' >";
			html+="<span class=\"video_date\">"+this.date_conv_short(d)+"</span>";
			html+="<dl>";
			for(var i=40;i>0;i-=10)
			{
				if(data[d][i])
				{
					html+="<dt>"+data[d][i].name+"</dt>";
					for(var j in  data[d][i].res)
					{
						if(data[d][i].res[j].url=='')
						{
							html+="<dd>"+data[d][i].res[j].title+"</dd>";
						}else
						{
							html+="<dd><a href='"+data[d][i].res[j].url+"'>"+data[d][i].res[j].title+"</a></dd>";
						}
					}
				}
			}
			html+="</dl>";
			html+="</li>\n";
		}
		html+="</ul>";
		html+='</div>';
		html+='</div>';
		this.newvideo_list.html(html);
		this.init();
	},
	getToday:function(){

		var d = new Date();
		var today_d = d.getDate().toString();
		var today_m = (1+parseInt(d.getMonth())).toString();
		var today_y = d.getFullYear().toString();

		if(today_d.length==1)
		{
			today_d = '0'+today_d;
		}
		if(today_m.length==1)
		{
			today_m = '0'+today_m;
		}
		var today = today_y+'-'+today_m+'-'+today_d;
		return today;
	},
	init:function()
	{
		var gl = xinyunkeji('#newvideoGoLeft');
		var gr = xinyunkeji('#newvideoGoRight');
		var allHeight = new Array;
		var days = this.days;
		var d = new Date();

		var today = this.getToday();

		var init_i = -1;
		for(var i=0;i<days.length ; i++)
		{
			if(days[i] >= today && init_i==-1)
			{
				init_i = i;
			}
		}
		xinyunkeji('#newvideoGoLeft').click(function(){indexcourse2.goL()});
		xinyunkeji('#newvideoGoRight').click(function(){indexcourse2.goR()});
		if(init_i==-1)
		{
			init_i = days.length;
		}
		this.setPos(init_i);
	},
	goL:function()
	{
		if(this.curr<=0)
		{
			return;
		}
		var oldli = this.curr;
		var newli = this.curr-1;
		this.setPos(newli);
	},
	goR:function()
	{

		if(this.curr>=this.days.length-1)
		{
			return;
		}
		var oldli = this.curr;
		var newli = this.curr+1;

		this.setPos(newli);
	},
	setPos:function(pos)
	{

		xinyunkeji('#newvideoGoLeft').remove('on');
		xinyunkeji('#newvideoGoRight').remove('on');
		if(pos<=0)
		{
			pos = 0;
			xinyunkeji('#newvideoGoLeft').removeClass('on');
			xinyunkeji('#newvideoGoLeft').attr('title','');
		}else
		{
			xinyunkeji('#newvideoGoLeft').addClass('on');
			xinyunkeji('#newvideoGoLeft').attr('title',this.date_conv_short(this.days[pos-1]));
		}
		if(pos>=this.days.length-1)
		{
			pos = this.days.length-1;
			xinyunkeji('#newvideoGoRight').removeClass('on');
			xinyunkeji('#newvideoGoRight').attr('title','');
		}else
		{
			xinyunkeji('#newvideoGoRight').addClass('on');
			xinyunkeji('#newvideoGoRight').attr('title',this.date_conv_short(this.days[pos+1]));
		}

		this.curr = pos;
		var w = 0;
		for(i=0;i<pos;i++)
		{
			w-=xinyunkeji('#day'+this.days[i]).height()+170;
		}
		xinyunkeji('#stay_date').html(this.date_conv_short(this.days[i]));


		xinyunkeji('#newvideolist').animate({'margin-top':w});
	}


}
indexcourse2.load();
