<?php
if(empty($_SESSION['nivsmartid']))
{
	header('Location: ../index.php');
	exit;
}
else
if($_SESSION['niv_deptid']!=8 && $_SESSION['niv_roleid']!=13)
{
	header('Location: ../index.php');
	exit;
}
else
if($_SESSION['niv_deptid']==8 && $_SESSION['niv_roleid']==13)
{
	$user=getRecord(EMP,'emp_id="'.$_SESSION['nivsmartid'].'"');
	if(empty($_SESSION['niv_branch']))
	{
		header('Location: branchselection.php');
		exit;
	}
}
?>