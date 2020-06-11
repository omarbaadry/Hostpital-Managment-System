<?php
include("header.php");
include("dbconnection.php");
if(isset($_GET[delid]))
{
	$sql ="DELETE FROM patient WHERE patientid='$_GET[delid]'";
	$qsql=mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('patient record deleted successfully..');</script>";
	}
}
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
<div class="wrapper col2">
  <div id="breadcrumb">
    <ul>
      <li class="first">View Patient records</li></ul>
  </div>
</div>
<div class="wrapper col4">
  <div id="container">

<section class="container">
<h2>Search Patient - <input type="search" class="light-table-filter" data-table="order-table" placeholder="Filtrer" /></h2>


	<table class="order-table">
      <thead>
        <tr>
          <th width="15%" height="36"><div align="center">Patient Name</div></th>
          <th width="20%"><div align="center">Admission details</div></th>
          <th width="28%"><div align="center">Address</div></th>    
          <th width="20%"><div align="center">Patient Profile</div></th>
          <th width="17%"><div align="center">Action</div></th>
        </tr>
        </thead>
      <tbody>
   <?php
		$sql ="SELECT * FROM patient";
		$qsql = mysqli_query($con,$sql);
		while($rs = mysqli_fetch_array($qsql))
		{
        echo "<tr>
          <td>$rs[patientname]<br>
		  <strong>Login ID :</strong> $rs[loginid] </td>
          <td>
		  <strong>Date</strong>: &nbsp;$rs[admissiondate]<br>
		 <strong>Time</strong>: &nbsp;$rs[admissiontime]</td>
		   <td>$rs[address]<br>$rs[city] -  &nbsp;$rs[pincode]<br>
Mob No. - $rs[mobileno]</td>
			    <td><strong>Blood group</strong> - $rs[bloodgroup]<br>
<strong>Gender</strong> - &nbsp;$rs[gender]<br>
<strong>DOB</strong> - &nbsp;$rs[dob]</td>
          <td align='center'>Status - $rs[status] <br>";
if(isset($_SESSION[adminid]))
{
		  echo "<a href='patient.php?editid=$rs[patientid]'>Edit</a> | <a href='viewpatient.php?delid=$rs[patientid]'>Delete</a> <hr>
<a href='patientreport.php?patientid=$rs[patientid]'>View Report</a>";
}
		  echo "</td></tr>";
		}
		?>
      </tbody>
    </table>
</section>
    <p>&nbsp;</p>
    <button onclick="goBack()">Go Back</button>

<script>
function goBack() {
  window.history.back();
}
</script>
  </div>
</div>
</div>
 <div class="clear"></div>
  </div>
</div>
