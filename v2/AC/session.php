<?php
if(empty($_SESSION['nivsmartid']))
{
	echo '<script>window.location.href="../index.php";</script>';
}
else
if($_SESSION['niv_deptid']!=7 && $_SESSION['niv_roleid']!=12)
{
	echo '<script>window.location.href="../index.php";</script>';
}
else
if($_SESSION['niv_deptid']==7 && $_SESSION['niv_roleid']==12)
{
	$user=getRecord(EMP,'emp_id="'.$_SESSION['nivsmartid'].'"');
	if(empty($_SESSION['niv_branch']))
	{
		echo '<script>window.location.href="branchselection.php";</script>';
	}
}
?>