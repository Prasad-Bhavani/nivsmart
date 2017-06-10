<?php
if(empty($_SESSION['nivsmartid']))
{
	header('Location: ../index.php');
	exit;
}
else if($_SESSION['niv_deptid']!=1 && $_SESSION['niv_roleid']!=1)
	header('Location: ../index.php');
?>