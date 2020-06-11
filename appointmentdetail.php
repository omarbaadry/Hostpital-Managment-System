<?php
session_start();
include("dbconnection.php");
if(isset($_POST[submitapp]))
{
	$sql ="INSERT INTO appointment(appointmenttype,roomid,departmentid,appointmentdate,appointmenttime,doctorid) values('$_POST[select]','$_POST[select2]','$_POST[select3]','$_POST[date]','$_POST[time]','$_POST[select5]')";
	if($qsql = mysqli_query($con,$sql))
	{
		echo "<script>alert('appointment record inserted successfully...');</script>";
	}
	else
	{
		echo mysqli_error($con);
	}
}

if(isset($_GET[editid]))
{
	$sql="SELECT * FROM appointment WHERE appointmentid='$_GET[editid]' ";
	$qsql = mysqli_query($con,$sql);
	$rsedit = mysqli_fetch_array($qsql);
	
}

	$sqlappointment1 = "SELECT max(appointmentid) FROM appointment where patientid='$_GET[patientid]' AND (status='Active' OR status='Approved')";
	$qsqlappointment1 = mysqli_query($con,$sqlappointment1);
	$rsappointment1=mysqli_fetch_array($qsqlappointment1);
	
	$sqlappointment = "SELECT * FROM appointment where appointmentid='$rsappointment1[0]'";
	$qsqlappointment = mysqli_query($con,$sqlappointment);
	$rsappointment=mysqli_fetch_array($qsqlappointment);
	
if(mysqli_num_rows($qsqlappointment) == 0)
{
	echo "<center><h2>No Appointment records found..</h2></center>";
}
else
{
	$sqlappointment = "SELECT * FROM appointment where appointmentid='$rsappointment1[0]'";
	$qsqlappointment = mysqli_query($con,$sqlappointment);
	$rsappointment=mysqli_fetch_array($qsqlappointment);
	
	$sqlroom = "SELECT * FROM room where roomid='$rsappointment[roomid]' ";
	$qsqlroom = mysqli_query($con,$sqlroom);
	$rsroom =mysqli_fetch_array($qsqlroom);
	
	$sqldepartment = "SELECT * FROM department where departmentid='$rsappointment[departmentid]'";
	$qsqldepartment = mysqli_query($con,$sqldepartment);
	$rsdepartment =mysqli_fetch_array($qsqldepartment);
	
	$sqldoctor = "SELECT * FROM doctor where doctorid='$rsappointment[doctorid]'";
	$qsqldoctor = mysqli_query($con,$sqldoctor);
	$rsdoctor =mysqli_fetch_array($qsqldoctor);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
  <title>HOSPITAL PROJECT</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500,600,700,800,900" rel="stylesheet">

    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">

    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/ionicons.min.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">

    
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
  <nav class="navbar py-4 navbar-expand-lg ftco_navbar navbar-light bg-light flex-row">
    	<div class="container">
    		<div class="row no-gutters d-flex align-items-start align-items-center px-3 px-md-0">
    			<div class="col-lg-2 pr-4 align-items-center">
		    		<a class="navbar-brand" >Cairo.<span>Hospital</span></a>
	    		</div>
	    		<div class="col-lg-10 d-none d-md-block">
		    		<div class="row d-flex">
			    		<div class="col-md-4 pr-4 d-flex topper align-items-center">
			    			<div class="icon bg-white mr-2 d-flex justify-content-center align-items-center"><span class="icon-map"></span></div>
						    <span class="text">Address: 198 West 21th Street, Australia</span>
					    </div>
					    <div class="col-md pr-4 d-flex topper align-items-center">
					    	<div class="icon bg-white mr-2 d-flex justify-content-center align-items-center"><span class="icon-paper-plane"></span></div>
						    <span class="text">Email: ziaddiab74@l@email.com</span>
					    </div>
					    <div class="col-md pr-4 d-flex topper align-items-center">
					    	<div class="icon bg-white mr-2 d-flex justify-content-center align-items-center"><span class="icon-phone2"></span></div>
						    <span class="text">Phone: 01100036613</span>
					    </div>
				    </div>
			    </div>
		    </div>
		  </div>
    </nav>
<table width="464" border="1">
  
  <tr>
    <td>Appointment No.</td>
    <td>&nbsp;<?php echo $_GET[appointmentid]; ?></td>
  </tr>
  <tr>
    <td>Department</td>
    <td>&nbsp;<?php echo $rsdepartment[departmentname]; ?></td>
  </tr>
  <tr>
    <td>Doctor</td>
    <td>&nbsp;<?php echo $rsdoctor[doctorname]; ?></td>
  </tr>
  <tr>
    <td>Appointment Date</td>
    <td>&nbsp;<?php echo date("d-M-Y",strtotime($rsappointment[appointmentdate])); ?></td>
  </tr>
  <tr>
    <td>Appointment Time</td>
    <td>&nbsp;<?php echo date("h:i A",strtotime($rsappointment[appointmenttime])); ?></td>
  </tr>
</table>
<button onclick="goBack()">Go Back</button>

<script>
function goBack() {
  window.history.back();
}
</script>
<?php
}
?>
<script type="application/javascript">
function validateform()
{
	
	if(document.frmappntdetail.select.value == "")
	{
		alert("Appointment type should not be empty..");
		document.frmappntdetail.select.focus();
		return false;
	}
	else if(document.frmappntdetail.select2.value == "")
	{
		alert("Room type should not be empty..");
		document.frmappntdetail.select2.focus();
		return false;
	}
	else if(document.frmappntdetail.select3.value == "")
	{
		alert("Department name should not be empty..");
		document.frmappntdetail.select3.focus();
		return false;
	}
	else if(document.frmappntdetail.date.value == "")
	{
		alert("Appointment date should not be empty..");
		document.frmappntdetail.date.focus();
		return false;
	}
	else if(document.frmappntdetail.time.value == "")
	{
		alert("Appointment time should not be empty..");
		document.frmappntdetail.time.focus();
		return false;
	}
	else if(document.frmappntdetail.select5.value == "")
	{
		alert("Doctor name should not be empty..");
		document.frmappntdetail.select5.focus();
		return false;
	}
	else
	{
		return true;
	}
}
</script>