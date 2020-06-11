<?php
include("header.php");
include("dbconnection.php");
if(isset($_POST[submit]))
{
		if(isset($_GET[editid]))
		{
				$sql ="UPDATE patient SET status='Active' WHERE patientid='$_GET[patientid]'";
				$qsql=mysqli_query($con,$sql);
			
			$sql ="UPDATE appointment SET appointmenttype='$_POST[apptype]'='$_POST[select3]',departmentid='$_POST[select5]',doctorid='$_POST[select6]',status='Approved',appointmentdate='$_POST[appointmentdate]',appointmenttime='$_POST[time]' WHERE appointmentid='$_GET[editid]'";
			if($qsql = mysqli_query($con,$sql))
			{
				
							
				echo "<script>alert('appointment record updated successfully...');</script>";				
				echo "<script>window.location='patientreport.php?patientid=$_GET[patientid]&appointmentid=$_GET[editid]';</script>";
			}
			else
			{
				echo mysqli_error($con);
			}	
		}
		else
		{
			$sql ="UPDATE patient SET status='Active' WHERE patientid='$_POST[select4]'";
			$qsql=mysqli_query($con,$sql);
				
			$sql ="INSERT INTO appointment(appointmenttype,patientid,departmentid,appointmentdate,appointmenttime,doctorid,status) values('$_POST[select2]','$_POST[select4]','$_POST[select3]','$_POST[select5]','$_POST[appointmentdate]','$_POST[time]','$_POST[select6]','$_POST[select]')";
			if($qsql = mysqli_query($con,$sql))
			{
				echo "<script>alert('Appointment record inserted successfully...');</script>";
			}
			else
			{
				echo mysqli_error($con);
			}
		}
}
if(isset($_GET[editid]))
{
	$sql="SELECT * FROM appointment WHERE appointmentid='$_GET[editid]' ";
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
      <li class="first">Add New Appointment</li></ul>
  </div>
</div>
<div class="wrapper col4">
  <div id="container">
    <h1>Appointment record Approval Process</h1>
   <form method="post" action="" name="frmappnt" onSubmit="return validateform()">
  
    <table width="448" border="3">                
        <tr>
          <td width="136">Patient</td>
          <td width="292">
            <?php
			if(isset($_GET[patientid]))
			{
				$sqlpatient= "SELECT * FROM patient WHERE patientid='$_GET[patientid]'";
				$qsqlpatient = mysqli_query($con,$sqlpatient);
				$rspatient=mysqli_fetch_array($qsqlpatient);
				echo $rspatient[patientname] . " (Patient ID - $rspatient[patientid])";
			}
			else
			{
				$sqlpatient= "SELECT * FROM patient WHERE status='Active'";
				$qsqlpatient = mysqli_query($con,$sqlpatient);
				while($rspatient=mysqli_fetch_array($qsqlpatient))
				{
					if($rspatient[patientid] == $rsedit[patientid])
					{
					echo "<option value='$rspatient[patientid]' selected> $rspatient[patientname](Patient ID - $rspatient[patientid])</option>";
					}
				}
			}
		  ?>
      </td>
        </tr>

        <tr>
          <td>Department</td>
          <td><select name="select5" id="select5">
           <option value="">Select</option>
            <?php
		  	$sqldepartment= "SELECT * FROM department WHERE status='Active'";
			$qsqldepartment = mysqli_query($con,$sqldepartment);
			while($rsdepartment=mysqli_fetch_array($qsqldepartment))
			{
				if($rsdepartment[departmentid] == $rsedit[departmentid])
				{
	echo "<option value='$rsdepartment[departmentid]' selected>$rsdepartment[departmentname]</option>";
				}
				else
				{
  echo "<option value='$rsdepartment[departmentid]'>$rsdepartment[departmentname]</option>";
				}
				
			}
		  ?>
          </select></td>
        </tr>
		
        <tr>
          <td>Doctor</td>
          <td><select name="select6" id="select6">
            <option value="">Select</option>
            <?php
          	$sqldoctor= "SELECT * FROM doctor INNER JOIN department ON department.departmentid=doctor.departmentid WHERE doctor.status='Active'";
			$qsqldoctor = mysqli_query($con,$sqldoctor);
			while($rsdoctor = mysqli_fetch_array($qsqldoctor))
			{
				if($rsdoctor[doctorid] == $rsedit[doctorid])
				{
					echo "<option value='$rsdoctor[doctorid]' selected>$rsdoctor[doctorname] ( $rsdoctor[departmentname] ) </option>";
				}
				else
				{
					echo "<option value='$rsdoctor[doctorid]'>$rsdoctor[doctorname] ( $rsdoctor[departmentname] )</option>";				
				}
			}
		  ?>
          </select></td>
        </tr>
		
        <tr>
          <td>Appointment Date</td>
          <td><input type="date" name="appointmentdate" id="appointmentdate" value="<?php echo $rsedit[appointmentdate]; ?>" /></td>
        </tr>
        <tr>
          <td>Appointment Time</td>
          <td><input type="time" name="time" id="time" value="<?php echo $rsedit[appointmenttime]; ?>" /></td>
        </tr>
        <tr>
          <td>Appointment reason</td>
          <td><textarea name="appreason" id="appreason" style="width:300px;height:100px;"><?php echo $rsedit[app_reason]; ?></textarea></td>         
        </tr>
        <tr>
          <td colspan="2" align="center"><input type="submit" name="submit" id="submit" value="Submit" /></td>
        </tr>
      </tbody>
    </table>
    </form>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="application/javascript">
function validateform()
{
	if(document.frmappnt.select4.value == "")
	{
		alert("Patient name should not be empty..");
		document.frmappnt.select4.focus();
		return false;
	}

	else if(document.frmappnt.select5.value == "")
	{
		alert("Department name should not be empty..");
		document.frmappnt.select5.focus();
		return false;
	}
	else if(document.frmappnt.appointmentdate.value == "")
	{
		alert("Appointment date should not be empty..");
		document.frmappnt.appointmentdate.focus();
		return false;
	}
	else if(document.frmappnt.time.value == "")
	{
		alert("Appointment time should not be empty..");
		document.frmappnt.time.focus();
		return false;
	}
	else if(document.frmappnt.select6.value == "")
	{
		alert("Doctor name should not be empty..");
		document.frmappnt.select6.focus();
		return false;
	}
	else if(document.frmappnt.select.value == "" )
	{
		alert("Kindly select the status..");
		document.frmappnt.select.focus();
		return false;
	}
	else
	{
		return true;
	}
}
$('.out_patient').hide();
$('#apptype').change(function()
{
	apptype=$('#apptype').val();
	if(apptype=='InPatient')
	{
		$('.out_patient').show();
	}
	else
	{
		$('.out_patient').hide();
	}
});
</script>