<<<<<<< HEAD
<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ob_end_clean();
ob_start();
@header("Expires: -1");
@header("Cache-Control: no-store, private, post-check=0, pre-check=0, max-age=0", FALSE);
@header("Pragma: no-cache");
@header("Content-type: text/xml; charset=".CHARSET);
=======
<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ob_end_clean();
ob_start();
@header("Expires: -1");
@header("Cache-Control: no-store, private, post-check=0, pre-check=0, max-age=0", FALSE);
@header("Pragma: no-cache");
@header("Content-type: text/xml; charset=".CHARSET);
>>>>>>> 0b8187810795a86152eeb304945027719b5e939a
echo '<?xml version="1.0" encoding="'.CHARSET.'"?>'."\r\n";?><root><![CDATA[