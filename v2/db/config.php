<?php
ob_start();
@session_start();
date_default_timezone_set("Asia/Calcutta");
define('CDATE',date('Y-m-d H:i:s'));

define('ONSITE',false);

define('NIV',true);

define('SITENAME','NIV SMART');

if(ONSITE)
{
	if(NIV)
	{
		define('HOST','localhost');
		define('DBUSER','nivinfoc_tally');
		define('DBPASS','nivINFO@12#');
		define('DBNAME','nivinfoc_tallyusers');
	}
	else
	{
		define('HOST','localhost');
		define('DBUSER','lyratech_nivsmar');
		define('DBPASS','NivSmart@444');
		define('DBNAME','lyratech_nivsmart');		
	}
}
else
{
	define('HOST','localhost');
	define('DBUSER','root');
	define('DBPASS','');
	define('DBNAME','nivsmart');
}

if(!mysql_connect(HOST,DBUSER,DBPASS)) die(mysql_error());
if(!mysql_select_db(DBNAME)) die(mysql_error());

define('LOGIN','login_details');
define('STATES','states');
define('CITIES','cities');
define('BRANCHES','branches');
define('PRODUCTTYPES','product_types');
define('PRODUCTS','products');
define('BUSINESS','business_names');
define('DEPARTMENTS','departments');
define('DEPTROLES','dept_roles');
define('EMP','employees');
define('CRMLEADS','crm_leads');
define('CUSTOMERDETAILS','customer_personal_details');
define('CRMREFERREDCUSTOMER','crm_referred_customers');
define('COLDLEADS','cold_lead_process');
define('HOTLEADS','hot_lead_process');
define('FOLLOWUP','lead_followups');
define('LEADPROCESS','lead_process');
define('QUOTATION','tally_quotation');
define('GUESTUSERS','tally_guest_reg');
define('TALLY_CUSTOMERS','tally_customers');
define('EMPATTENDANCE','emp_attendance');
define('EMPEXPENSES','emp_expenses');
define('MONTHLYFOLLOWUP','monthly_leads_followup');
define('TEAMS','teams');
define('AMCLEADS','amc_leads');
define('TEAMTARGETS','teamtargets');

//truncatetab();

function truncatetab($table)
{
	$sql=@mysql_query('truncate table '.$table);
	if($sql) echo 'Success'; else echo 'Fail';
}

/* For example Poland: -pattern = xxxxxxxxx OR xxx-xxx-xxx OR xxx xxx xxx -regexp ="^\d{9}|^\d{3}-\d{3}-\d{3}|^\d{3}\s\d{3}\s\d{3}" */

/*An internation phone number can be checked like this:

/^\+(?:[0-9] ?){6,14}[0-9]$/
explanation:

^         # Assert position at the beginning of the string.
\+        # Match a literal "+" character.
(?:       # Group but don't capture:
[0-9]     # Match a digit.
\x20      # Match a space character
?         # between zero and one time.
)         # End the noncapturing group.
{6,14}    # Repeat the group between 6 and 14 times.
[0-9]     # Match a digit.
$         # Assert position at the end of the string.*/

/* Leads View */
/*select c.company_name,c.contact_no_1,c.contact_person,c.contact_no_2,c.addr,l.*,s.state,city.city,r.referred_company,r.referred_person,r.referred_contact_no,p.product_name,b.business_name,lp.is_remarks,lp.is_present_at,emp.emp_id as created_emp_id,emp.emp_name as created_emp_name,lp.is_status,lp.is_taken_date_time,lp.is_updated_date_time,empl.emp_id,empl.emp_name,branch.branch_name,l.lead_completed from crm_leads l join customer_personal_details c on c.id=l.customer_id LEFT join states s on s.id=c.state_id LEFT join cities city on city.id=c.city_id join employees emp on emp.id=l.created_emp_id join branches branch on branch.id=l.lead_branch_id LEFT join crm_referred_customers r on r.id=l.if_referred LEFT join products p on p.id=l.prospect_details_id LEFT join business_names b on b.id=l.business_name LEFT join lead_process lp on lp.id=l.last_process_id LEFT join employees empl on empl.id=lp.is_present_at where l.lead_branch_id=4*/
?>