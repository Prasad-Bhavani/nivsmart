<?php
$data=[];

function login()
{
	extract($_POST);
	$where='emp_id="'.mysql_real_escape_string(trim($userid)).'" and emp_pass="'.mysql_real_escape_string(trim($password)).'"';
	$count=getDuplicate(EMP,$where);
	if($count==1)
	{
		$where='emp_id="'.mysql_real_escape_string(trim($userid)).'" and emp_pass="'.mysql_real_escape_string(trim($password)).'" and emp_status=1';
		$count=getDuplicate(EMP,$where);
		if($count==1)
		{
			$rec=getRecord(EMP,$where);
			$_SESSION['nivsmartid']=$rec['id'];
			checkLogin($_SESSION['nivsmartid']);	
		}
		else
		{
			$_SESSION['msg']='<span style="color:red">Please Active Your Account</span>';
			return $_SESSION['msg'];
		}
	}
	else return 'Error';
}

function checkLogin($empid)
{
	$rec=getRecord(EMP,'id="'.$empid.'"');
	$_SESSION['niv_deptid']=$rec['emp_dept_id'];
	$_SESSION['niv_roleid']=$rec['emp_role_id'];

	// Master Login
	if($rec['emp_dept_id']==1 && $rec['emp_role_id']==1)
	{
		redirect('master/dashboard.php');
	}
	else // Admin Login
	if($rec['emp_dept_id']==1 && $rec['emp_role_id']==2)
	{
		redirect('admin/branchselection.php');
	}
	else // Marketing Head & Executive Login
	if($rec['emp_dept_id']==3 && ($rec['emp_role_id']==3 || $rec['emp_role_id']==4))
	{
		redirect('ME/branchselection.php');
	}
	else // Marketing Lead Manager Login
	if($rec['emp_dept_id']==3 && $rec['emp_role_id']==5)
	{
		redirect('LM/branchselection.php');
	}
	else // Marketing Telecaller Login
	if($rec['emp_dept_id']==3 && $rec['emp_role_id']==14)
	{
		redirect('MT/branchselection.php');
	}
	else // Marketing Sales,Service,Solution Head Login
	if(($rec['emp_dept_id']==4 && $rec['emp_role_id']==6) || ($rec['emp_dept_id']==5 && $rec['emp_role_id']==8) || ($rec['emp_dept_id']==6 && $rec['emp_role_id']==10))
	{
		redirect('SH/branchselection.php');
	}
	else // Marketing Sales,Service,Solution Executive Login
	if(($rec['emp_dept_id']==4 && $rec['emp_role_id']==7) || ($rec['emp_dept_id']==5 && $rec['emp_role_id']==9) || ($rec['emp_dept_id']==6 && $rec['emp_role_id']==11))
	{
		redirect('SE/branchselection.php');
	}
	else // Accountant Login
	if($rec['emp_dept_id']==7 && $rec['emp_role_id']==12)
	{
		redirect('AC/branchselection.php');
	}
	else // Feed Back Telecaller Login
	if($rec['emp_dept_id']==8 && $rec['emp_role_id']==13)
	{
		redirect('FT/branchselection.php');
	}
}

function getEMPBranches($empid)
{
	$rec=getQueryRecord('select id,emp_branch_ids from '.EMP.' where id="'.$empid.'"');

	if($rec['id'])
	{
		$recs=getQueryRecords('select id,branch_name,phno,email from '.BRANCHES.' where id in ('.rtrim($rec['emp_branch_ids'],',').')');
		return $recs;
	}
}

function getRemainingBranches($empid)
{
	$rec=getQueryRecord('select id,emp_branch_ids from '.EMP.' where id="'.$empid.'"');

	if($rec['id'])
	{
		$recs=getQueryRecords('select id,branch_name from '.BRANCHES.' where id not in ('.rtrim($rec['emp_branch_ids'],',').')');
		return $recs;
	}
}

function getBranch($branch,$empid)
{
	$rec=getQueryRecord('select id,emp_branch_ids from '.EMP.' where id="'.$empid.'"');
	$branchrecs=getQueryRecords('select id,branch_name from '.BRANCHES.' where branch_name!="'.$branch.'" and id in ('.rtrim($rec['emp_branch_ids'],',').')');
	return $branchrecs;
}

if(!empty($_SESSION['niv_branch'])) 
{
	$branchrecs=getBranch($_SESSION['niv_branch'],$_SESSION['nivsmartid']);
}

if(!empty($_SESSION['nivsmartid']))
{
	function getEMpDetails()
	{
		return getQueryRecord('select e.emp_name,e.emp_grade_id,d.dept,r.role from '.EMP.' e join '.DEPARTMENTS.' d on d.id=e.emp_dept_id join '.DEPTROLES.' r on r.id=e.emp_role_id where e.id='.$_SESSION['nivsmartid']);
	}
}

function getColdLead($id,$status)
{
	$rec=getQueryRecord('select c.company_name,c.contact_no_1,c.contact_person,c.contact_no_2,c.addr,l.*,s.state,city.city,r.referred_company,r.referred_person,r.referred_contact_no from '.CRMLEADS.' l join '.CUSTOMERDETAILS.' c on c.id=l.customer_id join '.STATES.' s on s.id=c.state_id join '.CITIES.' city on city.id=c.city_id join '.EMP.' emp on emp.id=l.created_emp_id LEFT JOIN '.CRMREFERREDCUSTOMER.' r on r.id=l.if_referred where l.id='.$id);

	if($status!=0)
	{
		$coldhistory=getQueryRecords('select c.cold_remarks,c.last_updated_date_time,c.lead_taken_date_time,emp.emp_id from '.COLDLEADS.' c join '.EMP.' emp on emp.id=c.lead_taken_empid where leadid='.$id.' and lead_status=0 order by c.id asc');
	}
	else $coldhistory=0;
	$result=array('rec'=>$rec,'coldhistory'=>$coldhistory);

	return $result;
}

function getColdLeadforEdit($id)
{
	$rec=getQueryRecord('select c.company_name,c.contact_no_1,c.contact_no_2,c.contact_person,c.addr,c.state_id,c.city_id, l.*,r.referred_person,r.referred_company,r.referred_contact_no from '.CRMLEADS.' l join '.CUSTOMERDETAILS.' c on c.id=l.customer_id LEFT join '.CRMREFERREDCUSTOMER.' r on r.id=l.if_referred where l.id='.$id);
	$recs=getQueryRecords('select id,city from '.CITIES.' where state_id='.$rec['state_id']);
	$business_names=getQueryRecords('select id,business_name from '.BUSINESS.' where business_type_id='.$rec['nature_of_business_type']);

	$data=array('rec'=>$rec,'recs'=>$recs,'business_names'=>$business_names);

	return $data;
}

function getHotLeadforEdit($id)
{
	$rec=getQueryRecord('select c.company_name,c.contact_no_1,c.contact_no_2,c.contact_person,c.addr,c.state_id,c.city_id, l.*,r.referred_person,r.referred_company,r.referred_contact_no from '.CRMLEADS.' l join '.CUSTOMERDETAILS.' c on c.id=l.customer_id LEFT join '.CRMREFERREDCUSTOMER.' r on r.id=l.if_referred where l.id='.$id);
	$recs=getQueryRecords('select id,city from '.CITIES.' where state_id='.$rec['state_id']);
	$business_names=getQueryRecords('select id,business_name from '.BUSINESS.' where business_type_id='.$rec['nature_of_business_type']);
	if($rec['if_prospect']!=0) $pros=getQueryRecords('select id,product_name from '.PRODUCTS.' where product_type_id='.$rec['prospect_type_id']);
	else $pros='';

	$data=array('rec'=>$rec,'recs'=>$recs,'business_names'=>$business_names,'pros'=>$pros);

	return $data;
}

function getLeadManagerColdLeads()
{
	$branch_id=getQueryRecord('select id from '.BRANCHES.' where branch_name="'.$_SESSION['niv_branch'].'"');
	$recs=getQueryRecords('select c.company_name,c.contact_no_1,c.contact_person,emp.emp_id,l.id,l.lead_id,l.status,lp.is_remarks,lp.is_updated_date_time,lp.is_status from '.CRMLEADS.' l join '.CUSTOMERDETAILS.' c on c.id=l.customer_id join '.EMP.' emp on emp.id=l.created_emp_id join '.DEPTROLES.' role on role.id=emp.emp_role_id LEFT join '.LEADPROCESS.' lp on lp.id=l.last_process_id where l.lead_branch_id='.$branch_id['id'].' and l.status in (0,6) and l.is_upgrade=0 and l.if_prospect=0 and l.if_interest_demo=0 and is_present=0');
	if($recs=='') $recs=0;

	return $recs;
}

function getLeadManagerHotLeads()
{
	$branch_id=getQueryRecord('select id from '.BRANCHES.' where branch_name="'.$_SESSION['niv_branch'].'"');
	$recs=getQueryRecords('select c.company_name,c.contact_no_1,emp.emp_id,c.contact_person,l.id,l.lead_id,l.if_interest_demo,l.demo_date_time,l.status from '.CRMLEADS.' l join '.CUSTOMERDETAILS.' c on c.id=l.customer_id join '.EMP.' emp on emp.id=l.created_emp_id where l.lead_branch_id='.$branch_id['id'].' and (l.is_upgrade=1 or l.if_prospect=1 or l.if_interest_demo=1) and l.lead_dept_id=0 and l.status=0 and is_present=0 order by l.id desc');
	if($recs=='') $recs=0;

	return $recs;
}

function getLeadManagerHotInboxLeads()
{
	$branch_id=getQueryRecord('select id from '.BRANCHES.' where branch_name="'.$_SESSION['niv_branch'].'"');
	$recs=getQueryRecords('select c.company_name,c.contact_no_1,emp.emp_id,c.contact_person,l.id,l.lead_id,l.if_interest_demo,l.demo_date_time,l.status,l.lead_dept_id from '.CRMLEADS.' l join '.CUSTOMERDETAILS.' c on c.id=l.customer_id join '.EMP.' emp on emp.id=l.created_emp_id where l.lead_branch_id='.$branch_id['id'].' and is_present='.$_SESSION['nivsmartid'].' and status=5');
	if($recs=='') $recs=0;

	return $recs;
}

function getFollowupLeads()
{
	$branch_id=getQueryRecord('select id from '.BRANCHES.' where branch_name="'.$_SESSION['niv_branch'].'"');
	$recs=getQueryRecords('select c.company_name,c.contact_no_1,c.contact_person,emp.emp_id,l.id,l.lead_id,l.status,f.followup_date_time,l.lead_dept_id from '.CRMLEADS.' l join '.CUSTOMERDETAILS.' c on c.id=l.customer_id join '.EMP.' emp on emp.id=l.created_emp_id join '.DEPTROLES.' role on role.id=emp.emp_role_id LEFT join '.FOLLOWUP.' f on f.lead_process_id=l.last_process_id where l.lead_branch_id='.$branch_id['id'].' and l.status=3 and l.is_present='.$_SESSION['nivsmartid'].' order by f.followup_date_time asc');
	if($recs=='') $recs=0;

	return $recs;
}

function getLeadManagerColdInboxLeads()
{
	$branch_id=getQueryRecord('select id from '.BRANCHES.' where branch_name="'.$_SESSION['niv_branch'].'"');
		$recs=getQueryRecords('select c.company_name,c.contact_no_1,c.contact_person,emp.emp_id,l.id,l.lead_id,l.status,lp.is_remarks,lp.is_taken_date_time,lp.is_updated_date_time,lp.is_status from '.CRMLEADS.' l join '.CUSTOMERDETAILS.' c on c.id=l.customer_id join '.EMP.' emp on emp.id=l.created_emp_id LEFT join '.LEADPROCESS.' lp on lp.id=l.last_process_id where l.lead_branch_id='.$branch_id['id'].' and l.is_upgrade=0 and l.if_prospect=0 and l.if_interest_demo=0 and l.is_present='.$_SESSION['nivsmartid'].' group by lp.leadid order by lp.is_updated_date_time asc');
	if($recs=='') $recs=0;

	return $recs;
}

function getHotLeads()
{
	$branch_id=getQueryRecord('select id from '.BRANCHES.' where branch_name="'.$_SESSION['niv_branch'].'"');
	$recs=getQueryRecords('select c.company_name,c.contact_no_1,emp.emp_id,c.contact_person,l.id,l.lead_id,l.if_interest_demo,l.demo_date_time,l.status from '.CRMLEADS.' l join '.CUSTOMERDETAILS.' c on c.id=l.customer_id join '.EMP.' emp on emp.id=l.created_emp_id where l.lead_branch_id='.$branch_id['id'].' and (l.is_upgrade=1 or l.if_prospect=1 or l.if_interest_demo=1) and l.lead_dept_id=0 and l.status=0 and is_present=0 order by l.id desc');
	if($recs=='') $recs=0;

	return $recs;
}

function getHotInboxLeads()
{
	$branch_id=getQueryRecord('select id from '.BRANCHES.' where branch_name="'.$_SESSION['niv_branch'].'"');
	$recs=getQueryRecords('select c.company_name,c.contact_no_1,emp.emp_id,c.contact_person,l.id,l.lead_id,l.if_interest_demo,l.demo_date_time,l.status,l.lead_dept_id from '.CRMLEADS.' l join '.CUSTOMERDETAILS.' c on c.id=l.customer_id join '.EMP.' emp on emp.id=l.created_emp_id where l.lead_branch_id='.$branch_id['id'].' and (l.is_upgrade=1 or l.if_prospect=1 or l.if_interest_demo=1) and l.lead_dept_id=0 and l.status in (0,5) and l.is_present='.$_SESSION['nivsmartid'].' order by l.id desc');
	if($recs=='') $recs=0;

	return $recs;
}

function getTeleHotLeads()
{
	$branch_id=getQueryRecord('select id from '.BRANCHES.' where branch_name="'.$_SESSION['niv_branch'].'"');
	$recs=getQueryRecords('select c.company_name,c.contact_no_1,emp.emp_id,c.contact_person,l.id,l.lead_id,l.if_interest_demo,l.demo_date_time,l.status,l.lead_dept_id from '.CRMLEADS.' l join '.CUSTOMERDETAILS.' c on c.id=l.customer_id join '.EMP.' emp on emp.id=l.created_emp_id where l.lead_branch_id='.$branch_id['id'].' and is_present='.$_SESSION['nivsmartid'].' and status!=3 and (l.is_upgrade=1 or l.if_prospect=1 or l.if_interest_demo=1)');
	if($recs=='') $recs=0;

	return $recs;
}

function getTeleColdLeads()
{
	$branch_id=getQueryRecord('select id from '.BRANCHES.' where branch_name="'.$_SESSION['niv_branch'].'"');
	$recs=getQueryRecords('select c.company_name,c.contact_no_1,emp.emp_id,c.contact_person,l.id,l.lead_id,l.if_interest_demo,l.demo_date_time,l.status,l.lead_dept_id from '.CRMLEADS.' l join '.CUSTOMERDETAILS.' c on c.id=l.customer_id join '.EMP.' emp on emp.id=l.created_emp_id where l.lead_branch_id='.$branch_id['id'].' and is_present='.$_SESSION['nivsmartid'].' and l.is_upgrade=0 and l.if_prospect=0 and l.if_interest_demo=0');
	if($recs=='') $recs=0;

	return $recs;
}

function getCRMHeadLeads()
{
	$branch_id=getQueryRecord('select id from '.BRANCHES.' where branch_name="'.$_SESSION['niv_branch'].'"');
	$empbranchid=getQueryRecord('select emp_dept_id from '.EMP.' where id='.$_SESSION['nivsmartid']);
	$recs=getQueryRecords('select c.company_name,c.contact_no_1,emp.emp_id,c.contact_person,l.id,l.lead_id,l.if_interest_demo,l.demo_date_time,l.status,emp.emp_dept_id from '.CRMLEADS.' l join '.CUSTOMERDETAILS.' c on c.id=l.customer_id join '.EMP.' emp on emp.id=l.created_emp_id where l.lead_branch_id='.$branch_id['id'].' and l.status=5 and l.is_present=0 and l.lead_dept_id='.$empbranchid['emp_dept_id'].' order by l.id desc');
	if($recs=='') $recs=0;

	return $recs;
}

function getCRMHeadInboxLeads()
{
	$branch_id=getQueryRecord('select id from '.BRANCHES.' where branch_name="'.$_SESSION['niv_branch'].'"');
	$empbranchid=getQueryRecord('select emp_dept_id from '.EMP.' where id='.$_SESSION['nivsmartid']);
	$recs=getQueryRecords('select c.company_name,c.contact_no_1,emp.emp_id,c.contact_person,l.id,l.lead_id,l.nature_of_business_type,l.if_interest_demo,l.demo_date_time,l.status,l.lead_verified,emp.emp_dept_id,q.id as qid,cus.id as serial_no from '.CRMLEADS.' l join '.CUSTOMERDETAILS.' c on c.id=l.customer_id join '.EMP.' emp on emp.id=l.created_emp_id LEFT join '.QUOTATION.' q on q.leadid=l.id LEFT join '.TALLY_CUSTOMERS.' cus on cus.leadid=l.id where l.lead_branch_id='.$branch_id['id'].' and (l.status=5 or l.status=4) and l.is_present='.$_SESSION['nivsmartid'].' order by l.id desc');
	if($recs=='') $recs=0;

	return $recs;
}

function getCreatedLeads()
{
	$branch_id=getQueryRecord('select id from '.BRANCHES.' where branch_name="'.$_SESSION['niv_branch'].'"');
		$recs=getQueryRecords('select c.company_name,c.contact_no_1,c.contact_person,l.id,l.lead_id,l.created_date_time,l.lead_completed,l.status,d.dept as dept,emp.emp_id as is_present from '.CRMLEADS.' l join '.CUSTOMERDETAILS.' c on c.id=l.customer_id LEFT join '.EMP.' emp on emp.id=l.is_present LEFT join '.DEPARTMENTS.' d on d.id=l.lead_dept_id where l.created_emp_id='.$_SESSION['nivsmartid'].' and l.lead_branch_id='.$branch_id['id'].' order by l.id desc');
		if($recs=='') $recs=0;

		return $recs;
}

function getLeadsCountByStatus($status,$branch='',$where='')
{
	$count=0;
	$data=[];
	$branchcount=[];
	$statuscount=[];
	if($_SESSION['nivsmartid']==1) $whr=' where 1';
	else
	{
		$branchids=getQueryRecord('select emp_branch_ids as id from '.EMP.' where id='.$_SESSION['nivsmartid']);
		$branchids=rtrim($branchids['id'],',');
		$whr=' where id in ('.$branchids.')';
	}
	$branches=getQueryRecords('select id,branch_name from '.BRANCHES.$whr);
	foreach($branches as $branches)
	{
		for($i=1;$i<count($status);$i++)
		{
			$count=getDuplicate(CRMLEADS,'status='.$status[$i]['id'].' and lead_branch_id='.$branches['id'].$where);
			$statuscount[$status[$i]['id']]=$count;
		}
		$data[$branches['id']]=array('branchid'=>$branches['id'],'branch_name'=>$branches['branch_name'],'count'=>$statuscount);
	}
	return $data;
}

function getLeadsCountByProduct($status,$products,$branch='',$where='')
{
	$count=0;
	$data=[];
	$branchcount=[];
	$statuscount=[];
	foreach($products as $products)
	{
		for($i=1;$i<count($status);$i++)
		{
			$count=getDuplicate(CRMLEADS,'status='.$status[$i]['id'].' and lead_type_id='.$products['prodcutid'].$where);
			$statuscount[$status[$i]['id']]=$count;
		}
		$data[$products['id']]=array('productid'=>$products['prodcutid'],'product_name'=>$products['label'],'count'=>$statuscount);
	}
	return $data;
}

function getAllLeads()
{
		$recs=getQueryRecords('select c.company_name,c.contact_no_1,c.contact_person,l.id,l.lead_id,l.created_date_time,l.status,d.dept as dept,emp.emp_id as is_present from '.CRMLEADS.' l join '.CUSTOMERDETAILS.' c on c.id=l.customer_id LEFT join '.EMP.' emp on emp.id=l.is_present LEFT join '.DEPARTMENTS.' d on d.id=l.lead_dept_id order by l.id desc');
		if($recs=='') $recs=0;

		return $recs;
}

function getACUNTLeads()
{
	$branch_id=getQueryRecord('select id from '.BRANCHES.' where branch_name="'.$_SESSION['niv_branch'].'"');
	$empbranchid=getQueryRecord('select emp_dept_id from '.EMP.' where id='.$_SESSION['nivsmartid']);
	$recs=getQueryRecords('select c.company_name,c.contact_no_1,emp.emp_id,c.contact_person,l.id,l.lead_id,l.if_interest_demo,l.demo_date_time,l.status,emp.emp_dept_id,l.prospect_type_id from '.CRMLEADS.' l join '.CUSTOMERDETAILS.' c on c.id=l.customer_id join '.EMP.' emp on emp.id=l.created_emp_id where l.lead_branch_id='.$branch_id['id'].' and l.status=5 and l.is_present=0 and l.lead_dept_id='.$empbranchid['emp_dept_id'].' order by l.id desc');
	if($recs=='') $recs=0;

	return $recs;
}

function getFEEDBACKLeads()
{
	$branch_id=getQueryRecord('select id from '.BRANCHES.' where branch_name="'.$_SESSION['niv_branch'].'"');
	$recs=getQueryRecords('select c.company_name,c.contact_no_1,emp.emp_id,c.contact_person,l.id,l.lead_id,l.if_interest_demo,l.demo_date_time,l.status from '.CRMLEADS.' l join '.CUSTOMERDETAILS.' c on c.id=l.customer_id join '.EMP.' emp on emp.id=l.created_emp_id where l.lead_branch_id='.$branch_id['id'].' and (l.status=2 || l.status=4) and is_present=0 and lead_completed=0 order by l.id desc');
	if($recs=='') $recs=0;

	return $recs;
}

function getFEEDBACKInboxLeads()
{
	$branch_id=getQueryRecord('select id from '.BRANCHES.' where branch_name="'.$_SESSION['niv_branch'].'"');
	$recs=getQueryRecords('select c.company_name,c.contact_no_1,emp.emp_id,c.contact_person,l.id,l.lead_id,l.if_interest_demo,l.demo_date_time,l.status from '.CRMLEADS.' l join '.CUSTOMERDETAILS.' c on c.id=l.customer_id join '.EMP.' emp on emp.id=l.created_emp_id where l.lead_branch_id='.$branch_id['id'].' and (l.status=2 || l.status=4) and is_present='.$_SESSION['nivsmartid'].' order by l.id desc');
	if($recs=='') $recs=0;

	return $recs;
}

/*
if($_SESSION['nivsmartid']=='ABCD11')
{
	$id='';
	$ids='1040';
	$id=explode(',',$ids);
	foreach ($id as $id) {
		moveToHotInbox1($id);
	}	
}
*/

function moveToHotInbox1($id)
{
	$count=getDuplicate(CRMLEADS,'id='.$id.' and status=0');
		if($count==1)
		{
			$rec=getRecord(CRMLEADS,'id='.$id);

				$lpdata['leadid']=$id;
				$lpdata['tele_id']=$_SESSION['nivsmartid'];
				$lpdata['is_present_at']=$_SESSION['nivsmartid'];
				$lpdata['is_taken_date_time']=CDATE;
				$pid=addRecord(LEADPROCESS,$lpdata);
				$ldata['status']=5;
				$ldata['last_process_id']=$pid;
				$ldata['assign_tele_id']=$_SESSION['nivsmartid'];
				$ldata['is_present']=$_SESSION['nivsmartid'];
				updateRecord(CRMLEADS,$ldata,'id='.$id);

			$result=1;
		}
}

function saveEMPAttendance($data)
{
	extract($data);
	$rec=getRecord(EMPATTENDANCE,'emp_id='.$empid.' and month_year="'.date('M-Y').'"');
	if($rec=='')
	{
		$attend['emp_id']						= $empid;
		$attend['month_year']					= date('M-Y');
		$attend['date']							= date('d');
		$attend['time']							= date('h:i a');
		$attend['status']						= $status;
		$attend['absent_session']	= $absent_session;
		$attend['remarks']						= str_replace('*','-',$remarks);
		addRecord(EMPATTENDANCE,$attend);
		$result=1;
	}
	else
	{
		$attend['emp_id']						= $empid;
		$attend['month_year']					= date('M-Y');
		$attend['date']							= $rec['date'].'*'.date('d');
		$attend['time']							= $rec['time'].'*'.date('h:i a');
		$attend['status']						= $rec['status'].'*'.$status;
		$attend['absent_session']				= $rec['absent_session'].'*'.$absent_session;
		$attend['remarks']						= $rec['remarks'].'*'.str_replace('*','-',$remarks);
		updateRecord(EMPATTENDANCE,$attend,'id='.$rec['id']);
		$result=1;
	}
	return $result;
}

//if(date('H i')=='15 11') checkandupdateEMPAttendance();

function checkandupdateEMPAttendance()
{
	$emps=getQueryRecords('select id from '.EMP.' where emp_dept_id!=1');
	foreach($emps as $emp)
	{
		$check=getRecord(EMPATTENDANCE,'emp_id='.$emp['id'].' and month_year="'.date('M-Y').'" and date like "%'.date('d').'%"');
		if($check=='')
		{
			$data['empid']=$emp['id'];
			$data['status']=0;
			$data['absent_session']=3;
			$data['remarks']='NA';

			saveEMPAttendance($data);
		}
	}
}

function getMonthlyFollowupLeads()
{
	$recs=getQueryRecords('select mon.*,l.lead_id,tallycus.serial_no,cus.company_name,cus.contact_no_1,cus.contact_person from '.MONTHLYFOLLOWUP.' mon join '.CRMLEADS.' l on l.id=mon.leadid join '.TALLY_CUSTOMERS.' tallycus on tallycus.leadid=l.id join '.CUSTOMERDETAILS.' cus on cus.id=l.customer_id where mon.monthly_status=0 and mon.empid=0 and followupdate<="'.date('Y-m-d').'"');
		if($recs=='') $recs=0;
	return $recs;
}

function getAMCCreatedLeads()
{
	/*$branch_id=getQueryRecord('select id from '.BRANCHES.' where branch_name="'.$_SESSION['niv_branch'].'"');*/
		$recs=getQueryRecords('select c.company_name,c.contact_no_1,c.contact_person,l.id,l.amc_lead_id,l.created_date_time,l.tally_serial_no from '.AMCLEADS.' l join '.CUSTOMERDETAILS.' c on c.id=l.customer_id where 1 order by l.id desc');
		if($recs=='') $recs=0;

		return $recs;
}
?>