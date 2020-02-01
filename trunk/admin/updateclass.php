<?php # Script 1.0 - Upload Badge

// This page will gather all of the information from the previous page and enter it into the database.
include('includes/security.php');

//Check the posting of the page to make sure is was not by-passed
if (isset($_POST['Submit'])) {

	$idClass = $_REQUEST['idClass'];
	$chrClass = $_POST['chrClass'];
	$dtDate = date("Ymd", strtotime($_POST['dtDate']));
	$dtBegin = date("His", strtotime($_POST['dtBegin']));
	$dtEnd = date("His", strtotime($_POST['dtEnd']));
	$intSeats = $_POST['intSeats'];
	$intWaitlist = $_POST['intWaitlist'];
	$txtDescription = $_POST['txtDescription'];
	
	//Register the user in the database
	require_once ('../includes/mysql_connect.php'); //Map the Connection.
	
	//Make the query
	$query = "UPDATE corpclasses SET
	chrClass = '".$chrClass."',
	txtDescription = '".$txtDescription."',
	dtDate = '".$dtDate."',
	dtBegin = '".$dtBegin."',
	dtEnd = '".$dtEnd."',
	intSeats = '".$intSeats."',
	intWaitlist = '".$intWaitlist."'
	WHERE idClass = '".$idClass."'";
	
	$result = @mysql_query ($query); //Run the query.
	
	if ($result) {
		//redirect the user to the homepage now.
		header ('Location: viewevent.php?idAdminEvent='.$_REQUEST['idAdminEvent']);
		exit();
			
	} else { //No match was made
		header ("Location: error2.php");
		exit();	
	}

	mysql_close(); //close the connection
} //end the statement and redirect if we went this far.
?>