<<<<<<< HEAD
<?php
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
$config = array();
foreach($pluginvars as $key => $val) {
	$config[$key] = $val['value'];	
}
if($_GET['act']=='yes'){
	$typelist=C::t('#aljbd#aljbd_type')->range();
	$rlist=C::t('#aljbd#aljbd_region')->range();
	$currpage=$_GET['page']?$_GET['page']:1;
	$perpage=$config['page'];
	$num=C::t('#aljbd#aljbd')->count_by_status(1);
	$start=($currpage-1)*$perpage;
	$bdlist=C::t('#aljbd#aljbd')->fetch_all_by_status(1,$start,$perpage);
	$paging = helper_page :: multi($num, $perpage, $currpage, 'admin.php?action=plugins&operation=config&do='.$_GET['do'].'&identifier=aljbd&pmod=admin&act=yes', 0, 11, false, false);
	include template('aljbd:admin');
}else if($_GET['act']=='pass'){
	C::t('#aljbd#aljbd')->update_status_by_id($_GET['bid'],1);
	cpmsg(lang('plugin/aljbd','s11'), 'action=plugins&operation=config&do='.$_GET['do'].'&identifier=aljbd&pmod=admin', 'succeed');
}else if($_GET['act']=='refuse'){
	C::t('#aljbd#aljbd')->update_status_by_id($_GET['bid'],0);
	cpmsg(lang('plugin/aljbd','s11'), 'action=plugins&operation=config&do='.$_GET['do'].'&identifier=aljbd&pmod=admin&act=yes', 'succeed');
}else if($_GET['act']=='recommend'){
	C::t('#aljbd#aljbd')->update_recommend_by_id($_GET['bid'],1);
	cpmsg(lang('plugin/aljbd','s11'), 'action=plugins&operation=config&do='.$_GET['do'].'&identifier=aljbd&pmod=admin&act=yes', 'succeed');
}else if($_GET['act']=='unrecommend'){
	C::t('#aljbd#aljbd')->update_recommend_by_id($_GET['bid'],0);
	cpmsg(lang('plugin/aljbd','s11'), 'action=plugins&operation=config&do='.$_GET['do'].'&identifier=aljbd&pmod=admin&act=yes', 'succeed');
}else if($_GET['act']=='delete'){
	if($_GET['bid']){
		C::t('#aljbd#aljbd')->delete($_GET['bid']);
	}
	cpmsg(lang('plugin/aljbd','s50'),'action=plugins&operation=config&do='.$_GET['do'].'&identifier=aljbd&pmod=admin&act=yes');
}else if($_GET['act']=='edit'){
	if(submitcheck('submit')){
		if($_FILES['logo']['tmp_name']) {
			$picname = $_FILES['logo']['name'];
			$picsize = $_FILES['logo']['size'];
		
			if ($picname != "") {
				$type = strstr($picname, '.');
				if ($type != ".gif" && $type != ".jpg"&& $type != ".png") {
					showerror(lang('plugin/aljbd','s12'));
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
			'username'=>$_G['username'],
			'uid'=>$_G['uid'],
			'name'=>$_GET['name'],
			'tel'=>$_GET['tel'],
			'addr'=>$_GET['addr'],
			'intro'=>$_GET['intro'],
			'other'=>$_GET['other'],
			'type'=>$_GET['type'],
			'region'=>$_GET['region'],
			'subregion'=>$_GET['subregion'],
		);
		if($logo){
			$updatearray['logo']=$logo;
		}
		C::t('#aljbd#aljbd')->update($_GET['bid'],$updatearray);
		cpmsg(lang('plugin/aljbd','s13'), 'action=plugins&operation=config&do='.$_GET['do'].'&identifier=aljbd&pmod=admin&act=edit&bid='.$_GET['bid'], 'succeed');
	}else{
		$bd=C::t('#aljbd#aljbd')->fetch($_GET['bid']);
		$typelist=C::t('#aljbd#aljbd_type')->fetch_all_by_upid(0);
		$rlist=C::t('#aljbd#aljbd_region')->fetch_all_by_upid();
		include template('aljbd:aedit');
	}
}else if($_GET['act']=='dianping'){
	include template('aljbd:dianping');
}else if($_GET['act']=='commentlist'){
	$currpage=$_GET['page']?$_GET['page']:1;
	$perpage=10;
	$start=($currpage-1)*$perpage;
	$num=C::t('#aljbd#aljbd_comment')->count_by_bid_all($_GET['bid']);
	$commentlist=C::t('#aljbd#aljbd_comment')->fetch_all_by_bid_page($_GET['bid'],$start,$perpage);
	$paging = helper_page :: multi($num, $perpage, $currpage, 'admin.php?action=plugins&operation=config&do='.$_GET['do'].'&identifier=aljbd&pmod=admin&act=commentlist&bid='.$_GET['bid'], 0, 11, false, false);
	include template('aljbd:admincommentlist');
}else if($_GET['act']=='deletecomment'){
	C::t('#aljbd#aljbd_comment')->delete($_GET['cid']);
	$currpage=$_GET['page']?$_GET['page']:1;
	$perpage=10;
	$num=C::t('#aljbd#aljbd_comment')->count_by_bid_all($_GET['bid']);
	$commentlist=C::t('#aljbd#aljbd_comment')->fetch_all_by_bid_page($_GET['bid'],$start,$perpage);
	$paging = helper_page :: multi($num, $perpage, $currpage, 'admin.php?action=plugins&operation=config&do='.$_GET['do'].'&identifier=aljbd&pmod=admin&act=commentlist&bid='.$_GET['bid'], 0, 11, false, false);
	include template('aljbd:commentlist');
}else if($_GET['act']=='adv'){
	if(submitcheck('formhash')){
		for($i=1;$i<=3;$i++){
			if($_FILES['adv']['tmp_name'][$i]) {
				$picname = $_FILES['adv']['name'][$i];
				$picsize = $_FILES['adv']['size'][$i];
			
				if ($picname != "") {
					$type = strstr($picname, '.');
					if ($type != ".gif" && $type != ".jpg"&& $type != ".png") {
						showerror(lang('plugin/aljbd','s12'));
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
		showmsg(lang('plugin/aljbd','s14'),'edit');
	}
	$bd=C::t('#aljbd#aljbd')->fetch($_GET['bid']);
	$adv=unserialize($bd['adv']);
	$advurl=unserialize($bd['advurl']);
	include template('aljbd:adminadv');
}else if($_GET['act']=='gg'){
	if(submitcheck('formhash')){
		C::t('#aljbd#aljbd')->update($_GET['bid'],array('gg'=>$_GET['gg']));
		showmsg(lang('plugin/aljbd','s15'),'edit');
	}
	$bd=C::t('#aljbd#aljbd')->fetch($_GET['bid']);
	include template('aljbd:admingg');
}else if($_GET['act']=='mark'){
	$bd=C::t('#aljbd#aljbd')->fetch($_GET['bid']);
	if(submitcheck('formhash','get')){
		if($bd['uid']!=$_G['uid']&&$_G['groupid']!=1){
			C::t('#aljbd#aljbd_point')->insert(array('uid'=>$_G['uid'],'username'=>$_G['username'],'bid'=>$_GET['bid'],'name'=>$bd['name'],'x'=>$_GET['x'],'y'=>$_GET['y'],'dateline'=>TIMESTAMP));
			echo lang('plugin/aljbd','s16');
		}else{
			C::t('#aljbd#aljbd')->update($_GET['bid'],array('x'=>$_GET['x'],'y'=>$_GET['y']));
			echo lang('plugin/aljbd','s17');
		}
	}else{
		include template('aljbd:mark');
	}
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
		include template('aljbd:adminiwantclaim');
	}
}else{
	$typelist=C::t('#aljbd#aljbd_type')->range();
	$rlist=C::t('#aljbd#aljbd_region')->range();
	$currpage=$_GET['page']?$_GET['page']:1;
	$perpage=$config['page'];
	$num=C::t('#aljbd#aljbd')->count_by_status(0);
	$start=($currpage-1)*$perpage;
	$bdlist=C::t('#aljbd#aljbd')->fetch_all_by_status(0,$start,$perpage);
	$paging = helper_page :: multi($num, $perpage, $currpage, 'admin.php?action=plugins&operation=config&do='.$_GET['do'].'&identifier=aljbd&pmod=admin', 0, 11, false, false);	
	include template('aljbd:admin');
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
=======
<?php
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
$config = array();
foreach($pluginvars as $key => $val) {
	$config[$key] = $val['value'];	
}
if($_GET['act']=='yes'){
	$typelist=C::t('#aljbd#aljbd_type')->range();
	$rlist=C::t('#aljbd#aljbd_region')->range();
	$currpage=$_GET['page']?$_GET['page']:1;
	$perpage=$config['page'];
	$num=C::t('#aljbd#aljbd')->count_by_status(1);
	$start=($currpage-1)*$perpage;
	$bdlist=C::t('#aljbd#aljbd')->fetch_all_by_status(1,$start,$perpage);
	$paging = helper_page :: multi($num, $perpage, $currpage, 'admin.php?action=plugins&operation=config&do='.$_GET['do'].'&identifier=aljbd&pmod=admin&act=yes', 0, 11, false, false);
	include template('aljbd:admin');
}else if($_GET['act']=='pass'){
	C::t('#aljbd#aljbd')->update_status_by_id($_GET['bid'],1);
	cpmsg(lang('plugin/aljbd','s11'), 'action=plugins&operation=config&do='.$_GET['do'].'&identifier=aljbd&pmod=admin', 'succeed');
}else if($_GET['act']=='refuse'){
	C::t('#aljbd#aljbd')->update_status_by_id($_GET['bid'],0);
	cpmsg(lang('plugin/aljbd','s11'), 'action=plugins&operation=config&do='.$_GET['do'].'&identifier=aljbd&pmod=admin&act=yes', 'succeed');
}else if($_GET['act']=='recommend'){
	C::t('#aljbd#aljbd')->update_recommend_by_id($_GET['bid'],1);
	cpmsg(lang('plugin/aljbd','s11'), 'action=plugins&operation=config&do='.$_GET['do'].'&identifier=aljbd&pmod=admin&act=yes', 'succeed');
}else if($_GET['act']=='unrecommend'){
	C::t('#aljbd#aljbd')->update_recommend_by_id($_GET['bid'],0);
	cpmsg(lang('plugin/aljbd','s11'), 'action=plugins&operation=config&do='.$_GET['do'].'&identifier=aljbd&pmod=admin&act=yes', 'succeed');
}else if($_GET['act']=='delete'){
	if($_GET['bid']){
		C::t('#aljbd#aljbd')->delete($_GET['bid']);
	}
	cpmsg(lang('plugin/aljbd','s50'),'action=plugins&operation=config&do='.$_GET['do'].'&identifier=aljbd&pmod=admin&act=yes');
}else if($_GET['act']=='edit'){
	if(submitcheck('submit')){
		if($_FILES['logo']['tmp_name']) {
			$picname = $_FILES['logo']['name'];
			$picsize = $_FILES['logo']['size'];
		
			if ($picname != "") {
				$type = strstr($picname, '.');
				if ($type != ".gif" && $type != ".jpg"&& $type != ".png") {
					showerror(lang('plugin/aljbd','s12'));
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
			'username'=>$_G['username'],
			'uid'=>$_G['uid'],
			'name'=>$_GET['name'],
			'tel'=>$_GET['tel'],
			'addr'=>$_GET['addr'],
			'intro'=>$_GET['intro'],
			'other'=>$_GET['other'],
			'type'=>$_GET['type'],
			'region'=>$_GET['region'],
			'subregion'=>$_GET['subregion'],
		);
		if($logo){
			$updatearray['logo']=$logo;
		}
		C::t('#aljbd#aljbd')->update($_GET['bid'],$updatearray);
		cpmsg(lang('plugin/aljbd','s13'), 'action=plugins&operation=config&do='.$_GET['do'].'&identifier=aljbd&pmod=admin&act=edit&bid='.$_GET['bid'], 'succeed');
	}else{
		$bd=C::t('#aljbd#aljbd')->fetch($_GET['bid']);
		$typelist=C::t('#aljbd#aljbd_type')->fetch_all_by_upid(0);
		$rlist=C::t('#aljbd#aljbd_region')->fetch_all_by_upid();
		include template('aljbd:aedit');
	}
}else if($_GET['act']=='dianping'){
	include template('aljbd:dianping');
}else if($_GET['act']=='commentlist'){
	$currpage=$_GET['page']?$_GET['page']:1;
	$perpage=10;
	$start=($currpage-1)*$perpage;
	$num=C::t('#aljbd#aljbd_comment')->count_by_bid_all($_GET['bid']);
	$commentlist=C::t('#aljbd#aljbd_comment')->fetch_all_by_bid_page($_GET['bid'],$start,$perpage);
	$paging = helper_page :: multi($num, $perpage, $currpage, 'admin.php?action=plugins&operation=config&do='.$_GET['do'].'&identifier=aljbd&pmod=admin&act=commentlist&bid='.$_GET['bid'], 0, 11, false, false);
	include template('aljbd:admincommentlist');
}else if($_GET['act']=='deletecomment'){
	C::t('#aljbd#aljbd_comment')->delete($_GET['cid']);
	$currpage=$_GET['page']?$_GET['page']:1;
	$perpage=10;
	$num=C::t('#aljbd#aljbd_comment')->count_by_bid_all($_GET['bid']);
	$commentlist=C::t('#aljbd#aljbd_comment')->fetch_all_by_bid_page($_GET['bid'],$start,$perpage);
	$paging = helper_page :: multi($num, $perpage, $currpage, 'admin.php?action=plugins&operation=config&do='.$_GET['do'].'&identifier=aljbd&pmod=admin&act=commentlist&bid='.$_GET['bid'], 0, 11, false, false);
	include template('aljbd:commentlist');
}else if($_GET['act']=='adv'){
	if(submitcheck('formhash')){
		for($i=1;$i<=3;$i++){
			if($_FILES['adv']['tmp_name'][$i]) {
				$picname = $_FILES['adv']['name'][$i];
				$picsize = $_FILES['adv']['size'][$i];
			
				if ($picname != "") {
					$type = strstr($picname, '.');
					if ($type != ".gif" && $type != ".jpg"&& $type != ".png") {
						showerror(lang('plugin/aljbd','s12'));
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
		showmsg(lang('plugin/aljbd','s14'),'edit');
	}
	$bd=C::t('#aljbd#aljbd')->fetch($_GET['bid']);
	$adv=unserialize($bd['adv']);
	$advurl=unserialize($bd['advurl']);
	include template('aljbd:adminadv');
}else if($_GET['act']=='gg'){
	if(submitcheck('formhash')){
		C::t('#aljbd#aljbd')->update($_GET['bid'],array('gg'=>$_GET['gg']));
		showmsg(lang('plugin/aljbd','s15'),'edit');
	}
	$bd=C::t('#aljbd#aljbd')->fetch($_GET['bid']);
	include template('aljbd:admingg');
}else if($_GET['act']=='mark'){
	$bd=C::t('#aljbd#aljbd')->fetch($_GET['bid']);
	if(submitcheck('formhash','get')){
		if($bd['uid']!=$_G['uid']&&$_G['groupid']!=1){
			C::t('#aljbd#aljbd_point')->insert(array('uid'=>$_G['uid'],'username'=>$_G['username'],'bid'=>$_GET['bid'],'name'=>$bd['name'],'x'=>$_GET['x'],'y'=>$_GET['y'],'dateline'=>TIMESTAMP));
			echo lang('plugin/aljbd','s16');
		}else{
			C::t('#aljbd#aljbd')->update($_GET['bid'],array('x'=>$_GET['x'],'y'=>$_GET['y']));
			echo lang('plugin/aljbd','s17');
		}
	}else{
		include template('aljbd:mark');
	}
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
		include template('aljbd:adminiwantclaim');
	}
}else{
	$typelist=C::t('#aljbd#aljbd_type')->range();
	$rlist=C::t('#aljbd#aljbd_region')->range();
	$currpage=$_GET['page']?$_GET['page']:1;
	$perpage=$config['page'];
	$num=C::t('#aljbd#aljbd')->count_by_status(0);
	$start=($currpage-1)*$perpage;
	$bdlist=C::t('#aljbd#aljbd')->fetch_all_by_status(0,$start,$perpage);
	$paging = helper_page :: multi($num, $perpage, $currpage, 'admin.php?action=plugins&operation=config&do='.$_GET['do'].'&identifier=aljbd&pmod=admin', 0, 11, false, false);	
	include template('aljbd:admin');
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
>>>>>>> 534bf6aeb8124b634e72f48c38723b0305ca5919
?>