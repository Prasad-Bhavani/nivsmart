<?php
include_once('db/config.php');
include_once('db/functions.php');
include_once('db/user_functions.php');

if(isset($_POST['submit_login']) && $_POST['submit_login']=='submit_check')
{
    $status=login();
    if($status=='Error')
    {
        $error='Invalid Login Details';
    }
}

if(isset($_GET['action']) && $_GET['action']=='signout')
{
    if(!empty($_SESSION['nivsmartid']))
    {
        unset($_SESSION['nivsmartid']);
        unset($_SESSION['niv_deptid']);
        unset($_SESSION['niv_roleid']);
        unset($_SESSION['niv_branch']);
        unset($_SESSION['niv_email']);
        $_SESSION['msg']='<span style="color:blue">Successfully Logout</span>';
        redirect('index.php');
    }
    redirect('index.php');
}

if(!empty($_SESSION['nivsmartid']))
{
    checkLogin($_SESSION['nivsmartid']);
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Login</title>

    <meta name="description" content="login page" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="shortcut icon" href="images/logo.png" type="image/x-icon">

    <!--Basic Styles-->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link id="bootstrap-rtl-link" href="#" rel="stylesheet" />
    <link href="assets/css/font-awesome.min.css" rel="stylesheet" />

    <!--Fonts-->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,300" rel="stylesheet" type="text/css">

    <!--Beyond styles-->
    <link id="beyond-link" href="assets/css/beyond.min.css" rel="stylesheet" />
    <link href="assets/css/demo.min.css" rel="stylesheet" />
    <link href="assets/css/animate.min.css" rel="stylesheet" />

<style type="text/css">
input.has-error, input:focus.has-error
{
    border: 1px solid #D95C5C;
}
span.error
{
    color: #D95C5C;
    font-size: 11px;
    font-weight:bold;
    position: absolute;
}
span.success
{
    color: #3c763d;
    font-size: 11px;
    margin: 0px;
    padding: 0px;
    position: absolute;
    margin-left: -55px;
}
</style>
</head>
<!--Head Ends-->
<!--Body-->
<body>
    <div class="login-container animated fadeInDown">
        <!-- Login Form Start -->
        <form method="post" name="loginForm" id="loginForm">
        <div align="center" style="font-size:12px" id="msg"><?php if(isset($_SESSION['msg'])) echo $_SESSION['msg']; unset($_SESSION['msg']); ?></div>
        <div class="loginbox bg-white">
            <div class="loginbox-title">SIGN IN</div>
            <div class="loginbox-textbox">
                <input type="text" class="form-control" placeholder="Enter User ID" onblur="this.placeholder='Enter User ID'" onfocus="this.placeholder=''" name="userid" id="userid" value="<?php if(isset($_POST['userid'])) echo $_POST['userid']; ?>" />
            </div>
            <div class="loginbox-textbox">
                <input type="password" class="form-control"  placeholder="Enter Password" onblur="this.placeholder='Enter Password'" onfocus="this.placeholder=''" name="password" id="password" />
                <?php if(isset($error)) echo '<span class="error" id="error">'.$error.'</span>';?>
            </div>
            <div class="loginbox-forgot">
                <a href="#">Forgot Password?</a>
            </div>
            <div class="loginbox-submit">
                <input type="submit" class="btn btn-primary btn-block" name="login" id="login" value="Login">
            </div>
           
        </div>
      <input type="hidden" name="submit_login" id="submit_login" value="">
  </form>
  <!-- Login Form Start -->
    </div>

    <!--Basic Scripts-->
    <script src="assets/js/jquery.min.js"></script>
    <script src="jquery/jquery.validate.js"></script>
    <script src="jquery/additional-methods.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

<!-- Jquery Validation Start -->
<script type="text/javascript">
$('#loginForm').validate({
    errorElement:'span',
    errorClass:'has-error',
    rules:
    {
        userid:
        {
            required:true
        },
        password:
        {
            required:true
        }
    },
    messages:
    {
        userid:
        {
            required:''
        },
        password:
        {
            required:''
        }
    },
    highlight:function(element,errorClass)
    {
        $(element).addClass('has-error');
    },
    unhighlight:function(element,errorClass)
    {
        $(element).removeClass('has-error');
    }
});
</script>
<!-- Jquery Validation End -->

<script type="text/javascript">
$(document).ready(function(){
    $('#submit_login').val('submit_check');
});

$('form input').keypress(function()
    {
        $('#error').hide();
        $('#success').hide();
        $('#msg').hide();
    });
$("#login").click(function()
    {
        $('#error').hide();
        $('#success').hide();
        $('#msg').hide();
    });
</script>
</body>
</html>