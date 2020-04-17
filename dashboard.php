<?php

error_reporting(1);
?>


<?php require_once 'php_action/core.php'; ?>



<?php //require_once 'includes/header.php'; ?>

<?php 

$sql = "SELECT * FROM product WHERE status = 1";
$query = $connect->query($sql);
$countProduct = $query->num_rows;

$orderSql = "SELECT * FROM orders WHERE order_status = 1 ";
$orderQuery = $connect->query($orderSql);
$countOrder = $orderQuery->num_rows;

$totalRevenue = "";
while ($orderResult = $orderQuery->fetch_assoc()) {
	$totalRevenue += $orderResult['paid'];
}

$lowStockSql = "SELECT * FROM product WHERE quantity <= 3 AND status = 1";
$lowStockQuery = $connect->query($lowStockSql);
$countLowStock = $lowStockQuery->num_rows;

$connect->close();

?>





<!DOCTYPE html>
<html>
<head>

	<title>PridePoint Inventory</title>

	<!-- bootstrap -->
	<link rel="stylesheet" href="assests/bootstrap/css/bootstrap.min.css">
	<!-- bootstrap theme-->
	<link rel="stylesheet" href="assests/bootstrap/css/bootstrap-theme.min.css">
	<!-- font awesome -->
	<link rel="stylesheet" href="assests/font-awesome/css/font-awesome.min.css">

  <!-- custom css -->
  <link rel="stylesheet" href="custom/css/custom.css">

	<!-- DataTables -->
  <link rel="stylesheet" href="assests/plugins/datatables/jquery.dataTables.min.css">

  <!-- file input -->
  <link rel="stylesheet" href="assests/plugins/fileinput/css/fileinput.min.css">

  <!-- jquery -->
	<script src="assests/jquery/jquery.min.js"></script>
  <!-- jquery ui -->  
  <link rel="stylesheet" href="assests/jquery-ui/jquery-ui.min.css">
  <script src="assests/jquery-ui/jquery-ui.min.js"></script>

  <!-- bootstrap js -->
	<script src="assests/bootstrap/js/bootstrap.min.js"></script>

</head>
<body>


	<nav class="navbar navbar-default navbar-static-top">
		<div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <!-- <a class="navbar-brand" href="#">Brand</a> -->
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">      

      <ul class="nav navbar-nav navbar-right">        

      	<li id="navDashboard"><a href="index.php"><i class="glyphicon glyphicon-list-alt"></i>  Dashboard</a></li>        
        
        <li id="navBrand"><a href="brand.php"><i class="glyphicon glyphicon-btc"></i>  Brand</a></li>        

        <li id="navCategories"><a href="categories.php"> <i class="glyphicon glyphicon-th-list"></i> Category</a></li>        

        <li id="navProduct"><a href="product.php"> <i class="glyphicon glyphicon-ruble"></i> Product </a></li>     

        <li class="dropdown" id="navOrder">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="glyphicon glyphicon-shopping-cart"></i> Orders <span class="caret"></span></a>
          <ul class="dropdown-menu">            
            <li id="topNavAddOrder"><a href="orders.php?o=add"> <i class="glyphicon glyphicon-plus"></i> Add Orders</a></li>            
            <li id="topNavManageOrder"><a href="orders.php?o=manord"> <i class="glyphicon glyphicon-edit"></i> Manage Orders</a></li>            
          </ul>
        </li> 

        <li id="navReport"><a href="report.php"> <i class="glyphicon glyphicon-check"></i> Report </a></li>

        <li class="dropdown" id="navSetting">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="glyphicon glyphicon-user"></i> <span class="caret"></span></a>
          <ul class="dropdown-menu">            
            <li id="topNavSetting"><a href="setting.php"> <i class="glyphicon glyphicon-wrench"></i> Setting</a></li>            
            <li id="topNavLogout"><a href="logout.php"> <i class="glyphicon glyphicon-log-out"></i> Logout</a></li>            
          </ul>
        </li>        
               
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
	</nav>

	<div class="container">














<style type="text/css">
	.ui-datepicker-calendar {
		display: none;
	}
</style>

<!-- fullCalendar 2.2.5-->
    <link rel="stylesheet" href="assests/plugins/fullcalendar/fullcalendar.min.css">
    <link rel="stylesheet" href="assests/plugins/fullcalendar/fullcalendar.print.css" media="print">


<div class="row">
	
	<div class="col-md-4">
		<div class="panel panel-success">
			<div class="panel-heading">
				
				<a href="product.php" style="text-decoration:none;color:black;">
					Total Product
					<span class="badge pull pull-right"><?php echo $countProduct; ?></span>	
				</a>
				
			</div> <!--/panel-hdeaing-->
		</div> <!--/panel-->
	</div> <!--/col-md-4-->

		<div class="col-md-4">
			<div class="panel panel-info">
			<div class="panel-heading">
				<a href="orders.php?o=manord" style="text-decoration:none;color:black;">
					Total Orders
					<span class="badge pull pull-right"><?php echo $countOrder; ?></span>
				</a>
					
			</div> <!--/panel-hdeaing-->
		</div> <!--/panel-->
		</div> <!--/col-md-4-->

	<div class="col-md-4">
		<div class="panel panel-danger">
			<div class="panel-heading">
				<a href="product.php" style="text-decoration:none;color:black;">
					Low Stock
					<span class="badge pull pull-right"><?php echo $countLowStock; ?></span>	
				</a>
				
			</div> <!--/panel-hdeaing-->
		</div> <!--/panel-->
	</div> <!--/col-md-4-->

	<div class="col-md-4">
		<div class="card">
		  <div class="cardHeader">
		    <h1><?php echo "Today:"; echo date('d/m/Y'); ?></h1>
		  </div>

		  <div class="cardContainer">
		    <p><?php echo date('l') .' '.date('d').', '.date('Y'); ?></p>
		  </div>
		</div> 
		<br/>

		<div class="card">
		  <div class="cardHeader" style="background-color:#245580;">
		    <h1><?php
			
require_once("vars.php");

 $date=date('Y-m-d');
//echo"$date";
$con=mysqli_connect(host,user,pass,dbname) or die("Error in connection".mysqli_connect_error());

      if($qw="select * from details where date<='$date'")
	  {
      $qq = mysqli_query($con,$qw);
      while($r=mysqli_fetch_array($qq,MYSQLI_ASSOC))
      {
      
	  }
	  }
	    ?>

        <?php echo $r['itemname']; ?>			
		
<?php
        	//if($totalRevenue) {
		    	//echo $totalRevenue;
		    	//} else {
		    		//echo '0';
		    		//}
				
				
				
				
				
				
				//	if(isset($_POST["mydt"]))
					//{
					
				//	$gotdt=$_POST["myclndr"];
					$cont1=mysqli_connect(host,user,pass,dbname) or die("Error in connection".mysqli_connect_error());
				$qt1="select SUM(paid) as total FROM orders ";
			       $res1 = mysqli_query($cont1,$qt1);
				//	while($w1=mysqli_fetch_array($res1))
				$w1=mysqli_fetch_array($res1);
					
						//echo "$pay";
					//	echo $w[9];
						
				//	}
					//else
					
					//{
						
					
				//	echo $totalRevenue;
					echo $w1['total'];
					
				//	}
					
					
					//}
	?>		
			
					 </h1>
		  </div>

		  <div class="cardContainer">
		    <p> <i class="glyphicon glyphicon-usd"></i> Total Revenue</p>
		  </div>
		</div> 

	</div>

	<div class="col-md-8">
		<div class="panel panel-default">
			<div class="panel-heading"> <i class="glyphicon glyphicon-calendar"></i> Check Revenue By Date  </div>
			<div class="panel-body">
			<?php
			 //echo"	<div id='calendar'></div></div>	";
			
		//echo "<input type='text' id='datepicker' name'calendar'>";
		echo"<form method='post' name='myform1'>";
		
			echo "<input type='date' id='datepicke' name='myclndr'><input type='submit' name='mydt' value='Submit'>";
		echo"";
			echo"</form>";
			?>
		</div>
        
		
        
        
        
        
        
        
        
        
        
        <?php
        	//if($totalRevenue) {
		    	//echo $totalRevenue;
		    	//} else {
		    		//echo '0';
		    		//}
					if(isset($_POST["mydt"]))
					{
					
					$gotdt=$_POST["myclndr"];
					$cont=mysqli_connect(host,user,pass,dbname) or die("Error in connection".mysqli_connect_error());
					$qt="select * from orders where order_date='$gotdt'";
			        $res = mysqli_query($cont,$qt);
					$cnt1=mysqli_affected_rows($cont);
					
					
					
					
					$cont1=mysqli_connect(host,user,pass,dbname) or die("Error in connection".mysqli_connect_error());
					$qt1="select * from orders where order_date='$gotdt'";
			        $res1 = mysqli_query($cont1,$qt1);
					$cnt11=mysqli_affected_rows($cont1);
					
					
					
					
			//		$w1=mysqli_fetch_array($res);
		//			$ttd=$w[1];
			//		$pay=$w[9];
		//			if($ttd==$date)
				//{
					
					if($cnt1>0)
					{
					while($w=mysqli_fetch_array($res))
					{
						//echo "$pay";
						echo "Date:$w[1]&nbsp;&nbsp;&nbsp;&nbsp;$w[9]$<br>";
						
						
						//print_r(SUM($w[9]));
						
					}
				
					}
					//}
				//else
				
				//{
				//echo"No records found please confirm or enter the correct date.....";	
				
					
					
				else
				{
				echo"No records found please confirm or enter the correct date.....";	
				
				
				}
				}
				
?>        
        
        
        
	</div>

	<?php //echo"	<div id='calendar'></div></div>	";
			
	
			
			?>
</div> <!--/row-->






  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="//code.jquery.com/jquery-1.12.4.js"></script>
  <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  
  <script>
  $( function() {
    $( "#datepicker" ).datepicker({
		dateFormat: "yy-mm-dd",
		 showOn: "button",
		 disabled: false,
		showOptions: { direction: "up" },
		  altFormat: "yy-mm-dd",
		  buttonImage: "calendar.gif",
		 changeMonth: true,
		 changeDay: true
	
  });
	
	
  } );
  </script>
</head>


















<!-- fullCalendar 2.2.5 -->
  



<script type="text/javascript">
	$(function () {
			// top bar active
	$('#navDashboard').addClass('active');

      //Date for the calendar events (dummy data)
      var date = new Date();
      var d = date.getDate(),
      m = date.getMonth(),
      y = date.getFullYear();

      $('#calendar').fullCalendar({
        header: {
          left: '',
          center: 'title'
        },
        buttonText: {
          today: 'today',
          month: 'month'          
        }        
      });


    });
</script>

<?php require_once 'includes/footer.php'; ?>