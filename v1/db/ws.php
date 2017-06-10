<?php
include_once('headers.php');

if($_SERVER['REQUEST_METHOD']=='POST'){

if(!empty($_SESSION['nivsmartid']))
{
	if($_GET['path']=='addState')
	{
		extract((array)$request);

		$data['state']=$state;
		if(!isset($id)) $data['status']=1;
		if(!isset($id)) $data['created_date_time']=CDATE; else $data['updated_date_time']=CDATE;
		if(isset($id)) $where='state="'.$state.'" and id!='.$id;
		else $where='state="'.$state.'"';
		$count=getDuplicate(STATES,$where);
		if($count==0)
		{
			if(isset($id)) $run=updateRecord(STATES,$data,'id='.$id);
			else $run=addRecord(STATES,$data);
			$recs=getRecords(STATES,'1 order by state asc');
			if($recs=='') $recs=0;
			$sql['recs']=$recs;
			$sql['status']=1;
		}
		else $sql['status']=0;

		echo json_encode($sql);
	}
	else
	if($_GET['path']=='getStates')
	{
		if(isset($status)) $recs=getRecords(STATES,'status='.$status.' order by state asc');
		else $recs=getRecords(STATES,'1 order by state asc');
		if($recs=='') $recs=0;
		echo json_encode($recs);
	}
	else
	if($_GET['path']=='getState')
	{
		$rec=getRecord(STATES,'id='.$id);
		echo json_encode($rec);
	}
	else
	if($_GET['path']=='changeStateStatus')
	{
		$data['status']=$status;
		$data['updated_date_time']=CDATE;
		$rec=updateRecord(STATES,$data,'id='.$id);
		$recs=getRecords(STATES,'1 order by state asc');
		if($recs=='') $recs=0;

		echo json_encode($recs);
	}
	else
	if($_GET['path']=='addCity')
	{
		extract((array)$request);
		$data['state_id']=$state_id;
		$data['city']=$city;
		if(!isset($id)) $data['status']=1;
		if(!isset($id)) $data['created_date_time']=CDATE;
		if(isset($id)) $data['updated_date_time']=CDATE;
		if(isset($id)) $where='state_id="'.$state_id.'" and city="'.$city.'" and id!='.$id;
		else $where='state_id="'.$state_id.'" and city="'.$city.'"';
		$count=getDuplicate(CITIES,$where);
		if($count==0)
		{
			if(!isset($id))	addRecord(CITIES,$data);
			else updateRecord(CITIES,$data,'id='.$id);
			$query='select s.state, c.* from '.CITIES.' c join '.STATES.' s on s.id=c.state_id order by c.id desc';
			$recs=getQueryRecords($query);
			if($recs=='') $recs=0;
			$sql['recs']=$recs;
			$sql['status']=1;
		}
		else $sql['status']=0;

		echo json_encode($sql);
	}
	else
	if($_GET['path']=='getCities')
	{
		$query='select s.state, c.* from '.CITIES.' c join '.STATES.' s on s.id=c.state_id order by c.id desc';
		$recs=getQueryRecords($query);
		if($recs=='') $recs=0;

		echo json_encode($recs);
	}
	else
	if($_GET['path']=='changeCityStatus')
	{
		$data['status']=$status;
		$data['updated_date_time']=CDATE;
		$rec=updateRecord(CITIES,$data,'id='.$id);
		$query='select s.state, c.* from '.CITIES.' c join '.STATES.' s on s.id=c.state_id order by c.id desc';
		$recs=getQueryRecords($query);
		if($recs=='') $recs=0;

		echo json_encode($recs);
	}
	else
	if($_GET['path']=='getCity')
	{
		$rec=getRecord(CITIES,'id='.$id);
		echo json_encode($rec);
	}
	else
	if($_GET['path']=='getCitiesByStateId')
	{
		$recs=getQueryRecords('select id,city from '.CITIES.' where state_id='.$state_id.' and status='.$status.' order by city asc');
		if($recs=='') $recs=0;
		echo json_encode($recs);
	}
	else
	if($_GET['path']=='addBranch')
	{
		extract((array)$request);
		$data['branch_name']=$branch_name;
		$data['phno']=$phno;
		$data['email']=$email;
		$data['state_id']=$state_id;
		$data['city_id']=$city_id;
		$data['addr']=$addr;
		$data['status']=$status;
		if(!isset($id)) $data['created_date_time']=CDATE;
		if(isset($id)) $data['updated_date_time']=CDATE;
		if(isset($id)) $where='branch_name="'.$branch_name.'" and id!='.$id;
		else $where='branch_name="'.$branch_name.'"';
		$count=getDuplicate(BRANCHES,$where);
		if($count==0)
		{
			if(!isset($id)) addRecord(BRANCHES,$data);
			else updateRecord(BRANCHES,$data,'id='.$id);
			$query='select s.state, c.city, b.* from '.BRANCHES.' b join '.CITIES.' c on c.id=b.city_id join '.STATES.' s on s.id=c.state_id order by b.id desc';
			$recs=getQueryRecords($query);
			if($recs=='') $recs=0;
			$sql['recs']=$recs;
			$sql['status']=1;
		}
		else $sql['status']=0;

		echo json_encode($sql);
	}
	else
	if($_GET['path']=='getBranches')
	{
		$query='select s.state, c.city, b.* from '.BRANCHES.' b join '.CITIES.' c on c.id=b.city_id join '.STATES.' s on s.id=c.state_id order by b.id desc';
		$recs=getQueryRecords($query);
		if($recs=='') $recs=0;

		echo json_encode($recs);
	}
	else
	if($_GET['path']=='changeBranchStatus')
	{
		$data['status']=$status;
		$data['updated_date_time']=CDATE;
		$rec=updateRecord(BRANCHES,$data,'id='.$id);
		$query='select s.state, c.city, b.* from '.BRANCHES.' b join '.CITIES.' c on c.id=b.city_id join '.STATES.' s on s.id=c.state_id order by b.branch_name desc';
		$recs=getQueryRecords($query);
		if($recs=='') $recs=0;

		echo json_encode($recs);
	}
	else
	if($_GET['path']=='getBranch')
	{
		$rec=getRecord(BRANCHES,'id='.$id);
		$recs=getQueryRecords('select id,city from '.CITIES.' where state_id='.$rec["state_id"].' and status=1 order by city asc');
		if($recs=='') $recs=0;
		$data=array('branch'=>$rec,'cities'=>$recs);
		echo json_encode($data);
	}
	else
	if($_GET['path']=='getProductTypes')
	{
		$recs=getRecords(PRODUCTTYPES,'1 order by type asc');
		if($recs=='') $recs=0;
		echo json_encode($recs);
	}
	else
	if($_GET['path']=='addProduct')
	{
		extract((array)$request);
		$product_name=str_replace('*', '-', $product_name);
		$data['product_type_id']=$product_type_id;
		$data['product_name']=$product_name;
		if(!isset($id)) $data['status']=1;
		if(!isset($id)) $data['created_date_time']=CDATE;
		if(isset($id)) $data['updated_date_time']=CDATE;
		if(isset($id)) $where='product_type_id="'.$product_type_id.'" and product_name="'.$product_name.'" and id!='.$id;
		else $where='product_type_id="'.$product_type_id.'" and product_name="'.$product_name.'"';
		$count=getDuplicate(PRODUCTS,$where);
		if($count==0)
		{
			if(!isset($id)) addRecord(PRODUCTS,$data);
			else updateRecord(PRODUCTS,$data,'id='.$id);
			$query='select pt.type, p.* from '.PRODUCTS.' p join '.PRODUCTTYPES.' pt on pt.id=p.product_type_id order by p.id desc';
			$recs=getQueryRecords($query);
			if($recs=='') $recs=0;
			$sql['recs']=$recs;
			$sql['status']=1;
		}
		else $sql['status']=0;

		echo json_encode($sql);
	}
	else
	if($_GET['path']=='getProducts')
	{
		$query='select pt.type, p.* from '.PRODUCTS.' p join '.PRODUCTTYPES.' pt on pt.id=p.product_type_id order by p.id desc';
		$recs=getQueryRecords($query);
		if($recs=='') $recs=0;

		echo json_encode($recs);
	}
	else
	if($_GET['path']=='changeProductStatus')
	{
		$data['status']=$status;
		$data['updated_date_time']=CDATE;
		$rec=updateRecord(PRODUCTS,$data,'id='.$id);
		$query='select pt.type, p.* from '.PRODUCTS.' p join '.PRODUCTTYPES.' pt on pt.id=p.product_type_id order by p.id desc';
		$recs=getQueryRecords($query);
		if($recs=='') $recs=0;

		echo json_encode($recs);
	}
	else
	if($_GET['path']=='getProduct')
	{
		$rec=getRecord(PRODUCTS,'id='.$id);
		echo json_encode($rec);
	}
	else
	if($_GET['path']=='addBusiness')
	{
		extract((array)$request);
		$data['business_type_id']=$business_type_id;
		$data['business_name']=$business_name;
		if(!isset($id)) $data['status']=1;
		if(isset($id)) $where='business_type_id="'.$business_type_id.'" and business_name="'.$business_name.'" and id!='.$id;
		else $where='business_type_id="'.$business_type_id.'" and business_name="'.$business_name.'"';
		$count=getDuplicate(BUSINESS,$where);
		if($count==0)
		{
			if(!isset($id)) addRecord(BUSINESS,$data);
			else updateRecord(BUSINESS,$data,'id='.$id);
			$query='select * from '.BUSINESS.' order by id desc';
			$recs=getQueryRecords($query);
			if($recs=='') $recs=0;
			$sql['recs']=$recs;
			$sql['status']=1;
		}
		else $sql['status']=0;

		echo json_encode($sql);
	}
	else
	if($_GET['path']=='getBusiness')
	{
		$query='select * from '.BUSINESS.' order by id desc';
		$recs=getQueryRecords($query);
		if($recs=='') $recs=0;

		echo json_encode($recs);
	}
	else
	if($_GET['path']=='changeBusinessStatus')
	{
		$data['status']=$status;
		$rec=updateRecord(BUSINESS,$data,'id='.$id);
		$query='select * from '.BUSINESS.' order by id desc';
		$recs=getQueryRecords($query);
		if($recs=='') $recs=0;

		echo json_encode($recs);
	}
	else
	if($_GET['path']=='getBusinessName')
	{
		$rec=getRecord(BUSINESS,'id='.$id);
		echo json_encode($rec);
	}
	else
	if($_GET['path']=='getDepartments')
	{
		$recs=getRecords(DEPARTMENTS,'status=1 and is_view=1 order by dept asc');
		if($recs=='') $recs=0;
		echo json_encode($recs);
	}
	else
	if($_GET['path']=='getEmpRolesByDeptID')
	{
		if(isset($is_master)) $where=' where r.dept_id='.$dept_id;
		else $where=' where r.dept_id='.$dept_id.' and r.id!=1';
		$query='select dept.dept, r.* from '.DEPTROLES.' r join '.DEPARTMENTS.' dept on dept.id=r.dept_id '.$where.' order by r.id asc';
		$recs=getQueryRecords($query);
		if($recs=='') $recs=0;
		echo json_encode($recs);
	}
	else
	if($_GET['path']=='getActiveBranchesByRoles')
	{
		$row=getQueryRecord('select multiple_branches,is_multiple,role from '.DEPTROLES.' where id='.$roleid);
		$rec['multiple_branches']=$row['multiple_branches'];
		if($row['is_multiple']==0) $recs=getBranchsIFnoHead($deptid,$roleid,$pid);
		else $recs=getRecords(BRANCHES,'status=1');
		if($recs=='') $recs=0;
		$data=array('rec'=>$rec,'recs'=>$recs,'role'=>$row['role']);
		echo json_encode($data);
	}
	else
	if($_GET['path']=='createEMP')
	{
		extract((array)$request);
		
		if(isset($id)) $rec=getDuplicate(EMP,"emp_email='".$emp_email."' and id!=".$id);
		else $rec=getDuplicate(EMP,"emp_email='".$emp_email."'");

		if($rec==0)
		{
			$roleid=getQueryRecord('select label, role from '.DEPTROLES.' where id='.$emp_role_id);

			$data['emp_pass']='12345';
			$data['emp_dept_id']=$emp_dept_id;
			$data['emp_role_id']=$emp_role_id;
			$data['emp_branch_ids']=$emp_branch_ids;
			//$data['emp_grade_id']=$emp_grade_id;
			$data['emp_email']=$emp_email;
			$data['emp_name']=$emp_name;
			$data['emp_phone_no']=$emp_phone_no;
			$data['emp_state_id']=$emp_state_id;
			$data['emp_city_id']=$emp_city_id;
			$data['emp_addr']=$emp_addr;
			$data['emp_education']=$emp_education;
			if(!empty($emp_pan_no)) $data['emp_pan_no']=$emp_pan_no;
			$data['emp_bank_name']=$emp_bank_name;
			$data['emp_bank_ac_no']=$emp_bank_ac_no;
			$data['emp_bank_branch']=$emp_bank_branch;
			$data['emp_bank_ifsc_code']=$emp_bank_ifsc_code;
			$data['emp_status']=$emp_status;
			if(!isset($id)) $data['emp_created_date_time']=CDATE; else $data['emp_last_updated_date_time']=CDATE;
			
			if(isset($id) && !empty($id))
			{
				$rec['status']=updateRecord(EMP,$data,'id='.$id);
				echo json_encode($rec['status']);
			}
			else
			{
				$sql=addRecord(EMP,$data);
				if($sql) 
				{
					$id=$sql;
					$data1['emp_id']=$roleid['label'].str_pad($id, 3, 0, STR_PAD_LEFT);
					updateRecord(EMP,$data1,'id='.$sql);
					$row=getQueryRecord('select role from '.DEPTROLES.' where id='.$emp_role_id);
					if($row['role']=='Head')
					{
						$branch=explode(',', $emp_branch_ids);
						foreach($branch as $branch)
						{
							$data2['head_id']=$id;
							updateRecord(BRANCHES,$data2,'id='.$branch);
						}
					}
					$res['status']=1;
					echo json_encode($res);
				}
				else 
				{
					$res['status']=0;
					echo json_encode($res);
				}				
			}
		}
		else 
		{
			$res['status']=2;
			echo json_encode($res);
		}
	}
	else
	if($_GET['path']=='getEMPS')
	{
		if($_SESSION['nivsmartid']!=1)
		{
			//$branch_id=getRecord(EMP,'id='.$_SESSION['nivsmartid']);
			if($_SESSION['niv_deptid']!=1) $where=' and e.emp_branch_ids like "%'.$_SESSION['niv_branchid'].',%" and e.emp_dept_id='.$_SESSION['niv_deptid'].' and e.emp_role_id!='.$_SESSION['niv_roleid'];
			else $where=' and e.emp_branch_ids like "%'.$_SESSION['niv_branchid'].',%" and e.emp_role_id!='.$_SESSION['niv_roleid'];
		}
		else $where='';

		$recs=getQueryRecords('select e.id,e.emp_id,e.emp_name,e.emp_phone_no,e.emp_status,d.dept as emp_dept,r.role as emp_role from '.EMP.' e join '.DEPTROLES.' r on r.id=emp_role_id join '.DEPARTMENTS.' d on d.id=emp_dept_id where e.id!=1'.$where);
		if($recs=='') $recs=0;
		echo json_encode($recs);
	}
	else
	if($_GET['path']=='getEMP')
	{
		$rec=getQueryRecord('select e.*,d.dept as emp_dept,r.role as emp_role from '.EMP.' e join '.DEPTROLES.' r on r.id=emp_role_id join '.DEPARTMENTS.' d on d.id=emp_dept_id where e.id='.$id);
		$ids=rtrim($rec['emp_branch_ids'],',');
		$rows=getQueryRecords('select branch_name from '.BRANCHES.' where id in ('.$ids.')');
		if($rows=='') $rows=0;
		$data[]=array_merge($rec,$rows);
		echo json_encode($data);
	}
	else
	if($_GET['path']=='changeEMPStatus')
	{
		$data['emp_status']=$status;
		$data['emp_last_updated_date_time']=CDATE;
		$rec=updateRecord(EMP,$data,'id='.$id);
		$recs=getQueryRecords('select e.id,e.emp_id,e.emp_name,e.emp_phone_no,e.emp_status,d.dept as emp_dept,r.role as emp_role from '.EMP.' e join '.DEPTROLES.' r on r.id=emp_role_id join '.DEPARTMENTS.' d on d.id=emp_dept_id where e.id!=1');
		if($recs=='') $recs=0;
		echo json_encode($recs);
	}
	else
	if($_GET['path']=='getLeadFields')
	{
		$states=getQueryRecords('select id,state from '.STATES.' where status=1 order by state asc');
		$products=getQueryRecords('select id,type from '.PRODUCTTYPES.' where 1 order by type asc');
		$branches=getQueryRecords('select id,branch_name from '.BRANCHES.' where status=1 order by branch_name asc');
		if($states=='') $states=0;
		if($products=='') $products=0;
		if($branches=='') $branches=0;
		$data=array('states'=>$states,'products'=>$products,'branches'=>$branches);

		echo json_encode($data);
	}
	else
	if($_GET['path']=='getSearchFields')
	{
		$depts=getQueryRecords('select id,dept from '.DEPARTMENTS.' where id not in (1,10) order by dept asc');
		if($depts=='') $depts=0;

		$emps=getQueryRecords('select id,emp_id,emp_name from '.EMP.' order by id asc');
		if($emps=='') $emps=0;

		$data=array('depts'=>$depts,'emps'=>$emps);

		echo json_encode($data);
	}
	else
	if($_GET['path']=='getRolesbyDept')
	{
		$roles=getQueryRecords('select id,role from '.DEPTROLES.' where dept_id='.$dept_id.' order by id asc');
		if($roles=='') $roles=0;

		$emps=getQueryRecords('select id,emp_id,emp_name from '.EMP.' where emp_dept_id='.$dept_id.' order by id asc');
		if($emps=='') $emps=0;

		$data=array('roles'=>$roles,'emps'=>$emps);

		echo json_encode($data);
	}
	else
	if($_GET['path']=='getEMPSbyRole')
	{
		$emps=getQueryRecords('select id,emp_id,emp_name from '.EMP.' where emp_role_id='.$role_id.' order by id asc');
		if($emps=='') $emps=0;

		echo json_encode($emps);
	}
	else
	if($_GET['path']=='getProspectDetails')
	{
		$recs=getRecords(PRODUCTS,'product_type_id='.$product_type_id);
		if($recs=='') $recs=0;

		echo json_encode($recs);
	}
	else
	if($_GET['path']=='getBusinessNamesByID')
	{
		$recs=getRecords(BUSINESS,'status=1 and business_type_id='.$business_type_id);
		if($recs=='') $recs=0;

		echo json_encode($recs);
	}
	else
	if($_GET['path']=='goBranch')
	{
		if(!empty($_SESSION['nivsmartid']))
		{
			$check=getDuplicate(EMP,'id="'.$_SESSION['nivsmartid'].'" and emp_branch_ids like "%'.$id.',%" and emp_status=1');
			if($check==1)
			{
				$name=getQueryRecord('select branch_name,id from '.BRANCHES.' where id='.$id);
				$_SESSION['niv_branch']=$name['branch_name'];
				$_SESSION['niv_branchid']=$name['id'];
				$result=$_SESSION['niv_branch'];
			}
			else $result=1;			
		}
		else $result=0;
		
		echo json_encode($result);
	}
	else
	if($_GET['path']=='checkDupLead')
	{
		$where='company_name="'.$company_name.'" and (contact_no_1="'.$contact_no.'" or contact_no_2="'.$contact_no.'")';
		$res=getDuplicate(CUSTOMERDETAILS,$where);

		echo json_encode($res);
	}
	else
	if($_GET['path']=='getCustomerDetails')
	{
		if($label=='company_name') $where='company_name="'.$val.'"';
		else $where='contact_no_1='.$val.' or contact_no_2='.$val;
		$res=getRecord(CUSTOMERDETAILS,$where);

		echo json_encode($res);
	}
	else
	if($_GET['path']=='CRMShortLeadCreation')
	{
		$cdata['company_name']=$company_name;
		$cdata['contact_no_1']=$contact_no_1;
		$cdata['contact_person']=$contact_person;
		$cdata['created_date_time']=CDATE;
		$cid=addRecord(CUSTOMERDETAILS,$cdata);

		$ldata['customer_id']=$cid;
		$ldata['created_emp_id']=$_SESSION['nivsmartid'];
		$ldata['if_prospect']=1;
		$ldata['prospect_type_id']=$prospect_type_id;
		$ldata['lead_branch_id']=$lead_branch_id;
		$ldata['remarks']=$remarks;
		$ldata['created_date_time']=CDATE;
		$lid=addRecord(CRMLEADS,$ldata);
		$leaddata['lead_id']='LID'.str_pad($lid,3,0,STR_PAD_LEFT);
		updateRecord(CRMLEADS,$leaddata,'id='.$lid);

		echo json_encode(1);
	}
	else
	if($_GET['path']=='CRMLeadCreation')
	{
		extract((array)$request);

		$cdata['company_name']=$company_name;
		$cdata['contact_no_1']=$contact_no_1;
		if(!empty($contact_no_2)) $cdata['contact_no_2']=$contact_no_2;
		$cdata['contact_person']=$contact_person;
		$cdata['addr']=$addr;
		$cdata['state_id']=$state_id;
		$cdata['city_id']=$city_id;
		$cdata['created_date_time']=CDATE;
		$ldata['lead_branch_id']=$lead_branch_id;
		$ldata['source_from']=0;
		$ldata['created_emp_id']=$_SESSION['nivsmartid'];
		$ldata['nature_of_business_type']=$nature_of_business_type;
		$ldata['business_name']=$business_name;
		$ldata['if_tally_customer']=$if_tally_customer;
		if($if_tally_customer==0) $ldata['any_other_software']=$any_other_software;
		if($if_tally_customer==1)
		{
			$ldata['existing_tally_no']=$existing_tally_no;
			$ldata['is_upgrade']=$is_upgrade;
			if($is_upgrade==1) $ldata['upgrade_version']=$upgrade_version;
		}
		else $is_upgrade=0;
		$ldata['if_prospect']=$if_prospect;
		if($if_prospect==1)
		{
			$ldata['prospect_type_id']=$prospect_type_id;
			$ldata['prospect_details_id']=$prospect_details_id;
		}
		$ldata['if_interest_demo']=$if_interest_demo;
		if($if_interest_demo==1) $ldata['demo_date_time']=DBDATE($demo_date_time);
		$ldata['remarks']=$remarks;
		$ldata['status']=0;

		if($if_referred==1)
		{
			$rdata['referred_company']=$referred_company;
			$rdata['referred_person']=$referred_person;
			$rdata['referred_contact_no']=$referred_contact_no;
			$rid=addRecord(CRMREFERREDCUSTOMER,$rdata);
		}
		if(!empty($rid)) $ldata['if_referred']=$rid; else $ldata['if_referred']=0;

		$cid=addRecord(CUSTOMERDETAILS,$cdata);
		if($cid)
		{
			$ldata['customer_id']=$cid;
			$ldata['created_date_time']=CDATE;
			$lid=addRecord(CRMLEADS,$ldata);
			if($lid)
			{
				$leaddata['lead_id']='LID'.str_pad($lid,3,0,STR_PAD_LEFT);
				if(isset($roleid) && $roleid==14)
				{
					if(!isset($status)) $status=6;
					if($status==11 || $status==6)
					{
						$leaddata['assign_tele_id']=$_SESSION['nivsmartid'];
						$leaddata['is_present']=$_SESSION['nivsmartid'];
						$lpdata['leadid']=$lid;
						$lpdata['is_taken_from']=$_SESSION['nivsmartid'];
						$lpdata['tele_id']=$_SESSION['nivsmartid'];
						$lpdata['is_present_at']=$_SESSION['nivsmartid'];
						$lpdata['is_taken_date_time']=CDATE;
						$res=addRecord(LEADPROCESS,$lpdata);
					}
					else
					{
						$leaddata['assign_tele_id']=$_SESSION['nivsmartid'];
						if($status==2) $leaddata['is_present']=0;
						if($status==3) $leaddata['is_present']=$_SESSION['nivsmartid'];
						$lpdata['leadid']=$lid;
						$lpdata['is_remarks']=$status_remarks;
						$lpdata['is_status']=1;
						$lpdata['type_of_process']=$status;
						$lpdata['is_taken_from']=$_SESSION['nivsmartid'];
						$lpdata['tele_id']=$_SESSION['nivsmartid'];
						$lpdata['is_present_at']=$_SESSION['nivsmartid'];
						$lpdata['is_taken_date_time']=CDATE;
						$lpdata['is_updated_date_time']=CDATE;
						if(isset($lead_dept_id) && $lead_dept_id!='') $leaddata['lead_dept_id']=$lead_dept_id; else $leaddata['lead_dept_id']=0;
						if(isset($lead_dept_id) && $lead_dept_id!='') $leaddata['lead_type_id']=$lead_dept_id; else $leaddata['lead_type_id']=0;
						$res=addRecord(LEADPROCESS,$lpdata);
						if($status==3)
						{
							$fdata['lead_process_id']=$res;
							$fdata['followup_date_time']=DBDATE($followup_date_time);
							addRecord(FOLLOWUP,$fdata);
						}

					}
					$leaddata['last_process_id']=$res;
					if($status!=11) $leaddata['status']=$status; else $leaddata['status']=5;
					$leaddata['is_present']=$_SESSION['nivsmartid'];
				}
				updateRecord(CRMLEADS,$leaddata,'id='.$lid);
				
				$result=1;
				$recs=getCreatedLeads();
				$result=array('result'=>$result,'recs'=>$recs);
			}
			else $result=0;
		}
		else $result=0;

		echo json_encode($result);
	}
	else
	if($_GET['path']=='getSESSIONVariable')
	{
		$branch_id=getQueryRecord('select id from '.BRANCHES.' where branch_name="'.$_SESSION['niv_branch'].'"');
		$data['sempid']=$_SESSION['nivsmartid'];
		$data['sdeptid']=$_SESSION['niv_deptid'];
		$data['sroleid']=$_SESSION['niv_roleid'];
		$data['sbranchid']=$branch_id['id'];

		echo json_encode($data);
	}
	else
	if($_GET['path']=='getCreatedLeads')
	{
		echo json_encode(getCreatedLeads());
	}
	else
	if($_GET['path']=='getCreatedLeadsBySearch')
	{
		if(!isset($emp_id)) $where='where l.created_emp_id='.$_SESSION['nivsmartid']; else $where='l.created_emp_id='.$emp_id;
		if($lead_branch_id!='all') $where.=' and l.lead_branch_id='.$lead_branch_id;
		if(isset($from_date) && isset($to_date)) $where.=' and l.created_date_time between "'.DBDATE($from_date).'" and "'.DBDATE($to_date.' 23:59:59').'"';
		$recs=getQueryRecords('select c.company_name,c.contact_no_1,c.contact_person,l.id,l.lead_id,l.created_date_time,l.status,d.dept as dept,emp.emp_id as is_present from '.CRMLEADS.' l join '.CUSTOMERDETAILS.' c on c.id=l.customer_id LEFT join '.EMP.' emp on emp.id=l.is_present LEFT join '.DEPARTMENTS.' d on d.id=l.lead_dept_id '.$where.' order by l.id desc');
		if($recs=='') $recs=0;

		echo json_encode($recs);
	}
	else
	if($_GET['path']=='getAllLeads')
	{
		echo json_encode(getAllLeads());
	}
	else
	if($_GET['path']=='getMarketingExecutiveLead')
	{
		$rec=getQueryRecord('select c.company_name,c.contact_no_1,c.contact_person,c.contact_no_2,c.addr,l.*,s.state,city.city,r.referred_company,r.referred_person,r.referred_contact_no,p.product_name from '.CRMLEADS.' l join '.CUSTOMERDETAILS.' c on c.id=l.customer_id join '.STATES.' s on s.id=c.state_id join '.CITIES.' city on city.id=c.city_id join '.EMP.' emp on emp.id=l.created_emp_id LEFT join '.CRMREFERREDCUSTOMER.' r on r.id=l.if_referred LEFT join '.PRODUCTS.' p on p.id=l.prospect_details_id where l.id='.$id);

		if($status!=0)
		{
			$coldhistory=getQueryRecords('select c.cold_remarks,c.last_updated_date_time,c.lead_taken_date_time,emp.emp_id from '.COLDLEADS.' c join '.EMP.' emp on emp.id=c.lead_taken_empid where leadid='.$id.' and lead_status=0 order by c.id asc');
		}
		else $coldhistory=0;

		$result=array('rec'=>$rec,'coldhistory'=>$coldhistory);

		echo json_encode($result);
	}
	else
	if($_GET['path']=='getViewLead')
	{
		$rec=getQueryRecord('select c.company_name,c.contact_no_1,c.contact_person,c.contact_no_2,c.addr,l.*,s.state,city.city,r.referred_company,r.referred_person,r.referred_contact_no,p.product_name,b.business_name,lp.is_remarks,lp.is_present_at,emp.emp_id as created_emp_id,emp.emp_name as created_emp_name,lp.is_status,lp.is_taken_date_time,lp.is_updated_date_time,empl.emp_id,empl.emp_name,branch.branch_name,l.lead_completed from '.CRMLEADS.' l join '.CUSTOMERDETAILS.' c on c.id=l.customer_id LEFT join '.STATES.' s on s.id=c.state_id LEFT join '.CITIES.' city on city.id=c.city_id join '.EMP.' emp on emp.id=l.created_emp_id join '.BRANCHES.' branch on branch.id=l.lead_branch_id LEFT join '.CRMREFERREDCUSTOMER.' r on r.id=l.if_referred LEFT join '.PRODUCTS.' p on p.id=l.prospect_details_id LEFT join '.BUSINESS.' b on b.id=l.business_name LEFT join '.LEADPROCESS.' lp on lp.id=l.last_process_id LEFT join '.EMP.' empl on empl.id=lp.is_present_at where l.id='.$id);

		$len=getDuplicate(LEADPROCESS,'leadid='.$id);

		$quotation=getqueryRecord('select e.emp_name,e.emp_id as empid,q.* from '.QUOTATION.' q join '.EMP.' e on e.id=q.emp_id where q.leadid='.$id);
		if($quotation=='') $quotation=0;

		$customersno=getRecord(TALLY_CUSTOMERS,'leadid='.$id);
		if($customersno=='') $customersno=0;

		$monthlyfollowup=getQueryRecords('select mon.followupdate,mon.remarks,mon.updated_date_time,emp.emp_id,emp.emp_name from '.MONTHLYFOLLOWUP.' mon join '.EMP.' emp on emp.id=mon.empid where mon.leadid='.$id.' order by mon.id asc');
		if($monthlyfollowup=='') $monthlyfollowup=0;

		$data=array('rec'=>$rec,'len'=>$len,'customersno'=>$customersno,'quotation'=>$quotation,'monthlyfollowup'=>$monthlyfollowup);
		
		echo json_encode($data);
	}
	else
	if($_GET['path']=='getEMPIDNAME')
	{
		$rec=getQueryRecord('select emp_id,emp_name from '.EMP.' where id='.$id);

		echo json_encode($rec);
	}
	else
	if($_GET['path']=='getMarketingTeleMyLeads')
	{
		$branch_id=getQueryRecord('select id from '.BRANCHES.' where branch_name="'.$_SESSION['niv_branch'].'"');
		$recs=getQueryRecords('select c.company_name,c.contact_no_1,c.contact_person,emp.emp_id,l.id,l.lead_id,l.status,l.created_date_time from '.CRMLEADS.' l join '.CUSTOMERDETAILS.' c on c.id=l.customer_id join '.EMP.' emp on emp.id=l.created_emp_id where l.lead_branch_id='.$branch_id['id'].' and l.created_emp_id='.$_SESSION['nivsmartid'].' order by l.id desc');
		if($recs=='') $recs='0';

		echo json_encode($recs);
	}
	else
	if($_GET['path']=='getLeadManagerColdLeads')
	{
		$recs=getLeadManagerColdLeads();

		echo json_encode($recs);
	}
	else
	if($_GET['path']=='getHotLeads')
	{
		$recs=getHotLeads();
		echo json_encode($recs);
	}
	else
	if($_GET['path']=='getHotInboxLeads')
	{
		$recs=getHotInboxLeads();
		echo json_encode($recs);
	}
	else
	if($_GET['path']=='getEMPProfile')
	{
		if(empty($empid)) $empid=$_SESSION['nivsmartid'];
		$rec=getQueryRecord('select s.state, c.city, d.dept as dept, r.role as role, emp.* from '.EMP.' emp join '.DEPTROLES.' r on r.id=emp.emp_role_id join '.DEPARTMENTS.' d on d.id=emp.emp_dept_id join '.CITIES.' c on c.id=emp.emp_city_id join '.STATES.' s on s.id=emp.emp_state_id where emp.id='.$empid.'');
		$branches=getEMPBranches($empid);
		$data=array('profile'=>$rec,'branches'=>$branches);
		echo json_encode($data);
	}
	else
	if($_GET['path']=='getEMPforEdit')
	{
		$rec=getRecord(EMP,'id='.$empid);
		if($rec['id'])
		{
			$bids=$rec['emp_branch_ids'];
			$roles=getQueryRecords('select dept.dept, r.* from '.DEPTROLES.' r join '.DEPARTMENTS.' dept on dept.id=r.dept_id where r.dept_id='.$rec['emp_dept_id'].' and r.id!=1 order by r.id asc');
			$cities=getQueryRecords('select id,city from '.CITIES.' where state_id='.$rec['emp_state_id'].' order by city asc');
			$row=getQueryRecord('select id,multiple_branches,is_multiple,role,dept_id from '.DEPTROLES.' where id='.$rec['emp_role_id']);
			$count=$row['multiple_branches'];
				$branches=[];
				$nochange=0;
				$bids=explode(',',rtrim($rec['emp_branch_ids'],','));
				foreach($bids as $key=>$val)
				{
					$leads=getQueryRecords('select l.lead_branch_id from '.CRMLEADS.' l join '.LEADPROCESS.' lp on lp.leadid=l.id where (lp.is_present_at='.$empid.' and l.lead_branch_id='.$val.' and l.lead_completed!=1) or (l.is_present='.$empid.' and l.lead_branch_id='.$val.') group by l.id');	
					if($leads=='') $branches[$val]=0; else {$branches[$val]=1;$nochange=1; }
				}
				$not_allow=array('branches'=>$branches,'nochange'=>$nochange);
			if($row['is_multiple']==0) $branches=getBranchsIFnoHead($rec['emp_dept_id'],$rec['emp_role_id'],$empid);
			else $branches=getRecords(BRANCHES,'status=1');
			if($branches=='') $branches=0;
			$data=array('emp'=>$rec,'branches'=>$branches,'roles'=>$roles,'cities'=>$cities,'count'=>$count,'not_allow'=>$not_allow);			
		}
		else $data=0;
		echo json_encode($data);
	}
	else
	if($_GET['path']=='moveToColdInbox')
	{
		$count=getDuplicate(CRMLEADS,'id='.$id.' and is_present=0');
		if($count==1)
		{
			$rec=getRecord(CRMLEADS,'id='.$id);

				$colddata['leadid']=$id;
				$colddata['tele_id']=$_SESSION['nivsmartid'];
				$colddata['is_present_at']=$_SESSION['nivsmartid'];
				$colddata['is_taken_date_time']=CDATE;
				$pid=addRecord(LEADPROCESS,$colddata);
				$leaddata['status']=6;
				$leaddata['last_process_id']=$pid;
				$leaddata['is_present']=$_SESSION['nivsmartid'];
				updateRecord(CRMLEADS,$leaddata,'id='.$id);

			$result=1;
		}
		else $result=3;

		$recs=getLeadManagerColdLeads();
		$data=array('result'=>$result,'recs'=>$recs);

		echo json_encode($data);
	}
	else
	if($_GET['path']=='moveToHotInbox')
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
				$ldata['is_present']=$_SESSION['nivsmartid'];
				updateRecord(CRMLEADS,$ldata,'id='.$id);

			$result=1;
		}
		else $result=3;

		$recs=getLeadManagerHotLeads();
		$data=array('result'=>$result,'recs'=>$recs);

		echo json_encode($data);
	}
	else
	if($_GET['path']=='getLeadManagerColdInboxLeads')
	{
		$recs=getLeadManagerColdInboxLeads();

		echo json_encode($recs);
	}
	else
	if($_GET['path']=='getColdLead')
	{
		$recs=getColdLead($id,$status);

		echo json_encode($recs);
	}
	else
	if($_GET['path']=='getEditColdLead')
	{
		$data=getColdLeadforEdit($id);

		echo json_encode($data);
	}
	else
	if($_GET['path']=='getEditHotLead')
	{
		$data=getHotLeadforEdit($id);

		echo json_encode($data);
	}
	else
	if($_GET['path']=='getLeadManagerHotLeads')
	{
		$recs=getLeadManagerHotLeads();

		echo json_encode($recs);
	}
	else
	if($_GET['path']=='getLeadManagerHotInboxLeads')
	{
		$recs=getLeadManagerHotInboxLeads();

		echo json_encode($recs);
	}
	else
	if($_GET['path']=='getFollowupLeads')
	{
		$data=getFollowupLeads();

		echo json_encode($data);
	}
	else
	if($_GET['path']=='getTeleHotLeads')
	{
		$recs=getTeleHotLeads();

		echo json_encode($recs);
	}
	else
	if($_GET['path']=='getTeleColdLeads')
	{
		$recs=getTeleColdLeads();

		echo json_encode($recs);
	}
	else
	if($_GET['path']=='getLeadsReport')
	{
		$branch_id=getQueryRecord('select id from '.BRANCHES.' where branch_name="'.$_SESSION['niv_branch'].'"');

		$data=getQueryRecords('select c.company_name,c.contact_no_1,c.contact_person,l.id,l.lead_id,l.created_date_time,l.status,emp.emp_id as is_present,d.dept,b.branch_name,l.lead_completed from '.CRMLEADS.' l join '.CUSTOMERDETAILS.' c on c.id=l.customer_id LEFT join '.EMP.' emp on emp.id=l.is_present LEFT join '.LEADPROCESS.' lp on lp.leadid=l.id LEFT join '.DEPARTMENTS.' d on d.id=l.lead_dept_id join '.BRANCHES.' b on b.id=l.lead_branch_id where lp.is_present_at='.$_SESSION["nivsmartid"].' and l.lead_branch_id='.$branch_id['id'].' group by lp.leadid order by l.id desc');
		if($data=='') $data=0;

		echo json_encode($data);
	}
	else
	if($_GET['path']=='getStatusCount')
	{
		if(!isset($empids) && empty($empids)) $empids=$_SESSION['nivsmartid'];
		$branch_id=getQueryRecord('select id from '.BRANCHES.' where branch_name="'.$_SESSION['niv_branch'].'"');


		$data=getQueryRecords('select c.company_name,c.contact_no_1,c.contact_person,l.id,l.lead_id,l.created_date_time,l.status,emp.emp_id as is_present,d.dept from '.CRMLEADS.' l join '.CUSTOMERDETAILS.' c on c.id=l.customer_id LEFT join '.EMP.' emp on emp.id=l.is_present LEFT join '.LEADPROCESS.' lp on lp.leadid=l.id LEFT join '.DEPARTMENTS.' d on d.id=l.lead_dept_id where created_emp_id in ('.$empids.') group by l.id order by l.id desc');

	}
	else
	if($_GET['path']=='updateFollowupStatus')
	{
		$rec=getQueryRecord('select l.assign_tele_id,lp.is_present_at,lp.is_updated_date_time,lp.is_taken_from from '.CRMLEADS.' l join '.LEADPROCESS.' lp on lp.id=l.last_process_id where l.id='.$id);

		$lpdata['is_remarks']=$is_remarks;
		$lpdata['is_updated_date_time']=CDATE;
		$lpdata['is_taken_date_time']=$rec['is_updated_date_time'];
		$lpdata['is_status']=1;
		$lpdata['type_of_process']=$status;
		$lpdata['tele_id']=$rec['assign_tele_id'];
		$lpdata['leadid']=$id;
		if($rec['is_present_at']==$_SESSION['nivsmartid']) $lpdata['is_taken_from']=$rec['is_taken_from']; else $lpdata['is_taken_from']=$rec['is_present_at'];
		if($status==5)
		{
			if($rec['is_present_at']==$_SESSION['nivsmartid'])
			{
				$lpdata['is_moved_to']=$rec['is_taken_from'];
			}
			else
			{
				$lpdata['is_moved_to']=$rec['is_present_at'];
			}
		}
		$lpdata['is_present_at']=$_SESSION['nivsmartid'];
		$pid=addRecord(LEADPROCESS,$lpdata);

		if($status==5)
		{
			$data['if_interest_demo']=1;
			$data['demo_date_time']=DBDATE($demo_date_time);
			if($rec['is_present_at']==$_SESSION['nivsmartid']) $data['is_present']=$rec['is_taken_from']; else $data['is_present']=$rec['is_present_at'];
		}

		if($status==3)
		{
			$fdata['lead_process_id']=$pid;
			$fdata['followup_date_time']=DBDATE($followup_date_time);
			addRecord(FOLLOWUP,$fdata);
		}

		$data['last_process_id']=$pid;
		if($status==2) $data['is_present']=0;
		if($status==3) $data['is_present']=$rec['assign_tele_id'];
		$data['status']=$status;
		updateRecord(CRMLEADS,$data,'id='.$id);

		echo json_encode(1);
	}
	else
	if($_GET['path']=='updateLeadMangerHotLeadStatus')
	{
		$rec=getQueryRecord('select id from '.LEADPROCESS.' where is_status=0 and leadid='.$id);
		$colddata['is_status']=1;
		$colddata['type_of_process']=$status;
		$colddata['is_remarks']=$is_remarks;
		$colddata['is_updated_date_time']=CDATE;
		updateRecord(LEADPROCESS,$colddata,'id='.$rec['id']);
		
		$data['status']=$status;
		if($lead_dept_id!='')
		{
			$data['lead_dept_id']=$lead_dept_id;
			$data['lead_type_id']=$lead_dept_id;
		}
		if($status==3)
		{
			$fdata['lead_process_id']=$rec['id'];
			$fdata['followup_date_time']=DBDATE($followup_date_time);
			addRecord(FOLLOWUP,$fdata);
			$data['is_present']=$_SESSION['nivsmartid'];
		}
		else $data['is_present']=0;

		$data['last_process_id']=$rec['id'];
		$data['assign_tele_id']=$_SESSION['nivsmartid'];
		updateRecord(CRMLEADS,$data,'id='.$id);
		$recs=1;
		
		echo json_encode($recs);
	}
	else
	if($_GET['path']=='updateLeadMangerColdLeadStatus')
	{
		$rec=getQueryRecord('select id from '.LEADPROCESS.' where is_status=0 and leadid='.$id);
		$colddata['is_status']=1;
		$colddata['type_of_process']=$status;
		$colddata['is_remarks']=$is_remarks;
		$colddata['is_updated_date_time']=CDATE;
		updateRecord(LEADPROCESS,$colddata,'id='.$rec['id']);

		$data['status']=$status;
		if($_SESSION['niv_roleid']==14 && $status==6)
		{
			$rec=getRecord(CRMLEADS,'id='.$id);

			$newcolddata['leadid']=$id;
			$newcolddata['tele_id']=$_SESSION['nivsmartid'];
			$newcolddata['is_present_at']=$_SESSION['nivsmartid'];
			$newcolddata['is_taken_date_time']=CDATE;
			$pid=addRecord(LEADPROCESS,$newcolddata);
			$data['status']=6;
			$data['last_process_id']=$pid;
			$data['is_present']=$_SESSION['nivsmartid'];
		}
		else
		{
			$data['is_present']=0;
			$data['last_process_id']=$rec['id'];
		}
		updateRecord(CRMLEADS,$data,'id='.$id);
		$recs=getLeadManagerColdInboxLeads();
		
		echo json_encode($recs);
	}
	else
	if($_GET['path']=='updateLeadManagerLead')
	{
		$cdata['company_name']=$company_name;
		$cdata['contact_no_1']=$contact_no_1;
		if(!empty($contact_no_2)) $cdata['contact_no_2']=$contact_no_2; else $cdata['contact_no_2']='';
		$cdata['contact_person']=$contact_person;
		$cdata['addr']=$addr;
		$cdata['state_id']=$state_id;
		$cdata['city_id']=$city_id;
		$cdata['last_updated']=CDATE;
		$ldata['lead_branch_id']=$lead_branch_id;
		$ldata['nature_of_business_type']=$nature_of_business_type;
		$ldata['business_name']=$business_name;
		$ldata['if_tally_customer']=$if_tally_customer;
		if($if_tally_customer==0) $ldata['any_other_software']=$any_other_software;
		if($if_tally_customer==1)
		{
			$ldata['existing_tally_no']=$existing_tally_no;
			$ldata['is_upgrade']=$is_upgrade;
			if($is_upgrade==1) $ldata['upgrade_version']=$upgrade_version;
			$ldata['any_other_software']='';
		}
		else
		{
			$is_upgrade=0;
			$ldata['existing_tally_no']='';
			$ldata['is_upgrade']=0;
			$ldata['upgrade_version']='';
		}
		$ldata['if_prospect']=$if_prospect;
		if($if_prospect==1)
		{
			$ldata['prospect_type_id']=$prospect_type_id;
			$ldata['prospect_details_id']=$prospect_details_id;
		}
		else
		{
			$ldata['prospect_type_id']=0;
			$ldata['prospect_details_id']=0;
		}
		$ldata['if_interest_demo']=$if_interest_demo;
		if($if_interest_demo==1) $ldata['demo_date_time']=DBDATE($demo_date_time); else $ldata['demo_date_time']='';
		$ldata['remarks']=$remarks;

		$cid=getQueryRecord('select customer_id from '.CRMLEADS.' where id='.$id);
		if($if_referred!='0')
		{
			$rdata['referred_company']=$referred_company;
			$rdata['referred_person']=$referred_person;
			$rdata['referred_contact_no']=$referred_contact_no;
			if($if_referred=='New')
			{
				$rid=addRecord(CRMREFERREDCUSTOMER,$rdata);
				$ldata['if_referred']=$rid;
			}
			else
			{
				updateRecord(CRMREFERREDCUSTOMER,$rdata,'id='.$if_referred);
				$ldata['if_referred']=$if_referred;
			}
		}
		else $ldata['if_referred']=0;
			 $ldata['last_updated']=CDATE;

		updateRecord(CUSTOMERDETAILS,$cdata,'id='.$cid['customer_id']);
		updateRecord(CRMLEADS,$ldata,'id='.$id);

		if($update==2)
		{
			$check=getDuplicate(CRMLEADS,'lead_dept_id=0 and status=3 and id='.$id);
			if($check==1) 
			{
				$rec=getQueryRecord('select l.assign_tele_id,lp.is_present_at,lp.is_updated_date_time from '.CRMLEADS.' l join '.LEADPROCESS.' lp on lp.id=l.last_process_id where l.id='.$id);
				$lpdata['is_remarks']=$status_remarks;
				$lpdata['is_updated_date_time']=CDATE;
				$lpdata['is_taken_date_time']=$rec['is_updated_date_time'];
				$lpdata['is_status']=1;
				$lpdata['type_of_process']=$status;
				$lpdata['tele_id']=$_SESSION['nivsmartid'];
				$lpdata['leadid']=$id;
				$lpdata['is_present_at']=$_SESSION['nivsmartid'];
				$pid=addRecord(LEADPROCESS,$lpdata);

				if($status==3)
				{
					$fdata['lead_process_id']=$pid;
					$fdata['followup_date_time']=DBDATE($followup_date_time);
					addRecord(FOLLOWUP,$fdata);
					$lead['is_present']=$_SESSION['nivsmartid'];
				}
				else
				{
					$lead['is_present']=0;
				}
				if($lead_dept_id!='')
				{
					$lead['lead_dept_id']=$lead_dept_id;
					$lead['lead_type_id']=$lead_dept_id;

				} else 
				{
					$lead['lead_dept_id']=0;
					$lead['lead_type_id']=0;
				}
				$lead['status']=$status;
				$lead['last_process_id']=$pid;
				$lead['last_updated']=CDATE;
				updateRecord(CRMLEADS,$lead,'id='.$id);
			}
			else
			{
				$rec=getQueryRecord('select id from '.LEADPROCESS.' where leadid='.$id.' and is_status=0');
			if($status!=6)
			{
				if($status==3)
				{
					$fdata['lead_process_id']=$rec['id'];
					$fdata['followup_date_time']=DBDATE($followup_date_time);
					addRecord(FOLLOWUP,$fdata);
				}
					$pdata['type_of_process']=$status;
					$pdata['is_status']=1;
					$pdata['is_remarks']=$status_remarks;
					$pdata['is_updated_date_time']=CDATE;
					updateRecord(LEADPROCESS,$pdata,'id='.$rec['id']);
					
					$lead['status']=$status;
					if($status==3) $lead['is_present']=$_SESSION['nivsmartid']; else $lead['is_present']=0;
					$lead['last_process_id']=$rec['id'];
					$lead['assign_tele_id']=$_SESSION['nivsmartid'];
					$lead['last_updated']=CDATE;
					if($lead_dept_id!='')
					{
						$lead['lead_dept_id']=$lead_dept_id;
						$lead['lead_type_id']=$lead_dept_id;
					}else
					{
						$lead['lead_dept_id']=0;
						$lead['lead_type_id']=0;
					}
				updateRecord(CRMLEADS,$lead,'id='.$id);
			}
			}			
		}

		$recs=1;
		echo json_encode($recs);
	}
	else
	if($_GET['path']=='updateLeadManagerLeadFollowup')
	{
		$cdata['company_name']=$company_name;
		$cdata['contact_no_1']=$contact_no_1;
		if(!empty($contact_no_2)) $cdata['contact_no_2']=$contact_no_2; else $cdata['contact_no_2']='';
		$cdata['contact_person']=$contact_person;
		$cdata['addr']=$addr;
		$cdata['state_id']=$state_id;
		$cdata['city_id']=$city_id;
		$cdata['last_updated']=CDATE;
		$ldata['lead_branch_id']=$lead_branch_id;
		$ldata['nature_of_business_type']=$nature_of_business_type;
		$ldata['business_name']=$business_name;
		$ldata['if_tally_customer']=$if_tally_customer;
		if($lead_dept_id!='')
		{
			$ldata['lead_dept_id']=$lead_dept_id;
			$ldata['lead_type_id']=$lead_dept_id;
		}else
		{
			$ldata['lead_dept_id']=0;
			$ldata['lead_type_id']=0;
		}
		if($if_tally_customer==0) $ldata['any_other_software']=$any_other_software;
		if($if_tally_customer==1)
		{
			$ldata['existing_tally_no']=$existing_tally_no;
			$ldata['is_upgrade']=$is_upgrade;
			if($is_upgrade==1) $ldata['upgrade_version']=$upgrade_version;
		}
		else $is_upgrade=0;
		$ldata['if_prospect']=$if_prospect;
		if($if_prospect==1)
		{
			$ldata['prospect_type_id']=$prospect_type_id;
			$ldata['prospect_details_id']=$prospect_details_id;
		}
		$ldata['if_interest_demo']=$if_interest_demo;
		if($if_interest_demo==1) $ldata['demo_date_time']=DBDATE($demo_date_time);
		$ldata['remarks']=$remarks;
		$ldata['status']=$status;

		$cid=getQueryRecord('select customer_id from '.CRMLEADS.' where id='.$id);
		if($if_referred!='0')
		{
			$rdata['referred_company']=$referred_company;
			$rdata['referred_person']=$referred_person;
			$rdata['referred_contact_no']=$referred_contact_no;
			if($if_referred=='New')
			{
				$rid=addRecord(CRMREFERREDCUSTOMER,$rdata);
				$ldata['if_referred']=$rid;
			}
			else
			{
				updateRecord(CRMREFERREDCUSTOMER,$rdata,'id='.$if_referred);
				$ldata['if_referred']=$if_referred;
			}
		}
		else $ldata['if_referred']=0;

		updateRecord(CUSTOMERDETAILS,$cdata,'id='.$cid['customer_id']);

		$check=getDuplicate(CRMLEADS,'status=3 and id='.$id);

		$rec=getQueryRecord('select id from '.LEADPROCESS.' where leadid='.$id.' and is_status=0');

		if($status!=6)
		{
			if($status==3)
			{
				$fdata['lead_process_id']=$rec['id'];
				$fdata['followup_date_time']=DBDATE($followup_date_time);
				addRecord(FOLLOWUP,$fdata);
			}
				$pdata['type_of_process']=$status;
				if($status!=3)  $pdata['is_status']=1;
				$pdata['is_remarks']=$status_remarks;
				$pdata['is_updated_date_time']=CDATE;
				updateRecord(LEADPROCESS,$pdata,'id='.$rec['id']);
				
				$ldata['status']=$status;
				if($status==3) $ldata['is_present']=$_SESSION['nivsmartid']; else $ldata['is_present']=0;
				$ldata['last_process_id']=$rec['id'];
				$ldata['assign_tele_id']=$_SESSION['nivsmartid'];
				$ldata['last_updated']=CDATE;
		}

			updateRecord(CRMLEADS,$ldata,'id='.$id);

		$recs=1;
		echo json_encode($recs);
	}
	else
	if($_GET['path']=='getCRMHeadLeads')
	{
		$recs=getCRMHeadLeads();

		echo json_encode($recs);
	}
	else
	if($_GET['path']=='getCRMHeadInboxLeads')
	{
		$recs=getCRMHeadInboxLeads();

		echo json_encode($recs);
	}
	else
	if($_GET['path']=='getEMPSbyDept')
	{
		$recs=getQueryRecords('select e.id,e.emp_id,e.emp_name from '.EMP.' e join '.DEPARTMENTS.' d on d.id=emp_dept_id where e.id!=1 and e.emp_status=1 and d.id='.$_SESSION['niv_deptid']);
		if($recs=='') $recs=0;
		echo json_encode($recs);
	}
	else
	if($_GET['path']=='assignLeadsbyHead')
	{
		for($i=0;$i<count($leadids);$i++)
		{
			$rec=getQueryRecord('select l.assign_tele_id,lp.is_present_at,lp.is_updated_date_time from '.CRMLEADS.' l join '.LEADPROCESS.' lp on lp.id=l.last_process_id where l.id='.$leadids[$i]);
			$lpdata['leadid']=$leadids[$i];
			$lpdata['tele_id']=$rec['assign_tele_id'];
			$lpdata['is_taken_from']=$rec['is_present_at'];
			$lpdata['is_present_at']=$_SESSION['nivsmartid'];
			$lpdata['is_taken_date_time']=$rec['is_updated_date_time'];
			$lpdata['is_status']=1;
			$lpdata['is_remarks']='Lead Assigned and In-progress';
			$lpdata['type_of_process']=8;
			$lpdata['is_updated_date_time']=CDATE;
			$lpdata['is_moved_to']=$empid;
			$lpid=addRecord(LEADPROCESS,$lpdata);

			$adata['is_present']=$empid;
			$adata['last_process_id']=$lpid;
			updateRecord(CRMLEADS,$adata,'id='.$leadids[$i]);
		}

		echo json_encode(1);
	}
	else
	if($_GET['path']=='updateleadstatus')
	{
		$rec=getQueryRecord('select l.assign_tele_id,lp.is_present_at,lp.is_updated_date_time from '.CRMLEADS.' l join '.LEADPROCESS.' lp on lp.id=l.last_process_id where l.id='.$id);
		$lpdata['is_remarks']=$is_remarks;
		$lpdata['is_updated_date_time']=CDATE;
		$lpdata['is_taken_date_time']=$rec['is_updated_date_time'];
		$lpdata['is_status']=1;
		$lpdata['type_of_process']=$status;
		$lpdata['tele_id']=$rec['assign_tele_id'];
		$lpdata['leadid']=$id;

		$lpdata['is_taken_from']=$rec['is_present_at'];
		$lpdata['is_present_at']=$_SESSION['nivsmartid'];
		if($status==5 && $movetoemp!=7) $lpdata['is_moved_to']=$movetoemp;
		$pid=addRecord(LEADPROCESS,$lpdata);

		if($status==3)
		{
			$fdata['lead_process_id']=$pid;
			$fdata['followup_date_time']=DBDATE($followup_date_time);
			addRecord(FOLLOWUP,$fdata);
		}

		if($status==4 && $if_serial_no==0)
		{
			$frzdata['leadid']=$id;
			$frzdata['serial_no']=$serial_no;
			$frzdata['business_id']=$bid;
			$frzdata['invoice']=$invoice;
			$frzdata['inventory']=$inventory;
			$frzdata['filing']=$filing;
			$frzdata['diagonals']=$diagonals;
			$frzdata['lead_implementation']=$lead_implementation;
			$frzdata['next_contact_date']=DBDATE($next_contact_date);
			$dup=getDuplicate(TALLY_CUSTOMERS,'leadid='.$id);
			if($dup==0)
			{
				$frzdata['created_date_time']=CDATE;
				addRecord(TALLY_CUSTOMERS,$frzdata);
			}
			else
			{
				$frzdata['updated_date_time']=CDATE;
				updateRecord(TALLY_CUSTOMERS,$frzdata,'leadid='.$id);
			}
		}

		if($status==5 && $movetoemp==7 && $qid==0)
		{
			$qdata['leadid']=$id;
			$qdata['leadprocessid']=$pid;
			$qdata['emp_id']=$_SESSION['nivsmartid'];
			$qdata['prospect_id']=$_SESSION['niv_deptid'];
			$qdata['prospect_details_id']=$prospect_details_id;
			$qdata['quantity']=$quantity;
			$qdata['rate']=$rate;
			$qdata['des']=$des;
				$qdata['created_date_time']=CDATE;
			$count=getDuplicate(QUOTATION,'leadid='.$id);

			if($count==1)
			{
				updateRecord(QUOTATION,$qdata,'leadid='.$id);
			}
			else
			{
				addRecord(QUOTATION,$qdata);	
			}
		}

		$data['last_process_id']=$pid;
		if($status==2 || $status==4) $data['is_present']=0;
		if($status==5 && $movetoemp!=7) $data['is_present']=$movetoemp;
		if($status==5 && $movetoemp==7)
		{
			$data['lead_dept_id']=$movetoemp;
			$data['is_present']=0;
		}
		if($status==3) $data['is_present']=$rec['assign_tele_id'];
		$data['status']=$status;
		updateRecord(CRMLEADS,$data,'id='.$id);

		echo json_encode(1);
	}
	else
	if($_GET['path']=='updateLeadStatusbyACUNT')
	{
		$rec=getQueryRecord('select l.assign_tele_id,lp.is_present_at,lp.is_updated_date_time from '.CRMLEADS.' l join '.LEADPROCESS.' lp on lp.id=l.last_process_id where l.id='.$id);
		$deptid=getQueryRecord('select id as deptid from '.EMP.' where id='.$rec['is_present_at']);
		$lpdata['is_remarks']=$is_remarks;
		$lpdata['is_updated_date_time']=CDATE;
		$lpdata['is_taken_date_time']=$rec['is_updated_date_time'];
		$lpdata['is_status']=1;
		$lpdata['tele_id']=$rec['assign_tele_id'];
		$lpdata['leadid']=$id;
		$lpdata['type_of_process']=$status;

		$lpdata['is_taken_from']=$rec['is_present_at'];
		$lpdata['is_present_at']=$_SESSION['nivsmartid'];
		$lpdata['is_moved_to']=$rec['is_present_at'];
		$pid=addRecord(LEADPROCESS,$lpdata);
		
		$data['last_process_id']=$pid;
		$data['lead_dept_id']=$deptid['deptid'];
		$data['is_present']=$rec['is_present_at'];
		if($status==5) $data['lead_verified']=1;
		updateRecord(CRMLEADS,$data,'id='.$id);

		echo json_encode(1);
	}
	else
	if($_GET['path']=='updateLeadStatusbyFEEDBACK')
	{
		$rec=getQueryRecord('select l.assign_tele_id,lp.is_present_at,lp.is_updated_date_time,l.status from '.CRMLEADS.' l join '.LEADPROCESS.' lp on lp.id=l.last_process_id where l.id='.$id);
		$lpdata['is_remarks']=$is_remarks;
		$lpdata['is_updated_date_time']=CDATE;
		$lpdata['is_taken_date_time']=$rec['is_updated_date_time'];
		$lpdata['is_status']=1;
		$lpdata['tele_id']=$rec['assign_tele_id'];
		$lpdata['leadid']=$id;
		$lpdata['type_of_process']=$status;

		$lpdata['is_taken_from']=$rec['is_present_at'];
		$lpdata['is_present_at']=$_SESSION['nivsmartid'];
		$lpdata['is_moved_to']=$rec['is_present_at'];
		$pid=addRecord(LEADPROCESS,$lpdata);

		$data['last_process_id']=$pid;
		if($status==7) $data['status']=5;
		if($status==1)
		{
			$data['lead_completed']=1;
			$data['is_present']=0;
			if($rec['status']==4) $data['status']=$status; else $data['status']=2;

			$monthdata['leadid']=$id;
			$monthdata['followupdate']=date('Y-m-d', strtotime('+1 month'));
			addRecord(MONTHLYFOLLOWUP,$monthdata);
		}
		else $data['is_present']=$rec['is_present_at'];
		updateRecord(CRMLEADS,$data,'id='.$id);

		echo json_encode(1);
	}
	else
	if($_GET['path']=='getQuotationDetails')
	{
		$count=getDuplicate(QUOTATION,'leadid='.$id);

		if($count==1)
		{
			$quotation=getQueryRecord('select prospect_details_id,quantity,amount,rate,des from '.QUOTATION.' where leadid='.$id);
		}
		else $quotation=0;

		$recs=getQueryRecords('select p.id,p.product_name from '.PRODUCTS.' p join '.PRODUCTTYPES.' pt on pt.id=p.product_type_id join '.DEPARTMENTS.' d on d.dept=pt.type where d.id='.$_SESSION['niv_deptid']);

		if($recs=='') $recs=0;

		$data=array('quotation'=>$_SESSION,'recs'=>$recs);


		echo json_encode($data);
	}
	else
	if($_GET['path']=='getCRMSELeads')
	{
		$recs=getCRMHeadInboxLeads();

		echo json_encode($recs);
	}
	else
	if($_GET['path']=='getACUNTLeads')
	{
		$recs=getACUNTLeads();

		echo json_encode($recs);
	}
	else
	if($_GET['path']=='getFEEDBACKLeads')
	{
		$recs=getFEEDBACKLeads();

		echo json_encode($recs);
	}
	else
	if($_GET['path']=='moveToFEEDBACKInbox')
	{
		$count=getDuplicate(CRMLEADS,'id='.$id.' and is_present=0');
		if($count==1)
		{
			$rec=getQueryRecord('select l.assign_tele_id,lp.is_present_at,lp.is_updated_date_time from '.CRMLEADS.' l join '.LEADPROCESS.' lp on lp.id=l.last_process_id where l.id='.$id);

				$lpdata['leadid']=$id;
				$lpdata['type_of_process']=8;
				$lpdata['is_remarks']='Lead In-progress';
				$lpdata['tele_id']=$_SESSION['nivsmartid'];
				$lpdata['is_present_at']=$_SESSION['nivsmartid'];
				$lpdata['is_taken_from']=$rec['is_present_at'];
				$lpdata['is_taken_date_time']=CDATE;
				$res=addRecord(LEADPROCESS,$lpdata);
				
				$ldata['is_present']=$_SESSION['nivsmartid'];
				updateRecord(CRMLEADS,$ldata,'id='.$id);

			$result=1;
		}
		else $result=3;

		$recs=getFEEDBACKLeads();
		$data=array('result'=>$result,'recs'=>$recs);

		echo json_encode($data);
	}
	else
	if($_GET['path']=='getFEEDBACKInboxLeads')
	{
		$recs=getFEEDBACKInboxLeads();

		echo json_encode($recs);
	}
	else
	if($_GET['path']=='getGuestUsers')
	{
		$recs=getRecords(GUESTUSERS,'1 order by id desc');

		echo json_encode($recs);
	}
	else
	if($_GET['path']=='getViewMoreHistory')
	{
		$recs=getQueryRecords('select e.emp_id,e.emp_name,lp.id,lp.is_remarks,lp.is_updated_date_time from '.LEADPROCESS.' lp join '.EMP.' e on e.id=lp.is_present_at where leadid='.$leadid.' order by id desc limit '.$count.',5');
		if($recs=='') $recs=0;
		echo json_encode($recs);
	}
	else
	if($_GET['path']=='getChecklistData')
	{
		$rec=getQueryRecord('select serial_no,invoice,inventory,filing,diagonals,lead_implementation,next_contact_date from '.TALLY_CUSTOMERS.' where leadid='.$id);
		if($rec=='') $rec=0;

		echo json_encode($rec);
	}
	else
	if($_GET['path']=='getLeadsforDashboard')
	{
		$where='where ';
		if($branchid=='All')
		{
			if($_SESSION['nivsmartid']!=1)
			{
				$branchids=getQueryRecord('select emp_branch_ids as id from '.EMP.' where id='.$_SESSION['nivsmartid']);
				$branchid=rtrim($branchids['id'],',');
			}
			else
			if($status=='All' && $branchid=='All') $where.='1';
		}
		$data['status']=$status;
		$data['lead_branch_id']=$branchid;
		foreach($data as $label=>$value)
		{
			if($value!='All') $where.='l.'.$label.' in ('.$value.') and ';
		}
		$where=rtrim($where,' and ');

		$recs=getQueryRecords('select c.company_name,c.contact_no_1,c.contact_person,l.id,l.lead_id,l.created_date_time,l.status,d.dept as dept,emp.emp_id as is_present from '.CRMLEADS.' l join '.CUSTOMERDETAILS.' c on c.id=l.customer_id LEFT join '.EMP.' emp on emp.id=l.is_present LEFT join '.DEPARTMENTS.' d on d.id=l.lead_dept_id '.$where.' order by l.id desc');
		if($recs=='') $recs=0;
		echo json_encode($recs);
	}
	else
	if($_GET['path']=='getLeadsbyProduct')
	{
		$where='where ';
		if($_SESSION['nivsmartid']!=1)
		{
			$branchids=getQueryRecord('select emp_branch_ids as id from '.EMP.' where id='.$_SESSION['nivsmartid']);
			$branchids=rtrim($branchids['id'],',');
			$where.='l.lead_branch_id in ('.$branchids.') and ';
		}
		if($productid=='All' && $status=='All') $where.='l.lead_type_id in (4,5,6) and ';
		if($productid!='All') $where.='l.lead_type_id='.$productid.' and '; else $where.='l.lead_type_id in (4,5,6) and ';
		if($status!='All') $where.='l.status='.$status.' and ';
		$where=rtrim($where,' and ');
		$recs=getQueryRecords('select c.company_name,c.contact_no_1,c.contact_person,l.id,l.lead_id,l.created_date_time,l.status,d.dept as dept,emp.emp_id as is_present from '.CRMLEADS.' l join '.CUSTOMERDETAILS.' c on c.id=l.customer_id LEFT join '.EMP.' emp on emp.id=l.is_present LEFT join '.DEPARTMENTS.' d on d.id=l.lead_dept_id '.$where.' order by l.id desc');
		if($recs=='') $recs=0;
		echo json_encode($recs);
	}
	else
	if($_GET['path']=='getLeadsBySearch')
	{
		$where='where ';
		extract($search);
		$data['branch_id']=$branch_id;
		$data['dept_id']=$dept_id;
		$data['role_id']=$role_id;
		$data['emp_id']=$emp_id;
		$data['status_id']=$status_id;
		foreach($data as $label=>$value)
		{
			if($value!='All') $where.=$label.'='.$value.' and ';
		}
		$where=rtrim($where,' and ');
		if($where=='where') $where='where 1';
		echo json_encode($where);

	}
	else
	if($_GET['path']=='getLeadsCountByStatus')
	{
		$data=getLeadsCountByStatus($status,$branch='');
		echo json_encode($data);
	}
	else
	if($_GET['path']=='getLeadsCountByProduct')
	{
		$data=getLeadsCountByProduct($status,$products,$branch='');
		echo json_encode($data);
	}
	else
	if($_GET['path']=='getLeadsbyStatus')
	{
		extract($search);
		if($status!=11) $whr='where l.status='.$status.' and '; else $whr='where 1 and ';
		if($branch_id!='all') $whr.='lead_branch_id='.$branch_id.' and '; else $whr.='';
		if(!empty($from_date) && !empty($to_date)) $whr.='l.created_date_time between "'.DBDATE($from_date).'" and "'.DBDATE($to_date.' 23:59:59').'"'; else $whr.='';
		if($whr!='') $whr=rtrim($whr,' and ');

		$recs=getQueryRecords('select c.company_name,c.contact_no_1,c.contact_person,l.id,l.lead_id,l.created_date_time,l.status,d.dept as dept,emp.emp_id as is_present from '.CRMLEADS.' l join '.CUSTOMERDETAILS.' c on c.id=l.customer_id LEFT join '.EMP.' emp on emp.id=l.is_present LEFT join '.DEPARTMENTS.' d on d.id=l.lead_dept_id '.$whr.' order by l.id desc');
		if($recs=='') $recs=0;

		echo json_encode($recs);
	}
	else
	if($_GET['path']=='sendEMPAttendance')
	{
		$result=0;
		$data['empid']=$_SESSION['nivsmartid'];
		$data['status']=$status;
		if($status==1) $data['absent_session']=0; else $data['absent_session']=$absent_session;
		$data['remarks']=$remarks;

		$result=saveEMPAttendance($data);

		echo json_encode($result);		
	}
	else
	if($_GET['path']=='checkEMPAttendace')
	{
		$check=getRecord(EMPATTENDANCE,'emp_id='.$_SESSION['nivsmartid'].' and month_year="'.date('M-Y').'" and date like "%'.date('d').'%"');
		if($check=='') $check=0;

		echo json_encode($check);
	}
	else
	if($_GET['path']=='getEMPAttendance')
	{
		$recs=getQueryRecords('select att.*,emp.emp_id as empid,emp_name from '.EMPATTENDANCE.' att join '.EMP.' emp on emp.id=att.emp_id where month_year="'.date('M-Y').'" and date like "%'.date('d').'%"');
		if($recs=='') $recs=0;

		echo json_encode($recs);
	}
	else
	if($_GET['path']=='getEMPAttendCount')
	{
		$presentcount=0;
		$absentcount=0;
		$pending=0;
		$pendingempids='';
		$presentempids='';
		$absentempids='';

		$recs=getRecords(EMPATTENDANCE,'month_year="'.date('M-Y').'" and date like "%'.date('d').'%"');
		if($recs=='') $recs=0;
		else
		{
			foreach($recs as $rec)
			{
				$dates=explode('*', $rec['date']);
				$emp_status=explode('*', $rec['status']);
				for($i=0;$i<count($dates);$i++)
				{
					if(date('d')==$dates[$i])
					{
						if($emp_status[$i]==1)
						{
							$presentcount+=1;
							$presentempids.=$rec['emp_id'].',';
							$present=array('present'=>$presentcount,'empids'=>$presentempids);
						}
						else
						{
							$absentcount+=1;
							$absentempids.=$rec['emp_id'].',';
							$absent=array('absent'=>$absentcount,'empids'=>$absentempids);
						}
					}
				}
			}			
		}
			if($presentcount==0) $present=array('present'=>0,'empids'=>0);
			if($absentcount==0) $absent=array('absent'=>0,'empids'=>0);
			$total=getDuplicate(EMP,'emp_dept_id!=1');
			$pending=$total-($presentcount+$absentcount);
			if($presentcount==0 && $absentcount==0) $pendingempids=getQueryRecords('select id from '.EMP.' where emp_dept_id!=1');
			else $pendingempids=getQueryRecords('select id from '.EMP.' where id not in ('.rtrim($present['empids'].$absent['empids'],',').') and emp_dept_id!=1');
			if(count($pendingempids)>0)
			{	$pendingempid='';
				foreach($pendingempids as $id)
				{
					$pendingempid.=$id['id'].',';
				}
				$pendingempids=$pendingempid;
			}
			else $pendingempids=0;

			$pending=array('pending'=>$pending,'pendingempids'=>$pendingempids);
			$recs=array('present'=>$present,'absent'=>$absent,'pending'=>$pending);

		echo json_encode($recs);
	}
	else
	if($_GET['path']=='getEMPSbyAttendance')
	{
		if($searchby=='pending') $where='where emp.id in ('.rtrim($empids,',').')';
		else $where='where att.month_year="'.date('M-Y').'" and att.date like "%'.date('d').'%" and emp.id in ('.rtrim($empids,',').')';
		$recs=getQueryRecords('select att.*,emp.emp_id as empid,emp_name from '.EMP.' emp LEFT join '.EMPATTENDANCE.' att on emp.id=att.emp_id '.$where);
		if($recs=='') $recs=0;

		echo json_encode($recs);
	}
	else
	if($_GET['path']=='submitExpenses')
	{
		$data['emp_id']=$_SESSION['nivsmartid'];
		$data['branch_id']=$_SESSION['niv_branchid'];
		$data['from_date']=DBDATE($from_date);
		$data['to_date']=DBDATE($to_date);
		$data['type']=$type.'*';
		$data['amount']=$amount.'*';
		$data['remarks']=$remarks.'*';
		$data['created_date_time']=CDATE;

		$id=addRecord(EMPEXPENSES,$data);
		if($id)
		{
			$updata['tokenid']='EXPENSE'.str_pad($id, 3, 0, STR_PAD_LEFT);
			updateRecord(EMPEXPENSES,$updata,'id='.$id);
			$recs=getRecords(EMPEXPENSES,'emp_id='.$_SESSION['nivsmartid'].' and branch_id='.$_SESSION['niv_branchid'].' order by id desc');
		}
		else $recs=0;

		echo json_encode($recs);
	}
	else
	if($_GET['path']=='getEMPExpenses')
	{
		$recs=getRecords(EMPEXPENSES,'emp_id='.$_SESSION['nivsmartid'].' and branch_id='.$_SESSION['niv_branchid'].' order by id desc');
		if($recs=='') $recs=0;

		echo json_encode($recs);
	}
	else
	if($_GET['path']=='getEMPExpensesbyBranch')
	{
		if($_SESSION['nivsmartid']==1) $where='where 1';
		else $where='where exp.branch_id='.$_SESSION['niv_branchid'];
		$recs=getQueryRecords('select exp.*,emp.emp_id as empid,emp.emp_name,b.branch_name from '.EMPEXPENSES.' exp join '.EMP.' emp on emp.id=exp.emp_id join '.BRANCHES.' b on b.id=exp.branch_id '.$where.' order by exp.id desc');
		if($recs=='') $recs=0;

		echo json_encode($recs);
	}
	else
	if($_GET['path']=='updateExpensesByAdmin')
	{
		$data['admin_status']=$admin_status;
		$data['admin_remarks']=$admin_remarks;
		$data['last_updated_date_time']=CDATE;

		updateRecord(EMPEXPENSES,$data,'id='.$payid);

		echo json_encode(1);
	}
	else
	if($_GET['path']=='updateExpensesByMaster')
	{
		$data['master_status']=$master_status;
		$data['master_remarks']=$master_remarks;
		$data['last_updated_date_time']=CDATE;

		updateRecord(EMPEXPENSES,$data,'id='.$payid);

		echo json_encode(1);
	}
	else
	if($_GET['path']=='updateExpensesByACUNT')
	{
		$data['paid_status']=1;
		$data['paid_remarks']=$paid_remarks;
		$data['paid_date_time']=CDATE;

		updateRecord(EMPEXPENSES,$data,'id='.$payid);

		echo json_encode(1);
	}
	else
	if($_GET['path']=='getMonthlyFollowupLeads')
	{
		$recs=getMonthlyFollowupLeads();

		echo json_encode($recs);
	}
	else
	if($_GET['path']=='movetoInboxMonthlyLead')
	{
		$check=getDuplicate(MONTHLYFOLLOWUP,'monthly_status=0 and empid=0');
		if($check==1)
		{
			$data['empid']=$_SESSION['nivsmartid'];
			updateRecord(MONTHLYFOLLOWUP,$data,'id='.$id);
			$result=1;
		}
		else $result=3;

		$recs=getMonthlyFollowupLeads();
		$data=array('result'=>$result,'recs'=>$recs);
		echo json_encode($data);
	}
	else
	if($_GET['path']=='getInboxMonthlyFollowupLeads')
	{
		$recs=getQueryRecords('select mon.*,l.lead_id,tallycus.serial_no,cus.company_name,cus.contact_no_1,cus.contact_person from '.MONTHLYFOLLOWUP.' mon join '.CRMLEADS.' l on l.id=mon.leadid join '.TALLY_CUSTOMERS.' tallycus on tallycus.leadid=l.id join '.CUSTOMERDETAILS.' cus on cus.id=l.customer_id where mon.empid='.$_SESSION['nivsmartid'].' and monthly_status=0');
		if($recs=='') $recs=0;

		echo json_encode($recs);
	}
	else
	if($_GET['path']=='updateMonthlyLead')
	{
		$data['remarks']=$remarks;
		$data['monthly_status']=1;
		$data['updated_date_time']=CDATE;
		updateRecord(MONTHLYFOLLOWUP,$data,'id='.$id);

		$rec=getRecord(MONTHLYFOLLOWUP,'id='.$id);
		$count=getDuplicate(MONTHLYFOLLOWUP,'leadid='.$rec['leadid']);
		if($count<12)
		{
			$monthdata['leadid']=$rec['leadid'];
			$monthdata['followupdate']=date('Y-m-d', strtotime('+1 month',strtotime($rec['followupdate'])));
			addRecord(MONTHLYFOLLOWUP,$monthdata);	
		}
		echo json_encode($data);
	}
	else
	if($_GET['path']=='getNIVUsers')
	{
		$recs=getQueryRecords('select c.company_name,c.contact_no_1,c.contact_person,l.id,l.lead_id,tallcus.created_date_time,tallcus.serial_no from '.CRMLEADS.' l join '.CUSTOMERDETAILS.' c on c.id=l.customer_id LEFT join '.EMP.' emp on emp.id=l.is_present LEFT join '.TALLY_CUSTOMERS.' tallcus on tallcus.leadid=l.id where lead_completed=1 and status=1 order by l.id desc');
		if($recs=='') $recs=0;

		echo json_encode($recs);
	}
	else
	if($_GET['path']=='addTeam')
	{
		$data['name']=$name;
		$data['status']=1;
		$data['updated_date_time']=CDATE;
		if(!empty($id)) $where='name="'.$name.'" and id!='.$id; else $where='name="'.$name.'"';
		$check=getDuplicate(TEAMS,$where);
		if($check==0)
		{	
			if(!empty($id)) updateRecord(TEAMS,$data,'id='.$id);
			else addRecord(TEAMS,$data);
			$recs=getRecords(TEAMS,'1 order by name');
			if($recs=='') $recs=0;
		}
		else $recs=2;
		echo json_encode($recs);
	}
	else
	if($_GET['path']=='getTeams')
	{
		$recs=getRecords(TEAMS,'1 order by name');
		if($recs=='') $recs=0;

		echo json_encode($recs);
	}
	else
	if($_GET['path']=='getTeam')
	{
		$rec=getRecord(TEAMS,'id='.$id);
		echo json_encode($rec);
	}
	else
	if($_GET['path']=='changeTeamStatus')
	{
		$data['status']=$status;
		$data['updated_date_time']=CDATE;
		$rec=updateRecord(TEAMS,$data,'id='.$id);
		$recs=getRecords(TEAMS,'1 order by name');
		if($recs=='') $recs=0;

		echo json_encode($recs);
	}
	else
	if($_GET['path']=='AMCLeadCreation')
	{
		extract((array)$request);

		$cdata['company_name']=$company_name;
		$cdata['contact_no_1']=$contact_no_1;
		if(!empty($contact_no_2)) $cdata['contact_no_2']=$contact_no_2;
		$cdata['contact_person']=$contact_person;
		$cdata['addr']=$addr;
		$cdata['state_id']=$state_id;
		$cdata['city_id']=$city_id;
		$cdata['created_date_time']=CDATE;
		//$ldata['lead_branch_id']=$lead_branch_id;
		$ldata['source_from']=0;
		//$ldata['created_emp_id']=$_SESSION['nivsmartid'];
		$ldata['nature_of_business_type']=$nature_of_business_type;
		$ldata['business_name']=$business_name;
		$ldata['if_interest_amc']=$if_interest_amc;
		//if($if_tally_customer==0) $ldata['any_other_software']=$any_other_software;
		if($if_interest_amc==1)
		{
			$ldata['tally_serial_no']=$tally_serial_no;
			$ldata['tally_expiry_date']=DBDATE($tally_expiry_date);
			$ldata['amc_expiry_date']=DBDATE($amc_expiry_date);
			$ldata['hardware_contact_name']=$hardware_contact_name;
			$ldata['hardware_phno']=$hardware_phno;
			if(!empty($hardware_optional_no)) $ldata['hardware_optional_no']=$hardware_optional_no;
			$ldata['accountant_contact_name']=$accountant_contact_name;
			$ldata['accountant_phno']=$accountant_phno;
			if(!empty($accountant_optional_no)) $ldata['accountant_optional_no']=$accountant_optional_no;
		}
		$ldata['remarks']=$remarks;
		$ldata['status']=0;

		if($if_referred==1)
		{
			$rdata['referred_company']=$referred_company;
			$rdata['referred_person']=$referred_person;
			$rdata['referred_contact_no']=$referred_contact_no;
			$rid=addRecord(CRMREFERREDCUSTOMER,$rdata);
		}
		if(!empty($rid)) $ldata['if_referred']=$rid; else $ldata['if_referred']=0;

		$cid=addRecord(CUSTOMERDETAILS,$cdata);
		if($cid)
		{
			$ldata['customer_id']=$cid;
			$ldata['created_date_time']=CDATE;
			$lid=addRecord(AMCLEADS,$ldata);
			if($lid)
			{
				$leaddata['amc_lead_id']='AMCLID'.str_pad($lid,3,0,STR_PAD_LEFT);
				updateRecord(AMCLEADS,$leaddata,'id='.$lid);
				
				$result=1;
				$recs=getAMCCreatedLeads();
				$result=array('result'=>$result,'recs'=>$recs);
			}
			else $result=0;
		}
		else $result=0;

		echo json_encode($result);
	}
	else
	if($_GET['path']=='getAMCCreatedLeads')
	{
		echo json_encode(getAMCCreatedLeads());
	}
	else
	if($_GET['path']=='getAMCViewLead')
	{
		$rec=getQueryRecord('select c.company_name,c.contact_no_1,c.contact_person,c.contact_no_2,c.addr,l.*,s.state,city.city,r.referred_company,r.referred_person,r.referred_contact_no,b.business_name from '.AMCLEADS.' l join '.CUSTOMERDETAILS.' c on c.id=l.customer_id LEFT join '.STATES.' s on s.id=c.state_id LEFT join '.CITIES.' city on city.id=c.city_id LEFT join '.CRMREFERREDCUSTOMER.' r on r.id=l.if_referred LEFT join '.BUSINESS.' b on b.id=l.business_name where l.id='.$id);
		
		echo json_encode($rec);
	}
}
else echo json_encode(104);
}
?>