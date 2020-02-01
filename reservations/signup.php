<?php # Script 1.0 - Signup Attendee

// This page is designed to allow for Attendee to signup for the class they selected.
// Directions below should tell you more about how this works.

//Get the variables
	session_name('AppleProApps');
	session_start();
	$idClass = $_REQUEST['idClass'];
	$idAttendee = $_SESSION['idAttendee'];
	$idEvent = 40;
	
	//Register the user in the database
	require_once ('includes/mysql_connect.php'); //Map the Connection.
	
	//Make the query
	$query1 = "SELECT count(idRegistration) as intClasses 
	FROM corpregistration
	WHERE idAttendee = '".$idAttendee."' and idClass = '".$idClass."'";
	$result = mysql_query ($query1); //Run the query.
	$checker = mysql_fetch_array ($result, MYSQL_ASSOC);
	
	if ($checker['intClasses'] > 0) { //if the user has already signed up for this event then they cannot sign up again.
		//The user has indeed signed up for this class already we need to set a flag and continue.
		$FlagMessage = "Error, You have already signed up for this class.";			
	} else { //else they have not signed up.
		//They have not previously signed up so we have to count the seats available to see if they will fit.
		//Make the query for counting the records
		$query2 = "SELECT cc.intSeats, count(cr.idRegistration) as intSignedUp
		FROM corpclasses cc LEFT OUTER JOIN corpregistration cr USING (idClass)
		WHERE cc.idClass = '".$idClass."'
		GROUP by intSeats";
		$result2 = mysql_query($query2);
		$counting = mysql_fetch_array ($result2, MYSQL_ASSOC); //Run the query.

		//now here is where we decide if there is any seats available or not.
		if ($counting['intSignedUp'] >= $counting['intSeats']) { //if Signed Up already is Greater or Equal to Available then we have to put them on a waiting list
			//Waiting list section here
			$query = "INSERT INTO corpregistration (idEvent, idClass, idAttendee, idStatus)
			VALUES ('".$idEvent."','".$idClass."','".$idAttendee."','W')";
			$result = mysql_query ($query); //Run the query.

			//Now we need to make a message
			$FlagMessage = "Class Full. We apologize but this class is full. We have placed you on the waiting list.";
		} else { //There is room for them to signup for the class
			//They are Assigned
			$query = "INSERT INTO corpregistration (idEvent, idClass, idAttendee, idStatus)
			VALUES ('".$idEvent."','".$idClass."','".$idAttendee."','A')";
			$result = mysql_query ($query); //Run the query.

			//Now we need to make a message
			$FlagMessage = "Congratulations, You have been successfully added to this class.";
		}
	}
	mysql_close(); //close the connection
	//header ('Location: classes.php?idAttendee='.$idAttendee);
	//exit();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<?php
	include('includes/title-meta.htm');
?>
</head>
<body bgcolor="#8993A3" topmargin="0" leftmargin="0" marginheight="0" marginwidth="0" alink="#0000FF">
<?php
	include('includes/top.htm');
?>
<table width="698" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="10" background="images/fadeleft.gif"><img src="images/fadeleft.gif" width="10" height="1"></td>
    <td bgcolor="#ffffff"><form name="form1" method="post" action="classes.php">
      <table width="100%"  border="0" cellspacing="0" cellpadding="10">
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><table width="100%"  border="0" cellspacing="0" cellpadding="3">
            <tr>
              <td><font face="Arial, Helvetica, sans-serif" size="3"><strong>Class Signup</strong></font></td>
            </tr>
            <tr>
              <td bgcolor="#CCCCCC"><font size="1" face="Arial, Helvetica, sans-serif">Your information has been entered into the database.</font></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td align="center"><strong><font color="#0000FF" size="2" face="Arial, Helvetica, sans-serif"><?php  echo "{$FlagMessage}"; ?></font></strong></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><input type="submit" name="Submit" value="Return to Class List">
            <input type="hidden" name="idAttendee" value="<?php  echo "{$_REQUEST['idAttendee']}"; ?>"></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table>
    </form></td>
    <td width="10" background="images/faderight.gif"><img src="images/faderight.gif" width="10" height="1"></td>
  </tr>
</table>
<?php
	include('includes/bottom.htm');
?>
</body>
</html>
