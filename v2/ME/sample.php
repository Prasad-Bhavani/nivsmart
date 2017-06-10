<?php include_once('../db/config.php');
include_once('../db/functions.php');
include_once('../db/user_functions.php');
include_once('session.php');
include_once('header.php'); ?>
<!doctype html>
<html>
<head>
 <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
<style type="text/css">
	
/*Remove that CSS*/
.col-md-3 {
    margin-left:5%;
    }
/*Remove that CSS*/



button {
  margin: 20px 0;
  line-height: 34px;
  position: relative;
  cursor: pointer;
  user-select: none;
  outline:none !important;
  width:100%;
}

button:active {

  outline:none;
}

button.ribbon {
  
  outline:none;
  outline-color: transparent;
}
button.ribbon:before, button.ribbon:after {
  top: 5px;
  z-index: -10;
}
button.ribbon:before {
  border-color: #53dab6 #53dab6 #53dab6 transparent;
  left: -25px;
  border-width: 17px;
}
button.ribbon:after {
  border-color: #53dab6 transparent #53dab6 #53dab6;
  right: -25px;
  border-width: 17px;
}

button:before, button:after {
  content: '';
  position: absolute;
  height: 0;
  width: 0;
  border-style: solid;
  border-width: 0;
  outline:none;
}

button.btn-default:before {
  border-color: #757575 #757575 #757575 transparent;
    }
    button.btn-default:after {
  border-color: #757575 transparent #757575 #757575;
    }
    
    
    
    button.btn-primary:before {
  border-color: #2e6da4 #2e6da4 #2e6da4 transparent;
    }
    button.btn-primary:after {
  border-color: #2e6da4 transparent #2e6da4 #2e6da4;
    }
    
    
    button.btn-success:before {
  border-color: #398439 #398439 #398439 transparent;
    }
    button.btn-success:after {
  border-color: #398439 transparent #398439 #398439;
    }
    
    
    button.btn-info:before {
  border-color: #269abc #269abc #269abc transparent;
    }
    button.btn-info:after {
  border-color: #269abc transparent #269abc #269abc;
    }
    
    
    button.btn-warning:before {
  border-color: #d58512 #d58512 #d58512 transparent;
    }
    button.btn-warning:after {
  border-color: #d58512 transparent #d58512 #d58512;
    }
    
    
    button.btn-danger:before {
  border-color: #ac2925 #ac2925 #ac2925 transparent;
    }
    button.btn-danger:after {
  border-color: #ac2925 transparent #ac2925 #ac2925;
    }
    
    

</style>
</head>
<body>
<div class="container">
	<div class="row">
		<h2>Bootstrap Ribbon Buttons</h2>
	</div>
    
    <div class="row">
    
    <div class="col-md-6">       <!-- Standard button -->
<button type="button" class="btn btn-default ribbon">Default</button>

<!-- Provides extra visual weight and identifies the primary action in a set of buttons -->
<button type="button" class="btn btn-primary ribbon">Primary</button>

<!-- Indicates a successful or positive action -->
<button type="button" class="btn btn-success ribbon">Success</button>

<!-- Contextual button for informational alert messages -->
<button type="button" class="btn btn-info ribbon">Info</button>

<!-- Indicates caution should be taken with this action -->
<button type="button" class="btn btn-warning ribbon">Warning</button>

<!-- Indicates a dangerous or potentially negative action -->
<button type="button" class="btn btn-danger ribbon">Danger</button>

<!-- Deemphasize a button by making it look like a link while maintaining button behavior -->
</div>
  <div class="col-md-3 ">       <!-- Standard button -->
<button type="button" class="btn btn-default ribbon">Default</button>

<!-- Provides extra visual weight and identifies the primary action in a set of buttons -->
<button type="button" class="btn btn-primary ribbon">Primary</button>

<!-- Indicates a successful or positive action -->
<button type="button" class="btn btn-success ribbon">Success</button>

<!-- Contextual button for informational alert messages -->
<button type="button" class="btn btn-info ribbon">Info</button>

<!-- Indicates caution should be taken with this action -->
<button type="button" class="btn btn-warning ribbon">Warning</button>

<!-- Indicates a dangerous or potentially negative action -->
<button type="button" class="btn btn-danger ribbon">Danger</button>

<!-- Deemphasize a button by making it look like a link while maintaining button behavior -->
</div>

  <div class="col-md-2 pull-right">       <!-- Standard button -->
<button type="button" class="btn btn-default  ribbon">Default</button>

<!-- Provides extra visual weight and identifies the primary action in a set of buttons -->
<button type="button" class="btn btn-primary ribbon">Primary</button>

<!-- Indicates a successful or positive action -->
<button type="button" class="btn btn-success ribbon">Success</button>

<!-- Contextual button for informational alert messages -->
<button type="button" class="btn btn-info ribbon">Info</button>

<!-- Indicates caution should be taken with this action -->
<button type="button" class="btn btn-warning ribbon">Warning</button>

<!-- Indicates a dangerous or potentially negative action -->
<button type="button" class="btn btn-danger ribbon">Danger</button>

<!-- Deemphasize a button by making it look like a link while maintaining button behavior -->
</div>
    
 
    </div>
    
    
</div>
</body>
</html>