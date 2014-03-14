<?php echo 'Oiahoon www.oiahoon.com';exit;?>
<!--{template common/header}-->



<div class="contentbox">
  <!-- 轮播 S 1420-->
  <div class="banner">
    <a class="lbt"></a>
    <a class="rbt"></a> 
    <div class="middle_img_box">
      <!--[diy=jianshen_door_010_100]-->
        <div id="jianshen_door_010_100" class="area"></div>
      <!--[/diy]-->
    </div>
   
    <div class="num">
       <a>1</a>
       <a>2</a>
       <a>3</a>
       <a>4</a>
     </div>
  </div>
  <!-- 轮播 E -->
  <!-- 登录模块  -->
  <div class="denglubox">
    <div class="denglubox_1">
    <!--{if $_G['uid']}-->


      <img src="uc_server/avatar.php?uid=$_G['uid']&size=middle" />
      <div class="quickico1">
        <p>欢迎您，您已经登陆！</p>
      </div>
    <!--{else}-->
    
      <form method="post" autocomplete="off" id="lsform" action="member.php?mod=logging&action=login&loginsubmit=yes&infloat=yes&lssubmit=yes" onsubmit="{if $_G['setting']['pwdsafety']}pwmd5('ls_password');{/if}return lsSubmit();">
        <input type="hidden" name="formhash" value="{FORMHASH}" />
        <input type="hidden" name="referer" value="{echo dreferer()}" />
        <!--{if $auth}-->
          <input type="hidden" name="auth" value="$auth" />
        <!--{/if}-->
        <input type="text" name="username" id="ls_username" autocomplete="off" class="name_input" {if $_G['setting']['autoidselect']} value="{lang username}" onfocus="if(this.value == '{lang username}'){this.value = '';}" onblur="if(this.value == ''){this.value = '{lang username}';}"{/if} tabindex="901" />
        <input type="password" name="password" id="ls_password" autocomplete="off" tabindex="902" class="password_input" value="请输入密码">
        <button class="denglu"></button>
        <input type="hidden" name="quickforward" value="yes" />
        <input type="hidden" name="handlekey" value="ls" />
      </form>
      <div class="quickico1">
        <a class="misscode">忘记密码</a>
        <a class="zc">注册</a>
      </div>
    <!--{/if}-->
    </div>
     <div class="quickico2">
      <a href="$_G['setting']['site_weibo']">会友微博</a>
      <a href="$_G['setting']['site_weixin']">会友微信</a>
      <a href="$_G['setting']['site_xinxi']">会友信息</a>
      <div class="clear"></div>
    </div>
    <span>咨询热线：<!--{if $_G['setting']['site_phone']}-->$_G['setting']['site_phone']<!--{/if}--></span>
  </div>
  <div class="clear"></div>
  <!-- eof 登录模块  -->

  <!-- 三个大图 -->
  <ul class="content2">
    <!--[diy=jianshen_door_010_101]-->
      <div id="jianshen_door_010_101" class="area"></div>
    <!--[/diy]-->
  </ul>
  <!-- eof 三个大图 -->

  <!-- left -->
  <div class="left1">
    <!-- 公告 -->
      <!--[diy=jianshen_door_010_102]--><div id="jianshen_door_010_102" class="area"></div><!--[/diy]-->
    <!-- .公告 -->
    
    <!-- 板块一 -->
    <div class="zxzx">
      <span class="title"></span>
      <div class="left1_1">
        <!--[diy=jianshen_door_010_114]--><div id="jianshen_door_010_114" class="area"></div><!--[/diy]-->
      </div>
      <div class="right1_1">
        <!--[diy=jianshen_door_010_103]--><div id="jianshen_door_010_103" class="area"></div><!--[/diy]-->
      </div>
    </div>
    <!-- 板块二 -->
    <div class="jszs">
      <span class="title"><span>
        <!--[diy=jianshen_door_010_105]--><div id="jianshen_door_010_105" class="area"></div><!--[/diy]-->
      </span></span>
      <div class="left1_1">
        <!--[diy=jianshen_door_011_101]--><div id="jianshen_door_011_101" class="area"></div><!--[/diy]-->
      </div>
      <div class="right1_1">
        <!--[diy=jianshen_door_011_102]--><div id="jianshen_door_011_102" class="area"></div><!--[/diy]-->
      </div>
    </div> 
    <div class="mtss">
      <span class="title"><span>
        <!--[diy=jianshen_door_010_106]--><div id="jianshen_door_010_106" class="area"></div><!--[/diy]-->
      </span></span>
      <div class="left1_1">
        <!--[diy=jianshen_door_011_103]--><div id="jianshen_door_011_103" class="area"></div><!--[/diy]-->
      </div>
      <div class="right1_1">
        <!--[diy=jianshen_door_011_104]--><div id="jianshen_door_011_104" class="area"></div><!--[/diy]-->
      </div>
    </div> 
    <div class="ydjs">
      <span class="title"><span>
          <!--[diy=jianshen_door_010_107]--><div id="jianshen_door_010_107" class="area"></div><!--[/diy]-->
      </span></span>
      <div class="left1_1">
        <!--[diy=jianshen_door_011_105]--><div id="jianshen_door_011_105" class="area"></div><!--[/diy]-->
      </div>
      <div class="right1_1">
        <!--[diy=jianshen_door_011_106]--><div id="jianshen_door_011_106" class="area"></div><!--[/diy]-->
      </div>
    </div>
    <div class="hwyd">
      <span class="title"><span>
        <!--[diy=jianshen_door_010_108]--><div id="jianshen_door_010_108" class="area"></div><!--[/diy]-->
      </span></span>
      <div class="left1_1">
        <!--[diy=jianshen_door_011_107]--><div id="jianshen_door_011_107" class="area"></div><!--[/diy]-->
      </div>
      <div class="right1_1">
        <!--[diy=jianshen_door_011_108]--><div id="jianshen_door_011_108" class="area"></div><!--[/diy]-->
      </div>
    </div>        
  </div>
  <!-- eof left -->

  <!-- right -->
  <div class="right1">
    <div class="yybj">
      <div class="title">
        <span>营养补剂</span>
        <!--[diy=jianshen_door_010_109]--><div id="jianshen_door_010_109" class="area"></div><!--[/diy]-->
        <div class="clear"></div>
      </div>
      <ul>
        <!--[diy=jianshen_door_010_110]--><div id="jianshen_door_010_110" class="area"></div><!--[/diy]-->
      </ul>
    </div>
    <div class="pk">
      <div class="pk1">
        <!--[diy=jianshen_door_011_109]--><div id="jianshen_door_011_109" class="area"></div><!--[/diy]-->
        <span>健身前</span>
      </div>
      <span class="pk"></span>
      <div class="pk2">
        <!--[diy=jianshen_door_011_110]--><div id="jianshen_door_011_110" class="area"></div><!--[/diy]-->
        <span>健身后</span>
        </div>
    </div>
    <div class="rmlt">
        <p class="title">热门论坛</p>
        <!--[diy=jianshen_door_011_111]--><div id="jianshen_door_011_111" class="area"></div><!--[/diy]-->
        <div class="clear"></div>
        <!--[diy=jianshen_door_011_112]--><div id="jianshen_door_011_112" class="area"></div><!--[/diy]-->
    </div>
    <div class="rmhd">
        <p class="title">热门活动</p>
        <span class="title">最新活动</span><span class="line"></span>   <div class="clear"></div>
        <!--[diy=jianshen_door_011_113]--><div id="jianshen_door_011_113" class="area"></div><!--[/diy]-->
        <div class="clear"></div>
        <!--[diy=jianshen_door_011_114]--><div id="jianshen_door_011_114" class="area"></div><!--[/diy]-->
        
        <span class="title">我来召集</span><span class="line"></span>
        <div class="clear"></div>
        <!--[diy=jianshen_door_011_115]--><div id="jianshen_door_011_115" class="area"></div><!--[/diy]-->
        <div class="clear"></div>
        <!--[diy=jianshen_door_011_116]--><div id="jianshen_door_011_116" class="area"></div><!--[/diy]-->
        
        <span class="title">官方推荐</span><span class="line"></span>
        <div class="clear"></div>
        <!--[diy=jianshen_door_011_117]--><div id="jianshen_door_011_117" class="area"></div><!--[/diy]-->
        <div class="clear"></div>
        <!--[diy=jianshen_door_011_118]--><div id="jianshen_door_011_118" class="area"></div><!--[/diy]-->
    </div>
  </div>
  <!-- eof right -->

  <!-- bottom -->
  <div class="clear"></div>
  <div class="qm_fc">
    <div class="qm">
      <p class="title">热门活动</p>
      <div class="left">
        <!--[diy=jianshen_door_011_120]--><div id="jianshen_door_011_120" class="area"></div><!--[/diy]-->
        <!--[diy=jianshen_door_011_119]--><div id="jianshen_door_011_119" class="area"></div><!--[/diy]-->
      </div>
      <ul class="right">
        <!--[diy=jianshen_door_011_121]--><div id="jianshen_door_011_121" class="area"></div><!--[/diy]-->
      </ul>
      <div class="clear"></div>
    </div>
    <div class="fc">
      <div class="title">
        <span>会员风采</span>
        <a href="plugin.php?id=xhuaian_makefriends:main">+更多<<</a>
        <div class="clear"></div>
      </div>
      <div class="hyfc">
        <a class="more1_l"></a>
        <div class="hyfcbox">
        <!--[diy=jianshen_door_011_122]--><div id="jianshen_door_011_122" class="area"></div><!--[/diy]-->
        </div>
        <a class="more1_r"></a>
        <div class="clear">    
        </div> 
   
      </div>  
    </div>
  </div>
  <!-- eof bottom -->

</div>

<div class="foot">
  <div class="pinpai">
    <!--[diy=jianshen_door_011_123]--><div id="jianshen_door_011_123" class="area"></div><!--[/diy]-->
  </div>
  <div class="youqinglj">
    <!--友情链接 -->
    
    <!--[diy=jianshen_door_011_124]--><div id="jianshen_door_011_124" class="area"></div><!--[/diy]-->
    <!--友情链接 -->
  </div>
</div>

<!--{template common/footer}-->
