<?php
/**
 *	[90社区交友中心] (C)2012 Powered by 90_Discuz!
 *	Version: V1.0
 *	Date: 2012-8-15 18:44
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$_GET = daddslashes($_GET);
$_POST = daddslashes($_POST);
foreach(array_merge($_POST, $_GET) as $k => $v) {
	$_G['gp_'.$k] = $v;
	$_GET[$k] = $v;
}

$set= $_G['cache']['plugin']['xhuaian_makefriends'];
$offset = $set['status'];
//$admins = explode(",", $set['admins']);
$groups = unserialize($set['groups']);
$notice = $set['notice'];
$perpage = $set['perpage'];
$ad1 = $set['ad1'];
$ad2 = $set['ad2'];
$plugin_nav = lang('plugin/xhuaian_makefriends', 'main_nav');
if($offset != 1){
	showmessage(lang('plugin/xhuaian_makefriends', 'main_status'));
}elseif(!in_array($_G['groupid'], $groups)){
	showmessage(lang('plugin/xhuaian_makefriends', 'main_group'));
}

/*
$side_list = $side_lists = array();
$side_query = DB::query("SELECT * FROM ".DB::table('xhuaian_makefriends_type')." ORDER BY displayorder");
while($side_list = DB::fetch($side_query)){
	$side_lists[] = $side_list;
}
*/
$search_condition = array_merge($_GET, $_POST);


foreach($search_condition as $k => $v) {
	if(in_array($k, array('action', 'operation', 'formhash', 'submit', 'page')) || $v === '') {
		unset($search_condition[$k]);
	}
}


$myfields = array('uid','gender','birthyear','birthmonth','birthday','birthprovince','birthcity','resideprovince','residecity', 'residedist', 'residecommunity');

loadcache('profilesetting');
$fields = array();
foreach ($_G['cache']['profilesetting'] as $key => $value) {
	if($value['title'] && $value['available'] && $value['allowsearch'] && !in_array($key, $myfields)) {
		$fields[$value['fieldid']] = $value;
	}
}

$nowy = dgmdate($_G['timestamp'], 'Y');

if(!empty($_GET['searchsubmit']) || !empty($_GET['searchmode'])) {
	$_GET['searchsubmit'] = $_GET['searchmode'] = 1;
	$wherearr = $fromarr = $uidjoin = array();
	$fsql = '';

	$fromarr['member'] = DB::table('common_member').' s';

	if($searchkey = stripsearchkey($_GET['searchkey'])) {
		$wherearr[] = "s.username='$searchkey'";
		$searchkey = dhtmlspecialchars($searchkey);
	} else {
		foreach (array('uid','username','videophotostatus','avatarstatus') as $value) {
			if($_GET[$value]) {
				if($value == 'username' && empty($_GET['precision'])) {
					$_GET[$value] = stripsearchkey($_GET[$value]);
					$wherearr[] = "s.$value LIKE '%{$_GET[$value]}%'";
				} else {
					$wherearr[] = "s.$value='{$_GET[$value]}'";
				}
			}
		}
	}

	$startage = $endage = 0;
	if($_GET['endage']) {
		$startage = $nowy - intval($_GET['endage']);
	}
	if($_GET['startage']) {
		$endage = $nowy - intval($_GET['startage']);
	}

	if($startage && $endage && $endage > $startage) {
		$wherearr[] = '(sf.birthyear>='.$startage.' AND sf.birthyear<='.$endage.')';
	} else if($startage && empty($endage)) {
		$wherearr[] = 'sf.birthyear>='.$startage;
	} else if(empty($startage) && $endage) {
		$wherearr[] = 'sf.birthyear<='.$endage;
	}

	$havefield = 0;
	foreach ($myfields as $fkey) {
		$_GET[$fkey] = trim($_GET[$fkey]);
		if($_GET[$fkey]) {
			$havefield = 1;
			$wherearr[] = "sf.$fkey = '$_GET[$fkey]'";
		}
	}

	foreach ($fields as $fkey => $fvalue) {
		$_GET['field_'.$fkey] = empty($_GET['field_'.$fkey])?'':stripsearchkey($_GET['field_'.$fkey]);
		if($_GET['field_'.$fkey]) {
			$havefield = 1;
			$wherearr[] = "sf.$fkey LIKE '%".$_GET['field_'.$fkey]."%'";
		}
	}

	if($havefield || $startage || $endage) {
		$fromarr['profile'] = DB::table('common_member_profile').' sf';
		$wherearr['profile'] = "sf.uid=s.uid";
	}


	if($wherearr) {
    
	/*
	  
		$space['friends'] = array();
		$query = DB::query("SELECT fuid, fusername FROM ".DB::table('home_friend')." WHERE uid='$_G[uid]'");
		while ($value = DB::fetch($query)) {
			$space['friends'][$value['fuid']] = $value['fuid'];
		}
       */
		//$query = DB::query("SELECT s.* $fsql FROM ".implode(',', $fromarr)." WHERE ".implode(' AND ', $wherearr)." LIMIT 0,100"); 
		$countsql="SELECT count(*) FROM ".implode(',', $fromarr)." WHERE ".implode(' AND ', $wherearr);  
		$sql="SELECT s.* $fsql FROM ".implode(',', $fromarr)." WHERE ".implode(' AND ', $wherearr);
		
		/*
		while ($value = DB::fetch($query)) {
			$value['isfriend'] = ($value['uid']==$space['uid'] || $space['friends'][$value['uid']])?1:0;
			$list[$value['uid']] = $value;
		}
		*/
	}


}
else

{
	$countsql="SELECT COUNT(*) FROM ".DB::table('common_member')." WHERE status  = 0 ";
	$sql="SELECT s.* FROM ".DB::table('common_member')." s WHERE status  = 0 ";
}



	$theurl=$_SERVER['QUERY_STRING'];
	//echo $theurl;
	$theurl=preg_replace("/(\?|\&)page=(\d+)/",'',$theurl); 
	$theurl=preg_replace("/(\?|\&)id=xhuaian_makefriends%3Amain/",'',$theurl); 
	
    
	
	$page = empty($_G['page']) ? 1 : $_G['page'];
	$indexnum = DB::result_first($countsql);
	$start_limit = ($page - 1) * $perpage;
	$multipage = multi($indexnum, $perpage, $page, 'plugin.php?id=xhuaian_makefriends:main&'.$theurl, 0, 10);
	$sql = $sql." ORDER BY s.uid DESC LIMIT $start_limit, $perpage";
	
	$query = DB::query($sql);
	$index_list = $index_lists = array();
	while($index_list = DB::fetch($query)){
		$index_list['regdate '] = dgmdate($index_list['regdate'], 'd');
		$index_lists[] = $index_list;
	}
	include template('xhuaian_makefriends:main');
/*
}elseif($_G['gp_mod'] == 'cpanel'){
	require_once './source/plugin/xhuaian_makefriends/cpanel.inc.php';
}elseif($_G['gp_mod'] == 'add'){
	require_once './source/plugin/xhuaian_makefriends/add.inc.php';
}else{
	showmessage('undefined_action');
}
*/
?>