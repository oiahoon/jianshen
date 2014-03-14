<?php
if(!defined('IN_DISCUZ')) {
  exit('Access Denied');
}
class table_aljbd extends discuz_table{
  public function __construct() {

      $this->_table = 'aljbd';
      $this->_pk    = 'id';

      parent::__construct();
  }
  public function count_by_status($status,$uid,$type,$subtype,$region,$subregion,$search){
    $con[]=$this->_table;
    $where='where 1 ';
    if($uid){
      $con[]=$uid;
      $where.='and uid=%d';
    }
    if($status||$status=='0'){
      $con[]=$status;
      $where.=' and status=%d';
    }
    if($type){
      $con[]=$type;
      $where.=' and type=%d';
    }
    if($subtype){
      $con[]=$subtype;
      $where.=' and subtype=%d';
    }
    if($region){
      $con[]=$region;
      $where.=' and region=%d';
    }
    if($subregion){
      $con[]=$subregion;
      $where.=' and subregion=%d';
    }
    
    if($search){
      $con[]='%'.addcslashes($search, '%_').'%';
      
      $where.=" and name like %s";
    }//debug('select count(*) from %t '.$where);
    return DB::result_first('select count(*) from %t '.$where,$con);
  }
  public function fetch_all_by_recommend($recommend,$start,$perpage){
    return DB::fetch_all('select * from %t where recommend=%d limit %d,%d',array($this->_table,$recommend,$start,$perpage));
  }
  public function fetch_all_by_status($status,$start,$perpage,$uid,$type,$subtype,$region,$subregion,$order,$search){
    $con[]=$this->_table;
    $where='where 1 ';
    if(isset($status)){
      $con[]=$status;
      $where.='and status=%d';
    }
    if($uid){
      $con[]=$uid;
      $where.=' and uid=%d';
    }
    if($type){
      $con[]=$type;
      $where.=' and type=%d';
    }
    if($subtype){
      $con[]=$subtype;
      $where.=' and subtype=%d';
    }
    if($region){
      $con[]=$region;
      $where.=' and region=%d';
    }
    if($subregion){
      $con[]=$subregion;
      $where.=' and subregion=%d';
    }
    if($search){
      $con[]='%'.addcslashes($search, '%_').'%';
      
      $where.=" and name like %s";
    }
    if($order){
      $where.=' order by '.addslashes($order).' desc';
    }else{
      $where.=' order by comment desc';
    }
    if(!empty($perpage)){
      $con[]=$start;
      $con[]=$perpage;
      $where.=' limit %d,%d';
    }
    return DB::fetch_all('select * from %t '.$where,$con);
  }
  public function update_status_by_id($id,$status){
    return DB::query('update %t set status=%d where id=%d',array($this->_table,$status,$id));
  }
  public function update_recommend_by_id($id,$recommend){
    return DB::query('update %t set recommend=%d where id=%d',array($this->_table,$recommend,$id));
  }
  public function fetch_by_uid($uid){
    return DB::fetch_first('select * from %t where uid=%d',array($this->_table,$uid));
  }
  public function update_view_by_bid($bid){
    return DB::query('update %t set view=view+1 where id=%d',array($this->_table,$bid));
  }
  public function update_comment_by_bid($bid){
    return DB::query('update %t set comment=comment+1 where id=%d',array($this->_table,$bid));
  }
  public function count_by_type(){
    return DB::fetch_all('select type,count(*) num from %t where status=1 group by type',array($this->_table));
  }
  public function count_by_subtype($type){
    return DB::fetch_all('select subtype,count(*) num from %t where status=1 and type=%d group by subtype',array($this->_table,$type));
  }
  public function count_by_region(){
    return DB::fetch_all('select region,count(*) num from %t where status=1 group by region',array($this->_table));
  }
  public function search_by_subject($subject){
    return DB::fetch_all('select region,count(*) num from %t where status=1 group by region',array($this->_table));
  }
  public function fetch_thread_all_block($con,$sc,$items){
    return DB::fetch_all("select * from %t $con $sc limit 0,%d",array($this->_table,$items));
  }

  // 更新活动
  public function update_activities_by_bid($bid, $activities){
    return DB::query('update %t set activities=%a where id=%d',array($this->_table, $activities, $bid));
  }
}




?>