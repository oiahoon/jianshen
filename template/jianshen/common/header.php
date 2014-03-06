<?php echo 'Oiahoon www.oiahoon.com';exit;?>
<!--{subtemplate common/header_common}-->
  <meta name="application-name" content="$_G['setting']['bbname']" />
  <meta name="msapplication-tooltip" content="$_G['setting']['bbname']" />
  <!--{if $_G['setting']['portalstatus']}--><meta name="msapplication-task" content="name=$_G['setting']['navs'][1]['navname'];action-uri={echo !empty($_G['setting']['domain']['app']['portal']) ? 'http://'.$_G['setting']['domain']['app']['portal'] : $_G[siteurl].'portal.php'};icon-uri={$_G[siteurl]}{IMGDIR}/portal.ico" /><!--{/if}-->
  <meta name="msapplication-task" content="name=$_G['setting']['navs'][2]['navname'];action-uri={echo !empty($_G['setting']['domain']['app']['forum']) ? 'http://'.$_G['setting']['domain']['app']['forum'] : $_G[siteurl].'forum.php'};icon-uri={$_G[siteurl]}{IMGDIR}/bbs.ico" />
  <!--{if $_G['setting']['groupstatus']}--><meta name="msapplication-task" content="name=$_G['setting']['navs'][3]['navname'];action-uri={echo !empty($_G['setting']['domain']['app']['group']) ? 'http://'.$_G['setting']['domain']['app']['group'] : $_G[siteurl].'group.php'};icon-uri={$_G[siteurl]}{IMGDIR}/group.ico" /><!--{/if}-->
  <!--{if helper_access::check_module('feed')}--><meta name="msapplication-task" content="name=$_G['setting']['navs'][4]['navname'];action-uri={echo !empty($_G['setting']['domain']['app']['home']) ? 'http://'.$_G['setting']['domain']['app']['home'] : $_G[siteurl].'home.php'};icon-uri={$_G[siteurl]}{IMGDIR}/home.ico" /><!--{/if}-->
  <!--{if $_G['basescript'] == 'forum' && $_G['setting']['archiver']}-->
    <link rel="archives" title="$_G['setting']['bbname']" href="{$_G[siteurl]}archiver/" />
  <!--{/if}-->
  <!--{if !empty($rsshead)}-->$rsshead<!--{/if}-->
  <!--{if widthauto()}-->
    <link rel="stylesheet" id="css_widthauto" type="text/css" href="data/cache/style_{STYLEID}_widthauto.css?{VERHASH}" />
    <script type="text/javascript">HTMLNODE.className += ' widthauto'</script>
  <!--{/if}-->
  <!--{if $_G['basescript'] == 'forum' || $_G['basescript'] == 'group'}-->
    <script type="text/javascript" src="{$_G[setting][jspath]}forum.js?{VERHASH}"></script>
  <!--{elseif $_G['basescript'] == 'home' || $_G['basescript'] == 'userapp'}-->
    <script type="text/javascript" src="{$_G[setting][jspath]}home.js?{VERHASH}"></script>
  <!--{elseif $_G['basescript'] == 'portal'}-->
    <script type="text/javascript" src="{$_G[setting][jspath]}portal.js?{VERHASH}"></script>
  <!--{/if}-->
  <!--{if $_G['basescript'] != 'portal' && $_GET['diy'] == 'yes' && check_diy_perm($topic)}-->
    <script type="text/javascript" src="{$_G[setting][jspath]}portal.js?{VERHASH}"></script>
  <!--{/if}-->
  <!--{if $_GET['diy'] == 'yes' && check_diy_perm($topic)}-->
  <link rel="stylesheet" type="text/css" id="diy_common" href="data/cache/style_{STYLEID}_css_diy.css?{VERHASH}" />
  <!--{/if}-->
 <script type="text/javascript" src="template/jianshen/images/jquery.min.js" ></script>
<script type="text/javascript">
  oiahoon = jQuery.noConflict();
//以后jquery中的$都用 Oiahoon 代替即可。
oiahoon(function(){});
</script>
<SCRIPT language=javascript>
<!--
window.onerror=function(){return true;}
// -->
</SCRIPT> 
<script type="text/javascript">
  oiahoon(function(){
      oiahoon("div.navbox div.nav a").wrapInner("<span></span>");
     // oiahoon("div.navbox div.nav a[hidefocus=true]").addClass("on");
     oiahoon("a.nav_sec:even").css({"color":"#fdd000","background":"url(template/jianshen/images/ico2.jpg) no-repeat 7px"});
     oiahoon("a.nav_sec:odd").css({"color":"#b4b528","background":"url(template/jianshen/images/ico3.jpg) no-repeat 7px"});
    /* banner */
    var n=0;
    oiahoon("div.num a").eq(0).addClass("on");
      
   setInterval(function(){
       oiahoon("div.banner div.num a").removeClass("on"); 
       if(n==3){
          n=0;
          oiahoon(".middle_img_box").css("position","absolute").animate({"left":"0px"},900);
          oiahoon("div.num a").eq(0).addClass("on");
          } 
       else{ n++;
      oiahoon(".middle_img_box").css("position","absolute").animate({"left":-641*n+"px"},900);
      oiahoon("div.num a").eq(n).addClass("on");
           }
        
      },5000); 

    
     
  oiahoon("div.banner div.num a").bind("click",function(){
      oiahoon(".middle_img_box").stop();
      n=oiahoon(this).index();
      oiahoon("div.banner div.num a").removeClass("on");
      oiahoon(this).addClass("on");
      oiahoon(".middle_img_box").css("position","absolute").animate({"left":-641*n+"px"},900)
     
     

    });
     
     oiahoon("div.banner a.rbt").bind("click",function(){
      oiahoon(".middle_img_box").stop();
      n=oiahoon("div.banner div.num a.on").index();
      oiahoon("div.banner div.num a").removeClass("on"); 
      if(n==3){     
          n=0;
          oiahoon(".middle_img_box").css("position","absolute").animate({"left":-641*n+"px"},900);
          oiahoon("div.num a").eq(n).addClass("on");
          } 
       else{ n++;
      oiahoon(".middle_img_box").css("position","absolute").animate({"left":-641*n+"px"},900);
      oiahoon("div.num a").eq(n).addClass("on");
           } 
      
     
     });
     
     oiahoon("div.banner a.lbt").bind("click",function(){
     oiahoon(".middle_img_box").stop();
      n=oiahoon("div.banner div.num a.on").index();
      oiahoon("div.banner div.num a").removeClass("on");
      if(n==0){ n=3 ;
      oiahoon(".middle_img_box").css("position","absolute").animate({"left":-641*n+"px"},900);
      oiahoon("div.num a").eq(n).addClass("on");
          } 
       else{ n--;
      oiahoon(".middle_img_box").css("position","absolute").animate({"left":-641*n+"px"},900);
      oiahoon("div.num a").eq(n).addClass("on");
           } 
      
     
     });
    /* banner end*/
    }) 
</script>
 <!--[if IE 6]>
<script src="template/jianshen/images/iepng.js" type="text/javascript"></script> 
<script type="text/javascript">
   EvPNG.fix('div, ul, img, li, input');  
</script>
<![endif]-->

<!--{if empty($_G['forum']['picstyle']) || $_G['cookie']['forumdefstyle']}-->
<!--{else}-->
<style>

</style>
<!--{/if}-->
</head>

<body id="nv_{$_G[basescript]}" class="pg_{CURMODULE}{if $_G['basescript'] === 'portal' && CURMODULE === 'list' && !empty($cat)} {$cat['bodycss']}{/if}" onkeydown="if(event.keyCode==27) return false;">
  <div id="append_parent"></div><div id="ajaxwaitid"></div>
  <!--{if $_GET['diy'] == 'yes' && check_diy_perm($topic)}-->
    <!--{template common/header_diy}-->
  <!--{/if}-->
  <!--{if check_diy_perm($topic)}-->
    <!--{template common/header_diynav}-->
  <!--{/if}-->
  <!--{if CURMODULE == 'topic' && $topic && empty($topic['useheader']) && check_diy_perm($topic)}-->
    $diynav
  <!--{/if}-->
  <!--{if empty($topic) || $topic['useheader']}-->
    <!--{if $_G['setting']['mobile']['allowmobile'] && (!$_G['setting']['cacheindexlife'] && !$_G['setting']['cachethreadon'] || $_G['uid']) && ($_GET['diy'] != 'yes' || !$_GET['inajax']) && ($_G['mobile'] != '' && $_G['cookie']['mobile'] == '' && $_GET['mobile'] != 'no')}-->
      <div class="xi1 bm bm_c">
          {lang your_mobile_browser}<a href="{$_G['siteurl']}forum.php?mobile=yes">{lang go_to_mobile}</a> <span class="xg1">|</span> <a href="$_G['setting']['mobile']['nomobileurl']">{lang to_be_continue}</a>
      </div>
    <!--{/if}-->
    <!--{if $_G['setting']['shortcut'] && $_G['member'][credits] >= $_G['setting']['shortcut']}-->
      <div id="shortcut">
        <span><a href="javascript:;" id="shortcutcloseid" title="{lang close}">{lang close}</a></span>
        {lang shortcut_notice}
        <a href="javascript:;" id="shortcuttip">{lang shortcut_add}</a>

      </div>
      <script type="text/javascript">setTimeout(setShortcut, 2000);</script>
    <!--{/if}-->
    <div id="toptb" class="cl">
      <!--{hook/global_cpnav_top}-->
      <div class="wp">
        <div class="z">
                <!--{eval $i = 1;}-->
          <!--{loop $_G['setting']['topnavs'][0] $nav}-->
                    
            <!--{if $nav['available'] && (!$nav['level'] || ($nav['level'] == 1 && $_G['uid']) || ($nav['level'] == 2 && $_G['adminid'] > 0) || ($nav['level'] == 3 && $_G['adminid'] == 1))}-->$nav[code]<!--{/if}-->
                        <!--{eval $i++;}-->
          <!--{/loop}-->
          <!--{hook/global_cpnav_extra1}-->
        </div>
        <div class="y">
                    <!--{template common/header_userstatus}-->
          <a id="switchblind" href="javascript:;" onClick="toggleBlind(this)" title="{lang switch_blind}" class="switchblind">{lang switch_blind}</a>
          <!--{hook/global_cpnav_extra2}-->
          <!--{loop $_G['setting']['topnavs'][1] $nav}-->
            <!--{if $nav['available'] && (!$nav['level'] || ($nav['level'] == 1 && $_G['uid']) || ($nav['level'] == 2 && $_G['adminid'] > 0) || ($nav['level'] == 3 && $_G['adminid'] == 1))}-->$nav[code]<!--{/if}-->
          <!--{/loop}-->
          <!--{if empty($_G['disabledwidthauto']) && $_G['setting']['switchwidthauto']}-->
            <a href="javascript:;" id="switchwidth" onClick="widthauto(this)" title="{if widthauto()}{lang switch_narrow}{else}{lang switch_wide}{/if}" class="switchwidth"><!--{if widthauto()}-->{lang switch_narrow}<!--{else}-->{lang switch_wide}<!--{/if}--></a>
          <!--{/if}-->
          <!--{if $_G['uid'] && !empty($_G['style']['extstyle'])}--><a id="sslct" href="javascript:;" onMouseOver="delayShow(this, function() {showMenu({'ctrlid':'sslct','pos':'34!'})});">{lang changestyle}</a><!--{/if}-->
          <!--{if check_diy_perm($topic)}-->
            $diynav
          <!--{/if}-->
                    
        </div>
      </div>
    </div>

    <!--{if !IS_ROBOT}-->
      <!--{if $_G['uid']}-->
      <ul id="myprompt_menu" class="p_pop" style="display: none;">
        <li><a href="home.php?mod=space&do=pm" id="pm_ntc" style="background-repeat: no-repeat; background-position: 0 50%;"><em class="prompt_news{if empty($_G[member][newpm])}_0{/if}"></em>{lang pm_center}</a></li>

          <li><a href="home.php?mod=follow&do=follower"><em class="prompt_follower{if empty($_G[member][newprompt_num][follower])}_0{/if}"></em><!--{lang notice_interactive_follower}-->{if $_G[member][newprompt_num][follower]}($_G[member][newprompt_num][follower]){/if}</a></li>

        <!--{if $_G[member][newprompt] && $_G[member][newprompt_num][follow]}-->
          <li><a href="home.php?mod=follow"><em class="prompt_concern"></em><!--{lang notice_interactive_follow}-->($_G[member][newprompt_num][follow])</a></li>
        <!--{/if}-->
        <!--{if $_G[member][newprompt]}-->
          <!--{loop $_G['member']['category_num'] $key $val}-->
            <li><a href="home.php?mod=space&do=notice&view=$key"><em class="notice_$key"></em><!--{echo lang('template', 'notice_'.$key)}-->(<span class="rq">$val</span>)</a></li>
          <!--{/loop}-->
        <!--{/if}-->
        <!--{if empty($_G['cookie']['ignore_notice'])}-->
        <li class="ignore_noticeli"><a href="javascript:;" onClick="setcookie('ignore_notice', 1);hideMenu('myprompt_menu')" title="{lang temporarily_to_remind}"><em class="ignore_notice"></em></a></li>
        <!--{/if}-->
        </ul>
      <!--{/if}-->
      <!--{if $_G['uid'] && !empty($_G['style']['extstyle'])}-->
        <div id="sslct_menu" class="cl p_pop" style="display: none;">
          <!--{if !$_G[style][defaultextstyle]}--><span class="sslct_btn" onClick="extstyle('')" title="{lang default}"><i></i></span><!--{/if}-->
          <!--{loop $_G['style']['extstyle'] $extstyle}-->
            <span class="sslct_btn" onClick="extstyle('$extstyle[0]')" title="$extstyle[1]"><i style='background:$extstyle[2]'></i></span>
          <!--{/loop}-->
        </div>
      <!--{/if}-->
      <!--{subtemplate common/header_qmenu}-->
    <!--{/if}-->

    <!--{ad/headerbanner/wp a_h}-->
    <div class="header">
      <div class="header_top">
        <img src="template/jianshen/images/logo.png"/>
        <div class="top_rightbg">
          <div class="top_denglu">
            <span class="l_denglu"></span>
            <div class="m_denglu">
              <!--{template common/header_userstatus}-->
              <div class="clear"></div> 
            </div>
            <span class="r_denglu"></span>
          </div>
        </div>
      </div>
      <div class="navbox">
        <div class="nav">
          <!--{eval $mnid = getcurrentnav();}-->
          <ul>
          <!--{loop $_G['setting']['navs'] $nav}-->
            <!--{if $nav['available'] && (!$nav['level'] || ($nav['level'] == 1 && $_G['uid']) || ($nav['level'] == 2 && $_G['adminid'] > 0) || ($nav['level'] == 3 && $_G['adminid'] == 1))}--><li {if $mnid == $nav[navid]}class="a" {/if}$nav[nav]></li><!--{/if}-->
          <!--{/loop}-->
          </ul>
          <!--{hook/global_nav_extra}-->
          <div class="clear"></div>
        </div>
      </div>
       <div class="nav_sec">
        <!--[diy=jianshen_door_010_099]-->
          <div id="jianshen_door_010_099" class="area"></div>
        <!--[/diy]-->
        <!--{ad/subnavbanner/a_mu}-->
        <div class="searchbox">                                                                                                                                                     
          <!--{subtemplate common/pubsearchtop}-->                                                                                                                                 
        </div>
        <div class="clear"></div>
        <!--{if !empty($_G['setting']['plugins']['jsmenu'])}-->
          <ul class="p_pop h_pop" id="plugin_menu" style="display: none">
          <!--{loop $_G['setting']['plugins']['jsmenu'] $module}-->
             <!--{if !$module['adminid'] || ($module['adminid'] && $_G['adminid'] > 0 && $module['adminid'] >= $_G['adminid'])}-->
             <li>$module[url]</li>
             <!--{/if}-->
          <!--{/loop}-->
          </ul>
        <!--{/if}-->
        $_G[setting][menunavs]
        <div id="mu" class="cl">
        <!--{if $_G['setting']['subnavs']}-->
          <!--{loop $_G[setting][subnavs] $navid $subnav}-->
            <!--{if $_G['setting']['navsubhover'] || $mnid == $navid}-->
            <ul class="cl {if $mnid == $navid}current{/if}" id="snav_$navid" style="display:{if $mnid != $navid}none{/if}">
            $subnav
            </ul>
            <!--{/if}-->
          <!--{/loop}-->
        <!--{/if}-->
        </div>
      </div>
    </div>

    <!--{hook/global_header}-->
  <!--{/if}-->


