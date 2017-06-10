<?php
if(empty($_SESSION['nivsmartid']))
{
	echo '<script>window.location.href="../index.php";</script>';
}
else
if(($_SESSION['niv_deptid']!=4 && $_SESSION['niv_roleid']!=7) && ($_SESSION['niv_deptid']!=5 && $_SESSION['niv_roleid']!=9) && ($_SESSION['niv_deptid']!=6 && $_SESSION['niv_roleid']!=11))
{
	echo '<script>window.location.href="../index.php";</script>';
}
else
if(($_SESSION['niv_deptid']==4 && $_SESSION['niv_roleid']==7) || ($_SESSION['niv_deptid']==5 && $_SESSION['niv_roleid']==9) || ($_SESSION['niv_deptid']==6 && $_SESSION['niv_roleid']==11))
{
	$user=getRecord(EMP,'emp_id="'.$_SESSION['nivsmartid'].'"');
	if(empty($_SESSION['niv_branch']))
	{
		echo '<script>window.location.href="branchselection.php";</script>';
	}
}
?>