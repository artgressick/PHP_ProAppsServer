<?php
	include('includes/security.php');
	
	//Register the user in the database
	require_once ('../includes/mysql_connect.php'); //Map the Connection.
	
	//Get the name of the event
	$sql_query1 = "SELECT chrEvent
	FROM corpevents
	WHERE idEvent = '".$_REQUEST['idAdminEvent']."'";
	$result1 = @mysql_query ($sql_query1); //Run the query.
	$event = mysql_fetch_array ($result1, MYSQL_ASSOC);
	
	//Get a list of classes to display
	$sql_query1 = "SELECT idClass, chrClass, Date_FORMAT(dtDate,'%M %D, %Y') as dtDate, DATE_FORMAT(dtBegin, '%h:%i %p') as dtStart, DATE_FORMAT(dtEnd, '%h:%i %p') as dtEnd,
	dtDate as dtOrder, intSeats, (select count(idAttendee) from corpregistration where idClass = corpclasses.idClass) as intSignedUp
	FROM corpclasses
	WHERE idEvent = '".$_REQUEST['idAdminEvent']."'
	ORDER BY dtOrder, dtBegin";
	$result2 = @mysql_query ($sql_query1); //Run the query.
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
    <td bgcolor="#ffffff">
      <table width="100%"  border="0" cellspacing="0" cellpadding="10">
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><table width="100%"  border="0" cellspacing="0" cellpadding="3">
            <tr>
              <td width="50%"><font face="Arial, Helvetica, sans-serif" size="3"><strong><?php echo "{$event['chrEvent']}" ?></strong></font></td>
              <td width="50%" align="right"><font size="2"><a href="addclass.php?idAdminEvent=<?php echo "{$_REQUEST['idAdminEvent']}" ?>"><font face="Arial, Helvetica, sans-serif">Add Class</font></a></font></td>
            </tr>
            <tr>
              <td colspan="2" bgcolor="#CCCCCC"><font size="1" face="Arial, Helvetica, sans-serif">This is the class list for this event. Click on the View Attendees link for a list of the Attendees signed up for that class.</font></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
            <tr bgcolor="#CCCCCC">
              <td height="20"><strong><font size="1" face="Arial, Helvetica, sans-serif">&nbsp;Classes</font></strong></td>
              <td height="20"><strong><font size="1" face="Arial, Helvetica, sans-serif">&nbsp;Date</font></strong></td>
			  <td height="20"><strong><font size="1" face="Arial, Helvetica, sans-serif">&nbsp;Start Time</font></strong></td>
              <td height="20"><strong><font size="1" face="Arial, Helvetica, sans-serif">&nbsp;End Time</font></strong></td>
			  <td height="20"><strong><font size="1" face="Arial, Helvetica, sans-serif">&nbsp;Seats</font></strong></td>
			  <td height="20"><strong><font size="1" face="Arial, Helvetica, sans-serif">&nbsp;Signed Up</font></strong></td>
              <td height="20"><strong><font size="1" face="Arial, Helvetica, sans-serif">&nbsp;Class List</font></strong></td>
              <td height="20"><strong><font size="1" face="Arial, Helvetica, sans-serif">&nbsp;Options</font></strong></td>
            </tr>
<?php //we need to convert this to work
	$Records = TRUE; //Prime the Record Switch	
	//If there are not records then we need to print an error
	while ($classes = mysql_fetch_array ($result2, MYSQL_ASSOC)) { // page 383
		echo "<tr>
              <td height=\"20\"><font size=\"1\" face=\"Arial, Helvetica, sans-serif\">&nbsp;{$classes['chrClass']}</font></td>
              <td height=\"20\"><font size=\"1\" face=\"Arial, Helvetica, sans-serif\">&nbsp;{$classes['dtDate']}</font></td>
              <td height=\"20\"><font size=\"1\" face=\"Arial, Helvetica, sans-serif\">&nbsp;{$classes['dtStart']}</font></td>
			  <td height=\"20\"><font size=\"1\" face=\"Arial, Helvetica, sans-serif\">&nbsp;{$classes['dtEnd']}</font></td>
			  <td height=\"20\"><font size=\"1\" face=\"Arial, Helvetica, sans-serif\">&nbsp;{$classes['intSeats']}</font></td>
			  <td height=\"20\"><font size=\"1\" face=\"Arial, Helvetica, sans-serif\">&nbsp;{$classes['intSignedUp']}</font></td>
              <td height=\"20\"><font size=\"1\" face=\"Arial, Helvetica, sans-serif\">&nbsp;<a href=\"viewattendees.php?idClass={$classes['idClass']}\">View</a></font></td>
              <td height=\"20\"><font size=\"1\" face=\"Arial, Helvetica, sans-serif\">&nbsp;<a href=\"editclass.php?idClass={$classes['idClass']}\">Edit</a> - <a href=\"removeclass.php?idClass={$classes['idClass']}\">Remove</a></font></td>
            </tr>
            <tr bgcolor=\"#CCCCCC\">
              <td height=\"1\" colspan=\"8\"><img src=\"images/CCCCCC-dot.gif\" width=\"1\" height=\"1\"></td>
              </tr>\n";
		$Records = FALSE; //set the records flag to ok			
	} //End the while loop
	
	//If there were no records then print the no records
	if ($Records) {
		echo'<tr align="center">
              <td height="20" colspan="8"><font size="1" face="Arial, Helvetica, sans-serif">There are currently no Classes listed in the database.</font> </td>
              </tr>
            <tr bgcolor="#CCCCCC">
              <td height="1" colspan="8"><img src="images/CCCCCC-dot.gif" width="1" height="1"></td>
              </tr>';
	}
	mysql_close(); //close the MySQL Connection
?>	
          </table></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table>
    </td>
    <td width="10" background="images/faderight.gif"><img src="images/faderight.gif" width="10" height="1"></td>
  </tr>
</table>
<?php
	include('includes/bottom.htm');
?>
</body>
</html>
