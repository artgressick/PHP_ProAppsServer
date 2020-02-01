<?php
	include('includes/redirector.php');
	
	//Register the user in the database
	require_once ('includes/mysql_connect.php'); //Map the Connection.
	
	//Display the classes with the counter information.
	$sql_query = "select corpclasses.idClass, corpclasses.chrClass, DATE_FORMAT(corpclasses.dtDate, '%W') as Day, TIME_FORMAT(corpclasses.dtBegin,'%l:%i %p') as dtBegin,
	TIME_FORMAT(corpclasses.dtEnd,'%l:%i %p') as dtEnd, corpclasses.intSeats, 
	(select idStatus from corpregistration where idClass = corpclasses.idClass and idAttendee = '".$_REQUEST['idAttendee']."') as idStatus,
	(select count(idAttendee) from corpregistration where idClass = corpclasses.idClass) as intSignedUp
	FROM corpclasses
	WHERE corpclasses.idEvent = '".$_COOKIE['idEvent']."'
	ORDER BY dtDate, dtBegin ASC";
	
	//Removed from the SQL query above
	//AND dtDate = date_format(NOW(), '%Y-%m-%d')
	
	
	//select c.idClass, c.chrClass, dtBegin as orgTime, TIME_FORMAT(c.dtBegin,'%l:%i %p') as dtBegin, 
	//TIME_FORMAT(c.dtEnd,'%l:%i %p') as dtEnd, c.intSeats, count(s.idClass) as intSignedUp, s.idStatus, s.idAttendee 
	//FROM corpclasses AS c
	//LEFT OUTER JOIN corpregistration AS s ON (c.idClass = s.idClass AND s.idAttendee = '".$_REQUEST['idAttendee']."')
	//WHERE c.idEvent = '".$_COOKIE['idEvent']."'
	//AND dtDate = NOW()
	//GROUP BY c.idClass, c.chrClass, c.dtBegin, c.dtEnd, c.intSeats
	//ORDER BY orgTime ASC";
	
	$result = @mysql_query ($sql_query); //Run the query.

	//Display the classes with the counter information.
	//$sql_query2 = "select dtBegin, count(corpregistration.idClass) as intSignedUp FROM corpregistration JOIN corpclasses
	//ON corpregistration.idClass = corpclasses.idClass
	//WHERE corpregistration.idEvent = '".$_COOKIE['idEvent']."'
	//AND dtDate = NOW()
	//GROUP BY dtBegin
	//ORDER BY dtBegin ASC";
	
	//$result2 = @mysql_query ($sql_query2); //Run the query.
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Apple Pro Applications Classroom</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
<META HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE">
<META HTTP-EQUIV="EXPIRES" CONTENT="0">
<meta http-equiv="refresh" content="1200;URL=index.php">
<META NAME="Author" CONTENT="Arthur Gressick - techIT Solutions LLC.">
<META NAME="Keywords" CONTENT="Lead Tracking">
<META NAME="Description" CONTENT="Lead Tracking - Leader in Customized Solutions.">
<LINK REL="home" HREF="http://proappsclassroom.itechit.com/">
<LINK REL="index" HREF="http://proappsclassroom.itechit.com/">
<link href="includes/styles.css" rel="stylesheet" type="text/css">
</head>
<body bgcolor="#8993A3" topmargin="0" leftmargin="0" marginheight="0" marginwidth="0" alink="#0000FF" onLoad="refresh()">
<?php
	include('includes/top.htm');
?>
<table width="698" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="10" background="images/fadeleft.gif"><img src="images/fadeleft.gif" width="10" height="1"></td>
    <td bgcolor="#ffffff"><form name="form1" method="post" action="index.php">
      <table width="100%"  border="0" cellspacing="0" cellpadding="10">
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><table width="100%"  border="0" cellspacing="0" cellpadding="3">
            <tr>
              <td><font face="Arial, Helvetica, sans-serif" size="3"><strong>Today's Classes</strong></font></td>
            </tr>
            <tr>
              <td bgcolor="#CCCCCC"><font size="1" face="Arial, Helvetica, sans-serif">Listed below are all of the classes scheduled for today. To sign up for a class please click on the option to the far right of each class. You will only be allowed to sign up for classes for today. Please come back to sign up for classes on another day. When you are finished signing up for classes please click Finished below. </font></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td colspan="6"><table width="100%"  border="0" cellspacing="0" cellpadding="3">
                <tr>
                  <td><strong><font size="2" face="Arial, Helvetica, sans-serif">Classes for <?php echo(date('F j, Y')); ?></font></strong></td>
                </tr>
              </table></td>
              </tr>
            <tr bgcolor="#CCCCCC">
              <td height="20"><strong><font size="1" face="Arial, Helvetica, sans-serif">&nbsp;Class</font></strong></td>
			  <td height="20"><strong><font size="1" face="Arial, Helvetica, sans-serif">&nbsp;Date</font></strong></td>
              <td height="20"><strong><font size="1" face="Arial, Helvetica, sans-serif">&nbsp;Begin Time </font></strong></td>
              <td height="20"><strong><font size="1" face="Arial, Helvetica, sans-serif">&nbsp;End Time </font></strong></td>
              <td height="20"><strong><font size="1" face="Arial, Helvetica, sans-serif">&nbsp;Total Seats</font></strong></td>
              <td height="20"><strong><font size="1" face="Arial, Helvetica, sans-serif">&nbsp;Signed Up</font></strong></td>
              <td height="20"><strong><font size="1" face="Arial, Helvetica, sans-serif">&nbsp;Options</font></strong></td>
            </tr>
<?php //we need to convert this to work
	$Records = TRUE; //Prime the Record Switch	
	//If there are not records then we need to print an error
	while ($classes = mysql_fetch_array ($result, MYSQL_ASSOC)) { // page 383
		//move to the first record of the counter function
		//$counter = mysql_fetch_array ($result2, MYSQL_ASSOC);
?>		    <tr>
              <td height="20"><font size="1" face="Arial, Helvetica, sans-serif">&nbsp;<?php echo($classes['chrClass'])?></font></td>
			  <td height="20"><font size="1" face="Arial, Helvetica, sans-serif">&nbsp;<?php echo($classes['Day'])?></font></td>
              <td height="20"><font size="1" face="Arial, Helvetica, sans-serif">&nbsp;<?php echo($classes['dtBegin'])?></font></td>
              <td height="20"><font size="1" face="Arial, Helvetica, sans-serif">&nbsp;<?php echo($classes['dtEnd'])?></font></td>
              <td height="20"><font size="1" face="Arial, Helvetica, sans-serif">&nbsp;<?php echo($classes['intSeats'])?></font></td>
              <td height="20"><font size="1" face="Arial, Helvetica, sans-serif">&nbsp;<?php echo($classes['intSignedUp'])?></font></td>
              <td height="20"><font size="1" face="Arial, Helvetica, sans-serif">&nbsp;
	<?php if($classes['idStatus'] === 'A') {echo("<strong><font color='#333333'>Assigned</strong></font>");} 
	elseif($classes['idStatus'] === 'W') {echo("<font color='#FF0000'><strong>Waiting List</strong></font>");} 
	else {echo("<a href=\"signup.php?idClass={$classes['idClass']}&idAttendee={$_REQUEST['idAttendee']}\">Signup</a>");} ?>
			   </td>
			  
            </tr>
			<tr bgcolor="#CCCCCC">
              <td height="1" colspan="7"><img src="images/CCCCCC-dot.gif" width="1" height="1"></td>
            </tr>
<?php
	$Records = FALSE; //set the records flag to ok			
	} //End the while loop
	
	//If there were no records then print the no records
	if ($Records) {	
		echo'<tr align="center">
              <td height="20" colspan="6"><font size="1" face="Arial, Helvetica, sans-serif">There are no classes today. Please try again tomorrow. </font></td>
              </tr>
            <tr bgcolor="#CCCCCC">
              <td height="1" colspan="6"><img src="images/CCCCCC-dot.gif" width="1" height="1"></td>
              </tr>';
	}
?>
          </table></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td align="center"><input type="submit" name="Submit" value="Finished"></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table>
    </form>    </td>
    <td width="10" background="images/faderight.gif"><img src="images/faderight.gif" width="10" height="1"></td>
  </tr>
</table>
<?php
	include('includes/bottom.htm');
?>
</body>
</html>
