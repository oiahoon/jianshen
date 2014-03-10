<?php
if(!defined('IN_DISCUZ')) {
  exit('Access Denied');
}
$_G['setting']['switchwidthauto']=0;
$_G['setting']['allowwidthauto']=1;
$config=$_G['cache']['plugin']['aljbd'];
if($_GET['act']=='attend'){
  if(submitcheck('submit')){
    $bd=C::t('#aljbd#aljbd')->fetch_by_uid($_G['uid']);
    /*if($bd&&$_G['groupid']!=1){
      showerror(lang('plugin/aljbd','s18'));
    }*/
    if($_FILES['logo']['tmp_name']) {
      $picname = $_FILES['logo']['name'];
      $picsize = $_FILES['logo']['size'];
    
      if ($picname != "") {
        $type = strstr($picname, '.');
        if ($type != ".gif" && $type != ".jpg"&& $type != ".png") {
          showerror(lang('plugin/aljbd','s19'));
        }
        $rand = rand(100, 999);
        $pics = date("YmdHis") . $rand . $type;
        $logo = "source/plugin/aljbd/images/logo/". $pics;
        if(@copy($_FILES['logo']['tmp_name'], $logo)||@move_uploaded_file($_FILES['logo']['tmp_name'], $logo)){
          @unlink($_FILES['logo']['tmp_name']);
        }
      }
    }else{
      showerror(lang('plugin/aljbd','logo'));
    }

    $insertarray=array(
      'username'    =>$_G['username'],
      'uid'         =>$_G['uid'],
      'name'        =>$_GET['name'],
      'tel'         =>$_GET['tel'],
      'logo'        =>$logo,
      'addr'        =>$_GET['addr'],
      'intro'       =>$_GET['intro'],
      'other'       =>$_GET['other'],
      'type'        =>$_GET['type'],
      'subtype'     =>$_GET['subtype'],
      'region'      =>$_GET['region'],
      'subregion'   =>$_GET['subregion'],
      'dateline'    =>TIMESTAMP,
      );

      // ########### 增加扩展信息 
    $extesions = array(
      // 咨询联系人
      'contactuser' => $_GET['contactuser'],
      // 营业时间
      'timenormal'  => $_GET['timenormal'],
      'timeweekend' => $_GET['timeweekend'],
      // 商家网址
      'url'         => $_GET['url'],
      // 价格区间
      'pricerange'  => $_GET['pricerange'],
      // 配套服务
      'bus'         => $_GET['bus'], // 公交
      'metro'       => $_GET['metro'], //地铁
      'parking'     => $_GET['parking'], //停车信息
      'shopping'    => $_GET['shopping'], //购物
      'hospital'    => $_GET['hospital'], //医院
      'bank'        => $_GET['bank'],
      'eatting'     => $_GET['eatting'],
    );

    $shop_id = C::t('#aljbd#aljbd')->insert($insertarray);
    $extesions['bid'] = $shop_id;
    C::t('#aljbd#aljbdextensions')->insert($extesions);
    showmsg(lang('plugin/aljbd','s20'));
  }else{
    if(empty($_G['uid'])){
      showmessage(lang('plugin/aljbd','s21'));
    }
    $typelist=C::t('#aljbd#aljbd_type')->fetch_all_by_upid(0);
    $rlist=C::t('#aljbd#aljbd_region')->fetch_all_by_upid();
    include template('aljbd:attend');
  }
}else if($_GET['act']=='member'){
  if(empty($_G['uid'])){
    showmessage(lang('plugin/aljbd','s22'));
  }
  $typelist=C::t('#aljbd#aljbd_type')->range();
  $rlist=C::t('#aljbd#aljbd_region')->range();
  $currpage=$_GET['page']?$_GET['page']:1;
  $perpage=$config['page'];
  $num=C::t('#aljbd#aljbd')->count_by_status(1,$_G['uid']);
  $start=($currpage-1)*$perpage;
  $bdlist=C::t('#aljbd#aljbd')->fetch_all_by_status(1,$start,$perpage,$_G['uid']);
  $paging = helper_page :: multi($num, $perpage, $currpage, 'plugin.php?id=aljbd&act=member', 0, 11, false, false);
  include template('aljbd:member');
}else if($_GET['act']=='yes'){
  if(empty($_G['uid'])){
    showmessage(lang('plugin/aljbd','s23'));
  }
  $typelist=C::t('#aljbd#aljbd_type')->range();
  $rlist=C::t('#aljbd#aljbd_region')->range();
  $currpage=$_GET['page']?$_GET['page']:1;
  $perpage=$config['page'];
  $num=C::t('#aljbd#aljbd')->count_by_status(0,$_G['uid']);
  $start=($currpage-1)*$perpage;
  $bdlist=C::t('#aljbd#aljbd')->fetch_all_by_status(0,$start,$perpage,$_G['uid']);
  $paging = helper_page :: multi($num, $perpage, $currpage, 'plugin.php?id=aljbd&act=member', 0, 11, false, false);
  include template('aljbd:member');
}else if($_GET['act']=='gg'){
  if(file_exists('source/plugin/aljbd/com/gg.php')){
    include_once 'source/plugin/aljbd/com/gg.php';
  }
}else if($_GET['act']=='intro'){
  if(file_exists('source/plugin/aljbd/com/intro.php')){
    include_once 'source/plugin/aljbd/com/intro.php';
  }
}else if($_GET['act']=='adv'){
  if(submitcheck('formhash')){
    // 改为上传 3 个
    // for($i=1;$i<=3;$i++){
    for($i=1;$i<=5;$i++){
      if($_FILES['adv']['tmp_name'][$i]) {
        $picname = $_FILES['adv']['name'][$i];
        $picsize = $_FILES['adv']['size'][$i];
      
        if ($picname != "") {
          $type = strstr($picname, '.');
          if ($type != ".gif" && $type != ".jpg"&& $type != ".png") {
            showerror(lang('plugin/aljbd','s25'));
          }
          $rand = rand(100, 999);
          $pics = date("YmdHis") . $rand . $type;
          $dir='source/plugin/aljbd/images/adv/';
          if(!is_dir($dir)) {
            @mkdir($dir, 0777);
          }
          $adv[$i] = $dir. $pics;
          if(@copy($_FILES['adv']['tmp_name'][$i], $adv[$i])||@move_uploaded_file($_FILES['adv']['tmp_name'][$i], $adv[$i])){
            @unlink($_FILES['adv']['tmp_name'][$i]);
          }
        }
      }
    }
    $bd=C::t('#aljbd#aljbd')->fetch($_GET['bid']);
    $badv=unserialize($bd['adv']);
    $badvurl=unserialize($bd['advurl']);
    if($_GET['advdelete']){
      foreach($_GET['advdelete'] as $k=>$d){
        unset($badv[$k]);
      }
    }
    if(empty($adv)){
      $adv=$badv;
    }
    C::t('#aljbd#aljbd')->update($_GET['bid'],array('advurl'=>serialize($_GET['advurl']),'adv'=>serialize($adv)));
    showmsg(lang('plugin/aljbd','s27'),'edit');
  }
  $bd=C::t('#aljbd#aljbd')->fetch($_GET['bid']);
  $adv=unserialize($bd['adv']);
  $advurl=unserialize($bd['advurl']);
  include template('aljbd:adv');
}else if($_GET['act']=='winfo'){
  if(file_exists('source/plugin/aljbd/com/winfo.php')){
    include_once 'source/plugin/aljbd/com/winfo.php';
  }
}else if($_GET['act']=='winfolist'){
  $currpage=$_GET['page']?$_GET['page']:1;
  $perpage=1;
  $start=($currpage-1)*$perpage;
  $num=C::t('#aljbd#aljbd_winfo')->count_by_bid($_GET['bid']);
  $winfolist=C::t('#aljbd#aljbd_winfo')->fetch_all_by_bid($_GET['bid'],$start,$perpage);
  $paging = helper_page :: multi($num, $perpage, $currpage, 'plugin.php?id=aljbd&act=winfolist&bid='.$_GET['bid'], 0, 11, false, false);
  include template('aljbd:winfolist');
}else if($_GET['act']=='commentlist'){
  $currpage=$_GET['page']?$_GET['page']:1;
  $perpage=10;
  $start=($currpage-1)*$perpage;
  $num=C::t('#aljbd#aljbd_comment')->count_by_bid_all($_GET['bid']);
  $commentlist=C::t('#aljbd#aljbd_comment')->fetch_all_by_bid_page($_GET['bid'],$start,$perpage);
  $paging = helper_page :: multi($num, $perpage, $currpage, 'plugin.php?id=aljbd&act=commentlist&bid='.$_GET['bid'], 0, 11, false, false);
  include template('aljbd:commentlist');
}else if($_GET['act']=='deletecomment'){
  C::t('#aljbd#aljbd_comment')->delete($_GET['cid']);
  $currpage=$_GET['page']?$_GET['page']:1;
  $perpage=10;
  $num=C::t('#aljbd#aljbd_comment')->count_by_bid_all($_GET['bid']);
  $commentlist=C::t('#aljbd#aljbd_comment')->fetch_all_by_bid_page($_GET['bid'],$start,$perpage);
  $paging = helper_page :: multi($num, $perpage, $currpage, 'plugin.php?id=aljbd&act=commentlist&bid='.$_GET['bid'], 0, 11, false, false);
  include template('aljbd:commentlist');
}else if($_GET['act']=='edit'){
  if(submitcheck('submit')){
    if($_FILES['logo']['tmp_name']) {
      $picname = $_FILES['logo']['name'];
      $picsize = $_FILES['logo']['size'];
    
      if ($picname != "") {
        $type = strstr($picname, '.');
        if ($type != ".gif" && $type != ".jpg"&& $type != ".png") {
          showerror(lang('plugin/aljbd','s29'));
        }
        $rand = rand(100, 999);
        $pics = date("YmdHis") . $rand . $type;
        $logo = "source/plugin/aljbd/images/logo/". $pics;
        if(@copy($_FILES['logo']['tmp_name'], $logo)||@move_uploaded_file($_FILES['logo']['tmp_name'], $logo)){
          @unlink($_FILES['logo']['tmp_name']);
        }
      }
    }
    $updatearray=array(
      // 店铺名称
      'name'        =>$_GET['name'],
      // 联系电话
      'tel'         =>$_GET['tel'],
      // 店铺地址
      'addr'        =>$_GET['addr'],
      // 店铺介绍
      'intro'       =>$_GET['intro'],
      // 关键词
      'other'       =>$_GET['other'],
      // 分类
      'type'        =>$_GET['type'],
      // 子分类
      'subtype'     =>$_GET['subtype'],
      // 所属地区
      'region'      =>$_GET['region'],
      // 子地区
      'subregion'   =>$_GET['subregion'],
      // ######### 增加字段 
      // 最新活动帖子id
      'activities'  => $_GET['activities'],
      );
    // ######### 增加扩展信息 
    $extesions = array(
      // 咨询联系人
      'contactuser' => $_GET['contactuser'],
      // 营业时间
      'timenomal'   => $_GET['timenomal'],
      'timezhoumo'  => $_GET['timezhoumo'],
      // 商家网址
      'url'         => $_GET['url'],
      // 价格区间
      'pricerange'  => $_GET['pricerange'],
      // 配套服务
      'bus'         => $_GET['bus'],      // 公交
      'metro'       => $_GET['metro'],    //地铁
      'parking'     => $_GET['parking'],  //停车信息
      'shopping'    => $_GET['shopping'], //购物
      'hospital'    => $_GET['hospital'], //医院
      'bank'        => $_GET['bank'],
      'eatting'     => $_GET['eatting'],
    );
    if($logo){
      $updatearray['logo']=$logo;
    }
    C::t('#aljbd#aljbd')->update($_GET['bid'],$updatearray);
    $bd=C::t('#aljbd#aljbd')->fetch($_GET['bid']);
    C::t('#aljbd#aljbdextensions')->update($bd['id'], $extesions);
    showmsg(lang('plugin/aljbd','s30'));
  }else{
    $bd=C::t('#aljbd#aljbd')->fetch($_GET['bid']);
    $extesions=C::t('#aljbd#aljbd')->fetch($bd['id']);
    $typelist=C::t('#aljbd#aljbd_type')->fetch_all_by_upid(0);
    $rlist=C::t('#aljbd#aljbd_region')->fetch_all_by_upid();
    include template('aljbd:edit');
  }
}else if($_GET['act']=='gettype'){
  if($_GET['upid']){
    $typelist=C::t('#aljbd#aljbd_type')->fetch_all_by_upid($_GET['upid']);
  }
  include template('aljbd:gettype');
}else if($_GET['act']=='getregion'){
  if($_GET['upid']){
    $rlist=C::t('#aljbd#aljbd_region')->fetch_all_by_upid('','',$_GET['upid']);
  }
  include template('aljbd:getregion');
}else if($_GET['act']=='view'){
  $check=C::t('#aljbd#aljbd_user')->fetch($_G['uid']);
  if(empty($check)&&$_G['uid']){
    C::t('#aljbd#aljbd_user')->insert(array('uid'=>$_G['uid'],'username'=>$_G['username'],'bid'=>$_GET['bid']));
  }
  C::t('#aljbd#aljbd')->update_view_by_bid($_GET['bid']);
  $khf=C::t('#aljbd#aljbd_comment')->count_by_bid($_GET['bid']);
  foreach($khf[0] as $k=>$v){
    $khf[0][$k]=intval($v);
  }
  $typelist=C::t('#aljbd#aljbd_type')->range();
  $rlist=C::t('#aljbd#aljbd_region')->range();
  $commentcount=C::t('#aljbd#aljbd_comment')->count_by_bid_upid($_GET['bid'],0,0);
  $askcount=C::t('#aljbd#aljbd_comment')->count_by_bid_upid($_GET['bid'],0,1);
  $commentlist=C::t('#aljbd#aljbd_comment')->fetch_all_by_bid_upid($_GET['bid'],0,0);
  $asklist=C::t('#aljbd#aljbd_comment')->fetch_all_by_bid_upid($_GET['bid'],0,1);
  $bd=C::t('#aljbd#aljbd')->fetch($_GET['bid']);
  $tell=str_replace('{tel}',$bd['tel'],$config['tel']);
  require_once libfile('function/discuzcode');
  if(!file_exists('source/plugin/aljbd/com/intro.php')){
    $bd['intro']=discuzcode($bd['intro']);
  }
  $avg=C::t('#aljbd#aljbd_comment')->count_avg_by_bid($bd['id']);
  $avg=intval($avg);
  $gg=explode("\n",str_replace(array("\r\n","\r"),array("\n","\n"),discuzcode($bd['gg'])));
  $adv=unserialize($bd['adv']);
  $advurl=unserialize($bd['advurl']);
  $navtitle = $bd['name'].'-'.$config['title'];
  $metakeywords =  $config['keywords'];
  $metadescription = $config['description'];
  include template('aljbd:view');
}else if($_GET['act']=='comment'){
  if(submitcheck('formhash')){
    if(empty($_GET['commentmessage_1'])){
      showerror(lang('plugin/aljbd','s31'));
    }
    if(empty($_G['uid'])){
      showerror(lang('plugin/aljbd','s21'));
    }
    $insertarray=array(
      'uid'=>$_G['uid'],
      'username'=>$_G['username'],
      'content'=>$_GET['commentmessage_1'],
      'bid'=>$_GET['bid'],
      'displayorder'=>$_GET['isprivate'],
      'dateline'=>TIMESTAMP,
      'upid'=>0,
    );
    $cs=explode('@',$_GET['commentscorestr']);
    foreach($cs as $k=>$v){
      if($v==11){
        $insertarray['k']=$cs[$k+1];
      }elseif($v==12){
        $insertarray['h']=$cs[$k+1];
      }elseif($v==13){
        $insertarray['f']=$cs[$k+1];
      } 
    }
    $insertarray['avg']=intval(($insertarray['h']+$insertarray['f'])/2);
    C::t('#aljbd#aljbd')->update_comment_by_bid($_GET['bid']);
    C::t('#aljbd#aljbd_comment')->insert($insertarray);
    showmsg(lang('plugin/aljbd','s32'));
  }
}else if($_GET['act']=='ask'){
  if(submitcheck('formhash')){
    if(empty($_GET['commentmessage_2'])){
      showerror(lang('plugin/aljbd','s33'));
    }
    if(empty($_G['uid'])){
      showerror(lang('plugin/aljbd','s21'));
    }
    $insertarray=array(
      'uid'=>$_G['uid'],
      'username'=>$_G['username'],
      'content'=>$_GET['commentmessage_2'],
      'bid'=>$_GET['bid'],
      'displayorder'=>$_GET['isprivate'],
      'dateline'=>TIMESTAMP,
      'upid'=>0,
      'ask'=>$_GET['ask']
    );
    C::t('#aljbd#aljbd_comment')->insert($insertarray);
    showmsg(lang('plugin/aljbd','s34'));
  }
}else if($_GET['act']=='reply'){
  if(submitcheck('formhash')){
    if(empty($_GET['commentmessage_1'])){
      showerror(lang('plugin/aljbd','s35'));
    }
    if(empty($_G['uid'])){
      showerror(lang('plugin/aljbd','s21'));
    }
    $insertarray=array(
      'uid'=>$_G['uid'],
      'username'=>$_G['username'],
      'content'=>$_GET['commentmessage_1'],
      'bid'=>$_GET['bid'],
      'displayorder'=>$_GET['isprivate'],
      'dateline'=>TIMESTAMP,
      'upid'=>$_GET['upid'],
    );
    C::t('#aljbd#aljbd_comment')->insert($insertarray);
    showmsg(lang('plugin/aljbd','s36'));
  }
}else if($_GET['act']=='map'){
  $bd=C::t('#aljbd#aljbd')->fetch($_GET['bid']);
  $navtitle = $bd['name'].'-'.$config['title'];
  $metakeywords =  $config['keywords'];
  $metadescription = $config['description'];
  include template('aljbd:map');
}else if($_GET['act']=='mark'){
  if(file_exists('source/plugin/aljbd/com/mark.php')){
    include_once 'source/plugin/aljbd/com/mark.php';
  }
}else if($_GET['act']=='point'){
  if(empty($_G['uid'])){
    showmessage(lang('plugin/aljbd','s39'));
  }
  $currpage=$_GET['page']?$_GET['page']:1;
  $perpage=10;
  $start=($currpage-1)*$perpage;
  $num=C::t('#aljbd#aljbd_point')->count_by_buid($_G['uid']);
  $pointlist=C::t('#aljbd#aljbd_point')->fetch_all_by_buid($_G['uid'],$start,$perpage);
  $paging = helper_page :: multi($num, $perpage, $currpage, 'plugin.php?id=aljbd&act=point', 0, 11, false, false);
  include template('aljbd:point');
}else if($_GET['act']=='pointok'){
  if(empty($_G['uid'])){
    showerror(lang('plugin/aljbd','s40'));
  }
  C::t('#aljbd#aljbd')->update($_GET['bid'],array('x'=>$_GET['x'],'y'=>$_GET['y']));
  C::t('#aljbd#aljbd_point')->delete($_GET['pid']);
  showmsg(lang('plugin/aljbd','s41'));
}else if($_GET['act']=='pointdel'){
  if(empty($_G['uid'])){
    showerror(lang('plugin/aljbd','s42'));
  }
  C::t('#aljbd#aljbd_point')->delete($_GET['pid']);
  showmsg(lang('plugin/aljbd','s43'));
}else if($_GET['act']=='iwantclaim'){
  if(submitcheck('formhash')){
    if(empty($_GET['name'])){
      showerror(lang('plugin/aljbd','s47'));
    }
    $user=C::t('common_member')->fetch_by_username($_GET['name']);
    if(empty($user)){
      showerror(lang('plugin/aljbd','s48'));
    }
    C::t('#aljbd#aljbd')->update($_GET['bid'],array('uid'=>$user['uid'],'username'=>$_GET['name']));
    showmsg(lang('plugin/aljbd','s49'));
  }else{
    include template('aljbd:iwantclaim');
  }
}else if($_GET['act']=='delete'){
  if($_GET['bid']){
    C::t('#aljbd#aljbd')->delete($_GET['bid']);
  }
  showmessage(lang('plugin/aljbd','s50'),'plugin.php?id=aljbd&act=member');
}else if($_GET['act']=='goodslist'){
  $bdlist=C::t('#aljbd#aljbd')->range();
  $glist=C::t('#aljbd#aljbd_goods')->fetch_all_by_uid_bid($_G['uid'],$_GET['bid']);
  include template('aljbd:goodslist');
}else if($_GET['act']=='good'){
  if(file_exists('source/plugin/aljbd/com/good.php')){
    include_once 'source/plugin/aljbd/com/good.php';
  }
}else if($_GET['act']=='goodview'){
  C::t('#aljbd#aljbd_goods')->update_view_by_gid($_GET['gid']);
  $check=C::t('#aljbd#aljbd_user')->fetch($_G['uid']);
  if(empty($check)&&$_G['uid']){
    C::t('#aljbd#aljbd_user')->insert(array('uid'=>$_G['uid'],'username'=>$_G['username'],'bid'=>$_GET['bid']));
  }
  C::t('#aljbd#aljbd')->update_view_by_bid($_GET['bid']);
  $khf=C::t('#aljbd#aljbd_comment')->count_by_bid($_GET['bid']);
  foreach($khf[0] as $k=>$v){
    $khf[0][$k]=intval($v);
  }
  $typelist=C::t('#aljbd#aljbd_type')->range();
  $rlist=C::t('#aljbd#aljbd_region')->range();
  $commentcount=C::t('#aljbd#aljbd_comment')->count_by_bid_upid($_GET['bid'],0,0);
  $askcount=C::t('#aljbd#aljbd_comment')->count_by_bid_upid($_GET['bid'],0,1);
  $commentlist=C::t('#aljbd#aljbd_comment')->fetch_all_by_bid_upid($_GET['bid'],0,0);
  $asklist=C::t('#aljbd#aljbd_comment')->fetch_all_by_bid_upid($_GET['bid'],0,1);
  $bd=C::t('#aljbd#aljbd')->fetch($_GET['bid']);
  require_once libfile('function/discuzcode');
  if(!file_exists('source/plugin/aljbd/com/intro.php')){
    $bd['intro']=discuzcode($bd['intro']);
  }
  $avg=C::t('#aljbd#aljbd_comment')->count_avg_by_bid($bd['id']);
  $avg=intval($avg);
  
  $adv=unserialize($bd['adv']);
  $advurl=unserialize($bd['advurl']);
  $navtitle = $bd['name'].'-'.$config['title'];
  $metakeywords =  $config['keywords'];
  $metadescription = $config['description'];
  $bdlist=C::t('#aljbd#aljbd')->range();
  $g=C::t('#aljbd#aljbd_goods')->fetch($_GET['gid']);
  $t=C::t('#aljbd#aljbd_goods')->fetch_all_by_uid_bid_view($g['uid'],$_GET['bid'],0,6);
  include template('aljbd:goodview');
}else if($_GET['act']=='addgoods'){
  if(submitcheck('formhash')){
    if(empty($_GET['bid'])){
      showerror(lang('plugin/aljbd','s51'));
    }
    if(empty($_GET['name'])){
      showerror(lang('plugin/aljbd','s52'));
    }
    if($_FILES['pic1']['tmp_name']) {
      $picname = $_FILES['pic1']['name'];
      $picsize = $_FILES['pic1']['size'];
    
      if ($picname != "") {
        $type = strstr($picname, '.');
        if ($type != ".gif" && $type != ".jpg"&& $type != ".png") {
          showerror(lang('plugin/aljbd','s19'));
        }
        $rand = rand(100, 999);
        $pics = date("YmdHis") . $rand . $type;
        $pic1 = "source/plugin/aljbd/images/logo/". $pics;
        if(@copy($_FILES['pic1']['tmp_name'], $pic1)||@move_uploaded_file($_FILES['pic1']['tmp_name'], $pic1)){
          $imageinfo=getimagesize($pic1);
          $w60=$imageinfo[0]<60?$imageinfo[0]:60;
          $h60=$imageinfo[1]<60?$imageinfo[1]:60;
          $w205=$imageinfo[0]<205?$imageinfo[0]:205;
          $h205=$imageinfo[1]<205?$imageinfo[1]:205;
          $w470=$imageinfo[0]<470?$imageinfo[0]:470;
          $h470=$imageinfo[1]<470?$imageinfo[1]:470;
          img2thumb($pic1,$pic1.'.60x60.jpg',$w60,$h60);
          img2thumb($pic1,$pic1.'.205x205.jpg',$w205,$h205);
          img2thumb($pic1,$pic1.'.470x470.jpg',$w470,$h470);
          @unlink($_FILES['pic1']['tmp_name']);
        }
      }
    }else{
      showerror(lang('plugin/aljbd','s56'));
    }
    if($_FILES['pic2']['tmp_name']) {
      $picname = $_FILES['pic2']['name'];
      $picsize = $_FILES['pic2']['size'];
    
      if ($picname != "") {
        $type = strstr($picname, '.');
        if ($type != ".gif" && $type != ".jpg"&& $type != ".png") {
          showerror(lang('plugin/aljbd','s19'));
        }
        $rand = rand(100, 999);
        $pics = date("YmdHis") . $rand . $type;
        $pic2 = "source/plugin/aljbd/images/logo/". $pics;
        if(@copy($_FILES['pic2']['tmp_name'], $pic2)||@move_uploaded_file($_FILES['pic2']['tmp_name'], $pic2)){
          $imageinfo=getimagesize($pic2);
          $w60=$imageinfo[0]<60?$imageinfo[0]:60;
          $h60=$imageinfo[1]<60?$imageinfo[1]:60;
          $w205=$imageinfo[0]<205?$imageinfo[0]:205;
          $h205=$imageinfo[1]<205?$imageinfo[1]:205;
          $w470=$imageinfo[0]<470?$imageinfo[0]:470;
          $h470=$imageinfo[1]<470?$imageinfo[1]:470;
          img2thumb($pic2,$pic2.'.60x60.jpg',$w60,$h60);
          img2thumb($pic2,$pic2.'.205x205.jpg',$w205,$h205);
          img2thumb($pic2,$pic2.'.470x470.jpg',$w470,$h470);
          @unlink($_FILES['pic2']['tmp_name']);
        }
      }
    }
    if($_FILES['pic3']['tmp_name']) {
      $picname = $_FILES['pic3']['name'];
      $picsize = $_FILES['pic3']['size'];
    
      if ($picname != "") {
        $type = strstr($picname, '.');
        if ($type != ".gif" && $type != ".jpg"&& $type != ".png") {
          showerror(lang('plugin/aljbd','s19'));
        }
        $rand = rand(100, 999);
        $pics = date("YmdHis") . $rand . $type;
        $pic3 = "source/plugin/aljbd/images/logo/". $pics;
        if(@copy($_FILES['pic3']['tmp_name'], $pic3)||@move_uploaded_file($_FILES['pic3']['tmp_name'], $pic3)){
          $imageinfo=getimagesize($pic3);
          $w60=$imageinfo[0]<60?$imageinfo[0]:60;
          $h60=$imageinfo[1]<60?$imageinfo[1]:60;
          $w205=$imageinfo[0]<205?$imageinfo[0]:205;
          $h205=$imageinfo[1]<205?$imageinfo[1]:205;
          $w470=$imageinfo[0]<470?$imageinfo[0]:470;
          $h470=$imageinfo[1]<470?$imageinfo[1]:470;
          img2thumb($pic3,$pic3.'.60x60.jpg',$w60,$h60);
          img2thumb($pic3,$pic3.'.205x205.jpg',$w205,$h205);
          img2thumb($pic3,$pic3.'.470x470.jpg',$w470,$h470);
          @unlink($_FILES['pic3']['tmp_name']);
        }
      }
    }
    if($_FILES['pic4']['tmp_name']) {
      $picname = $_FILES['pic4']['name'];
      $picsize = $_FILES['pic4']['size'];
    
      if ($picname != "") {
        $type = strstr($picname, '.');
        if ($type != ".gif" && $type != ".jpg"&& $type != ".png") {
          showerror(lang('plugin/aljbd','s19'));
        }
        $rand = rand(100, 999);
        $pics = date("YmdHis") . $rand . $type;
        $pic4 = "source/plugin/aljbd/images/logo/". $pics;
        if(@copy($_FILES['pic4']['tmp_name'], $pic4)||@move_uploaded_file($_FILES['pic4']['tmp_name'], $pic4)){
          $imageinfo=getimagesize($pic4);
          $w60=$imageinfo[0]<60?$imageinfo[0]:60;
          $h60=$imageinfo[1]<60?$imageinfo[1]:60;
          $w205=$imageinfo[0]<205?$imageinfo[0]:205;
          $h205=$imageinfo[1]<205?$imageinfo[1]:205;
          $w470=$imageinfo[0]<470?$imageinfo[0]:470;
          $h470=$imageinfo[1]<470?$imageinfo[1]:470;
          img2thumb($pic4,$pic4.'.60x60.jpg',$w60,$h60);
          img2thumb($pic4,$pic4.'.205x205.jpg',$w205,$h205);
          img2thumb($pic4,$pic4.'.470x470.jpg',$w470,$h470);
          @unlink($_FILES['pic4']['tmp_name']);
        }
      }
    }
    if($_FILES['pic5']['tmp_name']) {
      $picname = $_FILES['pic5']['name'];
      $picsize = $_FILES['pic5']['size'];
    
      if ($picname != "") {
        $type = strstr($picname, '.');
        if ($type != ".gif" && $type != ".jpg"&& $type != ".png") {
          showerror(lang('plugin/aljbd','s19'));
        }
        $rand = rand(100, 999);
        $pics = date("YmdHis") . $rand . $type;
        $pic5 = "source/plugin/aljbd/images/logo/". $pics;
        if(@copy($_FILES['pic5']['tmp_name'], $pic5)||@move_uploaded_file($_FILES['pic5']['tmp_name'], $pic5)){
          $imageinfo=getimagesize($pic5);
          $w60=$imageinfo[0]<60?$imageinfo[0]:60;
          $h60=$imageinfo[1]<60?$imageinfo[1]:60;
          $w205=$imageinfo[0]<205?$imageinfo[0]:205;
          $h205=$imageinfo[1]<205?$imageinfo[1]:205;
          $w470=$imageinfo[0]<470?$imageinfo[0]:470;
          $h470=$imageinfo[1]<470?$imageinfo[1]:470;
          img2thumb($pic5,$pic5.'.60x60.jpg',$w60,$h60);
          img2thumb($pic5,$pic5.'.205x205.jpg',$w205,$h205);
          img2thumb($pic5,$pic5.'.470x470.jpg',$w470,$h470);
          @unlink($_FILES['pic5']['tmp_name']);
        }
      }
    }
    C::t('#aljbd#aljbd_goods')->insert(array(
        'bid'=>$_GET['bid'],
        'uid'=>$_G['uid'],
        'name'=>$_GET['name'],
        'price1'=>$_GET['price1'],
        'price2'=>$_GET['price2'],
        'pic1'=>$pic1,
        'pic2'=>$pic2,
        'pic3'=>$pic3,
        'pic4'=>$pic4,
        'pic5'=>$pic5,
        'intro'=>$_GET['intro'],
        'dateline'=>TIMESTAMP,
    ));
    showmsg(lang('plugin/aljbd','s53'));
  }else{
    if($_GET['bid']){
      $bd=C::t('#aljbd#aljbd')->fetch($_GET['bid']);
    }
    $bdlist=C::t('#aljbd#aljbd')->fetch_all_by_status(1,'','',$_G['uid']);
    include template('aljbd:addgoods');
  }
}else if($_GET['act']=='editgoods'){
  if(submitcheck('formhash')){
    if(empty($_GET['bid'])){
      showerror(lang('plugin/aljbd','s51'));
    }
    if(empty($_GET['name'])){
      showerror(lang('plugin/aljbd','s52'));
    }
    if($_FILES['pic1']['tmp_name']) {
      $picname = $_FILES['pic1']['name'];
      $picsize = $_FILES['pic1']['size'];
    
      if ($picname != "") {
        $type = strstr($picname, '.');
        if ($type != ".gif" && $type != ".jpg"&& $type != ".png") {
          showerror(lang('plugin/aljbd','s19'));
        }
        $rand = rand(100, 999);
        $pics = date("YmdHis") . $rand . $type;
        $pic1 = "source/plugin/aljbd/images/logo/". $pics;
        if(@copy($_FILES['pic1']['tmp_name'], $pic1)||@move_uploaded_file($_FILES['pic1']['tmp_name'], $pic1)){
          $imageinfo=getimagesize($pic1);
          $w60=$imageinfo[0]<60?$imageinfo[0]:60;
          $h60=$imageinfo[1]<60?$imageinfo[1]:60;
          $w205=$imageinfo[0]<205?$imageinfo[0]:205;
          $h205=$imageinfo[1]<205?$imageinfo[1]:205;
          $w470=$imageinfo[0]<470?$imageinfo[0]:470;
          $h470=$imageinfo[1]<470?$imageinfo[1]:470;
          img2thumb($pic1,$pic1.'.60x60.jpg',$w60,$h60);
          img2thumb($pic1,$pic1.'.205x205.jpg',$w205,$h205);
          img2thumb($pic1,$pic1.'.470x470.jpg',$w470,$h470);
          @unlink($_FILES['pic1']['tmp_name']);
        }
      }
    }
    if($_FILES['pic2']['tmp_name']) {
      $picname = $_FILES['pic2']['name'];
      $picsize = $_FILES['pic2']['size'];
    
      if ($picname != "") {
        $type = strstr($picname, '.');
        if ($type != ".gif" && $type != ".jpg"&& $type != ".png") {
          showerror(lang('plugin/aljbd','s19'));
        }
        $rand = rand(100, 999);
        $pics = date("YmdHis") . $rand . $type;
        $pic2 = "source/plugin/aljbd/images/logo/". $pics;
        if(@copy($_FILES['pic2']['tmp_name'], $pic2)||@move_uploaded_file($_FILES['pic2']['tmp_name'], $pic2)){
          $imageinfo=getimagesize($pic2);
          $w60=$imageinfo[0]<60?$imageinfo[0]:60;
          $h60=$imageinfo[1]<60?$imageinfo[1]:60;
          $w205=$imageinfo[0]<205?$imageinfo[0]:205;
          $h205=$imageinfo[1]<205?$imageinfo[1]:205;
          $w470=$imageinfo[0]<470?$imageinfo[0]:470;
          $h470=$imageinfo[1]<470?$imageinfo[1]:470;
          img2thumb($pic2,$pic2.'.60x60.jpg',$w60,$h60);
          img2thumb($pic2,$pic2.'.205x205.jpg',$w205,$h205);
          img2thumb($pic2,$pic2.'.470x470.jpg',$w470,$h470);
          @unlink($_FILES['pic2']['tmp_name']);
        }
      }
    }
    if($_FILES['pic3']['tmp_name']) {
      $picname = $_FILES['pic3']['name'];
      $picsize = $_FILES['pic3']['size'];
    
      if ($picname != "") {
        $type = strstr($picname, '.');
        if ($type != ".gif" && $type != ".jpg"&& $type != ".png") {
          showerror(lang('plugin/aljbd','s19'));
        }
        $rand = rand(100, 999);
        $pics = date("YmdHis") . $rand . $type;
        $pic3 = "source/plugin/aljbd/images/logo/". $pics;
        if(@copy($_FILES['pic3']['tmp_name'], $pic3)||@move_uploaded_file($_FILES['pic3']['tmp_name'], $pic3)){
          $imageinfo=getimagesize($pic3);
          $w60=$imageinfo[0]<60?$imageinfo[0]:60;
          $h60=$imageinfo[1]<60?$imageinfo[1]:60;
          $w205=$imageinfo[0]<205?$imageinfo[0]:205;
          $h205=$imageinfo[1]<205?$imageinfo[1]:205;
          $w470=$imageinfo[0]<470?$imageinfo[0]:470;
          $h470=$imageinfo[1]<470?$imageinfo[1]:470;
          img2thumb($pic3,$pic3.'.60x60.jpg',$w60,$h60);
          img2thumb($pic3,$pic3.'.205x205.jpg',$w205,$h205);
          img2thumb($pic3,$pic3.'.470x470.jpg',$w470,$h470);
          @unlink($_FILES['pic3']['tmp_name']);
        }
      }
    }
    if($_FILES['pic4']['tmp_name']) {
      $picname = $_FILES['pic4']['name'];
      $picsize = $_FILES['pic4']['size'];
    
      if ($picname != "") {
        $type = strstr($picname, '.');
        if ($type != ".gif" && $type != ".jpg"&& $type != ".png") {
          showerror(lang('plugin/aljbd','s19'));
        }
        $rand = rand(100, 999);
        $pics = date("YmdHis") . $rand . $type;
        $pic4 = "source/plugin/aljbd/images/logo/". $pics;
        if(@copy($_FILES['pic4']['tmp_name'], $pic4)||@move_uploaded_file($_FILES['pic4']['tmp_name'], $pic4)){
          $imageinfo=getimagesize($pic4);
          $w60=$imageinfo[0]<60?$imageinfo[0]:60;
          $h60=$imageinfo[1]<60?$imageinfo[1]:60;
          $w205=$imageinfo[0]<205?$imageinfo[0]:205;
          $h205=$imageinfo[1]<205?$imageinfo[1]:205;
          $w470=$imageinfo[0]<470?$imageinfo[0]:470;
          $h470=$imageinfo[1]<470?$imageinfo[1]:470;
          img2thumb($pic4,$pic4.'.60x60.jpg',$w60,$h60);
          img2thumb($pic4,$pic4.'.205x205.jpg',$w205,$h205);
          img2thumb($pic4,$pic4.'.470x470.jpg',$w470,$h470);
          @unlink($_FILES['pic4']['tmp_name']);
        }
      }
    }
    if($_FILES['pic5']['tmp_name']) {
      $picname = $_FILES['pic5']['name'];
      $picsize = $_FILES['pic5']['size'];
    
      if ($picname != "") {
        $type = strstr($picname, '.');
        if ($type != ".gif" && $type != ".jpg"&& $type != ".png") {
          showerror(lang('plugin/aljbd','s19'));
        }
        $rand = rand(100, 999);
        $pics = date("YmdHis") . $rand . $type;
        $pic5 = "source/plugin/aljbd/images/logo/". $pics;
        if(@copy($_FILES['pic5']['tmp_name'], $pic5)||@move_uploaded_file($_FILES['pic5']['tmp_name'], $pic5)){
          $imageinfo=getimagesize($pic5);
          $w60=$imageinfo[0]<60?$imageinfo[0]:60;
          $h60=$imageinfo[1]<60?$imageinfo[1]:60;
          $w205=$imageinfo[0]<205?$imageinfo[0]:205;
          $h205=$imageinfo[1]<205?$imageinfo[1]:205;
          $w470=$imageinfo[0]<470?$imageinfo[0]:470;
          $h470=$imageinfo[1]<470?$imageinfo[1]:470;
          img2thumb($pic5,$pic5.'.60x60.jpg',$w60,$h60);
          img2thumb($pic5,$pic5.'.205x205.jpg',$w205,$h205);
          img2thumb($pic5,$pic5.'.470x470.jpg',$w470,$h470);
          @unlink($_FILES['pic5']['tmp_name']);
        }
      }
    }
    $updatearray=array(
      'bid'=>$_GET['bid'],
      'uid'=>$_G['uid'],
      'name'=>$_GET['name'],
      'price1'=>$_GET['price1'],
      'price2'=>$_GET['price2'],
      'intro'=>$_GET['intro'],
      'dateline'=>TIMESTAMP,
    );
    if($pic1){
      $updatearray['pic1']=$pic1;
    }
    if($pic2){
      $updatearray['pic2']=$pic2;
    }
    if($pic3){
      $updatearray['pic3']=$pic3;
    }
    if($pic4){
      $updatearray['pic4']=$pic4;
    }
    if($pic5){
      $updatearray['pic5']=$pic5;
    }
    C::t('#aljbd#aljbd_goods')->update($_GET['gid'],$updatearray);
    showmsg(lang('plugin/aljbd','s54'));
  }else{
    $bdlist=C::t('#aljbd#aljbd')->fetch_all_by_status(1,'','',$_G['uid']);
    $g=C::t('#aljbd#aljbd_goods')->fetch($_GET['gid']);
    include template('aljbd:addgoods');
  }
}else if($_GET['act']=='deletegoods'){
  if($_GET['formhash']!=FORMHASH){
    exit('Access Denied!');
  }
  if($_GET['gid']){
    C::t('#aljbd#aljbd_goods')->delete($_GET['gid']);
  }
  showmsg(lang('plugin/aljbd','s55'));
}else{
    $navtitle = lang('plugin/aljbd','s44').$config['title'];
    $metakeywords =  $config['keywords'];
    $metadescription = $config['description'];
    $khf=C::t('#aljbd#aljbd_comment')->count_by_bid($_GET['bid']);
    $typecount=C::t('#aljbd#aljbd')->count_by_type();
    foreach($typecount as $tc){
      $tcs[$tc['type']]=$tc['num'];
    }
    if($_GET['type']){
      $subtypecount=C::t('#aljbd#aljbd')->count_by_type($_GET['type']);
    }
    $aljbd=C::t('#aljbd#aljbd')->fetch_by_uid($_G['uid']);
    $config=$_G['cache']['plugin']['aljbd'];
    $typelist=C::t('#aljbd#aljbd_type')->range();
    $tlist=C::t('#aljbd#aljbd_type')->fetch_all_by_upid(0);
    $rlist=C::t('#aljbd#aljbd_region')->fetch_all_by_upid(0);
    $currpage=$_GET['page']?$_GET['page']:1;
    $perpage=$config['page'];
    if(submitcheck('submit')){
      
      $search=$_GET['kw'];
    
    }
    $num=C::t('#aljbd#aljbd')->count_by_status(1,'',$_GET['type'],$_GET['subtype'],$_GET['region'],$_GET['subregion'],$search);
    
    $total_page = ceil($num/$perpage);
  //debug($currpage > 1);
      //µÚÒ»Ò³µÄÊ±ºòÃ»ÓÐÉÏÒ»Ò³
    if($total_page>1){
      if($currpage > 1){
        $shangyiye='<a href="plugin.php?id=aljbd&page='.($curpage-1).'">ÉÏÒ»Ò³</a>&nbsp;&nbsp;';
      }else{
        $shangyiye='<span>'.lang('plugin/ljww360','sj_1').'</span>';
      }
      //Î²Ò³µÄÊ±ºò²»ÏÔÊ¾ÏÂÒ»Ò³
      if($currpage < $total_page){
        $xiayiye= '<a href="plugin.php?id=aljbd&page='.($curpage+1).'">ÏÂÒ»Ò³</a>&nbsp;&nbsp;';
      }else{
        $xiayiye='<span>'.lang('plugin/ljww360','sj_2').'</span>';
      }
    }
    $allpage=ceil($num/$perpage);
    $start=($currpage-1)*$perpage;
    $recommendlist=C::t('#aljbd#aljbd')->fetch_all_by_recommend(1,0,10);
    if($config['isrewrite']){
      if($_GET['order']=='1'){
        $_GET['order']='view';
      }else if($_GET['order']=='2'){
        $_GET['order']='dateline';
      }else{
        $_GET['order']='';
      }
      if($_GET['view']=='3'){
        $_GET['view']="pic";
      }else if($_GET['view']=='4'){
        $_GET['view']="list";
      }else{
        $_GET['view']='';
      }
    }
    
    $bdlist=C::t('#aljbd#aljbd')->fetch_all_by_status(1,$start,$perpage,'',$_GET['type'],$_GET['subtype'],$_GET['region'],$_GET['subregion'],$_GET['order'],$search);
    //debug($bdlist);
    foreach($bdlist as $k=>$v){
      $bdlist[$k]['c']=C::t('#aljbd#aljbd_comment')->fetch_by_bid($v['id']);
    }
    $paging = helper_page :: multi($num, $perpage, $currpage, 'plugin.php?id=aljbd&type='.$_GET['type'].'&subtype='.$_GET['subtype'].'&region='.$_GET['region'].'&subregion='.$_GET['subregion'].'&order='.$_GET['order'], 0, 11, false, false);
    include template('aljbd:list');
  
}
function showmsg($msg,$close){
  if($close){
    $str="parent.hideWindow('$close');";
  }else{
    $str="parent.location=parent.location;";
  }
  include template('aljbd:showmsg');
  exit;
}
function showerror($msg){
  include template('aljbd:showerror');
  exit;
}
function img2thumb($src_img, $dst_img, $width = 75, $height = 75, $cut = 0, $proportion = 0)
{
    if(!is_file($src_img))
    {
        return false;
    }
    $ot = fileext($dst_img);
    $otfunc = 'image' . ($ot == 'jpg' ? 'jpeg' : $ot);
    $srcinfo = getimagesize($src_img);
    $src_w = $srcinfo[0];
    $src_h = $srcinfo[1];
    $type  = strtolower(substr(image_type_to_extension($srcinfo[2]), 1));
    $createfun = 'imagecreatefrom' . ($type == 'jpg' ? 'jpeg' : $type);

    $dst_h = $height;
    $dst_w = $width;
    $x = $y = 0;

    if(($width> $src_w && $height> $src_h) || ($height> $src_h && $width == 0) || ($width> $src_w && $height == 0))
    {
        $proportion = 1;
    }
    if($width> $src_w)
    {
        $dst_w = $width = $src_w;
    }
    if($height> $src_h)
    {
        $dst_h = $height = $src_h;
    }

    if(!$width && !$height && !$proportion)
    {
        return false;
    }
    if(!$proportion)
    {
        if($cut == 0)
        {
            if($dst_w && $dst_h)
            {
                if($dst_w/$src_w> $dst_h/$src_h)
                {
                    $dst_w = $src_w * ($dst_h / $src_h);
                    $x = 0 - ($dst_w - $width) / 2;
                }
                else
                {
                    $dst_h = $src_h * ($dst_w / $src_w);
                    $y = 0 - ($dst_h - $height) / 2;
                }
            }
            else if($dst_w xor $dst_h)
            {
                if($dst_w && !$dst_h)  
                {
                    $propor = $dst_w / $src_w;
                    $height = $dst_h  = $src_h * $propor;
                }
                else if(!$dst_w && $dst_h)  
                {
                    $propor = $dst_h / $src_h;
                    $width  = $dst_w = $src_w * $propor;
                }
            }
        }
        else
        {
            if(!$dst_h)  
            {
                $height = $dst_h = $dst_w;
            }
            if(!$dst_w)  
            {
                $width = $dst_w = $dst_h;
            }
            $propor = min(max($dst_w / $src_w, $dst_h / $src_h), 1);
            $dst_w = (int)round($src_w * $propor);
            $dst_h = (int)round($src_h * $propor);
            $x = ($width - $dst_w) / 2;
            $y = ($height - $dst_h) / 2;
        }
    }
    else
    {
        $proportion = min($proportion, 1);
        $height = $dst_h = $src_h * $proportion;
        $width  = $dst_w = $src_w * $proportion;
    }

    $src = $createfun($src_img);
    $dst = imagecreatetruecolor($width ? $width : $dst_w, $height ? $height : $dst_h);
    $white = imagecolorallocate($dst, 255, 255, 255);
    imagefill($dst, 0, 0, $white);

    if(function_exists('imagecopyresampled'))
    {
        imagecopyresampled($dst, $src, $x, $y, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
    }
    else
    {
        imagecopyresized($dst, $src, $x, $y, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
    }
    $otfunc($dst, $dst_img);
    imagedestroy($dst);
    imagedestroy($src);
    return true;
}
?>