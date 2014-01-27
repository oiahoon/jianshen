<?php echo 'Oiahoon www.oiahoon.com';exit;?>
 <!--{if $_G['uid']}-->
					
						
							<li><strong class="vwmy{if $_G['setting']['connect']['allow'] && $_G[member][conisbind]} qq{/if}"><a href="home.php?mod=space&uid=$_G[uid]" target="_blank" title="{lang visit_my_space}">{$_G[member][username]}</a></strong></li>
							
							<!--{hook/global_usernav_extra1}-->
                            
							<li><!--{hook/global_usernav_extra4}--><a href="home.php?mod=spacecp">{lang setup}</a></li>
							<li><a href="home.php?mod=space&do=pm" id="pm_ntc"{if $_G[member][newpm]} class="new"{/if}>{lang pm_center}</a></li>
							<li><a href="home.php?mod=space&do=notice" id="myprompt"{if $_G[member][newprompt]} class="new"{/if}>{lang remind}<!--{if $_G[member][newprompt]}-->($_G[member][newprompt])<!--{/if}--></a><span id="myprompt_check"></span>
							<!--{if $_G['setting']['taskon'] && !empty($_G['cookie']['taskdoing_'.$_G['uid']])}--><a href="home.php?mod=task&item=doing" id="task_ntc" class="new">{lang task_doing}</a><!--{/if}--></li>
							<!--{if ($_G['group']['allowmanagearticle'] || $_G['group']['allowpostarticle'] || $_G['group']['allowdiy'] || getstatus($_G['member']['allowadmincp'], 4) || getstatus($_G['member']['allowadmincp'], 6) || getstatus($_G['member']['allowadmincp'], 2) || getstatus($_G['member']['allowadmincp'], 3))}-->
								<li><a href="portal.php?mod=portalcp"><!--{if $_G['setting']['portalstatus'] }-->{lang portal_manage}<!--{else}-->{lang portal_block_manage}<!--{/if}--></a></li>
							<!--{/if}-->
							<!--{if $_G['uid'] && $_G['group']['radminid'] > 1}-->
								<li><a href="forum.php?mod=modcp&fid=$_G[fid]" target="_blank">{lang forum_manager}</a></li>
							<!--{/if}-->
							<!--{if $_G['uid'] && $_G['adminid'] == 1 && $_G['setting']['cloud_status']}-->
								<li><a href="admin.php?frames=yes&action=cloud&operation=applist" target="_blank">{lang cloudcp}</a></li>
							<!--{/if}-->
							<!--{if $_G['uid'] && getstatus($_G['member']['allowadmincp'], 1)}-->
								<li><a href="admin.php" target="_blank">{lang admincp}</a></li>
							<!--{/if}-->
							<!--{hook/global_usernav_extra2}-->
							<li><a href="member.php?mod=logging&action=logout&formhash={FORMHASH}">{lang logout}</a></li>
						
							<!--{hook/global_usernav_extra3}-->
							<!--{eval $upgradecredit = $_G['uid'] && $_G['group']['grouptype'] == 'member' && $_G['group']['groupcreditslower'] != 999999999 ? $_G['group']['groupcreditslower'] - $_G['member']['credits'] : false;}-->
							
						
					
					<!--{elseif !empty($_G['cookie']['loginuser'])}-->
					
						<li><strong><a id="loginuser" class="noborder"><!--{echo dhtmlspecialchars($_G['cookie']['loginuser'])}--></a></strong></li>
						<li><a href="member.php?mod=logging&action=login" onClick="showWindow('login', this.href)">{lang activation}</a></li>
						<li><a href="member.php?mod=logging&action=logout&formhash={FORMHASH}">{lang logout}</a></li>
					
					<!--{elseif !$_G[connectguest]}-->
                        
                        <li><a href="connect.php?mod=login&op=init&referer=index.php&statfrom=login_simple" class="qq2" style="padding-left:18px;">QQ</a></li>
                        <li><a rel="nofollow" href="member.php?mod=logging&action=login" class="xi2">{lang login}</a></li>
                        <li><a href="member.php?mod={$_G[setting][regname]}" class="xi2">$_G['setting']['reglinkname']</a></li>
					<!--{else}-->
					
						
						
							<li><strong class="vwmy qq">{$_G[member][username]}</strong></li>
							<!--{hook/global_usernav_extra1}-->
							<li><a href="member.php?mod=logging&action=logout&formhash={FORMHASH}">{lang logout}</a>
						
							<li><a href="home.php?mod=spacecp&ac=credit&showcredit=1">{lang credits}: 0</a>
							<li>{lang usergroup}: $_G[group][grouptitle]
					
					
					<!--{/if}-->