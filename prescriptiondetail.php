<table width="200" border="3">
      <tbody>
        <tr>
          <th><strong>Doctor</strong></th>
          <th><strong>Patient</strong></th>
          <th><strong>Prescription Date</strong></th>
          <th><strong>View</strong></th>              
        </tr>
<?php
$sql ="SELECT * FROM prescription WHERE patientid='$_GET[patientid]' AND appointmentid='$_GET[appointmentid]'";
$qsql = mysqli_query($con,$sql);
while($rs = mysqli_fetch_array($qsql))
{
	$sqlpatient = "SELECT * FROM patient WHERE patientid='$rs[patientid]'";
	$qsqlpatient = mysqli_query($con,$sqlpatient);
	$rspatient = mysqli_fetch_array($qsqlpatient);
	
	$sqldoctor = "SELECT * FROM doctor WHERE doctorid='$rs[doctorid]'";
	$qsqldoctor = mysqli_query($con,$sqldoctor);
	$rsdoctor = mysqli_fetch_array($qsqldoctor);

            echo "<tr>
              		<td>&nbsp;$rsdoctor[doctorname]</td>
              		<td>&nbsp;$rspatient[patientname]</td>
               		<td>&nbsp;$rs[prescriptiondate]</td>
					<td><a href='prescriptionrecord.php?prescriptionid=$rs[0]&patientid=$rs[patientid]' >View</td>
            </tr>";
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
  
  </tbody>
</table>

<?php
if(isset($_SESSION[doctorid]))
{
?>  
<hr>
	<table>
		<tr>
			<td>
			<div align="center"><strong><a href="prescription.php?patientid=<?php echo $_GET[patientid]; ?>&appid=<?php echo $rsappointment[appointmentid]; ?>">Add Prescription records</a></strong></div>
			</td>
		</tr>
	</table>
<?php
}
?>