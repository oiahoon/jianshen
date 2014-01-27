<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<style type="text/css">
.box_os .os_x, .box_os .osqq, .ico_os, .ico_gt, .ico_pp, .osqq .qq{ background:url("template/jianshen/images/os20130523.gif") no-repeat;}
.box_os{ height:auto; overflow:hidden; width:131px; position:fixed; right:0; top:174px; _position:absolute; z-index:9999;display:none;}
.box_os .os_x{ background-color:#f7f7f7; background-position:2px 2px; width:18px; height:20px; float:right; display:inline; cursor:pointer;}
.box_os .osqq{ width:129px; border:1px solid #D1D1D1; background-color:#fff; background-position:0 -120px; clear:both; padding:37px 0 8px 0; text-align:center;}
.box_os .osqq p{ height:auto; line-height:20px;width:129px; margin-top:8px;}
.box_os .osqq p strong{ color:#666;}
.box_os .osqq img{ padding:7px 0 3px 0;}
.box_os .osqq p em{ color:#999; display:block;}
.box_os .osqq p span{ color:#547816; display:block;}
.box_os .osqq .qq{ background-position:-140px -120px; display:block; width:99px; height:26px; margin:0 auto; margin-top:8px; cursor:pointer;}
.acbox{ width:130px; overflow:hidden;}
.acbox .ico_gt{ background-position:-60px 0; border:1px solid #299ec0; border-top:0; cursor:pointer; width:60px; height:33px; float:right;}
.acbox .ico_pp{ background-position:-60px -60px; border:1px solid #81b140; border-top:0; cursor:pointer; width:60px; height:33px; float:right; margin:0 2px;}
.onlineService{ background:none; display:none; width:39px; *width:84px; height:178px; ;position:fixed; right:0; top:174px; _position:absolute;}
.onlineService .ico_os{ background-position:-2px -20px; border:1px solid #c7c7c7; cursor:pointer; width:39px; height:98px; float:right;}
.onlineService .ico_gt{ background-position:right 0; border:1px solid #299ec0; cursor:pointer; width:39px; height:37px; float:right; clear:both;}
.onlineService .ico_pp{ background-position:right -60px; border:1px solid #81b140; cursor:pointer; width:39px; height:37px; float:right; margin:0 0 1px 0; clear:both;}
.box_os .osqq p span a{color:#557917;}
</style>
<script src="template/jianshen/images/onlineService.js" type="text/javascript" ></script>
<div class="box_os" style="display: none;">
<div class="os_x"></div>
    <div class="osqq">
    <p><em>(工作日：9:30-18:30)</em></p>
    	<p><strong>在线QQ</strong></p>
        <a class="qq" id="ico_onlineqq" href="#"></a>
        <p><strong>客服电话</strong><span>028-88888888</span><span>028-88888888</span></p>
        <p><strong>作者</strong><span>QQ：4296411</span></p>
        <p><strong>微博</strong><span><a href="http://www.oiahoon.com" target="_blank">@oiahoon</a></span></p>
    </div>
    <div class="acbox">
    	<a title="" href="javascript:void(0);" onclick="FeedbackUtil.feed('#');" class="ico_pp" target="_self"></a>
        <a title="" target="_self" href="javascript:void(0);" class="ico_gt"></a>
    </div>
</div>

<div class="onlineService" style="display: block;">
<p class="ico_os"></p>
    <a title="" href="javascript:void(0);" onclick="FeedbackUtil.feed('#');" class="ico_pp" target="_self" style="width: 39px;"></a>
    <a title="" target="_self" href="javascript:void(0);" class="ico_gt" style="width: 39px;"></a>
</div>