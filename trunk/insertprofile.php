<?php # Script 1.0 - Upload Badge

// This page will gather all of the information from the previous page and enter it into the database.
include('includes/redirector.php');

//Check the posting of the page to make sure is was not by-passed
if (isset($_POST['Submit'])) {

	//setup arrary for errors
	$errors = array();
	
	$idEvent = $_COOKIE['idEvent'];
	$chrFirst = $_POST['chrFirst'];
	$chrLast = $_POST['chrLast'];
	$chrTitle = $_POST['chrTitle'];
	$chrCompany = $_POST['chrCompany'];
	$chrAddress = $_POST['chrAddress'];
	$chrAddress2 = $_POST['chrAddress2'];
	$chrCity = $_POST['chrCity'];
	$chrState = $_POST['chrState'];
	$chrZip = $_POST['chrZip'];
	$chrCountry = $_POST['chrCountry'];
	$chrPhone = $_POST['chrPhone'];
	$chrEmail = $_POST['chrEmail'];
	//
	$chrOrgType = $_POST['chrOrgType'];
	$chrOrgSize = $_POST['chrOrgSize'];
	//
	$chrOS = $_POST['chrOS'];
	$chrApplications = $_POST['chrApplications'];
	//	
	$chrContact = $_POST['chrContact'];
	$chrEContact = $_POST['chrEContact'];
	//
	$PreScanned = $_POST['PreScanned'];
	//
	$Q1a = $_POST['Q1a'];
	$Q1b = $_POST['Q1b'];
	$Q1c = $_POST['Q1c'];
	$Q1d = $_POST['Q1d'];
	$Q1e = $_POST['Q1e'];
	
	$Q2a = $_POST['Q2a'];
	$Q2b = $_POST['Q2b'];
	$Q2c = $_POST['Q2c'];
	$Q2d = $_POST['Q2d'];
	$Q2e = $_POST['Q2e'];
	$Q2f = $_POST['Q2f'];
	$Q2g = $_POST['Q2g'];
	
	$Q3a = $_POST['Q3a'];
	$Q3b = $_POST['Q3b'];
	$Q3c = $_POST['Q3c'];
	$Q3d = $_POST['Q3d'];
	$Q3e = $_POST['Q3e'];
	
	$Q4 = $_POST['Q4'];
	
	$Q5a = $_POST['Q5a'];
	$Q5b = $_POST['Q5b'];
	$Q5c = $_POST['Q5c'];
	$Q5d = $_POST['Q5d'];
	$Q5e = $_POST['Q5e'];
	$Q5f = $_POST['Q5f'];
	
	$Q6 = $_POST['Q6'];
	
	$org_badge = $_POST['badge'];
	
	//Register the user in the database
	require_once ('includes/mysql_connect.php'); //Map the Connection.
	
	//This is for Classroom signup
	$query = "INSERT INTO corpattendees (
	idEvent,
	chrLast,
	chrFirst,
	chrCompany,
	chrAddress,
	chrAddress2,
	chrCity,
	chrState,
	chrZip,
	chrCountry,
	chrPhone,
	chrEmail,
	chrOrgType,
	chrOrgSize,
	chrOS,
	chrApplications,
	chrOrganization,
	chrContact,
	chrEContact,
	PreScanned,
	Q1a,
	Q1b,
	Q1c,
	Q1d,
	Q1e,
	Q2a,
	Q2b,
	Q2c,
	Q2d,
	Q2e,
	Q2f,
	Q2g,
	Q3a,
	Q3b,
	Q3c,
	Q3d,
	Q3e,
	Q4,
	Q5a,
	Q5b,
	Q5c,
	Q5d,
	Q5e,
	Q5f,
	Q6,
	org_badge)
	VALUES (
	'".$idEvent."',
	'".$chrLast."',
	'".$chrFirst."',
	'".$chrCompany."',
	'".$chrAddress."',
	'".$chrAddress2."',
	'".$chrCity."',
	'".$chrState."',
	'".$chrZip."',
	'".$chrCountry."',
	'".$chrPhone."',
	'".$chrEmail."',
	'".$chrOrgType."',
	'".$chrOrgSize."',
	'".$chrOS."',
	'".$chrApplications."',
	'".$chrOrganization."',
	'".$chrContact."',
	'".$chrEContact."',
	'".$PreScanned."',
	'".$Q1a."',
	'".$Q1b."',
	'".$Q1c."',
	'".$Q1d."',
	'".$Q1e."',
	'".$Q2a."',
	'".$Q2b."',
	'".$Q2c."',
	'".$Q2d."',
	'".$Q2e."',
	'".$Q2f."',
	'".$Q2g."',
	'".$Q3a."',
	'".$Q3b."',
	'".$Q3c."',
	'".$Q3d."',
	'".$Q3e."',
	'".$Q4."',
	'".$Q5a."',
	'".$Q5b."',
	'".$Q5c."',
	'".$Q5d."',
	'".$Q5e."',
	'".$Q5f."',
	'".$Q6."',
	'".$org_badge."')";
	
	$result = @mysql_query($query) or $errors[] = mysql_error(); //Run the query.
?>
<?php	
	
	$idAttendee = mysql_insert_id();	
	
	if ($result) {
		//redirect the user to the homepage now.
		header ('Location: classes.php?idAttendee='.$idAttendee);
		exit();
			
	} else { //No match was made
		header ("Location: error.php".print_r($errors));
		exit();	
	}

	mysql_close(); //close the connection
} //end the statement and redirect if we went this far.
?>