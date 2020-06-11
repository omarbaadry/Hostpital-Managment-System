<?php
include("header.php");
include("dbconnection.php");
if(isset($_POST[submit]))
{
	if(isset($_GET[editid]))
	{
		$sql ="UPDATE prescription SET ,doctorid='$_POST[select2]',patientid='$_POST[patientid]',prescriptiondate='$_POST[date]',status='$_POST[select]' WHERE prescription_id='$_GET[editid]'";
		if($qsql = mysqli_query($con,$sql))
		{
			echo "<script>alert('prescription record updated successfully...');</script>";
		}
		else
		{
			echo mysqli_error($con);
		}	
	}
	else
	{
		$sql ="INSERT INTO prescription(doctorid,patientid,prescriptiondate,status,appointmentid) values('$_POST[select2]','$_POST[patientid]','$_POST[date]','Active','$_GET[appid]')";
		if($qsql = mysqli_query($con,$sql))
		{
			$insid= mysqli_insert_id($con);
			$prescriptionid= $insid;
			$prescriptiondate= $_POST[date];
			$billtype="Prescription charge";
			$billamt=0;
			include("insertbillingrecord.php");	
			echo "<script>alert('prescription record inserted successfully...');</script>";
			echo "<script>window.location='prescriptionrecord.php?prescriptionid=" . $insid . "&patientid=$_GET[patientid]&appid=$_GET[appid]';</script>";
		}
		else
		{
			echo mysqli_error($con);
		}
	}
}
if(isset($_GET[editid]))
{
	$sql="SELECT * FROM prescription WHERE prescriptionid='$_GET[editid]' ";
	$qsql = mysqli_query($con,$sql);
	$rsedit = mysqli_fetch_array($qsql);
	
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
      <li class="first">Add New Prescription</li></ul>
  </div>
</div>
<div class="wrapper col4">
  <div id="container">
    <h1>Add new prescription record</h1>
     <form method="post" action="" name="frmpres" onSubmit="return validateform()">
     <input type="hidden" name="patientid" value="<?php echo $_GET[patientid]; ?>"  />
     
     <input type="hidden" name="appid" value="<?php echo $_GET[appid]; ?>"  />
    <table width="200" border="3">
      <tbody>
        <tr>
          <td>Patient</td>
          <td>
            <?php
		  	$sqlpatient= "SELECT * FROM patient WHERE status='Active' AND patientid='$_GET[patientid]'";
			$qsqlpatient = mysqli_query($con,$sqlpatient);
			while($rspatient=mysqli_fetch_array($qsqlpatient))
			{
				echo "$rspatient[patientid]- $rspatient[patientname]";
			}
		  ?></td>
        </tr>
        
  <?php
		if(isset($_SESSION[doctorid]))
		{
		?>
        <tr>
          <td>Doctor</td>
          <td>
    		<?php
				$sqldoctor= "SELECT * FROM doctor INNER JOIN department ON department.departmentid=doctor.departmentid WHERE doctor.status='Active' AND doctor.doctorid='$_SESSION[doctorid]'";
				$qsqldoctor = mysqli_query($con,$sqldoctor);
				while($rsdoctor = mysqli_fetch_array($qsqldoctor))
				{
					echo "$rsdoctor[doctorname] ( $rsdoctor[departmentname] )";
				}
				?>
                <input type="hidden" name="select2" value="<?php echo $_SESSION[doctorid]; ?>"  />
          </td>
        <?php
		}
		else
		{
		?>        
        <tr>
          <td width="34%">Doctor</td>
          <td width="66%"><select name="select2" id="select2">
          <option value="">Select</option>
            <?php
          	$sqldoctor= "SELECT * FROM doctor WHERE status='Active'";
			$qsqldoctor = mysqli_query($con,$sqldoctor);
			while($rsdoctor = mysqli_fetch_array($qsqldoctor))
			{
				if($rsdoctor[doctorid] == $rsedit[doctorid])
				{
				echo "<option value='$rsdoctor[doctorid]' selected>$rsdoctor[doctorid]-$rsdoctor[doctorname]</option>";
				}
				else
				{
				echo "<option value='$rsdoctor[doctorid]'>$rsdoctor[doctorid]-$rsdoctor[doctorname]</option>";				
				}
			}
		  ?>
          </select></td>
        </tr>
        <?php
		}
		?>
        <tr>
          <td>Prescription Date</td>
          <td><input type="date" name="date" id="date" value="<?php echo $rsedit[prescriptiondate]; ?>" /></td>
        </tr>
       
        <tr>
          <td colspan="2" align="center"><input type="submit" name="submit" id="submit" value="Submit" /></td>
        </tr>
      </tbody>
    </table>
    <p>&nbsp;</p>
	
</div>
 <div class="clear"></div>
  </div>
</div>

<script type="application/javascript">
function validateform()
{
	if(document.frmpres.select2.value == "")
	{
		alert("Doctor name should not be empty..");
		document.frmpres.select2.focus();
		return false;
	}
	
	else if(document.frmpres.select3.value == "")
	{
		alert("Patient name should not be empty..");
		document.frmpres.select3.focus();
		return false;
	}
	else if(document.frmpres.date.value == "")
	{
		alert("Prescription date should not be empty..");
		document.frmpres.date.focus();
		return false;
	}
	else if(document.frmpres.select.value == "" )
	{
		alert("Kindly select the status..");
		document.frmpres.select.focus();
		return false;
	}
	else
	{
		return true;
	}
}
</script>