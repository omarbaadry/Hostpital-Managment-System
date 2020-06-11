<?php
include("dbconnection.php");
if(isset($_POST[submitpat]))
{
	$sql ="INSERT INTO patient(patientname,admissiondate,admissiontime,address,mobileno,gender,dob) values('$_POST[patientname]','$_POST[admissiondate]','$_POST[admissiontime]','$_POST[address]','$_POST[mobilenumber]','$_POST[select]','$_POST[dateofbirth]')";
	if($qsql = mysqli_query($con,$sql))
	{
		echo "<script>alert('patients record inserted successfully...');</script>";
	}
	else
	{
		echo mysqli_error($con);
	}
}

if(isset($_GET[editid]))
{
	$sql="SELECT * FROM patient WHERE patientid='$_GET[editid]' ";
	$qsql = mysqli_query($con,$sql);
	$rsedit = mysqli_fetch_array($qsql);
	
}
?>
<?php
if(!isset($_GET[patientid]))
{
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
<form method="post" action="" name="frmpatdet" onSubmit="return validateform()">
      <table width="808" border="1">
      <tbody>
     <tr>
                <td width="17%"><strong>Patient Name </strong></td>
                <td width="41%"><input type="text" name="patientname" id="patientname"/></td>
                <td width="16%"><strong>Patient ID</strong></td>
                <td width="26%"><input type="text" name="patientid" id="patientid" /></td>
        </tr>
              <tr>
                <td><strong>Address</strong></td>
                <td align="right"><textarea name="address" id="address" cols="45" rows="5"> </textarea></td>
                <td><strong>Gender</strong></td>
                <td><label for="select"></label>
                  <select name="select" id="select">
                    <option value="">Select</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                  </select></td>
              </tr>
              <tr>
                <td><strong>Contact Number</strong></td>
                <td><input type="text" name="mobilenumber" id="mobilenumber"/></td>
                <td><strong>Date Of Birth </strong></td>
                <td><input type="date" name="dateofbirth" id="dateofbirth" /></td>
              </tr>
              <tr>
                <td colspan="4" align="center"><input type="submit" name="submitpat" id="submitpat" value="Submit" /></td>
              </tr>
        </tbody>
  </table>     
  <button onclick="goBack()">Go Back</button>

<script>
function goBack() {
  window.history.back();
}
</script>  
    </form>
<?php
}
else
{
$sqlpatient = "SELECT * FROM patient where patientid='$_GET[patientid]'";
$qsqlpatient = mysqli_query($con,$sqlpatient);
$rspatient=mysqli_fetch_array($qsqlpatient);
?>

    <table width="808" border="1">
      <tbody>
        <tr>
          <td width="16%"><strong>Patient Name </strong></td>
          <td width="34%">&nbsp;<?php echo $rspatient[patientname]; ?></td>
          <td width="16%"><strong>Patient ID</strong></td>
          <td width="34%">&nbsp;<?php echo $rspatient[patientid]; ?></td>
        </tr>
        <tr>
          <td><strong>Address</strong></td>
          <td>&nbsp;<?php echo $rspatient[address]; ?></td>
          <td><strong>Gender</strong></td>
          <td> <?php echo $rspatient[gender];?></td>
        </tr>
        <tr>
          <td><strong>Contact Number</strong></td>
          <td>&nbsp;<?php echo $rspatient[mobileno]; ?></td>
          <td><strong>Date Of Birth </strong></td>
          <td>&nbsp;<?php echo $rspatient[dob]; ?></td>
        </tr>
      </tbody>
    </table>
<?php
}
?>
<script type="application/javascript">
function validateform()
{
	if(document.frmpatdet.patientname.value == "")
	{
		alert("Patient name should not be empty..");
		document.frmpatdet.patientname.focus();
		return false;
	}
	else if(document.frmpatdet.patientid.value == "")
	{
		alert("Patient ID should not be empty..");
		document.frmpatdet.patientid.focus();
		return false;
	}
	else if(document.frmpatdet.admissiondate.value == "")
	{
		alert("Admission date should not be empty..");
		document.frmpatdet.admissiondate.focus();
		return false;
	}
	else if(document.frmpatdet.admissiontime.value == "")
	{
		alert("Admission time should not be empty..");
		document.frmpatdet.admissiontime.focus();
		return false;
	}
	else if(document.frmpatdet.address.value == "")
	{
		alert("Address should not be empty..");
		document.frmpatdet.address.focus();
		return false;
	}
	else if(document.frmpatdet.select.value == "")
	{
		alert("Gender should not be empty..");
		document.frmpatdet.select.focus();
		return false;
	}
	else if(document.frmpatdet.mobilenumber.value == "")
	{
		alert("Contact number should not be empty..");
		document.frmpatdet.mobilenumber.focus();
		return false;
	}
	else if(document.frmpatdet.dateofbirth.value == "")
	{
		alert("Date Of Birth should not be empty..");
		document.frmpatdet.dateofbirth.focus();
		return false;
	}
	
	else
	{
		return true;
	}
}
</script>