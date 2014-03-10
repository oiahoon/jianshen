<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
class table_aljbd_extensions extends discuz_table{
	public function __construct() {

			$this->_table = 'aljbd_extensions';
			$this->_pk    = 'id';

			parent::__construct();
	}

	public function fetch_by_bid($bid){
	    return DB::fetch_first('select * from %t where bid=%d',array($this->_table,$bid));
	  }

}




?>