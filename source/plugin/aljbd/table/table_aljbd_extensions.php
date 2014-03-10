<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
class table_aljbd_extensions extends discuz_table{
	public function __construct() {

			$this->_table = 'aljbd_extensions';
			$this->_pk    = 'eid';

			parent::__construct();
	}

}




?>