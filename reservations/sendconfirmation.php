<?php # Script 1.0 - Sending out the email to the attendees

//Get the variables
	session_name('AppleProApps');
	session_start();
	$idAttendee = $_SESSION['idAttendee'];
	$chrFirst = $_SESSION['chrFirst'];
	$chrLast = $_SESSION['chrLast'];
	$chrEmail = $_SESSION['chrEmail'];
	$idEvent = 40;

//Get the list of the classes for the attendee.

	//Register the user in the database
	require_once ('includes/mysql_connect.php'); //Map the Connection.

	//Make the query
	$sql_query = "SELECT chrClass, txtDescription,  TIME_FORMAT(dtBegin,'%l:%i %p') as dtBegin, DATE_FORMAT(dtDate,'%W, %M, %D') as dtDate, TIME_FORMAT(dtEnd,'%l:%i %p') as dtEnd
	FROM corpclasses
	WHERE idClass in (SELECT idClass FROM corpregistration where idAttendee = '".$_SESSION['idAttendee']."')
	ORDER BY corpclasses.dtDate, corpclasses.dtBegin";
	$result = @mysql_query ($sql_query); //Run the query.
	
	
	//$chrFirst = stripslashes($row['input_first_name']);
	$MailHeaders = "From: Apple Applications Marketing Events <proapps_events@apple.com>\n";
	//$chrFirst = "Arthur";
	//$chrLast = "Gressick";
	//$chrEmail = "artgressick@gmail.com";
	$Subject = "Apple Hands On Class Registration for Remix Hotel";
	$Message = "Dear Attendee,\n\n";
	$Message .= "Thank you for registering for the Apple Classroom at Remix Hotel Miami.  You are registered for the following classes.\n\n\n";
	
	//Build the email message to send to the person
	while ($classes = mysql_fetch_array ($result, MYSQL_ASSOC)) { // page 383
		$Message .= " ".$classes['chrClass']." on ".$classes['dtDate']." at ".$classes['dtBegin']." to ".$classes['dtEnd']."\n\n";
	}
	
	$Message .= "\nPlease arrive 5 min prior to the class start time.  Classes will be held in the Martini Room of the National Hotel.\n\n";
	$Message .= "Thank you for your interest in Logic Studio.\n\n";
	$Message .= "Regards,\n";
	$Message .= "Apple Pro Applications Marketing";
	
	
	mail($chrFirst . ' ' . $chrLast . '<' . $chrEmail . '>', $Subject, $Message, $MailHeaders);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<?php
	include('includes/title-meta.htm');
?>
</head>
<body bgcolor="#8993A3" topmargin="0" leftmargin="0" marginheight="0" marginwidth="0" alink="#0000FF" onLoad="document.form2.chrBadge.focus()">
<?php
	include('includes/top.htm');
?>
<table width="698" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="10" background="images/fadeleft.gif"><img src="images/fadeleft.gif" width="10" height="1"></td>
    <td width="678" valign="top" bgcolor="#ffffff"><table width="100%" border="0" cellspacing="0" cellpadding="10">
		<tr>
			<td width="50%" align="center"><img src="images/logo2.gif" width="234" height="160"></td>
			<td width="50%"><div style="text-align:left; font-family:Arial, Helvetica, sans-serif; size: 12 px;">Thank you. An email has been sent to your email address you have supplied.</div>
				<div style="text-align:center; font-family:Arial, Helvetica, sans-serif; size:12px; padding-top:25px;"><a href="profile.php">Signup Today</a>.</div></td>
		</tr>
	</table></td>
    <td width="10" background="images/faderight.gif"><img src="images/faderight.gif" width="10" height="1"></td>
  </tr>
</table>
<?php
	include('includes/bottom.htm');
?>
</body>
</html>
