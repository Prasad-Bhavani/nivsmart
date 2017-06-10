<?php

$entereddate=date("Y-m-d h:i:s");

function DBDATE($date){
	return date('Y-m-d H:i:s',strtotime($date));
}

function addRecord($table,$data){
	$colums="";
	$value="";
	foreach($data as $k=>$v){
		$colums .= $k.",";
		$value   .= "'".mysql_real_escape_string(trim($v))."',";
	}
	$colums=rtrim($colums,",");
	$value=rtrim($value,",");
	$ins="insert into ".$table." (".$colums.") values(".$value.")";
	if(@mysql_query($ins)) return @mysql_insert_id();
	else die(mysql_error());
}

function updateRecord($table,$data,$where=''){
	if($where) $where=' where '.$where;
	$rec="";
	foreach($data as $k=>$v){
		$rec.=$k."='".mysql_real_escape_string(trim($v))."',";
	}
	$rec=rtrim($rec,",");
	$update="update ".$table." set ".$rec.$where;
	if(@mysql_query($update)) return "Success";
	else die(mysql_error());
}

function getDuplicate($table,$where=''){
	if($where) $where=' where '.$where;
	$sql = "select id from ".$table.$where;
	$run=@mysql_query($sql);
	return @mysql_num_rows($run);
}

function parseArray($arr){
	
	return array_map(function($var) {    
    return is_numeric($var) ? (float)$var : $var;
	}, $arr);	
}

function getRecords($table,$where=''){
	$data=array();
	if($where) $where=" where ".$where; else $where=' order by id desc';
	$sql=@mysql_query("select * from ".$table.$where."");
	$count=@mysql_num_rows($sql);
	if($count>0){
		while($rec=mysql_fetch_assoc($sql)){
			$data[]=parseArray($rec);
		}
		return $data;
	}
	else return 0;
}

function getRecord($table,$where){
	if($where) $where=' where '.$where;
	$sql=@mysql_query("select * from ".$table.$where);
	$count=@mysql_num_rows($sql);
	if($count==1) {
		$rec=@mysql_fetch_assoc($sql);
		return $rec;
	}
}

function getQueryRecord($query){
	$sql=@mysql_query($query);
	$count=@mysql_num_rows($sql);
	if($count==1) {
		$rec=@mysql_fetch_assoc($sql);
		return $rec;
	}
	else return $count;
}

function getQueryRecords($sql){
	$data=array();
	$run=@mysql_query($sql);
	$count=@mysql_num_rows($run);
	if($count>0){
		while($rec=mysql_fetch_assoc($run)){
			$data[]=$rec;
		}
		return $data;
	}
}

function deleteRecord($table,$where=''){
	if($where) $where=' where '.$where;
	$sql=@mysql_query("delete from ".$table.$where);
	if($sql) echo 1;
}

function getNextId($table){
	$sql=@mysql_query("select max(id) as id from ".$table);
	$id=@mysql_fetch_array($sql);
	return $id['id']+1;
}

function randomPassword($length){
$chars='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
	$pass="";
	for($i=0;$i<$length;$i++){
		$pass .=$chars[mt_rand(0, strlen($chars)-1)];
	}
	return $pass;
}

function redirect($url){
	header('Location:'.$url);
	exit;
}

function arrayToString($data)
{
		$val="";
		foreach ($data as $value) {
			$val.=$value;
		}
		return rtrim($val,', ');
}

function getExtension($str)
{
	$i = strrpos($str,".");
	if (!$i) { return ""; } $l = strlen($str) - $i; $ext = substr($str,$i+1,$l);
	return $ext;
}

function imageCompress($source, $destination, $quality) {
		$info = getimagesize($source);
		if ($info['mime'] == 'image/jpeg') $image = imagecreatefromjpeg($source);
		elseif ($info['mime'] == 'image/gif') $image = imagecreatefromgif($source);
		elseif ($info['mime'] == 'image/png') $image = imagecreatefrompng($source);
		imagejpeg($image, $destination, $quality);
		return $destination;
}

/*function getBranchEMPS($branch)
{
	$recs=getQueryRecords('select id,emp_branch_ids from '.EMP.' where emp_branch_ids like "%'.$branch.',%"');
	foreach($recs as $recs)
	{
		echo $recs['id'].' '.$recs['emp_branch_ids'].'<br />';
	}
}*/

function checkBranchHeadbyDept($deptid,$roleid,$branch,$empid='')
{
	$val="";
	if($deptid) $val.='emp_dept_id='.$deptid.' and ';
	if($roleid) $val.='emp_role_id='.$roleid.' and ';
	if($empid) $val.='id!='.$empid.' and ';
	$recs=getQueryRecords('select id,emp_branch_ids from '.EMP.' where '.$val.' emp_branch_ids like "%'.$branch.',%" and emp_status=1');
	if($recs>0)
	{
		$count=1;
	}
	else $count=0;

	return $count;
}

function getBranchsIFnoHead($deptid,$roleid,$empid='')
{
	$recs=getQueryRecords('select id,branch_name from '.BRANCHES.' where status=1');

	if($recs>0)
	{
		$ids='';
		foreach($recs as $recs)
		{
			$count=checkBranchHeadbyDept($deptid,$roleid,$recs['id'],$empid);
			if($count==0)
			{
				$ids.= $recs['id'].',';
			}
		}
		$ids=rtrim($ids,',');
		$recs=getRecords(BRANCHES,'id in ('.$ids.')');
		return $recs;
	}
}

function changeEMPLabel()
{
	$recs=getQueryRecords('select e.id,r.label,e.emp_id from '.EMP.' e join '.DEPTROLES.' r where e.emp_role_id=r.id and e.id!=1');
	foreach($recs as $rec)
	{
	    $data['emp_id']=$rec['label'].substr($rec['emp_id'],-3);
	    $data['emp_last_updated_date_time']=CDATE;
	    updateRecord(EMP,$data,'id='.$rec['id']);
	}
}
?>