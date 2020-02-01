<?php	
	//Check to make sure we have an idAttendee
	session_name('AppleProApps');
	session_start();
	if ($_SESSION['idAttendee'] == '') {
		header ("Location: profile.php");
	}	
	
	//Register the user in the database
	require_once ('includes/mysql_connect.php'); //Map the Connection.
	
	//Display the classes with the counter information.
	$sql_query = "select corpclasses.idClass, corpclasses.chrClass, corpclasses.txtDescription, corpclasses.dtBegin as dtOrder, TIME_FORMAT(corpclasses.dtBegin,'%l:%i %p') as dtBegin,
	DATE_FORMAT(corpclasses.dtDate,'%W, %M, %D') as dtDate, TIME_FORMAT(corpclasses.dtEnd,'%l:%i %p') as dtEnd, corpclasses.intSeats, 
	(select idStatus from corpregistration where idClass = corpclasses.idClass and idAttendee = '".$_SESSION['idAttendee']."') as idStatus,
	(select count(idAttendee) from corpregistration where idClass = corpclasses.idClass) as intSignedUp
	FROM corpclasses
	ORDER BY corpclasses.dtDate, dtOrder ASC";
	
	$result = @mysql_query ($sql_query); //Run the query.
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
    <td bgcolor="#ffffff"><form name="form1" method="post" action="sendconfirmation.php">
      <table width="100%"  border="0" cellspacing="0" cellpadding="10">
        <tr>
          <td><table width="100%"  border="0" cellspacing="0" cellpadding="3">
            <tr>
              <td><font face="Arial, Helvetica, sans-serif" size="3"><strong>Classes for Remix</strong></font></td>
            </tr>
            <tr>
              <td bgcolor="#CCCCCC"><font size="1" face="Arial, Helvetica, sans-serif">Listed below are all of the scheduled classes. To sign up for a class please click on the option to the far right of each class. When you are finished signing up for classes please click Finished below. </font></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
            <tr style="font-family:Arial, Helvetica, sans-serif; font-size:10px; font-weight:bold;">
              <td height="20" background="images/list_head.gif">&nbsp;Class&nbsp;</td>
			  <td height="20" background="images/list_head.gif">&nbsp;Date&nbsp;</td>
              <td height="20" background="images/list_head.gif">&nbsp;Begins&nbsp;</td>
              <td height="20" background="images/list_head.gif">&nbsp;Ends&nbsp;</td>
              <td height="20" background="images/list_head.gif" nowrap>&nbsp;Available&nbsp;</td>
              <td height="20" background="images/list_head.gif" nowrap>&nbsp;Assigned&nbsp;</td>
              <td height="20" background="images/list_head.gif">&nbsp;Options&nbsp;</td>
            </tr>
<?php //we need to convert this to work
	$Records = TRUE; //Prime the Record Switch	
	//If there are not records then we need to print an error
	while ($classes = mysql_fetch_array ($result, MYSQL_ASSOC)) { // page 383
		//move to the first record of the counter function
		//$counter = mysql_fetch_array ($result2, MYSQL_ASSOC);
?>		    <tr style="font-family:Arial, Helvetica, sans-serif; font-size:10px; font-weight:bold;">
              <td height="20">&nbsp;<?=$classes['chrClass']?></td>
			  <td height="20">&nbsp;<?=$classes['dtDate']?></td>
              <td height="20">&nbsp;<?=$classes['dtBegin']?></td>
              <td height="20">&nbsp;<?=$classes['dtEnd']?></td>
              <td height="20" align="center">&nbsp;<?=$classes['intSeats']?></td>
              <td height="20" align="center">&nbsp;<?=$classes['intSignedUp']?></td>
              <td height="20">&nbsp;<? if($classes['idStatus'] === 'A') {echo("<strong><font color='#333333'>Assigned</strong></font>");} elseif($classes['idStatus'] === 'W') {echo("<font color='#FF0000'><strong>Waiting List</strong></font>");} else {echo("<a href=\"signup.php?idClass={$classes['idClass']}\">Signup</a>");} ?></td>
			  <!-- <? print_r($classes); ?> -->
            </tr>
			<tr>
              <td height="20" colspan="4" style="padding-left:1px; font-style:italic; font-family:Arial, Helvetica, sans-serif; font-size:10px; padding-bottom:5px; color:#666666;"><?=$classes['txtDescription']?></td>
			  <td height="20" colspan="3"></td>
            </tr>
			<tr bgcolor="#CCCCCC">
              <td height="1" colspan="7"><img src="images/CCCCCC-dot.gif" width="1" height="1"></td>
              </tr>
<?		$Records = FALSE; //set the records flag to ok			
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
	
	mysql_close(); //close the MySQL Connection
?>
          </table></td>
        </tr>
        <tr>
          <td align="center"><input type="submit" name="Submit" value="Finished Send Confirmation Email"></td>
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
