<?php
if(empty($_SESSION['nivsmartid']))
{
	echo '<script>window.location.href="../index.php";</script>';
}
else if($_SESSION['niv_deptid']!=1 && $_SESSION['niv_roleid']!=1)
{
	echo '<script>window.location.href="../index.php";</script>';
}
?>